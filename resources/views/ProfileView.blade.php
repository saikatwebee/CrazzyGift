@extends('layouts.master')

@section('title', $title)

@section('content')
    <!-- Your page-specific content goes here -->

    <section class="loginRegister container">
        <div class="breadcrumb">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                </ol>
            </div>
        </div>

        <div class="profileSec">
            <div class="profilebox">
                <div class="profilebox-item">


                    <div class="profile-picture">
                        <img src="{{ auth()->user()->profile_image == null ? asset('images/icons/profileAvatar.png') : asset('profile/' . auth()->user()->profile_image) }}"
                            alt="Profile Picture">
                        <div class="edit-icon" id="edit-icon">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                    </div>


                    <div class="modal">
                        <div class="modal-content upload-content">
                            <div class="closeIcon2">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <h2>Upload Profile Picture</h2>
                            <form action="{{ url('/profileUpload') }}" method="POST" enctype="multipart/form-data"
                                id="uploadForm">
                                {{-- @csrf --}}

                                <input type="hidden" name="_token" id="profile_csrf" value="{{ csrf_token() }}">
                                <div class="mb-3">
                                    {{-- <label for="formFile" class="form-label">Default file input example</label> --}}
                                    <input class="form-control" type="file" id="image" name="profile_image"
                                        accept="image/*">
                                </div>

                                <div id="image-preview" style="display: none;">
                                    <h2>Preview:</h2>
                                    <img id="preview-image" src="#" alt="Image Preview" />
                                </div>

                                <div class="my-3" style="text-align: right;">
                                    <div class="submit-container">
                                        <i class="fa fa-spinner fa-spin spinner" style="display:none;"></i>
                                        <input type="submit" id="uploadprofileBtn" class="loginButton mt-4" value="Upload">

                                    </div>
                                    <button type="button" id="close-button4">Close</button>

                                </div>
                            </form>



                        </div>
                    </div>
                </div>

                <div class="profilebox-item">
                    <div class="text-center">

                        <div class="profile-card">
                            <h3 style="font-weight:600;">{{ auth()->user()->name ? auth()->user()->name : '' }}</h3>
                            <h3 style="font-weight:600;">Customer ID : {{ auth()->user()->id ? auth()->user()->id : '' }}
                            </h3>
                            <div class="profile-item">
                                <span class="icon">
                                    <i class="fa-solid fa-user-lock"></i>
                                </span>
                                <span class="info">{{ auth()->user()->username ? auth()->user()->username : '' }}</span>
                            </div>
                            <div class="profile-item">
                                <span class="icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <span class="info">{{ auth()->user()->email ? auth()->user()->email : '' }}</span>
                            </div>
                            <div class="profile-item">
                                <span class="icon">
                                    <i class="fa-solid fa-square-phone"></i>
                                </span>
                                <span class="info">{{ auth()->user()->phone ? auth()->user()->phone : '' }}</span>
                            </div>


                        </div>



                    </div>

                    <!-- profile modal start-->

                    <div class="modal3">
                        <div class="modal-content3">
                            <div class="closeIcon1">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <h2 id="profile_model_heading">Edit Profile</h2>

                            <form action="{{ url('/updateProfile') }}" method="post" id="updateprofileForm">
                                <div class="my-4">
                                    <label for="name" class="form-label">Username</label>
                                    <input type="text" class="form-control shippingInput" id="username" name="username"
                                        placeholder="Your Username"
                                        value="{{ auth()->user()->username ? auth()->user()->username : '' }}"
                                        disabled="true" oninput="removeProfileValidation(event)">

                                </div>

                                <div class="my-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control shippingInput" id="name" name="name"
                                        placeholder="Your Full Name"
                                        value="{{ auth()->user()->name ? auth()->user()->name : '' }}"
                                        oninput="removeProfileValidation(event)">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="my-4">
                                    <label for="name" class="form-label">Phone</label>
                                    <input type="text" class="form-control shippingInput" id="phone"
                                        name="phone" placeholder="Your Phone"
                                        value="{{ auth()->user()->phone ? auth()->user()->phone : '' }}"
                                        oninput="removeProfileValidation(event)">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="my-4">
                                    <label for="name" class="form-label">Email</label>
                                    <input type="text" class="form-control shippingInput" id="email"
                                        name="email" placeholder="Your Email"
                                        value="{{ auth()->user()->email ? auth()->user()->email : '' }}"
                                        oninput="removeProfileValidation(event)">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @csrf


                                <div class="my-3" style="text-align: right;">
                                    <button id="save-button3">Save</button>
                                    <button type="button" id="close-button3">Close</button>
                                </div>

                            </form>


                        </div>
                    </div>
                    <!-- Profile Modal ended here-->






                </div>

            </div>

            <div class="iconEdit1" id="editmodalicon" title="Edit Profile">
                <i class="fa-solid fa-user-pen"></i>
            </div>
        </div>

        <div class="profileSec my-3">
            <div class="faq">
                <div id="order-toggle">
                    <div class="question">Orders</div>
                    <div class="question-description">View All Order</div>
                    <i class="fas fa-angle-right"></i>
                </div>
                <div class="answer" id="answer-toggle">
                    <div class="horizontalLine"></div>

                    @if ($orders)
                        @if (count($orders) > 0)
                            <div class="row my-3">

                                @foreach ($orders as $order)
                                    @php
                                        $products = $order->product_details;

                                        $product_title = $order->title;
                                        $amount = $order->amount;
                                        $order_id = $order->order_id;
                                        $order_status = $order->order_status;
                                        $awb = $order->awb_number;

                                        $dateObj = new DateTime($order->created_at);
                                        $orderDate = $dateObj->format('jS M Y');

                                        $totalAmount = str_replace('.00', '', $order->amount);

                                        if ($order->track_shipping) {
                                            $scan_stages = $order->track_shipping->object->field[36]->object;

                                            $orderId_tracking = $order->track_shipping->object->field[1]; //orderid

                                            $status = $order->track_shipping->object->field[10]; //status

                                            $reason_code_number = $order->track_shipping->object->field[14]; //reason_code_number

                                            $last_update_datetime = $order->track_shipping->object->field[20]; // last_update_datetime

                                            $delivery_date = $order->track_shipping->object->field[21]; //delivery_date
                                            if ($delivery_date != '') {
                                                $dateObj2 = new DateTime($delivery_date);
                                                $deliveryDate = $dateObj2->format('jS M Y h:i A');
                                            }

                                            $expected_date = $order->track_shipping->object->field[18]; //expected_date

                                            if ($expected_date != '') {
                                                $dateObj3 = new DateTime($expected_date);
                                                $expectedDate = $dateObj3->format('jS M Y');
                                            }
                                        }
                                    @endphp





                                    <div class="col-lg-12 my-3">
                                        <div class="shippingInfo">
                                            <div class="orderSummaryCard">
                                                @if ($order->order_status == 0)
                                                    <div class="ribbon-box">
                                                        <div class="ribbon ribbon-top-right ribbon-cancelled"><span>Order
                                                                Cancelled</span></div>
                                                    </div>
                                                @endif

                                                @if ($order->track_shipping)
                                                    @if (
                                                        ($order->order_status == 1 ||
                                                            $order->order_status == 2 ||
                                                            $order->order_status == 3 ||
                                                            $order->order_status == 4) &&
                                                            $order->order_status != 5)
                                                        <div class="ribbon-box">
                                                            <div class="ribbon ribbon-top-right ribbon-processing">
                                                                <span>Order Processing</span>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($order->order_status == 5 && $reason_code_number == 999)
                                                        <div class="ribbon-box">
                                                            <div class="ribbon ribbon-top-right ribbon-delivered">
                                                                <span>Order Delivered</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="row">


                                                            @foreach (json_decode($products) as $product)
                                                                <div class="product">
                                                                    <img src="{{ asset('/products') . '/' . $product->product_image }}"
                                                                        alt="cart_1">
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                        <!-- <div class="row">
                                                                            <div class="col-lg-12"><p class="mt-2">{{ $order->shipping_address }}</p></div>
                                                                            <div class="col-lg-12"><p class="mt-2">{{ $order->shipping_address }}</p></div>
                                                                            <div class="col-lg-12"><p class="mt-2">{{ $order->shipping_address }}</p></div>
                                                                    </div> -->

                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="row ">
                                                            <div class="nameAndPrice2">
                                                                <p>Order Id : {{ $order->order_id }}</p>

                                                                <h3>Total : <i class="fa-solid fa-indian-rupee-sign"></i>
                                                                    {{ $totalAmount }}</h3>



                                                                <p class="my-4" style="font-size: 13px;">
                                                                    {{ $order->shipping_address }}</p>

                                                                <p class="mt-3" style="font-size: 13px;"
                                                                    id="deliveredMsg">
                                                                    Order Placed on {{ $orderDate }}</p>


                                                                @if ($order->track_shipping)
                                                                    @if ($reason_code_number == 999 && $order->order_status == 5)
                                                                        @if ($delivery_date != '')
                                                                            <p class="mt-3" style="font-size: 12px;"
                                                                                id="deliveredMsg">
                                                                                Order Delivered on {{ $deliveryDate }}</p>
                                                                        @endif
                                                                    @else
                                                                        @if ($expected_date != '')
                                                                            <p class="mt-3" style="font-size: 12px;"
                                                                                id="deliveredMsg">
                                                                                <?= 'Expected Delivery on ' . $expectedDate
                                                                                ?> </p>
                                                                        @endif
                                                                    @endif
                                                                @endif

                                                            </div>

                                                        </div>
                                                    </div>

                                                    @if ($order->order_status != 0)
                                                        <div class="col-lg-6" id="dFlex">

                                                            <div class="w-100" style="margin-top:12vh;">
                                                                @if ($order->track_shipping)
                                                                    <div class="orderTrack">
                                                                        <div class="orderTrackBar"></div>
                                                                        <ul class="orderTrackPoints">

                                                                            <li class="tracking-item active"
                                                                                data-status-text="Order Placed"
                                                                                data-date="{{ $order->created_at }}">Order
                                                                                Placed<br><br><br><br>

                                                                            </li>

                                                                            <li class="tracking-item {{ $reason_code_number == 003 || $reason_code_number == 005 || $reason_code_number == 006 || $reason_code_number == 999 ? 'active' : '' }}"
                                                                                data-date="May 6, 2023">Order Shipped
                                                                                <br><br><br><br>

                                                                            </li>
                                                                            <li class="tracking-item {{ $reason_code_number == 005 || $reason_code_number == 006 || $reason_code_number == 999 ? 'active' : '' }}"
                                                                                data-status-text="Reached Hub">Reached Hub
                                                                                <br><br><br><br>

                                                                            <li
                                                                                class="tracking-item {{ $reason_code_number == 006 || $reason_code_number == 999 ? 'active' : '' }}">
                                                                                Out for Delivery<br><br><br><br>

                                                                            </li>
                                                                            <li class="tracking-item {{ $reason_code_number == 999 && $order->order_status == 5 ? 'active' : '' }}"
                                                                                data-status-text="Delivered">Order
                                                                                Delivered<br><br><br><br>

                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @else
                                                                    <div class="orderTrack">
                                                                        <div class="orderTrackBar"></div>
                                                                        <ul class="orderTrackPoints">

                                                                            <li class="tracking-item active"
                                                                                data-status-text="Order Placed static"
                                                                                data-date="{{ $order->created_at }}">Order
                                                                                Placed<br><br><br><br>

                                                                            </li>

                                                                            <li class="tracking-item "
                                                                                data-status-text="Order Shipped static">
                                                                                Order Shipped
                                                                                <br><br><br><br>

                                                                            </li>
                                                                            <li class="tracking-item "
                                                                                data-status-text="Reached Hub static">
                                                                                Reached Hub
                                                                                <br><br><br><br>

                                                                            <li class="tracking-item"
                                                                                data-status-text="Out for Delivery static">
                                                                                Delivery<br><br><br><br>

                                                                            </li>
                                                                            <li class="tracking-item"
                                                                                data-status-text="Delivered static">Order
                                                                                Delivered<br><br><br><br>

                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                @endif


                                                            </div>

                                                        </div> {{-- col-lg-7 end --}}
                                                    @endif


                                                    @if ($order->order_status != 0)
                                                        @if ($order->track_shipping)
                                                            @if ($reason_code_number == 001 || $reason_code_number == 1220 || $reason_code_number == 1340)
                                                                <div class="w-100 mb-2" style="text-align:right;"><button
                                                                        class="btn btn-outline-danger"
                                                                        style="border-radius:20px;"
                                                                        onclick="cancelOrder({{ $order->id }})">Cancel
                                                                        Order</button></div>
                                                            @endif

                                                            @if ($reason_code_number == 999 && $order->order_status == 5)
                                                                <div class="w-100 mb-2" style="text-align:right;"><button
                                                                        class="btn btn-outline-success"
                                                                        style="border-radius:20px;"
                                                                        onclick="downloadInvoice({{ $order->id }})">Download
                                                                        Invoice</button></div>
                                                            @endif
                                                        @else
                                                            <script>
                                                                toastr.warning("Kindly Reattempt the Shipment for OrderId : {{ $order->order_id }}");
                                                            </script>
                                                            <div class="w-100 mb-2" style="text-align:right;"><button
                                                                    class="btn btn-outline-success"
                                                                    style="border-radius:20px;"
                                                                    onclick="reattemptShipment({{ $order->id }})">Reattempt
                                                                    Shipment</button></div>
                                                        @endif
                                                    @endif


                                                </div> {{-- child row end --}}


                                            </div>
                                        </div>
                                    </div>
                                @endforeach



                            </div>
                        @else
                            <div class="emptyCart  p-3 my-3" style="display: block;">
                                <p class="text-center">No Orders Yet</p>
                            </div>
                        @endif
                    @endif


                </div>
            </div>
        </div>

        <div class="profileSec my-3">
            <div class="faq">
                @if ($addresses)
                    @php $count = count($addresses); @endphp
                    <div class="question-wrapper" id="address-btn">
                        <div class="question">Addresses</div>
                        <div class="question-description">
                            {{ $count > 0 ? 'View All Saved Address' : 'No Records available' }}</div>
                        <i class="fas fa-angle-right"></i>
                    </div>
                    <div class="answer" id="address-toggle">
                        <div class="horizontalLine"></div>

                        <div class="multipleBillingBox w-100  ">




                            <ul class="nav nav-tabs" id="myTabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1" data-bs-toggle="tab"
                                        href="#content1">Billing Address</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab2" data-bs-toggle="tab" href="#content2">Shipping
                                        Address</a>
                                </li>

                            </ul>

                            <div class="tab-content my-4" id="myTabsContent">

                                <div class="tab-pane fade show active" id="content1">
                                    <div class="row">
                                        @php $status=true; @endphp
                                        @foreach ($addresses as $address)
                                            @if ($address->is_billing_address == 1 && $address->status == 2)
                                                <div class="card  mobile-address col-lg-6" style="border:none;">
                                                    <div class="card-body mb-3"
                                                        style="border:1px solid #ccc; border-radius: 10px;">

                                                        <div class="billingItem">
                                                            {{ $address->name }}
                                                        </div>
                                                        <div class="billingItem">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            {{ $address->street_address1 }} ,
                                                            {{ $address->street_address2 }}
                                                        </div>
                                                        <div class="billingItem">
                                                            city - {{ $address->city }}
                                                        </div>
                                                        <div class="billingItem">
                                                            state - {{ $address->state }}
                                                        </div>
                                                        <div class="billingItem">
                                                            Pincode - {{ $address->postal_code }}
                                                        </div>
                                                        <div class="text-center">
                                                            <span class="p-2 m-1 delAddress"
                                                                style="color: #fb483a;font-size:14px;font-weight:600;"
                                                                data-id="{{ $address->id }}"><i
                                                                    class="fa-regular fa-trash-can"></i>
                                                                Delete</span>
                                                            <span class="p-2 m-1 editAddress"
                                                                style="color: #004A8C;font-size:14px;font-weight:600;"
                                                                data-id="{{ $address->id }}"
                                                                onclick="editAddress(event)"><i
                                                                    class="fa-solid fa-file-pen"
                                                                    data-id="{{ $address->id }}"
                                                                    onclick="editAddress(event)"></i>
                                                                Edit</span>

                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach




                                    </div>
                                </div>

                                <div class="tab-pane fade" id="content2">

                                    <div class="row">

                                        @foreach ($addresses as $address)
                                            @if ($address->is_shipping_address == 1)
                                                <div class="card  mobile-address col-lg-6" style="border:none;">
                                                    <div class="card-body mb-3"
                                                        style="border:1px solid #ccc; border-radius: 10px;">

                                                        <div class="billingItem">
                                                            {{ $address->name }}
                                                        </div>
                                                        <div class="billingItem">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            {{ $address->street_address1 }} ,
                                                            {{ $address->street_address2 }}
                                                        </div>
                                                        <div class="billingItem">
                                                            city - {{ $address->city }}
                                                        </div>
                                                        <div class="billingItem">
                                                            state - {{ $address->state }}
                                                        </div>
                                                        <div class="billingItem">
                                                            Pincode - {{ $address->postal_code }}
                                                        </div>
                                                        <div class="text-center">
                                                            <span class="p-2 m-1 delAddress"
                                                                style="color: #fb483a;font-size:14px;font-weight:600;"
                                                                data-id="{{ $address->id }}"><i
                                                                    class="fa-regular fa-trash-can"></i>
                                                                Delete</span>
                                                            <span class="p-2 m-1 editAddress"
                                                                style="color: #004A8C;font-size:14px;font-weight:600;"
                                                                data-id="{{ $address->id }}"
                                                                onclick="editAddress(event)"><i
                                                                    class="fa-solid fa-file-pen"
                                                                    data-id="{{ $address->id }}"
                                                                    onclick="editAddress(event)"></i>
                                                                Edit</span>

                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach



                                    </div>

                                </div>




                            </div>







                        </div>


                    </div>
            </div>
            @endif


        </div>

        <div class="profileSec my-3">
            <a href="javascript:void(0)" class="faq" onclick="forceLogout()">
                <div class="question-wrapper">
                    <div class="question" style="color:#FF6A6A;">Logout</div>
                    <i class="fas fa-angle-right text-dark"></i>
                </div>
            </a>
        </div>



        <!-- profile modal start-->

        <div class="profileVerifyModel">
            <div class="profileVerifyModelContent">
                <form id="profile-otp" method="post" action="{{ url('/verifyOtpProfile') }}">
                    <h5 class="small-heading" class="mb-3 text-center">Enter OTP to verify your Mobile Number</h5>
                    @csrf
                    <div class="otp-input my-4">
                        <input type="hidden" name="phone" id="hidPhone">
                        <input type="text" name="otp1" id="otp1" maxlength="1"
                            onkeyup="moveToNext(this, 'otp2')" required="">
                        <input type="text" name="otp2" id="otp2" maxlength="1"
                            onkeyup="moveToNext(this, 'otp3')" required="">
                        <input type="text" name="otp3" id="otp3" maxlength="1"
                            onkeyup="moveToNext(this, 'otp4')" required="">
                        <input type="text" name="otp4" id="otp4" maxlength="1" required="">
                    </div>
                    <span class="resend-box">
                        <p id="ch_num" onclick="changeNum()">Change Number</p>
                        <p id="re_num" onclick="resendOtp(event)">Resend OTP</p>
                    </span>



                    <div class="my-3" style="text-align: center;">
                        <button class="btn btn-primary" id="save_btn">Verify</button>
                        <!-- <button class="btn btn-primary" type="button" id="profileVerifyCloseBtn">Close</button> -->
                    </div>

                </form>


            </div>
        </div>
        <!-- Profile Modal ended here-->


        <!-- Edit Shipping address model start-->

        <div class="editAddressModal" id="editAddressModal">
            <div class="modal-content4">
                <div class="closeIcon4">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <h2>Edit Shipping Address</h2>

                <form action="{{ url('/updateAddress') }}" method="post" id="updateAddressForm">
                    <div class="my-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control shippingInput" id="name_ship" name="name"
                            placeholder="Your Full Name">
                    </div>

                    @csrf

                    <input type="hidden" name="id" id="AddressId">

                    <div class="my-3">

                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control shippingInput my-3" id="address1_ship"
                            placeholder="Address Lane 1" name="street_address1">
                        <input type="text" class="form-control shippingInput my-3" id="address2_ship"
                            placeholder="Address Lane 2" name="street_address2">
                        <input type="text" class="form-control shippingInput my-3" id="address3_ship"
                            placeholder="Address Lane 3" name="street_address3">
                    </div>
                    <div class="my-3">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" id="state_ship" name="state">
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
                                    placeholder="Enter City" name="city">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="my-3">
                                <label for="pincode" class="form-label">ZIP Code</label>
                                <input type="number" class="form-control shippingInput" id="postal_code_ship"
                                    placeholder="Enter ZIP Code" name="postal_code">
                                <span id="postal_error3" class="text-danger hideSpan">Service Unavailable in Your
                                    Area!</span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="my-3">
                                <label for="phone_shipping" class="form-label">Phone Number</label>
                                <input type="number" class="form-control shippingInput" id="phone_ship"
                                    placeholder="Enter Phone Number" name="phone">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="my-3">
                                <label for="alternate_phone_shipping" class="form-label">Alternative Phone
                                    Number (Optional)</label>
                                <input type="number" class="form-control shippingInput" id="alternate_phone_ship"
                                    placeholder="Enter Alternate Phone Number" name="alternate_phone">
                            </div>
                        </div>

                    </div>
                    <div class="my-3" style="text-align: right;">
                        <input type="submit" value="Save" style="color: #fff;
                        background: #004a8c;
                        border-color: transparent;
                        padding: 5px;
                        border-radius: 20px;">
                        {{-- <button type="button" id="close-button5">Close</button> --}}
                    </div>

                </form>



            </div>
        </div>

        <!-- Edit Shipping address moddel end -->



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var closeButtons = document.querySelectorAll('#close-button5, .closeIcon4');
                var modal = document.querySelector('.editAddressModal');

                closeButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        modal.style.display = 'none';
                    });
                });
            });

            function editAddress(event) {
                const id = event.target.getAttribute('data-id');
                document.getElementById("AddressId").value = id;


                var editAddressModal = document.getElementById('editAddressModal');
                editAddressModal.style.display = 'block';

                const formData = {
                    id: id
                };

                const csrfToken = document.getElementById('profile_csrf').value;

                fetch("{{ url('/getAddress') }}", {
                        method: 'POST',
                        body: JSON.stringify(formData),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json'
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        console.log(data);

                        if (data.errors) {
                            var error = data.errors;
                            for (const fieldName in error) {
                                if (error.hasOwnProperty(fieldName)) {
                                    const errorMessages = error[fieldName];
                                    errorMessages.forEach(errorMessage => {
                                        toastr.error(errorMessage);
                                    });
                                }
                            }
                        }


                        document.getElementById('name_ship').value = data.name;
                        document.getElementById('address1_ship').value = data.street_address1;
                        document.getElementById('address2_ship').value = data.street_address2;
                        document.getElementById('address3_ship').value = data.street_address3;


                        var state_ship = document.getElementById('state_ship');
                        const selectedState = data.state;

                        for (var i = 0; i < state_ship.options.length; i++) {
                            if (state_ship.options[i].value === selectedState) {
                                state_ship.options[i].selected = true;
                                break;
                            }
                        }

                        document.getElementById('city_ship').value = data.city;
                        document.getElementById('postal_code_ship').value = data.postal_code;
                        document.getElementById('phone_ship').value = data.phone;
                        document.getElementById('alternate_phone_ship').value = data.alternate_phone;


                        // toastr.success(data.msg, 'Success', {
                        //     onHidden: function() {
                        //        window.location.reload();
                        //     }
                        // });


                    })
                    .catch(error => {
                        console.error('Fetche error:', error);
                    });
            }

            document.addEventListener("DOMContentLoaded", function() {

                var uploadform = document.getElementById('uploadForm');

                uploadform.onsubmit = function(e) {

                    e.preventDefault();


                    const clickedButtonId = $(event.target).find(':submit:focus').attr('id');

                    $("#" + clickedButtonId).css({
                        'pointer-events': 'none',
                        'background': '#004a8cab'
                    }).val("");
                    $(".submit-container").css({
                        'top': '15px',
                        'width': '120px'
                    });
                    $(".spinner").css({
                        'display': 'block',
                        'left': '45%'
                    });


                    var image = document.getElementById('image');
                    var imageFile = image.files[0];
                    let inputElement = document.getElementById("image");
                    let spanElement = document.createElement("span");
                    spanElement.setAttribute("class", "uploaderrorSpan");

                    if (!imageFile) {
                        const existingErrorMessage = document.querySelector('.uploaderrorSpan');

                        if (!existingErrorMessage) {
                            spanElement.textContent = "Please select an image file.";
                            inputElement.parentNode.insertBefore(spanElement, inputElement.nextSibling);
                        }

                        inputElement.classList.add('inputError');
                        $(".submit-container").css({
                            'top': '0px',
                            'width': 'auto'
                        });
                        $(".spinner").css({
                            'display': 'none'
                        });
                        $("#" + clickedButtonId).css({
                            'pointer-events': 'auto',
                            'background': '#004a8c'
                        }).val('Upload');


                    } else {

                        if (imageFile.size > 5 * 1024 * 1024) {


                            const existingErrorMessage = document.querySelector('.uploaderrorSpan');



                            if (!existingErrorMessage) {

                                inputElement.classList.add('inputError');
                                spanElement.textContent =
                                    "The selected file is too large.";
                                inputElement.parentNode.insertBefore(spanElement, inputElement.nextSibling);
                            } else if (existingErrorMessage) {

                                if (existingErrorMessage.textContent.includes('Please select an image file.')) {
                                    existingErrorMessage.textContent = "The selected file is too large.";
                                }
                            }

                            inputElement.classList.add('inputError');
                            $(".submit-container").css({
                                'top': '0px',
                                'width': 'auto'
                            });
                            $(".spinner").css({
                                'display': 'none'
                            });

                            $("#" + clickedButtonId).css({
                                'pointer-events': 'auto',
                                'background': '#004a8c'
                            }).val('Upload');


                        } else {

                            if (inputElement.classList.contains('inputError')) {
                                inputElement.classList.remove('inputError');
                            }

                            let formElement = event.target;
                            let formAction = formElement.getAttribute('action');
                            let imageInput = document.getElementById('custom_image');

                            const formData = new FormData(formElement);

                            const csrfToken = document.getElementById('profile_csrf').value;

                            fetch(formAction, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                    },
                                })
                                .then((response) => response.json())
                                .then(data => {

                                    if (data.errors) {
                                        var error = data.errors;
                                        for (const fieldName in error) {
                                            if (error.hasOwnProperty(fieldName)) {
                                                const errorMessages = error[fieldName];
                                                errorMessages.forEach(errorMessage => {
                                                    toastr.error(errorMessage);
                                                });
                                            }
                                        }
                                    }

                                    $(".submit-container").css({
                                        'top': '0px',
                                        'width': 'auto'
                                    });
                                    $(".spinner").css({
                                        'display': 'none'
                                    });
                                    $("#" + clickedButtonId).val('Upload');

                                    toastr.success(data.msg, 'Success', {
                                        onHidden: function() {
                                            // $("#"+clickedButtonId).css({'pointer-events':'auto','background':'#004a8c'});

                                            window.location.reload();
                                        }
                                    });


                                })
                                .catch(error => {
                                    console.error('Fetch error:', error);
                                });
                        }


                    }
                }



                let is_verified = "{{ auth()->user()->is_verified }}";
                if (is_verified == 0) {

                    $(".modal3").css('display', 'block');
                    $("#profile_model_heading").html('Complete Your Profile');
                    $(".closeIcon1,#close-button3").hide();
                    $("#overlay").show();

                    toastr.warning('Please verify your mobile number.');
                } else if (is_verified == 1) {
                    console.log(is_verified);
                    $("#phone").prop('disabled', 'true');
                }



            });
        </script>

        <script type="text/javascript">
            function profileValidation() {

                var username = $("#username").val();
                var name = $("#name").val();
                var phone = $("#phone").val();
                var email = $("#email").val();



                var status = false;



                if (username == "") {
                    if ($("#username").hasClass("inputSuccess")) {
                        $("#username").removeClass("inputSuccess");
                        $("#username").addClass("inputError");
                    } else {
                        $("#username").addClass("inputError");
                    }
                }

                if (name == "") {
                    if ($("#name").hasClass("inputSuccess")) {
                        $("#name").removeClass("inputSuccess");
                        $("#name").addClass("inputError");
                    } else {
                        $("#name").addClass("inputError");
                    }
                }

                if (phone == "") {
                    if ($("#phone").hasClass("inputSuccess")) {
                        $("#phone").removeClass("inputSuccess");
                        $("#phone").addClass("inputError");
                    } else {
                        $("#phone").addClass("inputError");
                    }
                }

                if (email == "") {

                    if ($("#email").hasClass("inputSuccess")) {
                        $("#email").removeClass("inputSuccess");
                        $("#email").addClass("inputError");
                    } else {
                        $("#email").addClass("inputError");
                    }
                }


                if (username != "" && name != "" && phone != "" && email != "") {


                    if ($("#name").hasClass("inputError")) {
                        $("#name").removeClass("inputError");
                    }

                    if ($("#phone").hasClass("inputError")) {
                        $("#phone").removeClass("inputError");
                    }

                    if ($("#email").hasClass("inputError")) {
                        $("#email").removeClass("inputError");
                    }

                    if ($("#username").hasClass("inputError")) {
                        $("#username").removeClass("inputError");
                    }


                    return status = true;
                } else {
                    return status = false;
                }

            }

            function removeProfileValidation(event) {
                if (event.target.classList.contains('inputError')) {
                    event.target.classList.remove('inputError');
                }
            }



            document.addEventListener("DOMContentLoaded", function() {
                var updateform = document.getElementById('updateprofileForm');
                var html = '<i class="fa fa-spinner fa-spin" ></i>';
                var resetbtn = "Save";


                updateform.onsubmit = function(event) {
                    $("#save-button3").css({
                        'pointer-events': 'none',
                        'background': '#004a8cab'
                    }).html(html);
                    event.preventDefault();
                    let formElement = event.target;
                    let formAction = formElement.getAttribute('action');


                    const disabledInputs = document.querySelectorAll('input[disabled]');
                    disabledInputs.forEach(function(input) {
                        input.removeAttribute('disabled');
                    });

                    const formData = new FormData(formElement);
                    const ph = formData.get('phone');


                    disabledInputs.forEach(function(input) {
                        input.setAttribute('disabled', 'disabled');
                    });

                    const csrfToken = document.getElementById('profile_csrf').value;

                    if (profileValidation()) {

                        fetch(formAction, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                            })
                            .then((response) => response.json())
                            .then(data => {
                                $("#save-button3").html(resetbtn);


                                if (data.errors) {
                                    var error = data.errors;
                                    for (const fieldName in error) {
                                        if (error.hasOwnProperty(fieldName)) {
                                            const errorMessages = error[fieldName];
                                            errorMessages.forEach(errorMessage => {
                                                toastr.error(errorMessage, 'Oops', {
                                                    onHidden: function() {
                                                        $("#save-button3").css({
                                                            'pointer-events': 'auto',
                                                            'background': '#004a8c'
                                                        });

                                                    }
                                                });
                                            });
                                        }
                                    }
                                }



                                if (data.code == 200 && data.is_verified == 1) {

                                    toastr.success(data.msg, 'Success', {
                                        onHidden: function() {
                                            $("#save-button3").css({
                                                'pointer-events': 'auto',
                                                'background': '#004a8c'
                                            });
                                            window.location.reload();
                                        }
                                    });
                                } else if (data.code == 200 && data.is_verified == 0) {
                                    $("#save-button3").css({
                                        'pointer-events': 'auto',
                                        'background': '#004a8c'
                                    });
                                    $(".modal3").hide();
                                    $(".profileVerifyModel").show();

                                    $("#hidPhone").val(ph);

                                } else if (data.code == 210) {
                                    toastr.error(data.msg, 'Oops', {
                                        onHidden: function() {
                                            $("#save-button3").css({
                                                'pointer-events': 'auto',
                                                'background': '#004a8c'
                                            });

                                        }
                                    });
                                }



                            })
                            .catch(err => {
                                console.error('Fetch error:', err);
                            });
                    } else {
                        $("#save-button3").css({
                            'pointer-events': 'auto',
                            'background': '#004a8c'
                        }).html(resetbtn);
                    }


                }
            });


            function changeNum(event) {
                $(".profileVerifyModel").hide();
                $(".modal3").show();

            }



            //edit bannerupdate address form sub

            document.addEventListener("DOMContentLoaded", function() {
                var updateAddressForm = document.getElementById('updateAddressForm');

                updateAddressForm.onsubmit = function(event) {

                    event.preventDefault();

                    let formElement = event.target;
                    const formData = new FormData(formElement);
                    let formAction = formElement.getAttribute('action');

                    const csrfToken = getCsrfToken();

                    fetch(formAction, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then((response) => response.json())
                        .then(data => {

                            console.log(data);
                            if (data.errors) {
                                var error = data.errors;
                                for (const fieldName in error) {
                                    if (error.hasOwnProperty(fieldName)) {
                                        const errorMessages = error[fieldName];
                                        errorMessages.forEach(errorMessage => {
                                            toastr.error(errorMessage);
                                        });
                                    }
                                }
                            }

                            if (data.code == 200) {
                                toastr.success(data.msg, 'Success', {
                                    onHidden: function() {
                                        window.location.reload();
                                    },
                                });
                            }


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });
                }

            });
        </script>

    </section>
@endsection
