<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>

    <!-- Add your common CSS and JavaScript files here -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/register.css') }}"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href='https://fonts.googleapis.com/css?family=DM Sans' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.min.css"
        integrity="sha512-IScV5kvJo+TIPbxENerxZcEpu9VrLUGh1qYWv6Z9aylhxWE4k4Fch3CHl0IYYmN+jrnWQBPlpoTVoWfSMakoKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

    <!--Slick Slider -->

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />


    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script>
        window.baseUrl = "{{ url('/') }}";
        window.imgUrl = "{{ asset('/') }}";
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/magic-checkout.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.min.js"
        integrity="sha512-CyYoxe9EczMRzqO/LsqGsDbTl3wBj9lvLh6BYtXzVXZegJ8VkrKE90fVZOk1BNq3/9pyg+wn+TR3AmDuRjjiRQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <script src="{{ asset('js/main.js') }}"></script>
    {{-- <script src="{{ asset('js/register.js') }}"></script> --}}

</head>

<body>
    <!-- Loader -->
    <div class="loader-container">
        <div id="overlay" class="overlay"></div>

        <i class="fas fa-spinner fa-spin loader"></i>
    </div>

    @include('common.header') <!-- Include your header -->

    <div class="wrapper" id="lazyLoadWrapper">
        @yield('content') <!-- This is where the content from your views will be inserted -->
    </div>

    @include('common.footer') <!-- Include your footer -->


</body>

<script>
    //coomon js functionalities

    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-center",
        preventDuplicates: false,
        onclick: null,
        showDuration: "2000",
        hideDuration: "1000",
        timeOut: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    function moveToNext(currentInput, nextInputId) {
        if (currentInput.value.length === 1) {
            document.getElementById(nextInputId).focus();
        }
    }

    function moveToPreviousInput(currentInput, previousInputId, event) {
        const currentInputValue = currentInput.value;
        console.log(event.keyCode);

        // If the input is empty and the Backspace key is pressed, move focus to the previous input.
        if (currentInputValue === "" && event.keyCode === 8) {
            const previousInput = document.getElementById(previousInputId);

            if (previousInput) {
                previousInput.focus();
            }
        }
    }

    function getCsrfToken() {
        return document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
    }

    function resendOtp(event) {
        var phone = event.target.getAttribute("data-id");

        var resetBtn = "Resend";

        var html = "Resending... <i class='fa fa-spinner fa-spin'></i>";
        event.target.innerHTML = html;
        event.target.style.pointerEvents = "none";

        if (phone != undefined) {
            console.log(phone);

            const form_datas = {
                phone: phone,
            };
            const csrfToken = getCsrfToken();
            fetch(window.baseUrl + "/resendOtp", {
                    method: "POST",
                    body: JSON.stringify(form_datas),
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
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
                        event.target.innerHTML = resetBtn;
                        event.target.style.pointerEvents = "auto";
                    }
                })
                .catch((error) => {
                    console.error("Fetch error:", error);
                });
        } else {
            toastr.error("Something went wrong", "Oops", {
                onHidden: function() {
                    event.target.innerHTML = resetBtn;
                    event.target.style.pointerEvents = "auto";
                },
            });
        }
    }


    function cartAuthenticate() {
        var cartstr = localStorage.getItem("cartData");
        var cartData = JSON.parse(cartstr);
        if (cartData && cartData.length > 0) {
            const csrfToken = getCsrfToken();
            var form_data = [];
            cartData.forEach((cart) => {
                form_obj = {
                    product_id: cart.productId,
                    quantity: cart.quantity,
                    pincode: cart.pincode,
                    // 'custom_image' : cart.custom_image,
                    // 'custom_text' : cart.custom_text
                };

                if (cart.custom_image != undefined) {
                    form_obj.custom_image = cart.custom_image;
                } else {
                    form_obj.custom_image = "";
                }

                if (cart.custom_text != undefined) {
                    form_obj.custom_text = cart.custom_text;
                } else {
                    form_obj.custom_text = "";
                }

                form_data.push(form_obj);
            });

            fetch(window.baseUrl + "/transferCart", {
                    method: "POST",
                    body: JSON.stringify(form_data),
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                })
                .then((response) => {
                    console.log(response);
                    localStorage.removeItem("cartData");
                })
                .catch((error) => {
                    console.log(error);
                });

            return true;
        } else {
            return false;
        }
    }

    //otp submission

    $(document).ready(function() {
        $(".otp-form").on("submit", function(event) {
            //var html = '<i class="fa fa-spinner fa-spin" ></i>';
            // var resetbtn = "Login";
            const clickedButtonId = $(event.target)
                .find(":submit:focus")
                .attr("id");

            event.preventDefault();
            var formElement = event.target;
            var formAction = formElement.getAttribute("action");
            var formData = new FormData(formElement);

            console.log(clickedButtonId);

            $("#" + clickedButtonId)
                .css({
                    "pointer-events": "none",
                    background: "#004a8cab",
                })
                .val("");

            $(".spinner").css("display", "block");

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
                    $(".spinner").css("display", "none");
                    $("#" + clickedButtonId).val("Login");

                    if (data.code == 200) {
                        //console.log(cartAuthenticate());

                        if (cartAuthenticate()) {
                            toastr.success(data.msg, "Success", {
                                onHidden: function() {
                                    console.log("Toast hidden");

                                    $("#" + clickedButtonId).css({
                                        "pointer-events": "auto",
                                        background: "#004a8c",
                                    });

                                    window.location.href = window.baseUrl +
                                        "/shippingCart";
                                },
                            });
                        } else {
                            toastr.success(data.msg, "Success", {
                                onHidden: function() {
                                    console.log("Toast hidden");

                                    $("#" + clickedButtonId).css({
                                        "pointer-events": "auto",
                                        background: "#004a8c",
                                    });

                                    window.location.href = window.baseUrl + "/home";
                                },
                            });
                        }
                    } else if (data.code == 210) {
                        toastr.error(data.msg, "Oops!", {
                            onHidden: function() {
                                console.log("Toast hidden");

                                $("#" + clickedButtonId).css({
                                    "pointer-events": "auto",
                                    background: "#004a8c",
                                });
                            },
                        });
                    }
                })
                .catch((error) => {
                    console.error("Fetch error:", error);
                });
        });
    });

    //force logout
    function forceLogout() {
        let redirectedUrl = window.baseUrl + "/logout";
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to Logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#004a8c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = redirectedUrl;
            }
        });
    }
</script>

{{-- session msg --}}

@if (session('otpVerificationError'))
    <script>
        toastr.error("{{ session('otpVerificationError') }}");
    </script>
@endif

@if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif

@if (session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
@endif



<script>
    function downloadInvoice(order_id) {

        const url = "{{ url('/generateInvoice') }}/" + order_id;
        window.open(url, '_blank');
    }



    function cancelOrder(order_id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to cancel the order",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                //put all code if yes

                const url = "{{ url('/cancellShipment') }}";

                const csrfToken = getCsrfToken();

                const form_datas = {
                    id: order_id,

                };

                fetch(url, {
                        method: 'POST',
                        body: JSON.stringify(form_datas),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        if (data.code == 200) {
                            toastr.success(data.msg, 'Success', {
                                onHidden: function() {
                                    location.reload();
                                }
                            })
                        } else {
                            toastr.error("Something went wrong!", 'oops', {
                                onHidden: function() {
                                    location.reload();
                                }
                            })
                        }
                    })
                    .catch(error => console.error(error));
            }
        })

    }

    $(document).ready(() => {
        //     $('.owl-slide').owlCarousel()
        // });

        //     $(document).ready(function(){
        //         $('.owl-slide2,.owl-slide1').slick({
        //             dots: true,
        //             arrows: false,
        //   infinite: false,
        //   speed: 300,
        //   slidesToShow: 4,
        //   slidesToScroll: 4,
        //   autoplay: true,

        // autoplaySpeed: 5000, 
        //   responsive: [
        //     {
        //       breakpoint: 1024,
        //       settings: {
        //         slidesToShow: 3,
        //         slidesToScroll: 3,
        //         infinite: true,
        //         dots: true
        //       }
        //     },
        //     {
        //       breakpoint: 600,
        //       settings: {
        //         slidesToShow: 2,
        //         slidesToScroll: 2
        //       }
        //     },
        //     {
        //       breakpoint: 480,
        //       settings: {
        //         slidesToShow: 2,
        //         slidesToScroll: 2
        //       }
        //     }
        // ]

        //         });


        $('.owl-slide3,.owl-slide2,.owl-slide1').slick({
            // dots: true,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 4000,
            lazyLoad: 'ondemand',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        //dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]

        });




        $('.owl-slide').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            //   dots: true,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 4000,
            speed: 500,
            fade: true,
            cssEase: 'linear'

        });


    });

    function nextSlide1() {
        $('.owl-slide').slick('slickNext');
    }

    function prevSlide1() {
        $('.owl-slide').slick('slickPrev');
    }



    function BillingValidation() {

        var name_billing = $("#name_billing").val();
        var address1_billing = $("#address1_billing").val();
        var address2_billing = $("#address2_billing").val();
        var address3_billing = $("#address3_billing").val();

        var state_billing = $("#state_billing").val();
        var city_billing = $("#city_billing").val();
        var pincode_billing = $("#pincode_billing").val();

        var phone_billing = $("#phone_billing").val();
        //var alternate_phone_billing = $("#alternate_phone_billing").val();

        var status = false;



        if (name_billing == "") {
            if ($("#name_billing").hasClass("inputSuccess")) {
                $("#name_billing").removeClass("inputSuccess");
                $("#name_billing").addClass("inputError");
            } else {
                $("#name_billing").addClass("inputError");
            }
        }

        if (address1_billing == "") {
            if ($("#address1_billing").hasClass("inputSuccess")) {
                $("#address1_billing").removeClass("inputSuccess");
                $("#address1_billing").addClass("inputError");
            } else {
                $("#address1_billing").addClass("inputError");
            }
        }

        if (address2_billing == "") {
            if ($("#address2_billing").hasClass("inputSuccess")) {
                $("#address2_billing").removeClass("inputSuccess");
                $("#address2_billing").addClass("inputError");
            } else {
                $("#address2_billing").addClass("inputError");
            }
        }

        if (address3_billing == "") {

            if ($("#address3_billing").hasClass("inputSuccess")) {
                $("#address3_billing").removeClass("inputSuccess");
                $("#address3_billing").addClass("inputError");
            } else {
                $("#address3_billing").addClass("inputError");
            }
        }

        if (!state_billing) {

            if ($("#state_billing").hasClass("inputSuccess")) {
                $("#state_billing").removeClass("inputSuccess");
                $("#state_billing").addClass("inputError");
            } else {
                $("#state_billing").addClass("inputError");
            }

        }

        if (city_billing == "") {

            if ($("#city_billing").hasClass("inputSuccess")) {
                $("#city_billing").removeClass("inputSuccess");
                $("#city_billing").addClass("inputError");
            } else {
                $("#city_billing").addClass("inputError");
            }
        }

        if (pincode_billing == "") {
            if ($("#pincode_billing").hasClass("inputSuccess")) {
                $("#pincode_billing").removeClass("inputSuccess");
                $("#pincode_billing").addClass("inputError");
            } else {
                $("#pincode_billing").addClass("inputError");
            }
        }

        if (phone_billing == "") {

            if ($("#phone_billing").hasClass("inputSuccess")) {
                $("#phone_billing").removeClass("inputSuccess");
                $("#phone_billing").addClass("inputError");
            } else {
                $("#phone_billing").addClass("inputError");
            }
        }

        // if (alternate_phone_billing == "") {

        //     if ($("#alternate_phone_billing").hasClass("inputSuccess")) {
        //         $("#alternate_phone_billing").removeClass("inputSuccess");
        //         $("#alternate_phone_billing").addClass("inputError");
        //     } else {
        //         $("#alternate_phone_billing").addClass("inputError");
        //     }


        // }

        if (name_billing != "" && address1_billing != "" && address2_billing != "" && address3_billing != "" &&
            state_billing != "" && city_billing != "" && pincode_billing != "" && phone_billing != "") {


            if ($("#name_billing").hasClass("inputError")) {
                $("#name_billing").removeClass("inputError");
            }

            if ($("#address1_billing").hasClass("inputError")) {
                $("#address1_billing").removeClass("inputError");
            }

            if ($("#address2_billing").hasClass("inputError")) {
                $("#address2_billing").removeClass("inputError");
            }

            if ($("#address3_billing").hasClass("inputError")) {
                $("#address3_billing").removeClass("inputError");
            }


            if ($("#state_billing").hasClass("inputError")) {
                $("#state_billing").removeClass("inputError");
            }

            if ($("#city_billing").hasClass("inputError")) {
                $("#city_billing").removeClass("inputError");
            }

            if ($("#pincode_billing").hasClass("inputError")) {
                $("#pincode_billing").removeClass("inputError");
            }

            if ($("#phone_billing").hasClass("inputError")) {
                $("#phone_billing").removeClass("inputError");
            }

            // if ($("#alternate_phone_billing").hasClass("inputError")) {
            //     $("#alternate_phone_billing").removeClass("inputError");
            // }

            return status = true;
        } else {
            return status = false;
        }

    }




    document.addEventListener("DOMContentLoaded", function() {
        var loader = document.querySelector(".loader-container");
        setTimeout(() => {
            loader.style.display = "none";
        }, 1000);

    });

    document.addEventListener("DOMContentLoaded", function() {

        var uploadform2 = document.getElementById('uploadForm2');

        if (uploadform2) {


            uploadform2.onsubmit = function(e) {

                e.preventDefault();

                const clickedButtonId = $(event.target).find(':submit:focus').attr('id');

                // $("#"+clickedButtonId).css({'pointer-events':'none','background':'#004a8cab'});
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


                var custom_image = document.getElementById('custom_image');
                var imageFile = custom_image.files[0];
                let inputElement = custom_image;
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

                        let formElement = e.target;
                        let formAction = formElement.getAttribute('action');
                        // let imageInput = document.getElementById('custom_image');

                        const formData = new FormData(formElement);
                        var uid = formData.get("id");



                        const cartDataString = localStorage.getItem('cartData');

                        if (cartDataString) {
                            cartDatas = JSON.parse(cartDataString);
                            if (cartDatas.length > 0) {
                                cartDatas.forEach((cartData) => {
                                    if (typeof(cartData.custom_image) !== 'undefined') {
                                        formData.append('local_image', cartData.custom_image);
                                    }
                                });
                                console.log(formData);
                            }
                        }


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


                                $(".submit-container").css({
                                    'top': '0px',
                                    'width': 'auto'
                                });
                                $(".spinner").css({
                                    'display': 'none'
                                });
                                $("#" + clickedButtonId).val('Upload');

                                //save to localstorage if exist
                                let cartData = [];
                                if (cartDataString) {
                                    cartDatas = JSON.parse(cartDataString);
                                    if (cartDatas.length > 0) {

                                        const updatedItemIndex = cartDatas.findIndex(item => item.id ===
                                            data.uid);

                                        if (updatedItemIndex !== -1) {

                                            cartDatas[updatedItemIndex].custom_image = data
                                                .custom_image;
                                            const updatedCartDataString = JSON.stringify(cartDatas);
                                            localStorage.setItem('cartData', updatedCartDataString);
                                            //$("#"+clickedButtonId).css({'pointer-events':'auto','background':'#004a8c'});

                                        } else {
                                            console.log(
                                                `Product with productId ${uid} not found in the cart.`
                                            );
                                        }
                                    }
                                }



                                if (data.errors) {
                                    var error = data.errors;
                                    for (const fieldName in error) {
                                        if (error.hasOwnProperty(fieldName)) {
                                            const errorMessages = error[fieldName];
                                            errorMessages.forEach(errorMessage => {
                                                toastr.error(errorMessage, 'Oops', {
                                                    onHidden: function() {
                                                        $(".submit-container").css({
                                                            'top': '0px',
                                                            'width': 'auto'
                                                        });
                                                        $(".spinner").css({
                                                            'display': 'none'
                                                        });
                                                        $("#" + clickedButtonId)
                                                            .css({
                                                                'pointer-events': 'auto',
                                                                'background': '#004a8c'
                                                            }).val('Upload');
                                                    }
                                                });
                                            });
                                        }
                                    }
                                }

                                if (data.code == 200) {
                                    toastr.success(data.msg, 'Success', {
                                        onHidden: function() {
                                            window.location.reload();
                                        }
                                    });
                                }



                            })
                            .catch(error => {
                                console.error('Fetch error:', error);
                            });



                    }


                }
            }
        }


    });


    document.addEventListener("DOMContentLoaded", function() {
        var uploadform3 = document.getElementById('uploadForm3');

        if (uploadform3) {
            uploadform3.onsubmit = function(event) {

                event.preventDefault();



                let targetEle = event.target;

                $(targetEle).find(':submit:focus').attr('disabled', true).css('background', '#004a8cab')
                    .val("");
                $(".submit-container").css({
                    'top': '15px',
                    'width': '120px'
                });
                $(".spinner").css({
                    'display': 'block',
                    'left': '45%'
                });



                let formElement = event.target;
                let formAction2 = formElement.getAttribute('action');
                const formData2 = new FormData(formElement);

                var uid = document.getElementById('uidfortext').value;


                var mytextarea = document.getElementById('mytextarea');
                if (mytextarea.value != "") {

                    getUserStatus()
                        .then(status => {
                            console.log('User status:', status);
                            if (status) {
                                //fetch will be called

                                const csrfToken = getCsrfToken();

                                fetch(formAction2, {
                                        method: 'POST',
                                        body: formData2,
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

                                        $(".spinner").css({
                                            'display': 'none'
                                        });
                                        $(".submit-container").css({
                                            'top': '0px',
                                            'width': 'auto'
                                        });


                                        submitButton = targetEle.querySelector(
                                            'input[type="submit"]');
                                        submitButton.style.backgroundColor = "#004a8cab";
                                        submitButton.value = 'Add';


                                        toastr.success(data.msg, 'Success', {
                                            onHidden: function() {

                                                window.location.reload();
                                            }
                                        });


                                    })
                                    .catch(error => {
                                        console.error('Fetch error:', error);
                                    });

                            } else {
                                const cartDataString = localStorage.getItem('cartData');

                                let cartData = [];
                                if (cartDataString) {
                                    cartDatas = JSON.parse(cartDataString);
                                    if (cartDatas.length > 0) {

                                        const updatedItemIndex = cartDatas.findIndex(item => item.id ===
                                            uid);

                                        if (updatedItemIndex !== -1) {

                                            cartDatas[updatedItemIndex].custom_text = mytextarea.value;
                                            const updatedCartDataString = JSON.stringify(cartDatas);
                                            localStorage.setItem('cartData', updatedCartDataString);


                                            $(".spinner").css({
                                                'display': 'none'
                                            });
                                            $(".submit-container").css({
                                                'top': '0px',
                                                'width': 'auto'
                                            });


                                            submitButton = targetEle.querySelector(
                                                'input[type="submit"]');
                                            submitButton.style.backgroundColor = "#004a8cab";
                                            submitButton.value = 'Add';


                                            toastr.success("Message added successfully.", 'Success', {
                                                onHidden: function() {
                                                    window.location.reload();
                                                }
                                            });




                                        } else {
                                            console.log(
                                                `Product with productId ${uid} not found in the cart.`
                                            );
                                        }
                                    }
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                } else {
                    mytextarea.classList.add('inputError');


                    $(".spinner").css({
                        'display': 'none'
                    });
                    $(".submit-container").css({
                        'top': '0px',
                        'width': 'auto'
                    });


                    submitButton = targetEle.querySelector('input[type="submit"]');
                    submitButton.style.backgroundColor = "#004a8c";
                    submitButton.disabled = false;
                    submitButton.value = 'Add';



                }

            }
        }



    });

    document.addEventListener("DOMContentLoaded", function() {
        var uploadform4 = document.getElementById('uploadForm4');

        if (uploadform4) {
            uploadform4.onsubmit = function(event) {

                event.preventDefault();
                let targetEle = event.target;

                $(targetEle).find(':submit:focus').attr('disabled', true).css('background', '#004a8cab')
                    .val("");
                $(".submit-container").css({
                    'top': '15px',
                    'width': '120px'
                });
                $(".spinner").css({
                    'display': 'block',
                    'left': '65%'
                });



                let formElement = event.target;
                let formAction3 = formElement.getAttribute('action');
                const formData3 = new FormData(formElement);

                var uid = document.getElementById('uidfortext2').value;

                var mytextarea2 = document.getElementById('mytextarea2');
                var custom_text_edited = mytextarea2.value;

                if (mytextarea2.value != "") {

                    getUserStatus()
                        .then(status => {
                            console.log('User status:', status);
                            if (status) {
                                //fetch will be called
                                const csrfToken = getCsrfToken();

                                fetch(formAction3, {
                                        method: 'POST',
                                        body: formData3,
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

                                        $(".spinner").css({
                                            'display': 'none'
                                        });
                                        $(".submit-container").css({
                                            'top': '0px',
                                            'width': 'auto'
                                        });


                                        submitButton = targetEle.querySelector(
                                            'input[type="submit"]');
                                        submitButton.style.backgroundColor = "#004a8cab";
                                        submitButton.value = 'Save & Continue';


                                        toastr.success(data.msg, 'Success', {
                                            onHidden: function() {

                                                window.location.reload();
                                            }
                                        });


                                    })
                                    .catch(error => {
                                        console.error('Fetch error:', error);
                                    });

                            } else {
                                const cartDataString = localStorage.getItem('cartData');

                                if (cartDataString) {
                                    cartDatas = JSON.parse(cartDataString);
                                    if (cartDatas.length > 0) {

                                        const updatedItemIndex = cartDatas.findIndex(item => item.id ===
                                            uid);

                                        if (updatedItemIndex !== -1) {

                                            cartDatas[updatedItemIndex].custom_text =
                                                custom_text_edited;
                                            const updatedCartDataString = JSON.stringify(cartDatas);
                                            localStorage.setItem('cartData', updatedCartDataString);

                                            $(".spinner").css({
                                                'display': 'none'
                                            });
                                            $(".submit-container").css({
                                                'top': '0px',
                                                'width': 'auto'
                                            });


                                            submitButton = targetEle.querySelector(
                                                'input[type="submit"]');
                                            submitButton.style.backgroundColor = "#004a8cab";
                                            submitButton.value = 'Edit';


                                            toastr.success("Message updated successfully.", 'Success', {
                                                onHidden: function() {
                                                    window.location.reload();
                                                }
                                            });
                                        } else {
                                            console.log(
                                                `Product with productId ${uid} not found in the cart.`
                                            );
                                        }
                                    }
                                }

                            }
                        });


                } else {
                    mytextarea2.classList.add('inputError');
                    $(".spinner").css({
                        'display': 'none'
                    });
                    $(".submit-container").css({
                        'top': '0px',
                        'width': 'auto'
                    });
                    submitButton = targetEle.querySelector('input[type="submit"]');
                    submitButton.style.backgroundColor = "#004a8c";
                    submitButton.disabled = false;
                    submitButton.value = 'edit';

                }





            }

        }
    });




    document.addEventListener("DOMContentLoaded", function() {
        var mytextarea = document.getElementById('mytextarea');
        if (mytextarea) {
            mytextarea.addEventListener('input', function(event) {

                var inputValue = event.target;

                if (inputValue.classList.contains('inputError')) {
                    inputValue.classList.remove('inputError');
                }


            });
        }

    });



    function getUserStatus() {
        return new Promise((resolve, reject) => {
            fetch("{{ url('/checkUser') }}", {
                    method: 'GET',
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(result => {
                    if (result.code === 200) {
                        // Resolve with true for logged in user
                        resolve(true);
                    } else if (result.code === 210) {
                        // Resolve with false for guest user
                        resolve(false);
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    // Reject with an error
                    reject(error);
                });
        });
    }

    $(document).ready(() => {

        $('.checkout-form').submit(function(event) {
            event.preventDefault();
            let formElement = event.target;
            let formAction = formElement.getAttribute('action');
            let formData = new FormData(formElement);


            var ch = BillingValidation();

            checkShippingCount()
                .then(shippingStatus => {
                    console.log(ch);
                    console.log(shippingStatus);

                    if (ch && shippingStatus) {
                        //ok
                        var html = '<i class="fa fa-spinner fa-spin" ></i>';
                        var resetbtn = "Place Order";

                        const clickedButtonId = $(this).find(':submit:focus').attr('id');
                        console.log(clickedButtonId);
                        //$("#" + clickedButtonId).html(html);
                        $(".loader-container").css('display', 'flex');

                        var pincode = $("#pincode_billing").val();


                        checkSercvice(pincode)
                            .then(status => {

                                if (status) {

                                    fetch(formAction, {
                                            method: 'POST',
                                            body: formData,
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error(
                                                    'Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            console.log(data);
                                            let amount = data.amount;

                                            data.handler = function(sresponse) {

                                                $(".loader-container").css('display',
                                                    'flex');

                                                let sresponse_str = JSON.stringify(
                                                    sresponse);
                                                let payment_id = JSON.parse(
                                                        sresponse_str)
                                                    .razorpay_payment_id;
                                                let redirecturl =
                                                    window.baseUrl +
                                                    "/payment/status/" +
                                                    payment_id + "/" + amount;
                                                window.location.href = redirecturl;
                                            }

                                            var rzp1 = new Razorpay(data);

                                            rzp1.on('payment.failed', function(fresponse) {

                                                $(".loader-container").css(
                                                    'display', 'flex');

                                                let fresponse_str = JSON.stringify(
                                                    fresponse);
                                                let payment_id = JSON.parse(
                                                        fresponse_str).error
                                                    .metadata
                                                    .payment_id;
                                                let redirecturl =
                                                    window.baseUrl +
                                                    "/payment/status/" +
                                                    payment_id + "/" + amount;
                                                window.location.href = redirecturl;
                                            });

                                            $(".loader-container").css('display', 'none');
                                            rzp1.open();


                                        })
                                        .catch(error => {
                                            console.error('Fetch error:', error);
                                        });


                                } else {

                                    $(".loader-container").css('display', 'none');


                                    // $("#" + clickedButtonId).html(resetbtn);

                                    $("#pincode_billing").addClass('inputError');


                                    if ($("#postal_error1").hasClass('hideSpan')) {
                                        $("#postal_error1").removeClass('hideSpan');
                                        $("#postal_error1").addClass('showSpan');
                                    } else {
                                        $("#postal_error1").addClass('showSpan');
                                    }
                                }

                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    } else {
                        if (!shippingStatus) {
                            $(".loader-container").css('display', 'none');

                            toastr.error('Shipping address is missing!');
                        }
                    }

                })
                .catch(err => {
                    console.error('Error:', err);
                });










        });


    });



    function checkShippingCount() {

        return fetch("{{ url('/checkShipping') }}", {
                method: 'GET',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(result => {
                console.log(result);
                if (result.code == 200) {

                    return true;
                } else {
                    return false;
                }

            })
            .catch(error => {
                console.error('Fetch error:', error);
                reject(error);
            });

    }



    function checkSercvice(pincode) {

        return new Promise((resolve, reject) => {
            const csrfToken = getCsrfToken();



            const form_datas = {
                location: pincode,
            };

            fetch("{{ url('/serviceAjax') }}", {
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

                    if (data.code == 210) {
                        resolve(false);
                    } else if (data.code = 200) {

                        resolve(true);

                    }




                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    reject(error);
                });

        });
    }
</script>


</html>
