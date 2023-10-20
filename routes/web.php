<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ProductInventoryController;
use App\Http\Controllers\OrderInventoryController;
use App\Http\Controllers\SliderController;


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
    });

    //non authenticated routes

    Route::get('/checkGoogle', [UserController::class, "checkGoogle"])->name('checkGoogle')->withoutMiddleware(['auth', 'verifyUser']);
    Route::get('/demo', [UserController::class, "demo"])->name('demo')->withoutMiddleware('auth');

    Route::get('/', [UserController::class, "index"])->name('home')->withoutMiddleware('auth');


    Route::get('/shippingInformation', [OrderController::class, "shippingInfo"])->name('shippinginfo')->withoutMiddleware('auth');

    Route::get('/shippingCart', [OrderController::class, "shippingCart"])->name('shippingcart')->withoutMiddleware('auth');

    Route::get('/products/all', [ProductController::class, "index"])->name('products')->withoutMiddleware('auth');

    Route::get('/productDetails/{product_id}', [ProductController::class, "details"])->name('productdetails')->withoutMiddleware('auth');


    Route::get('/products/3d-crystal', [ProductController::class, "product_3d_crystal"])->name('product-3d-crystal')->withoutMiddleware('auth');

    Route::get('/products/wooden-engraved', [ProductController::class, "wooden_engraved"])->name('wooden-engraved')->withoutMiddleware('auth');

    Route::get('/products/photo-frames', [ProductController::class, "photo_frames"])->name('photo-frames')->withoutMiddleware('auth');


    Route::get('/price/0-500', [ProductController::class, "product_price_low"])->name('product-price-low')->withoutMiddleware('auth');

    Route::get('/price/1000-2000', [ProductController::class, "product_price_medium"])->name('product-price-medium')->withoutMiddleware('auth');

    Route::get('/price/2000-above', [ProductController::class, "product_price_high"])->name('product-price-high')->withoutMiddleware('auth');


    Route::get('/occasions', [ProductController::class, "occasions"])->name('occasions')->withoutMiddleware('auth');

    Route::get('/occasions/anniversary', [ProductController::class, "product_anniversary"])->name('product-anniversary')->withoutMiddleware('auth');

    Route::get('/occasions/birthday', [ProductController::class, "product_birthday"])->name('product-birthday')->withoutMiddleware('auth');

    Route::get('/occasions/valentines-day', [ProductController::class, "product_valentines"])->name('product-valentines')->withoutMiddleware('auth');

    Route::post('/serviceAjax', [ProductController::class, "serviceAjax"])->withoutMiddleware('auth');
    Route::post('/addToCart', [ProductController::class, "addToCart"])->withoutMiddleware('auth');
    Route::get('/checkUser', [UserController::class, "checkUser"])->name('checkUser')->withoutMiddleware(['auth', 'verifyUser']);

    Route::get('/search', [ProductController::class, "search"])->name('search')->withoutMiddleware('auth');

    Route::post('/customUpload', [ProductController::class, "customUpload"])->name('customUpload')->withoutMiddleware('auth');
    Route::post('/customMessage', [ProductController::class, "customMessage"])->name('customMessage')->withoutMiddleware('auth');
    Route::post('/guestCartImgDelete', [ProductController::class, "guestCartImgDelete"])->name('guestCartImgDelete')->withoutMiddleware('auth');




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

    //cron jobs for updating
    Route::get('/orderStatusUpdate', [PaymentController::class, "orderStatusUpdate"]);
    
    Route::post('/razorpay', [PaymentController::class, "Razorpay"]);
    Route::get('/payment/status/{payment_id}/{amount}', [PaymentController::class, "payment_status"])->name('paymentStatus');
});

//Admin Routes starts from here...


Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    // Route::get('/login', [AdminController::class, "login"])->name('adminLogin')->withoutMiddleware('auth');
    // Route::post('/loginSubmit', [AdminController::class, "loginSubmit"])->name('loginSubmit')->withoutMiddleware('auth');
    // Route::get('/register', [AdminController::class, "register"])->name('adminRegister')->withoutMiddleware('auth');
    // Route::get('/registerSubmit', [AdminController::class, "registerSubmit"])->name('registerSubmit')->withoutMiddleware('auth');

    Route::get('/product/all', [ProductInventoryController::class, 'all_product'])->name('AllProducts');


    Route::get('/Addproducts', [ProductInventoryController::class, 'Addproducts'])->name('Addproducts');
    Route::get('/getAllProducts', [ProductInventoryController::class, 'getAllProducts'])->name('getAllProducts');
    Route::post('/productDelete', [ProductInventoryController::class, 'productDelete'])->name('productDelete');
    Route::post('/subproducts', [ProductInventoryController::class, 'subproducts'])->name('subproducts');

    Route::post('/getProduct', [ProductInventoryController::class, 'getProduct'])->name('getProduct');
    Route::post('/editProduct', [ProductInventoryController::class, 'editProduct'])->name('editProduct');



    Route::get('/orders', [OrderInventoryController::class, 'index'])->name('adminOrders');
    Route::get('/orders/new', [OrderInventoryController::class, 'newOrders'])->name('newOrders');
    Route::get('/orders/cancelled', [OrderInventoryController::class, 'cancelledOrders'])->name('cancelledOrders');
    Route::get('/orders/completed', [OrderInventoryController::class, 'completedOrders'])->name('completedOrders');
    Route::get('/orderReport', [OrderInventoryController::class, 'orderReport'])->name('orderReport');


    
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/userReport', [AdminController::class, 'userReport'])->name('userReport');

    
    

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

     Route::post('/addBanner', [SliderController::class, 'addBanner'])->name('addBanner');
     Route::post('/addSlider', [SliderController::class, 'addSlider'])->name('addSlider');
     

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');
    Route::get('/logout', [AdminController::class, "logout"])->name('logout');

});


Route::middleware(['guest:admin'])->prefix('admin')->group(function () {

    Route::get('/login', [AdminController::class, "login"])->name('adminLogin');
    Route::post('/loginSubmit', [AdminController::class, "loginSubmit"])->name('loginSubmit');
    Route::get('/register', [AdminController::class, "register"])->name('adminRegister');
    Route::post('/registerSubmit', [AdminController::class, "registerSubmit"])->name('registerSubmit');

});


//error routes



Route::get('/error-denied', [ErrorController::class, "errorDenied"])->name('error-denied');
Route::get('/generateInvoice/{order_id}', [PaymentController::class, "generateInvoice"])->name('generateInvoice');
