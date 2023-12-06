@extends('layouts.master')

@section('title', $title)

@section('content')
    <!-- Your page-specific content goes here -->

    <section class="loginRegister container">
        <div class="row">
            <div class="col-md-4 my-3 align-item-center">
                <div class="loginGiftLeft">

                    <img src="{{ asset('images/leftgift.png') }}" alt="gift" class="giftImage">
                </div>
            </div>

            <div class="col-md-4 my-3">
                <div class="cardLoginRegister">
                    <div class="align-items-center">
                        <div class="titleSignIn">
                            <h3>Register</h3>
                        </div>
                        <div class="get_code active">
                            <div class="titleSignIn">
                                <p style="line-height: 20px;">Enter your details to Register to your account with OTP</p>
                            </div>

                            <form class="login-form my-4" id="getcode_form" method="post"
                                action="{{ url('/sentRegisterOtp') }}">
                                @csrf
                                <label for="userName">Fullname</label>
                                <div class="input-group">

                                    <input type="text" class="form-control register-inputText" id="userName"
                                        name="name" placeholder="eg:John Doe" aria-label="Fullname" required
                                        style="border: 1px solid #CCCCCC;">

                                </div>
                                <label for="userPhone">Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+91</span>
                                    <input type="tel" class="form-control" id="userPhone" name="phone"
                                        placeholder="0000000000" maxlength="10" aria-label="Mobile Number"
                                        aria-describedby="basic-addon1" required>

                                </div>
                                <label for="userEmail">Email</label>
                                <div class="input-group">

                                    <input type="text" class="form-control register-inputText" id="userEmail"
                                        name="email" placeholder="eg:john@gmail.com" aria-label="Email" required
                                        style="border: 1px solid #CCCCCC;">

                                </div>

                                <a href="javascript:void(0)" id="getcode_btn" style="text-decoration: none;"
                                    class="loginButton mt-4">Get Code</a>
                            </form>

                        </div>
                        <div class="submit_code deactive">
                            <form class="login-form otp-form my-4" id="submitcode_form" method="post"
                                action="{{ url('/verifyOtpRegister') }}">
                                @csrf
                                <p>Enter 4 digit verification code sent to your mobile number</p>

                                <div class="otp-input">
                                    <input type="hidden" name="phone" id="hid_phone">
                                    <input type="text" name="otp1" id="otp1" name="otp1" maxlength="1"
                                        onkeyup="moveToNext(this, 'otp2')" onkeyup="moveToPreviousInput(this, 'otp1',event)"
                                        onkeypress="moveToPreviousInput(this, 'otp1',event)"
                                        onkeydown="moveToPreviousInput(this, 'otp1',event)" required>

                                    <input type="text" name="otp2" id="otp2" name="otp2" maxlength="1"
                                        onkeyup="moveToNext(this, 'otp3')" onkeyup="moveToPreviousInput(this, 'otp1',event)"
                                        onkeypress="moveToPreviousInput(this, 'otp1',event)"
                                        onkeydown="moveToPreviousInput(this, 'otp1',event)" required>
                                    <input type="text" name="otp3" id="otp3" name="otp3" maxlength="1"
                                        onkeyup="moveToNext(this, 'otp4')" onkeyup="moveToPreviousInput(this, 'otp2',event)"
                                        onkeypress="moveToPreviousInput(this, 'otp2',event)"
                                        onkeydown="moveToPreviousInput(this, 'otp2',event)" required>
                                    <input type="text" name="otp4" id="otp4" name="otp4" maxlength="1"
                                        onkeyup="moveToPreviousInput(this, 'otp3',event)"
                                        onkeypress="moveToPreviousInput(this, 'otp3',event)"
                                        onkeydown="moveToPreviousInput(this, 'otp3',event)" required>
                                </div>

                                <div class="logtimer">
                                    <span id="countdown">10</span> seconds to Resend
                                </div>

                                <div id="resend" class="hideSpan">
                                    <p id="resendp" onclick="resendOtp(event)">Resend OTP</p>
                                </div>

                                <div class="submit-container">
                                    <i class="fa fa-spinner fa-spin spinner" style="display:none;"></i>
                                    <input type="submit" id="submitcodeBtn" class="loginButton mt-4" value="Register">
                                </div>
                            </form>
                        </div>

                        <div class="login-form mb-3">
                            <p class="mt-4">Or continue with</p>
                            <form class="googleForm" id="googleForm2" action="{{ url('auth/redirect') }}"
                                method="get">

                                <a href="javascript:void(0)" class="googleLogin" onclick="googleLogin()"><img
                                        src="{{ asset('images/icons/google.png') }}" alt=""> <span>Sign in with
                                        Google</span></a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-4 my-3 align-item-center">
                <div class="loginGiftRight">
                    <img src="{{ asset('images/rightgift.png') }}" alt="gift" class="giftImage">
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Retrieve the array of objects from localStorage
                var cartDataString = localStorage.getItem('cartData');
                var cartData = JSON.parse(cartDataString);


                // Loop through the array and create form fields dynamically
                if (cartData && Array.isArray(cartData)) {
                    // var form = document.getElementById('googleForm');


                    var forms = document.querySelectorAll('.googleForm');

                    forms.forEach(function(form) {

                        cartData.forEach(function(item, index) {
                            var productId = item.productId;
                            var quantity = item.quantity;
                            var pincode = item.pincode;
                            var custom_image = item.custom_image;
                            var custom_text = item.custom_text;

                            // Create input fields for each item
                            var productInput = document.createElement('input');
                            productInput.type = 'hidden';
                            productInput.name = 'cartItems[' + index + '][product_id]';
                            productInput.value = productId;

                            var quantityInput = document.createElement('input');
                            quantityInput.type = 'hidden';
                            quantityInput.name = 'cartItems[' + index + '][quantity]';
                            quantityInput.value = quantity;

                            var pincodeInput = document.createElement('input');
                            pincodeInput.type = 'hidden';
                            pincodeInput.name = 'cartItems[' + index + '][pincode]';
                            pincodeInput.value = pincode;


                            // Append input fields to the form
                            form.appendChild(productInput);
                            form.appendChild(quantityInput);
                            form.appendChild(pincodeInput);


                            var custom_imageInput = document.createElement('input');
                            custom_imageInput.type = 'hidden';
                            custom_imageInput.name = 'cartItems[' + index + '][custom_image]';


                            if (item.custom_image != undefined) {

                                custom_imageInput.value = item.custom_image;
                                form.appendChild(custom_imageInput);
                            } else {

                                custom_imageInput.value = "";
                                form.appendChild(custom_imageInput);
                            }

                            var custom_textInput = document.createElement('input');
                            custom_textInput.type = 'hidden';
                            custom_textInput.name = 'cartItems[' + index + '][custom_text]';


                            if (item.custom_text != undefined) {

                                custom_textInput.value = item.custom_text;
                                form.appendChild(custom_textInput);
                            } else {

                                custom_textInput.value = "";
                                form.appendChild(custom_textInput);

                            }


                        });
                    });



                } else {
                    console.log("Cart is Empty");
                }


            });

            function googleLogin() {
                $("#googleForm2").submit();
                localStorage.removeItem('cartData');

            }

            $(document).ready(() => {

                $(document).on("click", "#getcode_btn", () => {
                    $("#getcode_form").submit();
                });
            });

            //Register otp sent

            $("#getcode_form").on("submit", (event) => {
                event.preventDefault();

                var html = '<i class="fa fa-spinner fa-spin" ></i>';
                var resetbtn = "Get Code";
                const clickedButtonId = $(event.target).find("a").attr("id");

                let formElement = event.target;
                let formAction = formElement.getAttribute("action");
                let formMethod = formElement.getAttribute("method");
                let formData = new FormData(formElement);
                var phone = formData.get("phone");
                var name = formData.get("name");
                var email = formData.get("email");
                console.log(name);
                console.log(typeof email);

                if (name == "") {
                    $("#userName").css("border-color", "#fb483a");
                }

                if (phone == "") {
                    $("[name='phone']").css("border-color", "#fb483a");
                    $(".input-group-text").css("border-color", "#fb483a");
                }

                if (email == "") {
                    $("#userEmail").css("border-color", "#fb483a");
                }

                if (phone != "" && name != "" && email != "") {
                    $("#" + clickedButtonId)
                        .css({
                            "pointer-events": "none",
                            background: "#004a8cab"
                        })
                        .html(html);
                    fetch(formAction, {
                            method: "POST",
                            body: formData,
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            console.log(data);

                            if (data.errors) {
                                var error = data.errors;
                                for (const fieldName in error) {
                                    if (error.hasOwnProperty(fieldName)) {
                                        const errorMessages = error[fieldName];
                                        errorMessages.forEach((errorMessage) => {
                                            toastr.error(errorMessage, "Oops", {
                                                onHidden: function() {
                                                    $("#" + clickedButtonId)
                                                        .css({
                                                            "pointer-events": "auto",
                                                            background: "#004a8c",
                                                        })
                                                        .html(resetbtn);
                                                },
                                            });
                                        });
                                    }
                                }
                            }

                            if (data.code == 200) {
                                $("#hid_phone").val(phone);
                                $("#resendp").attr("data-id", phone);

                                toastr.success(data.msg, "Success", {
                                    onHidden: function() {
                                        $("#" + clickedButtonId)
                                            .css({
                                                "pointer-events": "auto",
                                                background: "#004a8c",
                                            })
                                            .html(resetbtn);
                                        if ($(".submit_code").hasClass("deactive")) {
                                            $(".submit_code").removeClass("deactive");
                                            $(".submit_code").addClass("active");
                                        }
                                        if ($(".get_code").hasClass("active")) {
                                            $(".get_code").removeClass("active");
                                            $(".get_code").addClass("deactive");
                                        }

                                        var countdownInterval = setInterval(function() {
                                            var countdownElement =
                                                document.getElementById("countdown");

                                            if (countdownElement) {
                                                var countdownValue = parseInt(
                                                    countdownElement.textContent
                                                );

                                                if (countdownValue > 0) {
                                                    countdownValue--;
                                                    countdownElement.textContent =
                                                        countdownValue;
                                                }
                                                if (countdownValue == 0) {
                                                    clearInterval(countdownInterval);
                                                    $(".logtimer").hide();

                                                    if ($("#resend").hasClass("hideSpan")) {
                                                        $("#resend").removeClass(
                                                            "hideSpan"
                                                        );
                                                        $("#resend").addClass("showSpan");
                                                    }
                                                }
                                            }
                                        }, 1000);
                                    },
                                });
                            } else if (data.code == 210) {
                                toastr.error(data.msg, "Oops!", {
                                    onHidden: function() {
                                        $("#" + clickedButtonId)
                                            .css({
                                                "pointer-events": "auto",
                                                background: "#004a8c",
                                            })
                                            .html(resetbtn);
                                        window.location.href = window.baseUrl + "/login";
                                    },
                                });
                            }
                        })
                        .catch((error) => {
                            console.error("Fetch error:", error);
                        });
                }
            });
        </script>

    </section>
@endsection
