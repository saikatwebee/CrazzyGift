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
    timeOut: "2000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};

$(document).ready(() => {
    $(document).on("click", "#getcodeBtn", () => {
        $("#getcodeForm").submit();
    });

    $(document).on("click", "#getcode-btn", () => {
        $("#getcode-form").submit();
    });

    $(document).on("click", "#getcode_btn", () => {
        $("#getcode_form").submit();
    });
});

//login otp sent from main login page

$("#getcodeForm").on("submit", (event) => {
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
                $("#" + clickedButtonId).html(resetbtn);
                if (data.code == 200) {
                    $("#hidPhone").val(phone);
                    $("#resendp").attr("data-id", phone);

                    toastr.success(data.msg, "Success", {
                        onHidden: function () {
                            $("#" + clickedButtonId).css({
                                "pointer-events": "auto",
                                background: "#004a8c",
                            });
                            if ($(".submitCode").hasClass("deactive")) {
                                $(".submitCode").removeClass("deactive");
                                $(".submitCode").addClass("active");
                            }
                            if ($(".getCode").hasClass("active")) {
                                $(".getCode").removeClass("active");
                                $(".getCode").addClass("deactive");
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
                            $("#" + clickedButtonId).css({
                                "pointer-events": "auto",
                                background: "#004a8c",
                            });
                            window.location.href ="/register";
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
                            window.location.href ="/register";
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
            .css({ "pointer-events": "none", background: "#004a8cab" })
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
                                    onHidden: function () {
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
                        onHidden: function () {
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
                            window.location.href ="/login";
                        },
                    });
                }
            })
            .catch((error) => {
                console.error("Fetch error:", error);
            });
    }
});

$(document).ready(function () {
    $("#image").change(function () {
        readURL(this);
        const existingErrorMessage = document.querySelector(".uploaderrorSpan");
        if (existingErrorMessage) {
            existingErrorMessage.remove();
            if ($("#image").hasClass("inputError")) {
                $("#image").removeClass("inputError");
            }
        }
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#preview-image").attr("src", e.target.result);
            $("#image-preview").show();
        };

        reader.readAsDataURL(input.files[0]);
    }
}

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
        fetch("/resendOtp", {
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
            onHidden: function () {
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

        fetch("/transferCart", {
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

$(document).ready(function () {
    fetch("/checkGoogle")
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
            if (error.message === "Response is not JSON") {
            } else {
                console.error("Error:", error);
            }
        });
});

$(document).ready(function () {
    $(".otp-form").on("submit", function (event) {
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
                            onHidden: function () {
                                console.log("Toast hidden");

                                $("#" + clickedButtonId).css({
                                    "pointer-events": "auto",
                                    background: "#004a8c",
                                });

                                window.location.href = "/shippingCart";
                            },
                        });
                    } else {
                        toastr.success(data.msg, "Success", {
                            onHidden: function () {
                                console.log("Toast hidden");

                                $("#" + clickedButtonId).css({
                                    "pointer-events": "auto",
                                    background: "#004a8c",
                                });

                                window.location.href = "/";
                            },
                        });
                    }
                } else if (data.code == 210) {
                    toastr.error(data.msg, "Oops!", {
                        onHidden: function () {
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

// $(document).on("click", ".googleLogin", () => {
//     $(".googleForm").submit();
//     localStorage.removeItem('cartData');
// });
function forceLogout() {
    let redirectedUrl = "/logout";
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
