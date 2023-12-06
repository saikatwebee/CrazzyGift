@extends('layouts.master')

@section('title', $title)

@section('content')
    <!-- Your page-specific content goes here -->

    <section class="loginRegister container">
        <div class="breadcrumb">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipping Cart</li>
                </ol>
            </div>
        </div>

        @if ($status && $carts && count($carts) > 0)
            <div class="row">
                <div class="col-lg-8">
                    <div class="shippingInfo">


                        @foreach ($carts as $key => $cart)
                            @php
                                $product = $cart->product;

                            @endphp
                            <div class="orderSummaryCard">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="imgCartPro">

                                                    <img src="{{ $product->product_image ? asset('/products') . '/' . $product->product_image : asset('/products/dummyProduct.jpg') }}"
                                                        alt="cart_1" style="border-radius: 10px;">

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="nameAndPrice1">
                                                    <p>{{ $product->title }}</p>
                                                    <h3><i class="fa-solid fa-indian-rupee-sign"></i> {{ $product->price }}
                                                    </h3>
                                                </div>

                                                <div class="quantity-selector1">
                                                    <div class="quantityBtn1">
                                                        <b>Quantity</b>
                                                    </div>

                                                    <button class="quantity-btn1 quantity-decrease1"
                                                        data-id="{{ $cart->id }}">-</button>
                                                    <input type="text" class="quantity-input1"
                                                        value="{{ $cart->quantity }}" data-id="{{ $cart->id }}"
                                                        price="{{ $product->price }}">
                                                    <button class="quantity-btn1 quantity-increase1"
                                                        data-id="{{ $cart->id }}">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="titleDel">
                                            <p>Delivery time</p>
                                            <h6> Metros - 2 to 3 days, Tier 2 cities - 3 to 5 days, Others - 4 to 6 days
                                            </h6>
                                            {{-- <h6 class="mt-4"><strong>Pin Code :</strong> {{ $cart->pincode }}</h6> --}}
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="totalPriceAM">
                                            <p>Total</p>
                                            <h6><strong id="totalPriceAM_{{ $cart->id }}"><i
                                                        class="fa-solid fa-indian-rupee-sign"></i>
                                                    {{ $product->price * $cart->quantity }}</strong></h6>

                                            <div class="uploadAndDelBtn mt-4">

                                                @if ($cart->custom_image != '')
                                                    <button class="showimageBTN d-flex my-2"
                                                        data-id="{{ $cart->custom_image }}">
                                                        <div class="iconshowUpload showimageBTN_div"
                                                            data-id="{{ $cart->custom_image }}" style="margin-right: 8px;">
                                                            <i class="fa-solid fa-cloud-arrow-up showimageBTN_i"
                                                                data-id="{{ $cart->custom_image }}"></i>
                                                        </div>

                                                        <span id="showimageBTN_span"
                                                            data-id="{{ $cart->custom_image }}">Show
                                                            Image
                                                        </span>

                                                        <i class="fa-solid fa-square-xmark" data-id="{{ $cart->id }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            aria-label="Change Image" data-bs-original-title="Remove Image">
                                                        </i>
                                                    </button>
                                                @else
                                                    <button class="uploadBTN d-flex my-2" data-id="{{ $cart->id }}">
                                                        <div class="iconUpload uploadBTN_div" style="margin-right: 8px;"
                                                            data-id="{{ $cart->id }}">
                                                            <i class="fa-solid fa-cloud-arrow-up uploadBTN_i"
                                                                data-id="{{ $cart->id }}"></i>
                                                        </div>
                                                        <span id="uploadBTN_span" data-id="{{ $cart->id }}">Upload
                                                            Image</span>
                                                    </button>
                                                @endif

                                                @if ($cart->custom_text != '')
                                                    <button class="showtextBTN d-flex my-2" id="{{ $cart->id }}"
                                                        data-id="{{ $cart->custom_text }}">
                                                        <div class="iconshowUpload showtextBTN_div"
                                                            style="margin-right: 8px;" id="{{ $cart->id }}"
                                                            data-id="{{ $cart->custom_text }}"><i
                                                                class="fa-solid fa-envelope-open-text showtextBTN_i"
                                                                data-id="{{ $cart->custom_text }}"
                                                                id="{{ $cart->id }}"></i></div><span
                                                            id="{{ $cart->id }}"
                                                            style="font-family: 'DM Sans';font-style: normal;font-weight: 900;font-size: 12px;line-height: 16px;color: #4caf50;"
                                                            data-id="{{ $cart->custom_text }}">Show Message</span>
                                                    </button>
                                                @else
                                                    <button class="textBTN d-flex my-2" data-id="{{ $cart->id }}">
                                                        <div class="iconUpload textBTN_div" style="margin-right: 8px;"
                                                            data-id="{{ $cart->id }}">
                                                            <i class="fa-solid fa-envelope-open-text textBTN_i"
                                                                data-id="{{ $cart->id }}"></i>
                                                        </div>
                                                        <span id="textBTN_span" data-id="{{ $cart->id }}">Add
                                                            Message</span>
                                                    </button>
                                                @endif

                                                <button type="button" class="deleteBTN d-flex my-2"
                                                    data-id="{{ $cart->id }}">
                                                    <div class="iconUpload" style="margin-right: 8px;">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </div>
                                                    <span>Delete</span>
                                                </button>




                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="orderSummaryCard">
                        <div class="orderSummaryCardHeader mb-4">
                            <h3 style="font-weight:600;"><i class="fa-solid fa-arrow-up-short-wide"></i> Order Summary</h3>
                        </div>


                        <div class="displayFlex">
                            <div class="w-100">

                                @foreach ($carts as $key => $cart)
                                    @php
                                        $product = $cart->product;
                                        $productTitle = $product->title;
                                        $maxLength = 15;

                                        if (strlen($productTitle) > $maxLength) {
                                            $truncatedTitle = substr($productTitle, 0, $maxLength);
                                        } else {
                                            $truncatedTitle = $productTitle;
                                        }
                                    @endphp
                                    <div class="itemName">
                                        <p data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $productTitle }}">
                                            {{ $truncatedTitle }}...</p>

                                    </div>
                                @endforeach


                            </div>
                            <div class="w-50" id="priceDetails">

                                @foreach ($carts as $cart)
                                    @php $product = $cart->product @endphp
                                    <div class="amountPrice">
                                        <p><i class="fa-solid fa-indian-rupee-sign"></i>
                                            {{ $product->price * $cart->quantity }}</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="horizontalLine1"></div>

                        <div class="displayFlex">

                            <div class="w-100">
                                <div class="totalItem">
                                    <p>Total</p>
                                </div>
                            </div>

                            <div class="w-50">
                                <div class="totalPrice" id="totalDetails">
                                    @php $productPrice= 0; @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $product = $cart->product;
                                            $productPrice = $productPrice + $product->price * $cart->quantity;
                                        @endphp
                                    @endforeach
                                    <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $productPrice }}</p>
                                </div>
                            </div>

                        </div>
                        <div class="horizontalLine1"></div>
                        <div class="buttonSummary">
                            <button class="summaryCheckout checkoutBtn my-2">Checkout</button>
                            <br>
                            <a href="{{ url('/products-all') }}"><button class="summaryShopping my-2">Continue
                                    Shopping</button></a>
                        </div>
                    </div>

                </div>

            </div>
        @endif

        <!--Non authenticate guest user cart -->
        @if (!$status)
            <div class="row" id="guestCart">
                <div class="col-lg-8">
                    <div class="shippingInfo" id="shippingInfoDiv"></div>
                </div>
                <div class="col-lg-4">
                    <div class="orderSummaryCard">
                        <div class="orderSummaryCardHeader mb-4">
                            <h3>Order Summary</h3>
                        </div>

                        <div class="displayFlex">
                            <div class="w-100" id="itemDetails"></div>
                            <div class="w-50" id="priceDetails"></div>

                        </div>
                        <div class="horizontalLine1"></div>
                        <div class="displayFlex">
                            <div class="w-100">
                                <div class="totalItem">
                                    <p>Total</p>
                                </div>
                            </div>

                            <div class="w-50">
                                <div class="totalPrice" id="totalDetails">
                                </div>
                            </div>
                        </div>
                        <div class="horizontalLine1"></div>
                        <div class="buttonSummary">
                            <button class="summaryCheckout checkoutBtn my-2">Checkout</button>
                            <br>
                            <a href="{{ url('/products-all') }}"><button class="summaryShopping my-2">Continue
                                    Shopping</button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (auth()->Check())

            @if ($status && $carts && count($carts) == 0)
                <div class="emptyCart  p-3 my-3">
                    <p class="text-center">Cart is Empty</p>
                </div>
            @endif
        @else
            <div class="emptyCart guest-cart p-3 my-3" id="guest-cart">

            </div>
        @endif



        <div class="modal5">
            <div class="modal-content upload-content">
                <div class="closeIcon5">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <h2>Upload the image you need in the Product</h2>
                <form action="{{ url('/customUpload') }}" method="POST" enctype="multipart/form-data"
                    id="uploadForm2">
                    @csrf
                    <div class="mb-3">
                        {{-- <label for="formFile" class="form-label">Default file input example</label> --}}
                        <input class="form-control" type="file" id="custom_image" name="custom_image"
                            accept="image/*">
                    </div>

                    <div id="image_preview" style="display: none;">
                        <h2>Preview:</h2>
                        <img id="preview_image" src="#" alt="Image Preview">
                    </div>

                    <input type="hidden" name="id" id="uidforimage">


                    <div class="my-3" style="text-align: right;">
                        <div class="submit-container">
                            <i class="fa fa-spinner fa-spin spinner" style="display:none;"></i>
                            <input type="submit" id="uploadcustomBtn" class="loginButton mt-4" value="Upload">
                        </div>
                        <button type="button" id="close-button6">Close</button>
                    </div>

                </form>

            </div>
        </div>


        <div class="modal6">
            <div class="modal-content upload-content">
                <div class="closeIcon6">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <h2>Add the message you need in the Product</h2>
                <form action="{{ url('/customMessage') }}" method="POST" id="uploadForm3">
                    @csrf
                    <div class="mb-3">
                        <textarea id="mytextarea" class="form-control" name="custom_text" id="custom_text"></textarea>

                    </div>
                    <input type="hidden" name="id" id="uidfortext">

                    <div class="my-3" style="text-align: right;">
                        <div class="submit-container">
                            <i class="fa fa-spinner fa-spin spinner" style="display:none;"></i>
                            <input type="submit" id="uploadcustomBtn2" class="loginButton mt-4" value="Add">
                        </div>
                        <button type="button" id="close-button7">Close</button>
                    </div>

                </form>

            </div>
        </div>


        <div class="modal7">
            <div class="modal-content upload-content">
                <div class="closeIcon7">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <h2>Show Custom Message</h2>
                <form action="{{ url('/editCustomMessage') }}" method="POST" id="uploadForm4">
                    @csrf
                    <div class="mb-3">
                        <textarea id="mytextarea2" class="form-control" name="custom_text"></textarea>

                    </div>
                    <input type="hidden" name="id" id="uidfortext2">

                    <div class="my-3" style="text-align: right;">
                        <div class="submit-container">
                            <i class="fa fa-spinner fa-spin spinner" style="display:none;"></i>
                            <input type="submit" id="editCustombtn" class="loginButton mt-4" value="Save & Continue"
                                style="width:auto;">
                        </div>
                        <button type="button" id="close-button8">Close</button>
                    </div>

                    {{-- </form> --}}

            </div>
        </div>

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                var imageInput = document.getElementById("custom_image");
                imageInput.addEventListener("change", function() {

                    const existingErrorMessage = document.querySelector('.uploaderrorSpan');
                    if (existingErrorMessage) {
                        existingErrorMessage.remove();
                        imageInput.classList.remove('inputError');
                    }


                    read_url(this);
                });
            });

            function read_url(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var previewImage = document.getElementById("preview_image");
                        previewImage.setAttribute("src", e.target.result);
                        var imagePreview = document.getElementById("image_preview");
                        imagePreview.style.display = "block";
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

           


            $(document).ready(function() {
                fetch(window.baseUrl + "/checkGoogle")
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        if (response.headers.get("content-type") !== "application/json") {
                            throw new Error("Response is not JSON");
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.code == 200) {
                            cartAuthenticate();
                        }
                    })
                    .catch((error) => {
                        if (error.message === "Response is not JSON") {} else {
                            console.error("Error:", error);
                        }
                    });
            });
        </script>

    </section>


@endsection
