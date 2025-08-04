<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cta;
use App\Models\Faq;
use App\Models\Post;
use App\Models\About;
use App\Models\Brand;
use App\Models\Banner;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Category;
use App\Models\HomeAbout;
use App\Models\WhyChoseUs;
use App\Models\Achievement;
use App\Models\Promobanner;
use App\Models\ProjectVideo;
use App\Models\Returnrefund;
use Illuminate\Http\Request;
use App\Models\Privacypolicy;
use App\Models\Termscondition;
use App\Models\WebsiteSetting;
use App\Models\WebsiteSocialIcon;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();

        $promobanners = Promobanner::where('is_active', 1)
            ->latest()
            ->get(['id', 'image', 'url']);

        $about = About::first();
        $social_icon = WebsiteSocialIcon::select(['id', 'messanger_url'])->first();

        $featured_products = Product::with(['category:id,category_name'])
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->latest()
            ->limit(8)
            ->get(['id', 'category_id', 'product_name', 'product_slug', 'regular_price', 'discount_price', 'discount_type', 'thumbnail']);

        $achievements = Achievement::where('is_active', 1)
            ->latest()
            ->get(['id', 'title', 'count_number', 'image']);

        $reviews = Review::latest()->get(['id', 'name', 'profession', 'review', 'image']);

        $cta = Cta::where('is_active', 1)->first();

        $blogs = Post::latest()->take(3)->get();
        $products = Product::latest()->get();
        $brands = Brand::latest()->get();

        $homeAbout = HomeAbout::first();

        return view('website.home', compact(['banners', 'brands', 'products', 'achievements', 'reviews', 'about', 'featured_products', 'blogs', 'promobanners', 'social_icon', 'cta', 'homeAbout']));
    }

    public function shop(Request $request)
    {
        $minPrice = Product::min('discount_price');
        $maxPrice = Product::max('discount_price');

        $pageTitle = 'Shop';
        $query = Product::where('is_active', 1);

        if ($request->filled('category')) {
            $categoryIds = is_array($request->category) ? $request->category : [$request->category];
            $query->whereIn('category_id', $categoryIds);
        }

        if ($request->filled('category_slug')) {
            $category = Category::where('category_slug', $request->category_slug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($request->filled('min_price')) {
            $query->where('discount_price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('discount_price', '<=', $request->max_price);
        }

        if ($request->filled('brand')) {
            $brandIds = is_array($request->brand) ? $request->brand : [$request->brand];
            $query->whereIn('brand_id', $brandIds);
        }


        $products = $query->with('brand')
        ->latest()
            ->select([
                'id',
                'category_id',
                'brand_id',
                'product_name',
                'product_slug',
                'regular_price',
                'discount_price',
                'stock_quantity',
                'sizes',
                'discount_type',
                'thumbnail'
            ])
            ->paginate(12);

        if ($request->ajax()) {
            return view('website.layouts.pages.product.partials.products', compact('products'))->render();
        }

        $brands = Brand::with('products')->get(['id', 'brand_name']);

        return view('website.layouts.pages.product.shop-page', compact('products', 'brands', 'pageTitle', 'minPrice', 'maxPrice'));
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', 1)
            ->latest()
            ->take(4)
            ->get();
        $reviews = Review::latest()->get();
        return view('website.layouts.pages.product.detail', compact('product', 'reviews', 'relatedProducts'));
    }

//    public function productDetail($id)
//    {
//        $product = Product::with('category')->findOrFail($id);
//
//        $relatedProducts = Product::where('category_id', $product->category_id)
//            ->where('id', '!=', $product->id)
//            ->where('is_active', 1)
//            ->latest()
//            ->take(4)
//            ->get();
//
//        $reviews = Review::where('product_id', $product->id)
//            ->latest()
//            ->take(10)
//            ->get();
//
//        return view('website.layouts.pages.product.detail', compact('product', 'reviews', 'relatedProducts'));
//    }

    // Product search

    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $suggestions = Product::where('product_name', 'LIKE', '%' . $query . '%')
                ->orWhere('regular_price', 'LIKE', '%' . $query . '%')
                ->limit(5)
                ->get(['id', 'product_name', 'regular_price', 'discount_price', 'discount_type', 'thumbnail']);

            $formattedSuggestions = $suggestions->map(function ($product) {
                $final_price = $product->regular_price;
                $has_discount = false;

                if ($product->discount_price > 0) {
                    if ($product->discount_type === 'percent') {
                        $final_price = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                    } elseif ($product->discount_type === 'flat') {
                        $final_price = $product->regular_price - $product->discount_price;
                    }

                    // যদি ডিসকাউন্ট করার পরেও ফাইনাল প্রাইস রেগুলার প্রাইসের চেয়ে কম হয়, তাহলেই ডিসকাউন্ট ধরবো
                    $has_discount = $final_price < $product->regular_price;
                }

                return [
                    'id' => $product->id,
                    'product_name' => $product->product_name,
                    'regular_price' => $product->regular_price,
                    'discount_price' => $has_discount ? $final_price : null,
                    'final_price' => $has_discount ? $final_price : $product->regular_price,
                    'thumbnail' => $product->thumbnail ? asset($product->thumbnail) : asset('default.jpg'),
                    'url' => route('product_single.page', $product->id),
                ];
            });

            return response()->json(['suggestions' => $formattedSuggestions]);
        }

        return response()->json(['suggestions' => []]);
    }

    // Categorywise product filter
    public function multiCategoryFilter(Request $request)
    {
        $categoryIds = $request->input('category_ids', []);

        if (empty($categoryIds)) {
            // যদি কোন ক্যাটেগরি না থাকে, তাহলে সব প্রোডাক্ট রিটার্ন করো
            $products = Product::where('is_active', 1)
                ->latest()
                ->select(['id', 'category_id', 'product_name', 'product_slug', 'regular_price', 'discount_price', 'stock_quantity', 'discount_type', 'thumbnail'])
                ->paginate(12);

            $html = view('website.layouts.partials.product_list_partial', compact('products'))->render();
            return response()->json(['html' => $html]);
        } else {
            // নির্দিষ্ট ক্যাটেগরি অনুযায়ী প্রোডাক্ট আনো
            $products = Product::where('is_active', 1)->whereIn('category_id', $categoryIds)->latest()->get();

            $html = '';
            foreach ($products as $product) {
                $final_price = $product->regular_price;

                if ($product->discount_price > 0) {
                    if ($product->discount_type === 'percent') {
                        $final_price = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                    } elseif ($product->discount_type === 'flat') {
                        $final_price = $product->regular_price - $product->discount_price;
                    }
                }

                $html .= view('website.layouts.partials.product_search_by_category', compact('product', 'final_price'))->render();
            }

            return response()->json(['html' => $html]);
        }
    }

    public function priceFilter(Request $request)
    {
        $min = (float) $request->min_price;
        $max = (float) $request->max_price;

        $products = Product::all()->filter(function ($product) use ($min, $max) {
            $final_price = $product->regular_price;

            if ($product->discount_price > 0) {
                if ($product->discount_type === 'percent') {
                    $final_price -= ($product->regular_price * $product->discount_price) / 100;
                } elseif ($product->discount_type === 'flat') {
                    $final_price -= $product->discount_price;
                }
            }

            return $final_price >= $min && $final_price <= $max;
        });

        $html = '';

        foreach ($products as $product) {
            $final_price = $product->regular_price;

            if ($product->discount_price > 0) {
                if ($product->discount_type === 'percent') {
                    $final_price -= ($product->regular_price * $product->discount_price) / 100;
                } elseif ($product->discount_type === 'flat') {
                    $final_price -= $product->discount_price;
                }
            }

            $html .= view('website.layouts.partials.product_shop', compact('product', 'final_price'))->render();
        }

        return $html;
    }


    public function multiBrandFilter(Request $request)
    {
        $brandIds = $request->input('brand_ids', []);

        if (empty($brandIds)) {
            // যদি কোন ক্যাটেগরি না থাকে, তাহলে সব প্রোডাক্ট রিটার্ন করো
            $products = Product::where('is_active', 1)
                ->latest()
                ->select(['id', 'brand_id', 'product_name', 'product_slug', 'regular_price', 'discount_price', 'stock_quantity', 'discount_type', 'thumbnail'])
                ->paginate(12);

            $html = view('website.layouts.partials.product_list_partial', compact('products'))->render();
            return response()->json(['html' => $html]);
        } else {
            // নির্দিষ্ট ক্যাটেগরি অনুযায়ী প্রোডাক্ট আনো
            $products = Product::where('is_active', 1)->whereIn('brand_id', $brandIds)->latest()->get();

            $html = '';
            foreach ($products as $product) {
                $final_price = $product->regular_price;

                // Apply discount if available
                if ($product->discount_price > 0) {
                    if ($product->discount_type === 'percent') {
                        $final_price = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                    } elseif ($product->discount_type === 'flat') {
                        $final_price = $product->regular_price - $product->discount_price;
                    }
                }

                // Append the rendered HTML for each product
                $html .= view('website.layouts.partials.product_search_by_brand', compact('product', 'final_price'))->render();
            }

            return response()->json(['html' => $html]);
        }
    }

    public function termsAndCondtion()
    {
        $pageTitle = 'Term & Condition';
        $termsAndCondition = Termscondition::first();
        return view('website.layouts.terms_and_condition', compact('termsAndCondition', 'pageTitle'));
    }

    // Privacy policy page method
    public function privacyPolicyPage()
    {
        $pageTitle = 'Privacy policy';
        $privacyPolicy = Privacypolicy::first();
        return view('website.layouts.privacy_policy', compact('privacyPolicy', 'pageTitle'));
    }

    public function returnRefund()
    {
        $pageTitle = 'Return & Refund';
        $returnRefund = Returnrefund::first();
        return view('website.layouts.return_refund', compact('returnRefund', 'pageTitle'));
    }
}
