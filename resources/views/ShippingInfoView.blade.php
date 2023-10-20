@extends('layouts.master')

@section('title', $title)

@section('content')
    <!-- Your page-specific content goes here -->
    
    <section class="loginRegister container">

        <div class="breadcrumb">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipping Information</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">

                <div class="shippingInfo">
                    <div class="titleShipping">
                        <h3>Billing Information</h3>
                    </div>

                    <form action="{{ url('/editBillingAddress') }}" method="post" id="editBillingForm">
                        @csrf
                        <input type="hidden" name="address_id" value="{{ $billingAddress ? $billingAddress->id : '' }}">
                        <div class="my-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control shippingInput" id="name_billing" name="name"
                                placeholder="Your Full Name" value="{{ $billingAddress ? $billingAddress->name : '' }}"
                                oninput="getInput(event);removeValidation(event);">
                        </div>


                        <div class="my-3">

                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control shippingInput my-3" id="address1_billing"
                                placeholder="Address Lane 1"
                                value="{{ $billingAddress ? $billingAddress->street_address1 : '' }}" name="street_address1"
                                oninput="getInput(event);removeValidation(event);">

                            <input type="text" class="form-control shippingInput my-3" id="address2_billing"
                                placeholder="Address Lane 2"
                                value="{{ $billingAddress ? $billingAddress->street_address2 : '' }}" name="street_address2"
                                oninput="getInput(event);removeValidation(event);">

                            <input type="text" class="form-control shippingInput my-3" id="address3_billing"
                                placeholder="Address Lane 3"
                                value="{{ $billingAddress ? $billingAddress->street_address3 : '' }}" name="street_address3"
                                oninput="getInput(event);removeValidation(event);">

                            <label for="state" class="form-label">State</label>

                            <select class="form-select" id="state_billing" name="state"
                                oninput="getInput(event);removeValidation(event);">

                                <option value="" disabled selected>Select a state</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>

                            </select>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="my-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control shippingInput" id="city_billing"
                                        placeholder="Enter City" value="{{ $billingAddress ? $billingAddress->city : '' }}"
                                        name="city" oninput="getInput(event);removeValidation(event);">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="my-3">
                                    <label for="pincode_billing" class="form-label">ZIP Code</label>
                                    <input type="number" class="form-control shippingInput" id="pincode_billing"
                                        placeholder="Enter ZIP Code"
                                        value="{{ $billingAddress ? $billingAddress->postal_code : '' }}"
                                        name="postal_code" oninput="getInput(event);removeValidation(event);">

                                    <span id="postal_error1" class="text-danger hideSpan">Service Unavailable in Your Area!</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="my-3">
                                    <label for="phone_billing" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control shippingInput" id="phone_billing"
                                        placeholder="Enter Phone Number"
                                        value="{{ $billingAddress ? $billingAddress->phone : '' }}" name="phone"
                                        oninput="getInput(event);removeValidation(event);">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="my-3">
                                    <label for="alternate_phone_billing" class="form-label">Alternate Phone Number</label>
                                    <input type="number" class="form-control shippingInput" id="alternate_phone_billing"
                                        placeholder="Enter Alternate Phone Number"
                                        value="{{ $billingAddress ? $billingAddress->alternate_phone : '' }}"
                                        name="alternate_phone" oninput="getInput(event);removeValidation(event);">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="my-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" class="form-control shippingInput" id="comany_name"
                                        placeholder="Enter Company Name" value="{{ $billingAddress ? $billingAddress->company_name : '' }}"
                                        name="company_name" oninput="getInput(event);removeValidation(event);">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="my-3">
                                    <label for="gst" class="form-label">GST Number</label>
                                    <input type="text" class="form-control shippingInput" id="gst"
                                        placeholder="Enter GST"
                                        value="{{ $billingAddress ? $billingAddress->gst : '' }}"
                                        name="gst" oninput="getInput(event);removeValidation(event);">
                                </div>
                            </div>

                        </div>

                    </form>

                    <div class="shipping-button my-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                style="margin-top: 6px;" data-id="{{ url('/addShippingAddress') }}" {{($is_samae_as_billing) ? "checked" : ""}}>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Shipping Address same as Billing
                                Address</label>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-sm btn-primary" id="addShippingBtn" type="button"><i
                                    class="fa-regular fa-address-book"></i> Add New
                                Shipping Address</button>
                        </div>


                        <div class="modal2">
                            <div class="modal-content2">
                                <div class="closeIcon">
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                                <h2>Add Shipping Address</h2>

                                <form action="{{ url('/addShipping') }}" method="post" id="addShippingForm">
                                    <div class="my-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control shippingInput" id="name_shipping"
                                            name="name" placeholder="Your Full Name"
                                            oninput="remove_validation(event);">
                                    </div>

                                    @csrf

                                    <div class="my-3">

                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control shippingInput my-3"
                                            id="address1_shipping" placeholder="Address Lane 1" name="street_address1"
                                            oninput="remove_validation(event);">
                                        <input type="text" class="form-control shippingInput my-3"
                                            id="address2_shipping" placeholder="Address Lane 2" name="street_address2"
                                            oninput="remove_validation(event);">
                                        <input type="text" class="form-control shippingInput my-3"
                                            id="address3_shipping" placeholder="Address Lane 3" name="street_address3"
                                            oninput="remove_validation(event);">
                                    </div>
                                    <div class="my-3">
                                        <label for="state" class="form-label">State</label>
                                        <select class="form-select" id="state_shipping" name="state"
                                            oninput="remove_validation(event);">
                                            <option value="" disabled="" selected="">Select a state
                                            </option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>

                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="my-3">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control shippingInput"
                                                    id="city_shipping" placeholder="Enter City" name="city"
                                                    oninput="remove_validation(event);">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="my-3">
                                                <label for="pincode" class="form-label">ZIP Code</label>
                                                <input type="number" class="form-control shippingInput"
                                                    id="postal_code_shipping" placeholder="Enter ZIP Code"
                                                    name="postal_code" oninput="remove_validation(event);">
                                                    <span id="postal_error2" class="text-danger hideSpan" >Service Unavailable in Your Area!</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="my-3">
                                                <label for="phone_shipping" class="form-label">Phone Number</label>
                                                <input type="number" class="form-control shippingInput"
                                                    id="phone_shipping" placeholder="Enter Phone Number" name="phone"
                                                    oninput="remove_validation(event);">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="my-3">
                                                <label for="alternate_phone_shipping" class="form-label">Alternative Phone
                                                    Number</label>
                                                <input type="number" class="form-control shippingInput"
                                                    id="alternate_phone_shipping"
                                                    placeholder="Enter Alternate Phone Number" name="alternate_phone"
                                                    oninput="remove_validation(event);">
                                            </div>
                                        </div>

                                    </div>
                                </form>


                                <div class="my-3" style="text-align: right;">
                                    <button type="button" id="save-button2">Save</button>
                                    <button id="close-button2">Close</button>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="multipleBillingBox w-100 d-flex ">
                       
                        @if(!$is_samae_as_billing)

                        @if ($shippingAddresses)
                            @php $count = count($shippingAddresses); @endphp
                             @if ($count > 0)
                            @foreach ($shippingAddresses as $shippingAddress)
                                <div class="card w-{{ 100 / (int) $count }} p-2 m-1 mobile-address">
                                    <div class="card-body">

                                        <div class="form-check form-check-inline">

                                            <input class="form-check-input form-check-select" type="radio"
                                                name="addressId" id="inlineRadio1_{{ $shippingAddress->id }}"
                                                value="{{ $shippingAddress->id }}"
                                                {{ $shippingAddress->status == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1">Select Shipping
                                                Address</label>

                                        </div>



                                        <div class="w-100 billingItem">
                                            <i class="fa-solid fa-location-dot"></i>
                                            {{ $shippingAddress->street_address1 }} ,
                                            {{ $shippingAddress->street_address2 }},
                                             {{ $shippingAddress->street_address3 }}
                                        </div>
                                        <div class="w-100 billingItem">
                                            city - {{ $shippingAddress->city }}
                                        </div>
                                        <div class="w-100 billingItem">
                                            state - {{ $shippingAddress->state }}
                                        </div>
                                        <div class="w-100 billingItem">
                                            Pincode - {{ $shippingAddress->postal_code }}
                                        </div>
                                        <div class="text-center">
                                            <span class="p-2 m-1 delAddress"
                                                style="color: #fb483a;font-size:14px;font-weight:600;"
                                                data-id="{{ $shippingAddress->id }}"><i
                                                    class="fa-regular fa-trash-can del_ship" data-id="{{ $shippingAddress->id }}"></i> Delete</span>
                                            <span class="p-2 m-1 editAddress edit_shipping"
                                                style="color: #004A8C;font-size:14px;font-weight:600;"
                                                data-id="{{ $shippingAddress->id }}"><i class="fa-solid fa-file-pen edit_ship"  data-id="{{ $shippingAddress->id }}"></i>
                                                Edit</span>

                                        </div>
                                    </div>

                                </div>



                            @endforeach
                            @endif
                        @endif
                        @endif


                        <div class="modal4">
                            <div class="modal-content4">
                                <div class="closeIcon4">
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                                <h2>Edit Shipping Address</h2>

                                <form action="{{ url('/editShippingAddress') }}" method="post" id="editShippingForm">
                                    <div class="my-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control shippingInput" id="name_ship"
                                            name="name" placeholder="Your Full Name"
                                            >
                                    </div>

                                    @csrf

                                    <input type="hidden" name="id" id="AddressId">

                                    <div class="my-3">

                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control shippingInput my-3" id="address1_ship"
                                            placeholder="Address Lane 1" name="street_address1"
                                            >
                                        <input type="text" class="form-control shippingInput my-3" id="address2_ship"
                                            placeholder="Address Lane 2" name="street_address2"
                                            >
                                        <input type="text" class="form-control shippingInput my-3" id="address3_ship"
                                            placeholder="Address Lane 3" name="street_address3"
                                            >
                                    </div>
                                    <div class="my-3">
                                        <label for="state" class="form-label">State</label>
                                        <select class="form-select" id="state_ship" name="state"
                                            >
                                            <option value="" disabled="" selected="">Select a state
                                            </option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>

                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="my-3">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control shippingInput" id="city_ship"
                                                    placeholder="Enter City" name="city"
                                                    >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="my-3">
                                                <label for="pincode" class="form-label">ZIP Code</label>
                                                <input type="number" class="form-control shippingInput"
                                                    id="postal_code_ship" placeholder="Enter ZIP Code" name="postal_code"
                                                    >

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="my-3">
                                                <label for="phone_shipping" class="form-label">Phone Number</label>
                                                <input type="number" class="form-control shippingInput" id="phone_ship"
                                                    placeholder="Enter Phone Number" name="phone"
                                                    >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="my-3">
                                                <label for="alternate_phone_shipping" class="form-label">Alternative Phone
                                                    Number</label>
                                                <input type="number" class="form-control shippingInput"
                                                    id="alternate_phone_ship" placeholder="Enter Alternate Phone Number"
                                                    name="alternate_phone" >
                                            </div>
                                        </div>

                                    </div>
                                    <div class="my-3" style="text-align: right;">
                                        <button  type="button" id="save-button4">Save</button>
                                        <button type="button" id="close-button5">Close</button>
                                    </div>

                                </form>



                            </div>
                        </div>

                    </div>

                    {{-- <div class="text-center my-4">
                        <button class="btnShippingInfo">Save</button>
                    </div> --}}

                    <div class="buttonSummary" style="text-align: center;">

                        @php $productPrice= 0; @endphp
                        @foreach ($carts as $cart)
                            @php
                                $product = $cart->product;
                                $productPrice = $productPrice + $product->price * $cart->quantity;
                            @endphp
                        @endforeach

                        <form class="checkout-form" action="{{ url('/razorpay') }}" method="post">
                            @csrf
                            <input type="hidden" name="amount" id="productPrice"
                                value="{{ $productPrice + ($productPrice * 6) / 100 + ($productPrice * 6) / 100 }}">
                            <button type="submit" class="summaryCheckout2 my-2" id="placeOrderBtn2">Place Order</button>
                        </form>
                        <br>
                        {{-- <button class="summaryShopping my-2">Continue Shopping</button> --}}
                    </div>


                </div>

            </div>


            <div class="col-lg-4">
                <div class="orderSummaryCard">
                    <div class="orderSummaryCardHeader mb-4">
                        <h3 style="font-weight:600;"><i class="fa-solid fa-arrow-up-short-wide"></i> Order Summary</h3>
                    </div>

                    <div class="displayFlex">
                        <div class="w-100">
                            @foreach ($carts as $cart)
                                @php $product = $cart->product; @endphp

                                <div class="item-details d-flex justify-content-space-between align-items-center">
                                    <div class="itemName w-100">
                                        <img src="{{($product->product_image) ? asset('/products').'/'.$product->product_image : asset('/products/dummyProduct.jpg') }}" class="checkoutImage">
                                    </div>
                                    <div class="amountPrice w-100">
                                        <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $product->title }}</p>
                                        <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $product->price * $cart->quantity }}</p>
                                        <div class="quantity-selector1">
                                            <div class="quantityBtn1">
                                                <b>Quantity</b>
                                            </div>


                                            <input type="text" class="quantity-input1" value="{{ $cart->quantity }}">

                                        </div>
                                    </div>

                                </div>
                                <div class="horizontalLine1"></div>
                            @endforeach
                        </div>

                    </div>

                    <div class="displayFlex">
                        <div class="w-50">
                            <div class="totalItem">
                                <p>Subtotal</p>
                            </div>
                            <div class="totalItem">
                                <p>CGST({{$gst_details->cgst}}%)</p>
                            </div>
                            <div class="totalItem">
                                <p>SGST({{$gst_details->sgst}}%)</p>
                            </div>
                            <div class="totalItem">
                                <p>Total</p>
                            </div>
                        </div>
                        <div class="w-50">
                            <div class="totalPrice">
                                @php $productPrice= 0; @endphp
                                @foreach ($carts as $cart)
                                    @php
                                        $product = $cart->product;
                                        $productPrice = $productPrice + $product->price * $cart->quantity;
                                        $cgst = $gst_details->cgst;
                                        $sgst = $gst_details->sgst;
                                    @endphp
                                @endforeach
                                <p> {{ $productPrice }}</p>
                            </div>
                            <div class="totalPrice">
                                <p>{{ ($productPrice * $cgst) / 100 }}</p>
                            </div>
                            <div class="totalPrice">
                                <p>{{ ($productPrice * $sgst) / 100 }}</p>
                            </div>
                            <div class="totalPrice">
                                <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $productPrice + ($productPrice *  $cgst) / 100 + ($productPrice * $sgst) / 100 }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="horizontalLine1"></div>

                    <div class="buttonSummary">
                        <form class="checkout-form" action="{{ url('/razorpay') }}" method="post">
                            @csrf
                            <input type="hidden" name="amount" id="productPrice"
                                value="{{ $productPrice + ($productPrice * 6) / 100 + ($productPrice * 6) / 100 }}">
                            <button type="submit" class="summaryCheckout my-2" id="placeOrderBtn" >Place Order</button>
                        </form> 
                        <br>
                        <button class="summaryShopping my-2">Continue Shopping</button>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
       
         
         const postalCodeShipping = document.getElementById('postal_code_shipping');

postalCodeShipping.addEventListener('keypress', () => {
    handlePostalCodeEvent();
});

postalCodeShipping.addEventListener('keyup', () => {
    handlePostalCodeEvent();
});

function handlePostalCodeEvent() {
    if (postalCodeShipping.classList.contains('inputError')) {
        postalCodeShipping.classList.remove('inputError');
    }
        const postalError2 = document.getElementById('postal_error2');

        if (postalError2.classList.contains('showSpan')) {
            postalError2.classList.remove('showSpan');
            postalError2.classList.add('hideSpan');
        } else {
            postalError2.classList.add('hideSpan');
        }
    
}



 const PincodeBilling = document.getElementById('pincode_billing');

PincodeBilling.addEventListener('keypress', () => {
    handlePincodeEvent();
});

PincodeBilling.addEventListener('keyup', () => {
    handlePincodeEvent();
});

function handlePincodeEvent() {
    if (PincodeBilling.classList.contains('inputError')) {
        PincodeBilling.classList.remove('inputError');
    }
        const postalError1 = document.getElementById('postal_error1');

        if (postalError1.classList.contains('showSpan')) {
            postalError1.classList.remove('showSpan');
            postalError1.classList.add('hideSpan');
        } else {
            postalError1.classList.add('hideSpan');
        }
    
}

       

    </script>




    <script>
       

        function editShippingValidation(){
            var name_ship = $("#name_ship").val();
            var address1_ship = $("#address1_ship").val();
            var address2_ship = $("#address2_ship").val();
            var address3_ship = $("#address3_ship").val();

            var state_ship = $("#state_ship").val();
            var city_ship = $("#city_ship").val();
            var postal_code_ship = $("#postal_code_ship").val();

            var phone_ship = $("#phone_ship").val();
            //var alternate_phone_ship = $("#alternate_phone_ship").val();

            var status = false;



            if (name_ship == "") {
                if ($("#name_ship").hasClass("inputSuccess")) {
                    $("#name_ship").removeClass("inputSuccess");
                    $("#name_ship").addClass("inputError");
                } else {
                    $("#name_ship").addClass("inputError");
                }
            }

            if (address1_ship == "") {
                if ($("#address1_ship").hasClass("inputSuccess")) {
                    $("#address1_ship").removeClass("inputSuccess");
                    $("#address1_ship").addClass("inputError");
                } else {
                    $("#address1_ship").addClass("inputError");
                }
            }

            if (address2_ship == "") {
                if ($("#address2_ship").hasClass("inputSuccess")) {
                    $("#address2_ship").removeClass("inputSuccess");
                    $("#address2_ship").addClass("inputError");
                } else {
                    $("#address2_ship").addClass("inputError");
                }
            }

            if (address3_ship == "") {

                if ($("#address3_ship").hasClass("inputSuccess")) {
                    $("#address3_ship").removeClass("inputSuccess");
                    $("#address3_ship").addClass("inputError");
                } else {
                    $("#address3_ship").addClass("inputError");
                }
            }

            if (!state_ship) {

                if ($("#state_ship").hasClass("inputSuccess")) {
                    $("#state_ship").removeClass("inputSuccess");
                    $("#state_ship").addClass("inputError");
                } else {
                    $("#state_ship").addClass("inputError");
                }

            }

            if (city_ship == "") {

                if ($("#city_ship").hasClass("inputSuccess")) {
                    $("#city_ship").removeClass("inputSuccess");
                    $("#city_ship").addClass("inputError");
                } else {
                    $("#city_ship").addClass("inputError");
                }
            }

            if (postal_code_ship == "") {
                if ($("#postal_code_ship").hasClass("inputSuccess")) {
                    $("#postal_code_ship").removeClass("inputSuccess");
                    $("#postal_code_ship").addClass("inputError");
                } else {
                    $("#postal_code_ship").addClass("inputError");
                }
            }

            if (phone_ship == "") {

                if ($("#phone_ship").hasClass("inputSuccess")) {
                    $("#phone_ship").removeClass("inputSuccess");
                    $("#phone_ship").addClass("inputError");
                } else {
                    $("#phone_ship").addClass("inputError");
                }
            }

            // if (alternate_phone_ship == "") {

            //     if ($("#alternate_phone_ship").hasClass("inputSuccess")) {
            //         $("#alternate_phone_ship").removeClass("inputSuccess");
            //         $("#alternate_phone_ship").addClass("inputError");
            //     } else {
            //         $("#alternate_phone_ship").addClass("inputError");
            //     }


            // }

            if (name_ship != "" && address1_ship != "" && address2_ship != "" && address3_ship != "" &&
                state_ship != "" && city_ship != "" && postal_code_ship != "" && phone_ship != "") {


                if ($("#name_ship").hasClass("inputError")) {
                    $("#name_ship").removeClass("inputError");
                }

                if ($("#address1_ship").hasClass("inputError")) {
                    $("#address1_ship").removeClass("inputError");
                }

                if ($("#address2_ship").hasClass("inputError")) {
                    $("#address2_ship").removeClass("inputError");
                }

                if ($("#address3_ship").hasClass("inputError")) {
                    $("#address3_ship").removeClass("inputError");
                }


                if ($("#state_ship").hasClass("inputError")) {
                    $("#state_ship").removeClass("inputError");
                }

                if ($("#city_ship").hasClass("inputError")) {
                    $("#city_ship").removeClass("inputError");
                }

                if ($("#postal_code_ship").hasClass("inputError")) {
                    $("#postal_code_ship").removeClass("inputError");
                }

                if ($("#phone_ship").hasClass("inputError")) {
                    $("#phone_ship").removeClass("inputError");
                }

                // if ($("#alternate_phone_ship").hasClass("inputError")) {
                //     $("#alternate_phone_ship").removeClass("inputError");
                // }

                return status = true;
            } else {
                return status = false;
            }

        }


        function ShippingValidation() {

            var name_shipping = $("#name_shipping").val();
            var address1_shipping = $("#address1_shipping").val();
            var address2_shipping = $("#address2_shipping").val();
            var address3_shipping = $("#address3_shipping").val();

            var state_shipping = $("#state_shipping").val();
            var city_shipping = $("#city_shipping").val();
            var postal_code_shipping = $("#postal_code_shipping").val();

            var phone_shipping = $("#phone_shipping").val();
            //var alternate_phone_shipping = $("#alternate_phone_shipping").val();

            var status = false;



            if (name_shipping == "") {
                if ($("#name_shipping").hasClass("inputSuccess")) {
                    $("#name_shipping").removeClass("inputSuccess");
                    $("#name_shipping").addClass("inputError");
                } else {
                    $("#name_shipping").addClass("inputError");
                }
            }

            if (address1_shipping == "") {
                if ($("#address1_shipping").hasClass("inputSuccess")) {
                    $("#address1_shipping").removeClass("inputSuccess");
                    $("#address1_shipping").addClass("inputError");
                } else {
                    $("#address1_shipping").addClass("inputError");
                }
            }

            if (address2_shipping == "") {
                if ($("#address2_shipping").hasClass("inputSuccess")) {
                    $("#address2_shipping").removeClass("inputSuccess");
                    $("#address2_shipping").addClass("inputError");
                } else {
                    $("#address2_shipping").addClass("inputError");
                }
            }

            if (address3_shipping == "") {

                if ($("#address3_shipping").hasClass("inputSuccess")) {
                    $("#address3_shipping").removeClass("inputSuccess");
                    $("#address3_shipping").addClass("inputError");
                } else {
                    $("#address3_shipping").addClass("inputError");
                }
            }

            if (!state_shipping) {

                if ($("#state_shipping").hasClass("inputSuccess")) {
                    $("#state_shipping").removeClass("inputSuccess");
                    $("#state_shipping").addClass("inputError");
                } else {
                    $("#state_shipping").addClass("inputError");
                }

            }

            if (city_shipping == "") {

                if ($("#city_shipping").hasClass("inputSuccess")) {
                    $("#city_shipping").removeClass("inputSuccess");
                    $("#city_shipping").addClass("inputError");
                } else {
                    $("#city_shipping").addClass("inputError");
                }
            }

            if (postal_code_shipping == "") {
                if ($("#postal_code_shipping").hasClass("inputSuccess")) {
                    $("#postal_code_shipping").removeClass("inputSuccess");
                    $("#postal_code_shipping").addClass("inputError");
                } else {
                    $("#postal_code_shipping").addClass("inputError");
                }
            }

            if (phone_shipping == "") {

                if ($("#phone_shipping").hasClass("inputSuccess")) {
                    $("#phone_shipping").removeClass("inputSuccess");
                    $("#phone_shipping").addClass("inputError");
                } else {
                    $("#phone_shipping").addClass("inputError");
                }
            }

            // if (alternate_phone_shipping == "") {

            //     if ($("#alternate_phone_shipping").hasClass("inputSuccess")) {
            //         $("#alternate_phone_shipping").removeClass("inputSuccess");
            //         $("#alternate_phone_shipping").addClass("inputError");
            //     } else {
            //         $("#alternate_phone_shipping").addClass("inputError");
            //     }


            // }

            if (name_shipping != "" && address1_shipping != "" && address2_shipping != "" && address3_shipping != "" &&
                state_shipping != "" && city_shipping != "" && postal_code_shipping != "" && phone_shipping != "") {


                if ($("#name_shipping").hasClass("inputError")) {
                    $("#name_shipping").removeClass("inputError");
                }

                if ($("#address1_shipping").hasClass("inputError")) {
                    $("#address1_shipping").removeClass("inputError");
                }

                if ($("#address2_shipping").hasClass("inputError")) {
                    $("#address2_shipping").removeClass("inputError");
                }

                if ($("#address3_shipping").hasClass("inputError")) {
                    $("#address3_shipping").removeClass("inputError");
                }


                if ($("#state_shipping").hasClass("inputError")) {
                    $("#state_shipping").removeClass("inputError");
                }

                if ($("#city_shipping").hasClass("inputError")) {
                    $("#city_shipping").removeClass("inputError");
                }

                if ($("#postal_code_shipping").hasClass("inputError")) {
                    $("#postal_code_shipping").removeClass("inputError");
                }

                if ($("#phone_shipping").hasClass("inputError")) {
                    $("#phone_shipping").removeClass("inputError");
                }

                // if ($("#alternate_phone_shipping").hasClass("inputError")) {
                //     $("#alternate_phone_shipping").removeClass("inputError");
                // }

                return status = true;
            } else {
                return status = false;
            }

        }




        function removeValidation(event) {
            if (event.target.classList.contains("inputError")) {
                event.target.classList.remove("inputError");
                // const checkbox = document.getElementById('flexSwitchCheckDefault');
                // checkbox.disabled = false;
            }
        }

        function remove_validation(event) {
            if (event.target.classList.contains("inputError")) {
                event.target.classList.remove("inputError");

            }

            const button = document.getElementById("save-button2");
            if (button.disabled) {
                button.disabled = false;
            }
        }


  


        
        const saveButton2 = document.getElementById('save-button2');

        saveButton2.addEventListener('click', function() {

            var validationStatus = ShippingValidation();

           saveButton2.style.backgroundColor="#004a8cab";
           saveButton2.disabled="true";
           saveButton2.innerHTML="<i class='fa fa-spinner fa-spin'></i>";
           


            if (validationStatus) {

                const addShippingForm = document.getElementById("addShippingForm");
               // addShippingForm.submit();
                const formData = new FormData(addShippingForm);
                const serializedArray = [];
                formData.forEach((value, key) => {
                    serializedArray.push({ name: key, value: value });
                });

                console.log(serializedArray);

                 const url = 'http://127.0.0.1:8000/addShipping';
                const csrfToken = getCsrfToken();

                const requestOptions = {
                                method: 'POST',
                                    headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': csrfToken, 
                                            },
                                        body: JSON.stringify(serializedArray), 
                                };


                                 fetch(url, requestOptions)
                                .then((response) => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                        return response.json(); // Parse the response as JSON if needed
                                })
                                .then((data) => {

                                    saveButton2.innerHTML="Save";
                                    saveButton2.style.backgroundColor="#004a8c";

                                        console.log(data);

                                        if(data.code==200){
                                            toastr.success(data.msg,'Success',{
                                                 onHidden: function() {
                                                    location.reload();
                                                 }
                                            });
                                            
                                        }
                                        else{
                                            //toastr.error(data.msg);


                                            if($("#postal_error2").hasClass('hideSpan')){

                                           
                                                $("#postal_error2").removeClass('hideSpan');
                                                $("#postal_error2").addClass('showSpan');
                                            }
                                            else{
                                                $("#postal_error2").addClass('showSpan');
                                            }
                                        

                                            $("#postal_code_shipping").addClass('inputError');
                                            
                                            saveButton2.disabled="false";
                                            

                                           

                                        }


                                        
                                }).catch((error) => {
    
                                    console.error('There was a problem with the fetch operation:', error);
                                });
                   

            }
            else{
                saveButton2.innerHTML="Save";
                saveButton2.disabled="false";
                saveButton2.style.backgroundColor="#004a8c";
            }

        });


     

         const saveButton4 = document.getElementById('save-button4');
        saveButton4.addEventListener('click', function() {
            var validationStatus = editShippingValidation();
            console.log(validationStatus);

            if (validationStatus) {
                const editShippingForm = document.getElementById("editShippingForm");
                const formData = new FormData(editShippingForm);

                const serializedArray = [];
                formData.forEach((value, key) => {
                    serializedArray.push({ name: key, value: value });
                });

                    console.log(serializedArray);


                   
                    const url = 'http://127.0.0.1:8000/editShippingAddress';
                    const csrfToken = getCsrfToken();
                   
                        
                        const requestOptions = {
                                method: 'POST',
                                    headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': csrfToken, 
                                            },
                                        body: JSON.stringify(serializedArray), 
                                };


                            fetch(url, requestOptions)
                                .then((response) => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                        return response.json(); // Parse the response as JSON if needed
                                })
                                .then((data) => {
   
                                        console.log(data);
                                        if(data.code==200){
                                            toastr.success(data.msg,'Success',{
                                                onHidden: function() {
                                                     location.reload();
                                                }
                                            });
                                         
                                        }
                                }).catch((error) => {
    
                                    console.error('There was a problem with the fetch operation:', error);
                                });
                        }

        });



        function getInput(event) {

            const inputElement = event.target;
            const inputValue = inputElement.value;
            const inputName = event.target.getAttribute('name');
           


            console.log(inputValue);
            console.log(inputName);

            


            const dataObj = {
                [inputName]: inputValue
            }


            // const csrfToken = $("[name='_token']").val();
            const csrfToken = getCsrfToken();


            fetch('http://127.0.0.1:8000/updateBillingOnInput', {
                    method: 'POST',
                    body: JSON.stringify(dataObj),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    // toastr.success(data.msg);
                    // setTimeout(() => {
                    //     window.location.reload();
                    // }, 3000);
                   
                    
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });



        }

        
    </script>


    <script>
        var selectedState = "<?= $billingAddress ? $billingAddress->state : '' ?>";

        var state_billing = document.getElementById('state_billing');

        for (var i = 0; i < state_billing.options.length; i++) {
            if (state_billing.options[i].value === selectedState) {
                state_billing.options[i].selected = true;
                break;
            }
        }



        const checkbox = document.getElementById('flexSwitchCheckDefault');

        checkbox.addEventListener('change', function(event) {
            if (this.checked) {


                var validationStatus = BillingValidation();
                if (validationStatus) {
                    //success

                   


                    var formAction = event.target.getAttribute('data-id');

                    var form_datas = $("#editBillingForm").serializeArray();
                    const csrfToken = getCsrfToken();
                    fetch(formAction, {
                            method: 'POST',
                            body: JSON.stringify(form_datas),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data);
                              
                            if (data.code == 200) {
                                toastr.success(data.msg,'Success',{
                                     onHidden: function() {
                                         window.location.reload();
                                     }
                                });
                               
                            } else {
                                var pincode_billing = document.getElementById('pincode_billing');
                                pincode_billing.classList.add('inputError');

                                //toastr.error(data.msg);

                                  if($("#postal_error1").hasClass('hideSpan')){

                                           
                                                $("#postal_error1").removeClass('hideSpan');
                                                $("#postal_error1").addClass('showSpan');
                                            }
                                            else{
                                                $("#postal_error1").addClass('showSpan');
                                            }


                                             checkbox.checked = false;



                            }



                           
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });
                } 

            }
            else{
                
                          fetch("http://127.0.0.1:8000/uncheckSameAsBilling", {
                            method: 'GET',
                            }).then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data);
                           if(data.code==200){
                               location.reload();
                           }
                           
                          
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });

            }
        });




        

    </script>

@endsection
