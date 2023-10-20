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
                        <img src="{{ auth()->user()->profile_image == null ? asset('images/icons/profile.png') : asset('profile/' . auth()->user()->profile_image) }}"
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

                                <input type="hidden" name="_token" id="profile_csrf" value="{{csrf_token()}}">
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
                            <h3 style="font-weight:600;">Customer ID : {{ auth()->user()->id ? auth()->user()->id : '' }}</h3>
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
                                        value="{{ auth()->user()->username ? auth()->user()->username : '' }}" disabled="true" oninput="removeProfileValidation(event)">
                                        
                                </div>

                                <div class="my-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control shippingInput" id="name" name="name"
                                        placeholder="Your Full Name"
                                        value="{{ auth()->user()->name ? auth()->user()->name : '' }}" oninput="removeProfileValidation(event)"> 
                                         @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
                                </div>

                                <div class="my-4">
                                    <label for="name" class="form-label">Phone</label>
                                    <input type="text" class="form-control shippingInput" id="phone" name="phone"
                                        placeholder="Your Phone"
                                        value="{{ auth()->user()->phone ? auth()->user()->phone : '' }}" oninput="removeProfileValidation(event)"> 
                                         @error('phone')
        <span class="text-danger">{{ $message }}</span>
    @enderror
                                </div>

                                <div class="my-4">
                                    <label for="name" class="form-label">Email</label>
                                    <input type="text" class="form-control shippingInput" id="email" name="email"
                                        placeholder="Your Email"
                                        value="{{ auth()->user()->email ? auth()->user()->email : '' }}" oninput="removeProfileValidation(event)"> 
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
                        $formattedDate = $dateObj->format('jS M Y');
                        $orderDate = $formattedDate;
                        $totalAmount = str_replace(".00", "", $order->amount);


                        
                    @endphp

                    
                        <div class="col-lg-12 my-3">
                            <div class="shippingInfo">
                                <div class="orderSummaryCard">

                                    <div class="row">
                                        <div class="col-lg-3">
                                             <div class="row">

                                               
                                                    @foreach (json_decode($products) as $product)
                                                      <div class="col-md-6 col-sm-12">
                                                        <a href=""><img  class="imgCartPro" src="{{ $product->product_image }}"
                                                                alt="cart_1"></a>
                                                                </div>
                                                    @endforeach
                                                
                                            </div>
                                            <!-- <div class="row">
                                                    <div class="col-lg-12"><p class="mt-2">{{$order->shipping_address}}</p></div>
                                                    <div class="col-lg-12"><p class="mt-2">{{$order->shipping_address}}</p></div>
                                                    <div class="col-lg-12"><p class="mt-2">{{$order->shipping_address}}</p></div>
                                            </div> -->

                                        </div>

                                        <div class="col-lg-3">
                                            <div class="row ">
                                                <div class="nameAndPrice2">
                                                    <p >Order Id : {{$order->order_id}}</p>

                                                    <h3>Total : <i class="fa-solid fa-indian-rupee-sign"></i> {{ $totalAmount}}</h3>



                                                  <p  class="my-4" style="font-size: 13px;">{{$order->shipping_address}}</p>

                                                      <p class="mt-3" style="font-size: 13px;" id="deliveredMsg">
                                                                Order Placed on {{$orderDate}}</p>


                                                  <p class="mt-3" style="font-size: 13px;" id="deliveredMsg">
                                                                    Expected Delivery on 12 May 2023</p>

                                                    </div>

                                            </div>
                                        </div>
                                        

                                        <div class="col-lg-6" id="dFlex">

                                            <div class="w-100">
                                                @if ($order->track_shipping)
                                                    @php
                                                        
                                                        $scan_stages = $order->track_shipping->object->field[36]->object;
                                                        
                                                        $orderId_tracking = $order->track_shipping->object->field[1]; //orderid
                                                        
                                                        $status = $order->track_shipping->object->field[10]; //status
                                                        
                                                        $reason_code_number = $order->track_shipping->object->field[14]; //reason_code_number

                                                        $last_update_datetime = $order->track_shipping->object->field[20]; // last_update_datetime  

                                                        $delivery_date = $order->track_shipping->object->field[21]; //delivery_date

                                                        $expected_date = $order->track_shipping->object->field[18]; //expected_date


                                                       

                                                    @endphp

                                                    <div class="orderTrack">
                                                        <div class="orderTrackBar"></div>
                                                        <ul class="orderTrackPoints">

                                                            <li class="tracking-item active" data-status-text="Order Placed"
                                                                data-date="{{$order->created_at}}">Order
                                                                Placed<br><br><br><br>
                                                            <!-- <small>{{$order->created_at}}</small> -->
                                                            </li>

                                                            <li class="tracking-item {{($reason_code_number == 1260 || $reason_code_number == 11 || $reason_code_number == 400 || $reason_code_number == 127 || $reason_code_number == 5 || $reason_code_number == 6 || $reason_code_number == 999) ? 'active' : ''}}" data-status-text="Order Shipped"
                                                                data-date="May 6, 2023">Order Shipped
                                                                <br><br><br><br>
                                                                {{-- <small>{{($reason_code_number == 1260 || $reason_code_number == 11 || $reason_code_number == 400) ? $last_update_datetime : ''}}</small> --}}
                                                            </li>
                                                            <li class="tracking-item {{($reason_code_number == 127 || $reason_code_number == 5 || $reason_code_number == 6 || $reason_code_number == 999) ? 'active' : ''}}" data-status-text="Reached Hub"
                                                                data-date="May 8, 2023">Reached Hub
                                                                <br><br><br><br>
                                                                {{-- <small>{{($reason_code_number == 127 || $reason_code_number == 5 ) ? $last_update_datetime : ''}}</small></li> --}}
                                                            <li class="tracking-item {{($reason_code_number == 6 || $reason_code_number == 999) ? 'active' : ''}}" data-status-text="Out for Delivery"
                                                                data-date="May 10, 2023">Out for
                                                                Delivery<br><br><br><br>
                                                                {{-- <small>May 10, 2023</small> --}}
                                                            </li>
                                                            <li class="tracking-item {{($reason_code_number == 999 ) ? 'active' : ''}}" data-status-text="Delivered"
                                                                data-date="May 12, 2023">Order
                                                                Delivered<br><br><br><br>
                                                                <small>{{($reason_code_number == 999) ? $last_update_datetime : ''}}</small>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif


                                            </div>

                                        </div> {{-- col-lg-7 end --}}


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
                    <div class="question-description">{{($count > 0) ? "View All Saved Address" : "No Records available"}}</div>
                    <i class="fas fa-angle-right"></i>
                </div>
                <div class="answer" id="address-toggle">
                    <div class="horizontalLine"></div>

                    <div class="multipleBillingBox w-100  ">

                       

          
    <ul class="nav nav-tabs" id="myTabs">
        <li class="nav-item">
            <a class="nav-link active" id="tab1" data-bs-toggle="tab" href="#content1">Billing Address</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab2" data-bs-toggle="tab" href="#content2">Shipping Address</a>
        </li>
       
    </ul>

    <div class="tab-content my-4" id="myTabsContent">

        <div class="tab-pane fade show active" id="content1">
           <div class="row">
             @php $status=true; @endphp
              @foreach ($addresses as $address)

                        @if($address->is_billing_address==1 && $address->status==2)


                                <div class="card  mobile-address col-lg-6" style="border:none;">
                                    <div class="card-body mb-3" style="border:1px solid #ccc; border-radius: 10px;">

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
                                                data-id="{{ $address->id }}"><i class="fa-regular fa-trash-can"></i>
                                                Delete</span>
                                            <span class="p-2 m-1 editAddress"
                                                style="color: #004A8C;font-size:14px;font-weight:600;"
                                                data-id="{{ $address->id }}"><i class="fa-solid fa-file-pen"></i>
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


               @if($address->is_shipping_address==1)

                                <div class="card  mobile-address col-lg-6" style="border:none;">
                                    <div class="card-body mb-3" style="border:1px solid #ccc; border-radius: 10px;">

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
                                                data-id="{{ $address->id }}"><i class="fa-regular fa-trash-can"></i>
                                                Delete</span>
                                            <span class="p-2 m-1 editAddress"
                                                style="color: #004A8C;font-size:14px;font-weight:600;"
                                                data-id="{{ $address->id }}"><i class="fa-solid fa-file-pen"></i>
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


        <!-- profile verification model start --> 
 <!-- profile modal start-->

                    <div class="profileVerifyModel">
                        <div class="profileVerifyModelContent">
                           <form id="profile-otp" method="post" action="{{url('/verifyOtpProfile')}}">
                                    <h5 class="small-heading" class="mb-3 text-center">Enter OTP to verify your Mobile Number</h5>
                                    @csrf
                                <div class="otp-input my-4">
                                    <input type="hidden" name="phone" id="hidPhone">
                                    <input type="text" name="otp1" id="otp1" maxlength="1" onkeyup="moveToNext(this, 'otp2')" required="">
                                    <input type="text" name="otp2" id="otp2" maxlength="1" onkeyup="moveToNext(this, 'otp3')" required="">
                                    <input type="text" name="otp3" id="otp3" maxlength="1" onkeyup="moveToNext(this, 'otp4')" required="">
                                    <input type="text" name="otp4" id="otp4" maxlength="1" required="">
                                </div>
                                <span  class="resend-box">
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


        <!-- profile verification model end --> 



        <script>



            document.addEventListener("DOMContentLoaded", function() {

                var uploadform = document.getElementById('uploadForm');

                uploadform.onsubmit = function(e) {

                    e.preventDefault();


                      const clickedButtonId = $(event.target).find(':submit:focus').attr('id');
               
                    $("#"+clickedButtonId).css({'pointer-events':'none','background':'#004a8cab'}).val("");
                    $(".submit-container").css({'top':'15px','width':'120px'});
                     $(".spinner").css({'display':'block','left':'45%'});


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
                     $(".submit-container").css({'top':'0px','width':'auto'});
                        $(".spinner").css({'display':'none'});
                     $("#"+clickedButtonId).css({'pointer-events':'auto','background':'#004a8c'}).val('Upload');


                    } else {

                        if (imageFile.size > 5 * 1024 * 1024) {


                          const existingErrorMessage = document.querySelector('.uploaderrorSpan');

                        

                          if (!existingErrorMessage) {

                        inputElement.classList.add('inputError');
                        spanElement.textContent =
                            "The selected file is too large.";
                        inputElement.parentNode.insertBefore(spanElement, inputElement.nextSibling);
                    }

                    else if(existingErrorMessage ){

                        if(existingErrorMessage.textContent.includes('Please select an image file.')){
                            existingErrorMessage.textContent="The selected file is too large.";
                        }
                    }

                        inputElement.classList.add('inputError');
                        $(".submit-container").css({'top':'0px','width':'auto'});
                        $(".spinner").css({'display':'none'});

                         $("#"+clickedButtonId).css({'pointer-events':'auto','background':'#004a8c'}).val('Upload');


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
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {

                                     $(".submit-container").css({'top':'0px','width':'auto'});
                                    $(".spinner").css({'display':'none'});
                                     $("#"+clickedButtonId).val('Upload');

                                    toastr.success(data.msg,'Success',{
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


                  
            let is_verified = "{{auth()->user()->is_verified}}";
            if(is_verified==0){
                
                $(".modal3").css('display','block');
                $("#profile_model_heading").html('Complete Your Profile');
                $(".closeIcon1,#close-button3").hide();
                $("#overlay").show();

                toastr.warning('Please verify your mobile number.');
            }
            else if(is_verified==1){
                console.log(is_verified);
                $("#phone").prop('disabled','true');
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

            
            if (username != "" && name != "" && phone != "" &&  email != ""  ) {


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

        function removeProfileValidation(event){
            if (event.target.classList.contains('inputError')) {
                    event.target.classList.remove('inputError');
            } 
        }


           
            document.addEventListener("DOMContentLoaded", function() {
                var updateform = document.getElementById('updateprofileForm');
                var html = '<i class="fa fa-spinner fa-spin" ></i>';
                var resetbtn = "Save";
               

                 updateform.onsubmit = function(event) {
                     $("#save-button3").css({'pointer-events':'none','background':'#004a8cab'}).html(html);
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

                    if(profileValidation()){
                        
                       fetch(formAction, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
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
                                     $("#save-button3").html(resetbtn);

                                    if(data.code==200 && data.is_verified==1){
                                        
                                        toastr.success(data.msg,'Success',{
                                            onHidden: function() {
                                                 $("#save-button3").css({'pointer-events':'auto','background':'#004a8c'});
                                                window.location.reload();
                                            }
                                        });
                                    }
                                    else if(data.code==200 && data.is_verified==0){
                                         $("#save-button3").css({'pointer-events':'auto','background':'#004a8c'});
                                        $(".modal3").hide();
                                        $(".profileVerifyModel").show();

                                        $("#hidPhone").val(ph);

                                    }
                                    else if(data.code==210){
                                        toastr.error(data.msg);
                                    }



                                })
                                .catch(err => {
                                    console.error('Fetch error:', err);
                                });
                    }else{
                         $("#save-button3").css({'pointer-events':'auto','background':'#004a8c'}).html(resetbtn);
                    }
                    

                 }
            });


            function changeNum(event){
                $(".profileVerifyModel").hide();
                 $(".modal3").show();
                
            }
          



        </script>

    </section>
@endsection
