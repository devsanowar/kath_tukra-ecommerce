<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Brand;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.layouts.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get(['id', 'category_name']);
        $brands = Brand::latest()->get(['id', 'brand_name']);
        return view('admin.layouts.pages.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $productThumbnail = $this->productImage($request);
        $images = $this->productMultipleImages($request);
        Product::create([
            'category_id'       => $request->category_id,
            // 'subcategory_id' => $request->subcategory_id,
            'brand_id'          => $request->brand_id,
            'product_name'      => $request->product_name,
            'product_slug'      => Str::slug($request->product_name),
            // 'sku' => $request->sku,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'regular_price'     => $request->regular_price,
            'discount_price'    => $request->discount_price,
            'discount_type'     => $request->discount_type,
            'stock_quantity'    => $request->stock_quantity,
            // 'in_stock' => $request->in_stock,
            // 'colors' => $request->colors ? json_encode($request->colors) : null,
            'sizes'             => $request->sizes,
            'thumbnail'         => $productThumbnail,
            'images'            => $images ? json_encode($images) : null,
            'is_featured'       => $request->is_featured,
            'is_active'         => $request->is_active,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get(['id', 'category_name']);
        $brands = Brand::get(['id', 'brand_name']);
        return view('admin.layouts.pages.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     // Handle thumbnail
    //     if ($request->hasFile('thumbnail')) {
    //         if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
    //             unlink(public_path($product->thumbnail));
    //         }
    //         $productThumbnail = $this->productImage($request);
    //     } else {
    //         $productThumbnail = $product->thumbnail; // retain old
    //     }

    //     // Handle multiple images
    //     if ($request->hasFile('images')) {
    //         if ($product->images) {
    //             foreach (json_decode($product->images, true) as $oldImage) {
    //                 if (file_exists(public_path($oldImage))) {
    //                     unlink(public_path($oldImage));
    //                 }
    //             }
    //         }
    //         $images = $this->productMultipleImages($request);
    //     } else {
    //         $images = json_decode($product->images, true); // retain old
    //     }

    //     // Update product
    //     $product->update([
    //         'category_id' => $request->category_id,
    //         // 'subcategory_id' => $request->subcategory_id,
    //         // 'brand_id' => $request->brand_id,
    //         'product_name' => $request->product_name,
    //         'product_slug' => Str::slug($request->product_name),
    //         // 'sku' => $request->sku,
    //         'short_description' => $request->short_description,
    //         'long_description' => $request->long_description,
    //         'regular_price' => $request->regular_price,
    //         'discount_price' => $request->discount_price,
    //         'discount_type' => $request->discount_type,
    //         'stock_quantity' => $request->stock_quantity,
    //         // 'in_stock' => $request->in_stock,
    //         // 'colors' => $request->colors ? json_encode($request->colors) : null,
    //         // 'sizes' => $request->sizes ? json_encode($request->sizes) : null,
    //         'thumbnail' => $productThumbnail,
    //         'images' => $images ? json_encode($images) : null,
    //         'is_featured' => $request->is_featured,
    //         'is_active' => $request->is_active,
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //     ]);
    // }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Handle thumbnail
        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                unlink(public_path($product->thumbnail));
            }
            $productThumbnail = $this->productImage($request);
        } else {
            $productThumbnail = $product->thumbnail;
        }

        // 1. Get existing image paths from form
        $existingImages = $request->input('existing_images', []);

        // 2. Get old images from database
        $oldImages = json_decode($product->images, true) ?? [];

        // 3. Find deleted images by comparing old with existing
        $deletedImages = array_diff($oldImages, $existingImages);

        // 4. Delete removed images from public folder
        foreach ($deletedImages as $image) {
            $imagePath = public_path($image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // 5. Handle new uploaded images
        $newImages = $this->productMultipleImages($request);

        // 6. Merge existing + new images
        $finalImages = array_merge($existingImages, $newImages);

        // 7. Update product
        $product->update([
            'category_id'       => $request->category_id,
            'brand_id'          => $request->brand_id,
            'product_name'      => $request->product_name,
            'product_slug'      => Str::slug($request->product_name),
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'regular_price'     => $request->regular_price,
            'discount_price'    => $request->discount_price,
            'discount_type'     => $request->discount_type,
            'stock_quantity'    => $request->stock_quantity,
            'sizes'             => $request->sizes,
            'thumbnail'         => $productThumbnail,
            'images'            => json_encode($finalImages),
            'is_featured'       => $request->is_featured,
            'is_active'         => $request->is_active,
        ]);

        // return response()->json(['success' => true]);

        Toastr::success('Product Updated Successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        Toastr::success('Product Deleted Successfully!');
        return redirect()->back();
    }


    // Product multiple images

    private function productMultipleImages(Request $request)
    {
        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $image = Image::read($file);
                $imageName = time() . '-' . uniqid() . '-' . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/product_image/');
                $image->save($destinationPath . $imageName);
                $imagePaths[] = 'uploads/product_image/' . $imageName;
            }
        }

        return $imagePaths;
    }

    public function trashedData()
    {
        $products = Product::onlyTrashed()->get();

        return view('admin.layouts.pages.product.recyclebin', compact('products'));
    }

    // Restore product data
    public function restoreData($id)
    {
        Product::withTrashed()->where('id', $id)->restore();
        $toast = Toastr();
        $toast->success('Product restored successfully.');
        return redirect()->route('product.index');
    }

    public function forceDeleteData($id)
    {
        $product = Product::withTrashed()->where('id', $id)->first();

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        // Delete the thumbnail image if it exists
        if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
            unlink(public_path($product->thumbnail));
        }

        // Delete the multiple images if they exist
        if ($product->images) {
            $images = json_decode($product->images, true);
            foreach ($images as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }


        $product->forceDelete();

        $toast = Toastr();
        $toast->success('Product permanently deleted successfully.');
        return redirect()->back();
    }




    // public function changeStatus($id)
    // {
    //     $getStatus = Product::select('is_active')->where('id', $id)->first();

    //     if ($getStatus->is_active == 1) {
    //         $status = 0;
    //     } else {
    //         $status = 1;
    //     }
    //     Product::where('id', $id)->update(['is_active' => $status]);

    //     $toast = Toastr();
    //     $toast->success('Status change successfully.');
    //     return redirect()->route('product.index');
    // }


    public function productChangeStatus(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found.']);
        }

        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json([
            'status'     => true,
            'message'    => 'Status changed successfully.',
            'new_status' => $product->is_active ? 'Active' : 'DeActive',
            'class'      => $product->is_active ? 'btn-success' : 'btn-danger',
        ]);
    }


    // Product thumbnail image
    private function productImage(Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            $image = Image::read($request->file('thumbnail'));
            $imageName = time() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $destinationPath = public_path('uploads/product_image/');
            $image->save($destinationPath . $imageName);
            return 'uploads/product_image/' . $imageName;
        }
        return null;
    }


}
