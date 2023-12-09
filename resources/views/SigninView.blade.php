@extends('layouts.master')

@section('title', $title)

@section('content')
    <!-- Your page-specific content goes here -->
    <section class="loginRegister container">
        <div class="breadcrumb">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">Resister | Login</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 my-3 align-item-center">
                <div class="loginGiftLeft">
                    
                    <img src="{{ asset('images/leftgift.png') }}" alt="gift" class="giftImage">
                </div>
            </div>

            <div class="col-md-4 my-3">
                <div class="cardLoginRegister">
                    <div class="align-items-center">
                        <div class="titleSignIn">
                            <h3>Login</h3>

                        </div>

                        <div class="get-code active">
                            <div class="titleSignIn">
                                <p>Enter your mobile to login to your account with OTP</p>
                            </div>
                            <form class="login-form my-4" id="getcode-form" method="post"
                                action="{{ url('/sentLoginOtp') }}">
                                @csrf
                                <label for="mobile-number">Mobile Number</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">+91</span>
                                    <input type="tel" class="form-control" name="phone" id="user-phone"
                                        placeholder="0000000000" maxlength="10" aria-label="Mobile Number"
                                        aria-describedby="basic-addon1" required>
                                </div>
                                <a href="javascript:void(0)" id="getcode-btn" style="text-decoration: none;"
                                    class="loginButton mt-4">Get Code</a>
                            </form>
                        </div>

                        <div class="submit-code deactive">
                            <form class="login-form otp-form my-4" method="post" action="{{ url('/verifyOtp') }}">

                                <p>Enter 4 digit verification code sent to your mobile number</p>
                                @csrf
                                <input type="hidden" name="phone" id="hid-phone">
                                <div class="otp-input">
                                    <input type="text" id="otp1" name="otp1" maxlength="1"
                                        onkeyup="moveToNext(this, 'otp2')" onkeyup="moveToPreviousInput(this, 'otp1',event)"
                                        onkeypress="moveToPreviousInput(this, 'otp1',event)"
                                        onkeydown="moveToPreviousInput(this, 'otp1',event)" required>
                                    <input type="text" id="otp2" name="otp2" maxlength="1"
                                        onkeyup="moveToNext(this, 'otp3')" onkeyup="moveToPreviousInput(this, 'otp1',event)"
                                        onkeypress="moveToPreviousInput(this, 'otp1',event)"
                                        onkeydown="moveToPreviousInput(this, 'otp1',event)" required>
                                    <input type="text" id="otp3" name="otp3" maxlength="1"
                                        onkeyup="moveToNext(this, 'otp4')" onkeyup="moveToPreviousInput(this, 'otp2',event)"
                                        onkeypress="moveToPreviousInput(this, 'otp2',event)"
                                        onkeydown="moveToPreviousInput(this, 'otp2',event)" required>
                                    <input type="text" id="otp4" name="otp4" maxlength="1"
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
                                    <input type="submit" id="submitcode-btn" class="loginButton mt-4" value="Login">
                                </div>

                            </form>
                        </div>

                        <div class="login-form mb-3">
                            <p class="mt-4">Or continue with</p>
                            <form class="googleForm" id="googleForm3" action="{{ url('auth/redirect') }}" method="get">

                                <a href="javascript:void(0)" class="googleLogin" onclick="googleLogin()"><img
                                        src="{{ asset('images/icons/google.png') }}" alt=""> <span>Sign in with
                                        Google</span></a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-4 my-3">
                <div class="cardLoginRegister">
                    <div class="align-items-center">
                        <div class="titleSignIn">
                            <h3>Register</h3>
                            <p>Don't have an Account?</p>
                        </div>
                        <div class="login-form my-3">
                            <a href="{{ route('register') }}" style="text-decoration: none;"
                                class="loginButton mt-4">Register</a>
                        </div>
                        <div class="login-form my-3 mt-5">
                            <form class="googleForm" id="googleForm4" action="{{ url('auth/redirect') }}"
                                method="get">

                                <a href="javascript:void(0)" class="googleLogin" onclick="googleLogin2()"><img
                                        src="{{ asset('images/icons/google.png') }}" alt=""> <span>Sign in with
                                        Google</span></a>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
            <div class="col-md-2 my-3 align-item-center">
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

                    var forms = document.querySelectorAll('.googleForm');

                    forms.forEach(function(form) {

                        cartData.forEach(function(item, index) {
                            var productId = item.productId;
                            var quantity = item.quantity;
                            var pincode = item.pincode;

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
                $("#googleForm3").submit();
                localStorage.removeItem('cartData');

            }

            function googleLogin2() {
                $("#googleForm4").submit();
                localStorage.removeItem('cartData');

            }

            $(() => {
                $(document).on("click", "#getcode-btn", () => {
                    $("#getcode-form").submit();
                });
            });


            //login otp sent from  signin/register page

$("#getcode-form").on("submit", (event) => {
    event.preventDefault();

    var html = '<i class="fa fa-spinner fa-spin" ></i>';
    var resetbtn = "Get Code";
    const clickedButtonId = $(event.target).find("a").attr("id");

    let formElement = event.target;
    let formAction = formElement.getAttribute("action");
    let formMethod = formElement.getAttribute("method");
    let formData = new FormData(formElement);
    var phone = formData.get("phone");

    if (phone != "") {
        $("#" + clickedButtonId)
            .css({ "pointer-events": "none", background: "#004a8cab" })
            .html(html);

        fetch(formAction, {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                console.log(data);
                if (data.code == 200) {
                    $("#hid-phone").val(phone);
                    $("#resendp").attr("data-id", phone);

                    toastr.success(data.msg, "Success", {
                        onHidden: function () {
                            $("#" + clickedButtonId)
                                .css({
                                    "pointer-events": "auto",
                                    background: "#004a8c",
                                })
                                .html(resetbtn);
                            if ($(".submit-code").hasClass("deactive")) {
                                $(".submit-code").removeClass("deactive");
                                $(".submit-code").addClass("active");
                            }
                            if ($(".get-code").hasClass("active")) {
                                $(".get-code").removeClass("active");
                                $(".get-code").addClass("deactive");
                            }

                            var countdownInterval = setInterval(function () {
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
                        onHidden: function () {
                            $("#" + clickedButtonId)
                                .css({
                                    "pointer-events": "auto",
                                    background: "#004a8c",
                                })
                                .html(resetbtn);
                            window.location.href =window.baseUrl +"/register";
                        },
                    });
                }
            })
            .catch((error) => {
                console.error("Fetch error:", error);
            });
    } else {
        $("[name='phone']").css("border-color", "#fb483a");
        $(".input-group-text").css("border-color", "#fb483a");
    }
});


        </script>
    </section>

@endsection
