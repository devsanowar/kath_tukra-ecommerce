<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\AboutPageController;
use App\Http\Controllers\Frontend\SubscriberController;
use App\Http\Controllers\Frontend\ContactPageController;
use App\Http\Controllers\Frontend\CheckoutpageController;
use App\Http\Controllers\Frontend\SocialworkPageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;



Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/product-detail/{id}', [FrontendController::class, 'productDetail'])->name('product-detail');
Route::get('/about', [AboutPageController::class, 'about'])->name('about');

Route::get('/shop-page', [FrontendController::class, 'shopPage'])->name('shop_page');

Route::get('/search', [FrontendController::class, 'search'])->name('search');


// Price filtering
Route::get('/price-filter', [FrontendController::class, 'priceFilter'])->name('website.price.filter');
Route::get('/category-filter-multi', [FrontendController::class, 'multiCategoryFilter'])->name('category_product.filter.multi');
Route::get('/brand-filter-multi', [FrontendController::class, 'multiBrandFilter'])->name('brand_product.filter.multi');
Route::get('/get-category-products/{id}', [FrontendController::class, 'getCategoryProducts'])->name('get_category.products');





Route::get('/shoping-cart', [CartController::class, 'cartPage'])->name('cart.page');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/buy-now', [CartController::class, 'buyNow'])->name('buy.now');
Route::get('remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('removefrom.cart');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');



Route::get('/checkout-page', [CheckoutpageController::class, 'checkoutPage'])->name('checkout.page');
Route::get('/get-upazilas/{district_id}', [CheckoutpageController::class, 'getUpazilas'])->name('get.upazilas');
Route::post('/place-an-order', [CheckoutpageController::class, 'placeOrder'])->name('place_an_order');
Route::get('order/confirmation/{id}', [CheckoutpageController::class, 'showOrderConfirmation'])->name('order.confirmation');
//Route::get('/download-invoice/{order}', [CheckoutpageController::class, 'downloadInvoice'])->name('invoice.download');





Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'contactForm'])->name('contact.store');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{post_slug}', [BlogController::class, 'blogDetail'])->name('blog.detail');


Route::post('/subscribe-newsletter', [SubscriberController::class, 'subscribe'])->name('newsletter.subscribe');


Route::get('/faq', [FaqController::class, 'index'])->name('faq.page');


Route::get('privacy/policy/page', [FrontendController::class, 'privacyPolicyPage'])->name('privacy_policy.page');
Route::get('terms/and/condition', [FrontendController::class, 'termsAndCondtion'])->name('terms_and_condition.page');
Route::get('return/refund', [FrontendController::class, 'returnRefund'])->name('return_refund.page');


// Route::get('/project', [ProjectController::class, 'projectPage'])->name('project.page');
// Route::get('/project/{project_slug}/', [ProjectController::class, 'projectSinglePage'])->name('projectSingle.page');


// Route::get('/service', [ServiceController::class, 'servicePage'])->name('service.page');



// Route::post('/send-message', [ContactPageController::class, 'contactForm'])->name('form.submit');


// Route::get('/social-work-page', [SocialworkPageController::class, 'socialWorkPage'])->name('social_work_page.page');






// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login'); // লগইন পেজ বা যেখানেই পাঠাতে চান
})->name('logout');


require __DIR__.'/auth.php';
