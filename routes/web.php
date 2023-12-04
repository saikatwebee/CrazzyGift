<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductInventoryController;
use App\Http\Controllers\OrderInventoryController;
use App\Http\Controllers\SliderController;
use App\Models\Menu;



//error route
//Route::get('/{any}', [CatchAllController::class, 'handleRequest'])->name('catch-all');



Route::middleware(['auth', 'verifyUser'])->group(function () {

    Route::middleware(['guest:web'])->group(function () {

        //guest route

        Route::get('/login', [UserController::class, "login"])->name('login')->withoutMiddleware(['auth', 'verifyUser']);
        Route::get('/signin', [UserController::class, "signin"])->name('signin')->withoutMiddleware(['auth', 'verifyUser']);
        Route::get('/register', [UserController::class, "register"])->name('register')->withoutMiddleware(['auth', 'verifyUser']);

        Route::get('/auth/redirect', [UserController::class, "redirectToGoogle"])->withoutMiddleware(['auth', 'verifyUser']);
        Route::get('/auth/callback', [UserController::class, "handleGoogleCallback"])->withoutMiddleware(['auth', 'verifyUser']);

        Route::post('/sentRegisterOtp', [UserController::class, "sentRegisterOtp"])->name('sentRegisterOtp')->withoutMiddleware(['auth', 'verifyUser']);

        Route::post('/resendOtp', [UserController::class, "resendOtp"])->name('resendOtp')->withoutMiddleware(['auth', 'verifyUser']);

        Route::post('/sentLoginOtp', [UserController::class, "sentLoginOtp"])->name('sentLoginOtp')->withoutMiddleware(['auth', 'verifyUser']);
        Route::post('/verifyOtp', [UserController::class, "verifyOtp"])->name('verifyOtp')->withoutMiddleware(['auth', 'verifyUser']);
        Route::post('/verifyOtpRegister', [UserController::class, "verifyOtpRegister"])->name('verifyOtpRegister')->withoutMiddleware(['auth', 'verifyUser']);
        
    });

    //non authenticated routes

    Route::get('/shippingCart', [OrderController::class, "shippingCart"])->name('shippingcart')->withoutMiddleware('auth');
    Route::post('/serviceAjax', [ProductController::class, "serviceAjax"])->withoutMiddleware('auth');
    Route::post('/addToCart', [ProductController::class, "addToCart"])->withoutMiddleware('auth');
    Route::get('/checkUser', [UserController::class, "checkUser"])->name('checkUser')->withoutMiddleware(['auth', 'verifyUser']);
    Route::get('/search', [ProductController::class, "search"])->name('search')->withoutMiddleware('auth');
    Route::post('/customUpload', [ProductController::class, "customUpload"])->name('customUpload')->withoutMiddleware('auth');
    Route::post('/customMessage', [ProductController::class, "customMessage"])->name('customMessage')->withoutMiddleware('auth');
    Route::post('/guestCartImgDelete', [ProductController::class, "guestCartImgDelete"])->name('guestCartImgDelete')->withoutMiddleware('auth');
    Route::get('/productDetails/{product_id}', [ProductController::class, "details"])->name('productdetails')->withoutMiddleware('auth');
    Route::post('/sentMail', [UserController::class, "sentMail"])->name('sentMail')->withoutMiddleware('auth');
    Route::get('/shippingInformation', [OrderController::class, "shippingInfo"])->name('shippinginfo')->withoutMiddleware('auth');
    Route::get('/checkGoogle', [UserController::class, "checkGoogle"])->name('checkGoogle')->withoutMiddleware(['auth', 'verifyUser']);
    Route::get('/demo', [UserController::class, "demo"])->name('demo')->withoutMiddleware('auth');

    Route::get('/', [UserController::class, "index"])->name('home')->withoutMiddleware('auth');
    Route::get('/{products-all}', [ProductController::class, "index"])->name('products-all')->withoutMiddleware('auth');

    // Route::get('/about-us', [UserController::class, "aboutUs"])->name('about-us')->withoutMiddleware('auth');
    // Route::get('/contact-us', [UserController::class, "contactUs"])->name('contact-us')->withoutMiddleware('auth');
    // Route::get('/corporate-gifts', [UserController::class, "corporateGifts"])->name('corporate-gifts')->withoutMiddleware('auth');

    //Route::get('/products/3d-crystal', [ProductController::class, "product_3d_crystal"])->name('product-3d-crystal')->withoutMiddleware('auth');

    //Route::get('/products/wooden-engraved', [ProductController::class, "wooden_engraved"])->name('wooden-engraved')->withoutMiddleware('auth');

    // Route::get('/products/photo-frames', [ProductController::class, "photo_frames"])->name('photo-frames')->withoutMiddleware('auth');


    // Route::get('/price/0-500', [ProductController::class, "product_price_low"])->name('product-price-low')->withoutMiddleware('auth');

    // Route::get('/price/1000-2000', [ProductController::class, "product_price_medium"])->name('product-price-medium')->withoutMiddleware('auth');

    //  Route::get('/price/2000-above', [ProductController::class, "product_price_high"])->name('product-price-high')->withoutMiddleware('auth');


    // Route::get('/occasions', [ProductController::class, "occasions"])->name('occasions')->withoutMiddleware('auth');

    //Route::get('/occasions/anniversary', [ProductController::class, "product_anniversary"])->name('product-anniversary')->withoutMiddleware('auth');

    // Route::get('/occasions/birthday', [ProductController::class, "product_birthday"])->name('product-birthday')->withoutMiddleware('auth');

    // Route::get('/occasions/valentines-day', [ProductController::class, "product_valentines"])->name('product-valentines')->withoutMiddleware('auth');



    //authenticated routes 

    Route::get('/Myprofile', [UserController::class, "profile"])->name('profile')->withoutMiddleware('verifyUser');
    Route::post('/profileUpload', [UserController::class, 'profileUpload'])->name('profileUpload');
    Route::post('/updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile')->withoutMiddleware('verifyUser');
    Route::post('/verifyOtpProfile', [UserController::class, 'verifyOtpProfile'])->name('verifyOtpProfile')->withoutMiddleware('verifyUser');

    Route::get('/myorder', [OrderController::class, "index"])->name('myorder');




    Route::get('/shippingInformation', [OrderController::class, "shippingInfo"])->name('shippinginfo');
    Route::get('/logout', [UserController::class, "logout"])->name('logout')->withoutMiddleware('verifyUser');
    Route::get('/payment', [PaymentController::class, "payment"])->name('payment');
    Route::get('/ecom', [ProductController::class, "ecom"])->name('ecom');
    Route::post('/transferCart', [ProductController::class, "transferCart"])->name('transferCart');
    Route::post('/deleteCart', [ProductController::class, "deleteCart"])->name('deleteCart');
    Route::post('/normalCartImgDelete', [ProductController::class, "normalCartImgDelete"])->name('normalCartImgDelete');
    Route::post('/cartUpdateNormal', [ProductController::class, "cartUpdateNormal"])->name('cartUpdateNormal');
    Route::get('/cartValidation', [ProductController::class, "cartValidation"])->name('cartValidation');
    Route::post('/editCustomMessage', [ProductController::class, "editCustomMessage"])->name('editCustomMessage');


    // Route::get('/checkGoogle', [UserController::class, "checkGoogle"])->name('checkGoogle');
    Route::post('/editBillingAddress', [OrderController::class, "editBillingAddress"])->name('editBillingAddress');
    Route::post('/getShippingAddress', [OrderController::class, "getShippingAddress"])->name('getShippingAddress');
    Route::post('/editShippingAddress', [OrderController::class, "editShippingAddress"])->name('editShippingAddress');

    Route::post('/getAddress', [OrderController::class, "getAddress"])->name('getAddress');
    Route::post('/updateAddress', [OrderController::class, "updateAddress"])->name('updateAddress');
    

    Route::post('/updateBillingOnInput', [OrderController::class, "updateBillingOnInput"])->name('updateBillingOnInput');

    Route::post('/addShippingAddress', [OrderController::class, "addShippingAddress"])->name('addShippingAddress');

    Route::post('/addShipping', [OrderController::class, "addShipping"])->name('addShipping');

    Route::post('/selectShipping', [OrderController::class, "selectShipping"])->name('selectShipping');

    Route::post('/deleteShipping', [OrderController::class, "deleteShipping"])->name('deleteShipping');

    Route::get('/uncheckSameAsBilling', [OrderController::class, "uncheckSameAsBilling"])->name('uncheckSameAsBilling');

    Route::get('/checkShipping', [OrderController::class, "checkShipping"])->name('checkShipping');





    Route::get('/awbAjax', [ProductController::class, "awbAjax"]);
    Route::get('/manifestAjax', [ProductController::class, "manifestAjax"]);
    Route::post('/cancellShipment', [PaymentController::class, "cancellShipment"]);



    Route::post('/razorpay', [PaymentController::class, "Razorpay"]);
    Route::get('/payment/status/{payment_id}/{amount}', [PaymentController::class, "payment_status"])->name('paymentStatus');
});

//dynamic  routes for menus 
Route::middleware(['auth', 'verifyUser'])->group(function () {

    $urls = Menu::distinct()->pluck('url')->toArray();

    foreach ($urls as $url) {

        Route::get("/{" . $url . "}", [SliderController::class, 'showPageByMenuUrl'])
            ->name($url)
            ->withoutMiddleware('auth');
    }
});






//Admin Routes starts from here...


Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    // Route::get('/login', [AdminController::class, "login"])->name('adminLogin')->withoutMiddleware('auth');
    // Route::post('/loginSubmit', [AdminController::class, "loginSubmit"])->name('loginSubmit')->withoutMiddleware('auth');
    // Route::get('/register', [AdminController::class, "register"])->name('adminRegister')->withoutMiddleware('auth');
    // Route::get('/registerSubmit', [AdminController::class, "registerSubmit"])->name('registerSubmit')->withoutMiddleware('auth');

    Route::get('/product/all', [ProductInventoryController::class, 'all_products'])->name('admin.product.all');
    Route::get('/product/inactive', [ProductInventoryController::class, 'inactive_products'])->name('InactiveProducts');


    Route::get('/Addproducts', [ProductInventoryController::class, 'Addproducts'])->name('Addproducts');
    Route::get('/getAllProducts', [ProductInventoryController::class, 'getAllProducts'])->name('getAllProducts');
    Route::get('/getAllInactiveProducts', [ProductInventoryController::class, 'getAllInactiveProducts'])->name('getAllInactiveProducts');



    Route::post('/productDelete', [ProductInventoryController::class, 'productDelete'])->name('productDelete');
    Route::post('/product_delete', [ProductInventoryController::class, 'product_delete'])->name('product_delete');
    Route::post('/subproducts', [ProductInventoryController::class, 'subproducts'])->name('subproducts');

    Route::post('/getProduct', [ProductInventoryController::class, 'getProduct'])->name('getProduct');
    Route::post('/getUser', [AdminController::class, 'getUser'])->name('getUser');

    Route::post('/editProduct', [ProductInventoryController::class, 'editProduct'])->name('editProduct');



    Route::get('/orders', [OrderInventoryController::class, 'index'])->name('adminOrders');
    Route::get('/orders/new', [OrderInventoryController::class, 'newOrders'])->name('newOrders');
    Route::get('/orders/cancelled', [OrderInventoryController::class, 'cancelledOrders'])->name('cancelledOrders');
    Route::get('/orders/completed', [OrderInventoryController::class, 'completedOrders'])->name('completedOrders');
    Route::get('/orderReport', [OrderInventoryController::class, 'orderReport'])->name('orderReport');



    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/userReport', [AdminController::class, 'userReport'])->name('userReport');
    Route::post('/userDelete', [AdminController::class, 'userDelete'])->name('userDelete');





    Route::get('/getAllOrders', [OrderInventoryController::class, 'getAllOrders'])->name('getAllOrders');

    Route::get('/getAllUsers', [AdminController::class, 'getAllUsers'])->name('getAllUsers');


    Route::post('/getFilterOrders', [OrderInventoryController::class, 'getFilterOrders'])->name('getFilterOrders');

    Route::post('/getFilterUsers', [AdminController::class, 'getFilterUsers'])->name('getFilterUsers');


    Route::get('/getNewOrders', [OrderInventoryController::class, 'getNewOrders'])->name('getNewOrders');
    Route::get('/getCancelledOrders', [OrderInventoryController::class, 'getCancelledOrders'])->name('getCancelledOrders');
    Route::get('/getCompletedOrders', [OrderInventoryController::class, 'getCompletedOrders'])->name('getCompletedOrders');
    Route::post('/orderDelete', [OrderInventoryController::class, 'orderDelete'])->name('orderDelete');

    Route::get('/orderDetails/{order_id}', [OrderInventoryController::class, "orderDetails"])->name('orderDetails');

    Route::get('/slider-management', [SliderController::class, 'sliderManagement'])->name('sliderManagement');
    Route::get('/getAllMenus', [SliderController::class, 'getAllMenus'])->name('getAllMenus');
    Route::post('/menuDelete', [SliderController::class, 'menuDelete'])->name('menuDelete');
    Route::post('/showMenu', [SliderController::class, 'showMenu'])->name('showMenu');
    Route::post('/editMenu', [SliderController::class, 'editMenu'])->name('editMenu');
    Route::post('/addMenu', [SliderController::class, 'addMenu'])->name('addMenu');


    Route::get('/menu-management', [SliderController::class, 'menuManagement'])->name('menuManagement');
    Route::get('/add-menu', [SliderController::class, 'addMenuView'])->name('addMenuView');
    Route::get('/edit-menu/{menu_id}', [SliderController::class, 'editMenuView'])->name('editMenuView');



    Route::post('/addBanner', [SliderController::class, 'addBanner'])->name('addBanner');
    Route::post('/addSlider', [SliderController::class, 'addSlider'])->name('addSlider');
    Route::post('/addTestimonialSlider', [SliderController::class, 'addTestimonialSlider'])->name('addTestimonialSlider');
    Route::post('/addOccasionImage', [SliderController::class, 'addOccasionImage'])->name('addOccasionImage');


    Route::post('/updateBanner', [SliderController::class, 'updateBanner'])->name('updateBanner');
    Route::post('/updateOccasionImage', [SliderController::class, 'updateOccasionImage'])->name('updateOccasionImage');

    Route::get('/getAllBanners', [SliderController::class, 'getAllBanners'])->name('getAllBanners');
    Route::get('/getOccasionImages', [SliderController::class, 'getOccasionImages'])->name('getOccasionImages');

    Route::post('/getBanner', [SliderController::class, 'getBanner'])->name('getBanner');
    Route::post('/getImage', [SliderController::class, 'getImage'])->name('getImage');

    Route::post('/getSlider', [SliderController::class, 'getSlider'])->name('getSlider');
    Route::post('/getTestimonialSlider', [SliderController::class, 'getTestimonialSlider'])->name('getTestimonialSlider');

    Route::post('/updateSlider', [SliderController::class, 'updateSlider'])->name('updateSlider');
    Route::post('/updateTestimonialSlider', [SliderController::class, 'updateTestimonialSlider'])->name('updateTestimonialSlider');

    Route::post('/bannerDelete', [SliderController::class, 'bannerDelete'])->name('bannerDelete');
    Route::post('/imageDelete', [SliderController::class, 'imageDelete'])->name('imageDelete');

    Route::post('/sliderDelete', [SliderController::class, 'sliderDelete'])->name('sliderDelete');
    Route::post('/gstStatusUpdate', [SliderController::class, 'gstStatusUpdate'])->name('gstStatusUpdate');
    
    Route::post('/TestimonialDelete', [SliderController::class, 'TestimonialDelete'])->name('TestimonialDelete');

    Route::get('/getAllSliders', [SliderController::class, 'getAllSliders'])->name('getAllSliders');
    Route::get('/getAllTestimonials', [SliderController::class, 'getAllTestimonials'])->name('getAllTestimonials');

    Route::get('/category-management', [SliderController::class, 'categoryManagement'])->name('categoryManagement');
    Route::get('/additional-setting', [SliderController::class, 'additionalSetting'])->name('additionalSetting');
    
    Route::get('/getAllCategories', [SliderController::class, 'getAllCategories'])->name('getAllCategories');
    Route::get('/getAllCategories', [SliderController::class, 'getAllCategories'])->name('getAllCategories');
    Route::get('/getGstDetails', [SliderController::class, 'getGstDetails'])->name('getGstDetails');
    Route::post('/addGstDetails', [SliderController::class, 'addGstDetails'])->name('addGstDetails');
    Route::post('/getGst', [SliderController::class, 'getGst'])->name('getGst');
    Route::post('/updateGst', [SliderController::class, 'updateGst'])->name('updateGst');

    Route::get('/getAllSubcategories', [SliderController::class, 'getAllSubcategories'])->name('getAllSubcategories');
    Route::post('/addCategory', [SliderController::class, 'addCategory'])->name('addCategory');
    Route::post('/addSubcategory', [SliderController::class, 'addSubcategory'])->name('addSubcategory');
    Route::post('/getDependent', [ProductInventoryController::class, 'getDependent'])->name('getDependent');
    Route::post('/getCategory', [ProductInventoryController::class, 'getCategory'])->name('getCategory');
    Route::post('/getSubcategory', [ProductInventoryController::class, 'getSubcategory'])->name('getSubcategory');

    Route::post('/updateCategory', [ProductInventoryController::class, 'updateCategory'])->name('updateCategory');
    Route::post('/updateSubcategory', [ProductInventoryController::class, 'updateSubcategory'])->name('updateSubcategory');
    Route::post('/categoryDelete', [ProductInventoryController::class, 'categoryDelete'])->name('categoryDelete');
    Route::post('/subcategoryDelete', [ProductInventoryController::class, 'subcategoryDelete'])->name('subcategoryDelete');


    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');
    Route::get('/logout', [AdminController::class, "logout"])->name('logout');
});


Route::middleware(['guest:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, "login"])->name('adminLogin');
    Route::get('/login', [AdminController::class, "login"])->name('adminLogin');
    Route::post('/loginSubmit', [AdminController::class, "loginSubmit"])->name('loginSubmit');
    Route::get('/register-admin', [AdminController::class, "register"])->name('adminRegister');
    Route::post('/registerSubmit', [AdminController::class, "registerSubmit"])->name('registerSubmit');
});


//error routes & cronjobs

// Route::fallback(function () {
//     return view('errors.404');
// });



//cron jobs for updating
Route::get('/orderStatusUpdate', [PaymentController::class, "orderStatusUpdate"]);
Route::get('/generateInvoice/{order_id}', [PaymentController::class, "generateInvoice"])->name('generateInvoice');
