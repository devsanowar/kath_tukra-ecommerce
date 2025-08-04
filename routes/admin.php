<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CtaController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\BlocklistController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\NewslatterController;
use App\Http\Controllers\Admin\SmsSettingController;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\Admin\WhyChoseUsController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\PromobannerController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\ReturnrefundController;
use App\Http\Controllers\Admin\WebsiteColorController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PrivacypolicyController;
use App\Http\Controllers\Admin\PrivilegeController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\TermsAdnCondiotnController;
use App\Http\Controllers\Admin\MessageSendController;
use App\Http\Controllers\Admin\SmsReportController;
use App\Http\Controllers\Admin\CostCategoryController;
use App\Http\Controllers\Admin\FieldOfCostController;
use App\Http\Controllers\Admin\CostController;
use App\Http\Controllers\Admin\HomeAboutController;

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        // Dashboard
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/dashboard/data', [AdminController::class, 'filterDashboardData'])->name('admin.dashboard.filter');

        // User Management
        Route::prefix('user')->group(function () {
            Route::get('create', [UserController::class, 'userCreate'])->name('user.create');
            Route::post('store', [UserController::class, 'storeUser'])->name('user.store');
            Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit.user');
            Route::post('{id}/update', [UserController::class, 'updateUser'])->name('update.user');
            Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
            Route::post('profile/{id}/image', [UserController::class, 'profileImageUpdate'])->name('update.profile.image');
            Route::post('password/{id}/change', [UserController::class, 'passwordUpdate'])->name('update.password');
            Route::delete('delete/{id}', [UserController::class, 'destroyUser'])->name('user.destroy');

            Route::get('/customer-list/', [UserController::class, 'customerList'])->name('customerList');
        });

        // Message
        Route::prefix('message')->group(function () {
            Route::get('/', [MessageSendController::class, 'index'])->name('message.index');
            Route::get('create', [MessageSendController::class, 'create'])->name('message.create');
            Route::post('store', [MessageSendController::class, 'store'])->name('message.store');
            Route::get('edit/{id}', [MessageSendController::class, 'edit'])->name('message.edit');
            Route::get('detail/{id}', [MessageSendController::class, 'detail'])->name('message.detail');
            Route::put('update/{id}', [MessageSendController::class, 'update'])->name('message.update');
            Route::delete('destroy/{id}', [MessageSendController::class, 'destroy'])->name('message.destroy');
        });

        Route::post('/send-message', [MessageSendController::class, 'send'])->name('send.message');
        Route::get('/custom-sms', [MessageSendController::class, 'customSms'])->name('custom.sms');

        // Sms Report
        Route::prefix('sms-report')->group(function () {
            Route::get('sms-report', [SmsReportController::class, 'index'])->name('sms-report.index');
            Route::delete('destroy/{id}', [SmsReportController::class, 'destroy'])->name('sms-report.destroy');
        });

        // Website Settings
        Route::prefix('website')->group(function () {
            Route::get('setting', [WebsiteSettingController::class, 'websiteSetting'])->name('website_setting');

            Route::post('setting/update', [WebsiteSettingController::class, 'websiteSettingUpdate'])->name('website_setting.update');

            Route::post('bredcrumb/update', [WebsiteSettingController::class, 'bredcrumbUpdate'])->name('bredcrumb.update');

            Route::post('google-map/update', [WebsiteSettingController::class, 'googleMapUpdate'])->name('googlemap.update');

            Route::post('footer-info/update', [WebsiteSettingController::class, 'footerInfoSettingUpdate'])->name('website_footer_info.update');

            Route::get('social-icon', [SocialIconController::class, 'socialIcon'])->name('website_social_icon.index');
            Route::post('social-icon/update', [SocialIconController::class, 'socialIconUpdate'])->name('website_social_icon.update');
        });


        // Admin Panel Settings
        Route::prefix('admin-panel')->group(function () {
            Route::get('setting', [AdminPanelController::class, 'adminPanelSetting'])->name('admin_panel_setting');
            Route::post('setting/update', [AdminPanelController::class, 'adminPanelSettingUpdate'])->name('admin_panel_setting.update');
        });

        // Home Page Sections
        Route::prefix('home-page')->group(function () {
            // Sliders
            Route::prefix('slider')->group(function () {
                Route::get('/', [SliderController::class, 'index'])->name('slider.index');
                Route::get('create', [SliderController::class, 'create'])->name('slider.create');
                Route::post('store', [SliderController::class, 'store'])->name('slider.store');
                Route::get('edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
                Route::put('update/{id}', [SliderController::class, 'update'])->name('slider.update');
                Route::delete('destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
            });

            // Brand
            Route::resource('brand', BrandController::class);
            Route::post('/brand/status-change', [BrandController::class, 'brandChangeStatus'])->name('brand.status');

            // About
            Route::get('about', [HomeAboutController::class, 'index'])->name('home.about.index');
            Route::post('about/update', [HomeAboutController::class, 'update'])->name('home.about.update');

            // Why chose us
            Route::resource('why-choose-us', WhyChoseUsController::class);

            // Achievement
            Route::resource('achievement', AchievementController::class);

            // Reviews
            Route::resource('review', ReviewController::class);

            // FAQs
            Route::resource('faq', FaqController::class);

            //Banner
            Route::get('banner', [BannerController::class, 'index'])->name('banner.index');
            Route::get('banner/create', [BannerController::class, 'create'])->name('banner.create');
            Route::post('banner/store', [BannerController::class, 'store'])->name('banner.store');
            Route::get('banner/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
            Route::post('banner/update/{id}', [BannerController::class, 'update'])->name('banner.update');
            Route::post('banner/delete/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');

            //Promo banner
            Route::get('/promobanner', [PromobannerController::class, 'index'])->name('promobanner.index');
            Route::post('/promobanner/store', [PromobannerController::class, 'store'])->name('promobanner.store');
            Route::put('/promobanner/update', [PromobannerController::class, 'update'])->name('promobanner.update');
            Route::delete('/promobanner/delete/{id}', [PromobannerController::class, 'destroy'])->name('promobanner.destroy');
            Route::post('/promobanner/status-change', [PromobannerController::class, 'PromoBannerChangeStatus'])->name('promobanner.status');


            // Cta routes here
            Route::resource('cta', CtaController::class);
            Route::post('/cta/status-change', [CtaController::class, 'ctaChangeStatus'])->name('cta.status');

        });

        // Categories
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::put('{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
            Route::post('/category/status-change', [CategoryController::class, 'categoryChangeStatus'])->name('category.status');
        });

        // Sub Category
        Route::resource('subcategory', SubcategoryController::class);

        // Product
        Route::resource('product', ProductController::class);
        Route::post('/product/status-change', [ProductController::class, 'productChangeStatus'])->name('product.status');
        Route::get('/All-trashed/product', [ProductController::class, 'trashedData'])->name('product.trash');
        Route::get('/restore/{id}/productData', [ProductController::class, 'restoreData'])->name('product.restore');
        Route::delete('/permanant/{id}/productdata', [ProductController::class, 'forceDeleteData'])->name('product.forceDelete');
        Route::get('changeStatus/{id}', [ProductController::class, 'changeStatus'])->name('changeStatus');

        // District route
        Route::get('district', [DistrictController::class, 'index'])->name('district.index');
        Route::post('/district/store/', [DistrictController::class, 'store'])->name('district.store');
        Route::get('district/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
        Route::post('district/update', [DistrictController::class, 'update'])->name('district.update');
        Route::delete('district/destroy/{id}', [DistrictController::class, 'destroy'])->name('district.destroy');
        Route::post('/district/status-change', [DistrictController::class, 'districtChangeStatus'])->name('district.status');

        // Upazila Route Here
        Route::get('upazila', [UpazilaController::class, 'index'])->name('upazila.index');
        Route::post('/upazila/store/', [UpazilaController::class, 'storeUpazila'])->name('upazila.store');
        Route::put('/upazilas/{id}', [UpazilaController::class, 'update'])->name('upazilas.update');
        Route::delete('upazila/destroy/{id}', [UpazilaController::class, 'destroyUpazila'])->name('upazila.destroy');
        Route::post('/upazila/status-change', [UpazilaController::class, 'upazilaChangeStatus'])->name('upazila.status');

        // Order routes Here
        Route::get('order', [OrderController::class, 'index'])->name('order.index');
        // Route::post('order-status/{id}', [OrderController::class, 'orderChangeStatus'])->name('orderChangeStatus');
        Route::get('orders-show/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::delete('orders-destroy/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/admin/filter-order', [OrderController::class, 'orderFilter'])->name('filter.orders');
        Route::post('/order/change-status/{id}', [OrderController::class, 'orderChangeStatus'])->name('orderChangeStatus');

        // shipping routes
        Route::get('shipping', [ShippingController::class, 'index'])->name('shipping.index');
        Route::post('shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
        Route::delete('shipping/{id}/destroy', [ShippingController::class, 'destroy'])->name('shipping.destroy');
        Route::put('/shipping/{id}', [ShippingController::class, 'update'])->name('shipping.update');
        Route::get('shipping-status/{id}', [ShippingController::class, 'shippingChangeStatus'])->name('shipping.status');

        // payment method routes here
        Route::get('payment_method', [PaymentMethodController::class, 'index'])->name('payment_method.index');
        Route::get('payment-method/create', [PaymentMethodController::class, 'create'])->name('payment_method.create');
        Route::post('payment-method/create', [PaymentMethodController::class, 'store'])->name('payment_method.store');
        Route::get('payment-method/edit/{id}', [PaymentMethodController::class, 'edit'])->name('payment_method.edit');
        Route::put('payment-method/update/{id}', [PaymentMethodController::class, 'update'])->name('payment_method.update');
        Route::delete('payment-method/delete/{id}', [PaymentMethodController::class, 'destroy'])->name('payment_method.destroy');
        Route::post('/payment-method/status-change', [PaymentMethodController::class, 'paymentMethodChangeStatus'])->name('payment_method.status');

        // Post Category
        Route::get('/post-category/', [PostCategoryController::class, 'index'])->name('post_category.index');
        Route::post('/post-category/store', [PostCategoryController::class, 'store'])->name('post_category.store');
        Route::post('/post-category/update', [PostCategoryController::class, 'update'])->name('post_category.update');
        Route::delete('/post-category/delete/{id}', [PostCategoryController::class, 'destroy'])->name('post_category.destroy');
        Route::post('/post-category/status-change/', [PostCategoryController::class, 'statusChange'])->name('post_category.status');
        Route::post('/post-category/status-change', [PostCategoryController::class, 'changeStatus'])->name('post_category.status');

        // Posts
        Route::resource('post', PostController::class);
        Route::post('/post/status-change', [PostController::class, 'postChangeStatus'])->name('post.status');

        // Cost Category
        Route::get('/cost-category/', [CostCategoryController::class, 'index'])->name('cost_category.index');
        Route::post('/cost-category/store', [CostCategoryController::class, 'store'])->name('cost_category.store');
        Route::post('/cost-category/update', [CostCategoryController::class, 'update'])->name('cost_category.update');
        Route::delete('/cost-category/delete/{id}', [CostCategoryController::class, 'destroy'])->name('cost_category.destroy');
        Route::post('/cost-category/status-change/', [CostCategoryController::class, 'statusChange'])->name('cost_category.status');
        Route::post('/cost-category/status-change', [CostCategoryController::class, 'changeStatus'])->name('cost_category.status');

        // Field of Cost Category
        Route::get('/field-of-cost/', [FieldOfCostController::class, 'index'])->name('field_of_cost.index');
        Route::post('/field-of-cost/store', [FieldOfCostController::class, 'store'])->name('field_of_cost.store');
        Route::post('/field-of-cost/update', [FieldOfCostController::class, 'update'])->name('field_of_cost.update');
        Route::delete('/field-of-cost/delete/{id}', [FieldOfCostController::class, 'destroy'])->name('field_of_cost.destroy');
        Route::post('/field-of-cost/status-change/', [FieldOfCostController::class, 'statusChange'])->name('field_of_cost.status');
        Route::post('/field-of-cost/status-change', [FieldOfCostController::class, 'changeStatus'])->name('field_of_cost.status');

        // Cost
        Route::get('/cost/', [CostController::class, 'index'])->name('cost.index');
        Route::get('/cost/create', [CostController::class, 'create'])->name('cost.create');
        Route::post('/cost/store', [CostController::class, 'store'])->name('cost.store');
        Route::get('/cost/edit/{id}', [CostController::class, 'edit'])->name('cost.edit');
        Route::get('/cost/detail/{id}', [CostController::class, 'detail'])->name('cost.detail');
        Route::post('/cost/update/{id}', [CostController::class, 'update'])->name('cost.update');
        Route::delete('/cost/delete/{id}', [CostController::class, 'destroy'])->name('cost.destroy');

        // About Page
        Route::get('about', [AboutController::class, 'index'])->name('about.index');
        Route::post('about/update', [AboutController::class, 'update'])->name('about.update');

        // About Page
        // Route::prefix('about-page')->group(function () {
        //     Route::get('/', [AboutPageController::class, 'index'])->name('about_page.page');
        //     Route::post('/chairman/update/{id}', [AboutPageController::class, 'update'])->name('chairman.update');

        //     Route::get('/mission/vision', [AboutPageController::class, 'missionVision'])->name('mission_vision.page');

        //     Route::post('/chairman/mission/update', [AboutPageController::class, 'missionUpdate'])->name('mission.update');
        //     Route::post('/chairman/vision/update', [AboutPageController::class, 'visionUpdate'])->name('vision.update');
        // });

        // Contact form message route
        Route::get('contact', [InboxController::class, 'index'])->name('contact.index');
        Route::get('contact-show/{id}', [InboxController::class, 'show'])->name('contact.message');
        Route::delete('contact/delete/{id}', [InboxController::class, 'destroy'])->name('contact.destroy');

        // Newsletter
        Route::get('Newslatter', [NewslatterController::class, 'index'])->name('newslatter');
        Route::get('Newslatter/destroy/{id}', [NewslatterController::class, 'destroy'])->name('newslatter.destroy');

        // SMS Settings
        Route::get('sms-settings', [SmsSettingController::class, 'edit'])->name('sms-settings.edit');
        Route::put('sms-settings', [SmsSettingController::class, 'update'])->name('sms-settings.update');


//        // SMS routes here
//        Route::group(['prefix' => 'moblieSMS'], function(){
//            Route::get('sms', [SmsSettingController::class, 'moblie_sms'])->name('mobile.sms');
////            Route::get('custom-sms', [SmsSettingController::class, 'custom_sms'])->name('custom.sms');
//            Route::get('sms-report', [SmsSettingController::class, 'sms_report'])->name('sms_report.sms');
//            Route::post('/send/custom/message', [SmsSettingController::class, 'sendCustomSms'])->name('send.custom_sms');
//        });


        // block list routes
        Route::get('block-list', [BlocklistController::class, 'index'])->name('block.list');
        Route::post('store-blocklist', [BlocklistController::class, 'store'])->name('block.number');
        Route::delete('/unblock/{id}', [BlocklistController::class, 'unblock'])->name('unblock.number');

        // Privacy policy route
        Route::get('privacy-policy', [PrivacypolicyController::class, 'privacyPolicy'])->name('privacy_policy');
        Route::put('/privacy-policy/{id}', [PrivacypolicyController::class, 'update'])->name('privacy_policy.update');

        //Return and refund
        Route::get('return-refund', [ReturnrefundController::class, 'returnRefund'])->name('return_refund');
        Route::put('/return-refund/update/{id}', [ReturnrefundController::class, 'update'])->name('return_refund.update');

        // Terms And Condition
        Route::get('/terms-and-condition', [TermsAdnCondiotnController::class, 'termsAndCondition'])->name('terms_and_condtion');
        Route::put('/terms-and-condition/update/{id}', [TermsAdnCondiotnController::class, 'update'])->name('terms_and_conditon.update');

        // Website Color routes
        Route::get('website-color', [WebsiteColorController::class, 'edit'])->name('website_color.edit');
        Route::put('/website-color/update/{id}', [WebsiteColorController::class, 'update'])->name('website_color.update');


});


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('privilege', [PrivilegeController::class, 'privilege'])->name('privilege');
    Route::post('privilege/update', [PrivilegeController::class, 'update'])->name('privilege.update');

});
