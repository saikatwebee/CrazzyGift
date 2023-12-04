@extends('layouts.master')

@section('title', $title)

@section('content')
    <!-- Your page-specific content goes here -->
    <section class="loginRegister container">
        <div class="breadcrumb">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/products') }}">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-2" id="col-LG-2">
                        <div class="sideProductImg ">
                            <img src="{{ $product->product_image ? asset('/products') . '/' . $product->product_image : asset('/products/dummyProduct.jpg') }}"
                                class="side-item active" onmouseenter="imagePreviewOnHover(event)" alt="product_details">
                        </div>

                       
                        @if ($altImages)
                        
                            @if (count($altImages) > 0)
                                @foreach ($altImages as $altImage)
                                    <div class="sideProductImg my-2">
                                        <img src="{{ asset('/product_alt') . '/' . $altImage }}" class="side-item"
                                            onmouseenter="imagePreviewOnHover(event)" alt="product_details">
                                    </div>
                                @endforeach
                            
                            @endif

                            @else
                                <div class="sideProductImg my-2">
                                    <img src="{{ 'https://crazzygift.netlify.app/assets/img/icons/user3.png' }}"
                                        class="side-item" onmouseenter="imagePreviewOnHover(event)" alt="product_details">
                                </div>

                                <div class="sideProductImg my-2">
                                    <img src="{{ 'https://crazzygift.netlify.app/assets/img/icons/user2.png' }}"
                                        class="side-item" onmouseenter="imagePreviewOnHover(event)" alt="product_details">
                                </div>

                                <div class="sideProductImg my-2">
                                    <img src="{{ 'https://crazzygift.netlify.app/assets/img/icons/user1.png' }}"
                                        class="side-item" onmouseenter="imagePreviewOnHover(event)" alt="product_details">
                                </div>

                        @endif



                    </div>
                    <div class="col-lg-10">
                        <div class="mainProductImg">
                            <img src="{{ $product->product_image ? asset('/products') . '/' . $product->product_image : asset('/products/dummyProduct.jpg') }}"
                                id="showPreview" alt="product_details" style="border-radius: 10px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="productDetailHistory">
                    <div class="nameAndPrice">
                        <p>{{ $product->title }}</p>
                        <h3><i class="fa-solid fa-indian-rupee-sign"></i> {{ $product->price }}</h3>
                    </div>


                    <div class="quantity_selector">
                        <div class="quantityBtn">
                            <b>Quantity</b>
                        </div>

                        <button class="quantity-btn quantity_decrease">-</button>
                        <input type="text" class="quantity_input" id="quantity_input" name="quantity-input"
                            value="1">
                        <button class="quantity-btn quantity_increase" max="10">+</button>
                    </div>



                    <div class="inputPinLocation my-4">
                        <form action="{{ url('/serviceAjax') }}" method="post" id="servicecheckForm">
                            <div class="input-container my-3">
                                <input type="text" name="location" class="form-control" id="location"
                                    placeholder="Enter Pin code here" required>
                                <span class="checkButton" id="checkLocatin">Check Servicebility <i
                                        class="fa-solid fa-arrow-right-long"></i></span>
                                <span class="checkButton" id="responseLocation"></span>

                                {{-- <span class="text-success checkButton">@if (session('pincodesuccess')) <i class="fa-solid fa-circle-check"></i> {{ session('pincodesuccess') }} @endif</span>
                                    <span class="text-danger checkButton">@if (session('pincodecheck')) <i class="fa-solid fa-circle-exclamation"></i> {{ session('pincodecheck') }} @endif</span> --}}
                            </div>
                            @csrf
                        </form>

                        <form action="{{ url('/addToCart') }}" id="cart_form" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" id="product_quantity" value="1">
                            <input type="hidden" name="pincode">
                            <div class="cart-btns">
                                <a href="javascript:void(0)" id="add_cart"><button id="add_cart_btn"><i
                                            class="fa-solid fa-cart-shopping" style="margin-right: 6px;"></i>Add to
                                        cart</button></a>

                                <a href="{{ url('/products-all') }}" id="continue_cart"><button type="button"
                                        id="continue_cart_btn" class="mt-3">Continue Shopping<i
                                            class="fa-solid fa-arrow-right-long" style="margin-left: 6px;"></i></button></a>
                            </div>

                        </form>

                    </div>

                    <div class="productDescriptionDetail">
                        <p>{!! $product->description !!}</p>

                        <ul>
                            <li><strong>Size</strong> - {{ $product->product_length }} (width) x
                                {{ $product->product_height }} (height)
                                x {{ $product->product_breadth }} (thickness)</li>
                            {{-- <li><strong>Material</strong> - European quality crystal</li> --}}
                            <li><strong>To Personalize</strong> - Email photo to designs@crazzygift.com with Order ID. Our
                                designers will contact you for design approval.</li>
                            {{-- <li><strong>Time to dispatch</strong> - 1 working day</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="horizontalLine1"></div>

        <div class="row">
            <div class="tileSimilarPro">
                <h3>Similar Products</h3>
            </div>


            @foreach ($similarProducts as $similarProduct)
                <div class="col-lg-3 my-3">
                    <div class="products"
                        onclick="window.location.href='{{ url('/productDetails') . '/' . $similarProduct->slug }}';">
                        <div class="slide-image"
                            onclick="window.location.href='{{ url('/productDetails') . '/' . $similarProduct->slug }}';">
                            <img src="{{ $similarProduct->product_image ? asset('/products') . '/' . $similarProduct->product_image : asset('/products/dummyProduct.jpg') }}"
                                alt="Slide 1" class="slide"
                                onclick="window.location.href='{{ url('/productDetails') . '/' . $similarProduct->slug }}';">
                            {{-- <a href="{{ url('') . '/productDetails/' . $similarProduct->slug }}" class="overlay2">
                                <button>Quick View</button>
                            </a> --}}
                            <button type="button" class="btn btn-sm quick-view"
                                onclick="window.location.href='{{ url('/productDetails') . '/' . $similarProduct->slug }}';">Quick
                                View</button>
                        </div>
                        <div class="slide-caption">
                            <h2>{{ $similarProduct->title }}</h2>
                            <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $similarProduct->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>

        <script>
            function redirectToCart(event) {
                redirectUrl = event.target.getAttribute('data-id');
                console.log(redirectUrl);
                window.location.href = redirectUrl;
            }

            document.addEventListener("DOMContentLoaded", function() {

                var service_pincode = localStorage.getItem('service_pincode');
                if (service_pincode != undefined) {
                    $("#location").val(service_pincode);
                    $("[name='pincode']").val(service_pincode);

                    if ($("#location").hasClass('inputError')) {
                        $("#location").removeClass('inputError');
                        $("#location").addClass('inputSuccess');
                    } else {
                        $("#location").addClass('inputSuccess');
                    }

                    var html = 'Service Available in Your Area  <i class="fa-solid fa-circle-check"></i>';



                    if ($("#responseLocation").hasClass('text-error')) {
                        $("#responseLocation").removeClass('text-error');
                        $("#responseLocation").addClass('text-success');

                    } else {
                        $("#responseLocation").addClass('text-success');
                    }
                    $("#responseLocation").html(html);
                    $("#checkLocatin").html("");


                    $("#add_cart").css('pointer-events', 'auto');
                    $("#add_cart_btn").css('background', '#004a8c');



                }

            });
        </script>
    </section>
@endsection
