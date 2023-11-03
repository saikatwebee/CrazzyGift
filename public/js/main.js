// function toggleDropdown(event) {
//   const dropdown = event.currentTarget.parentNode;
//   const isDropdownOpen = dropdown.classList.contains("show-dropdown");

//   // Close any previously opened dropdowns
//   const allDropdowns = document.querySelectorAll(".dropdown");
//   allDropdowns.forEach(function (dropdown) {
//     dropdown.classList.remove("show-dropdown");
//   });

//   // Toggle the clicked dropdown
//   if (!isDropdownOpen) {
//     dropdown.classList.add("show-dropdown");
//   }
// }



$(document).ready(function () {
    $('.dropdown').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
    });
});


function imagePreviewOnHover(event) {
    var elem = event.target;
    var imageSrc = elem.getAttribute('src');
    console.log(imageSrc);
    const showPreview = document.getElementById("showPreview");
    showPreview.src = imageSrc;
}

function resetImage(event) {
    $(document).ready(function () {
        $('.side-item').each(function () {
            if ($(this).hasClass('active')) {
                var defaulltImage = $(this).attr('src');
                const showPreview = document.getElementById("showPreview");
                showPreview.src = defaulltImage;
            }
        });
    });
}


$(document).ready(() => {

    $('input[name="location"]').on("keyup keypress", function (event) {

        $("[name='location']").css("pointer-events", "auto");
        var html = "";

        if ($(this).hasClass('inputSuccess')) {
            $(this).removeClass('inputSuccess');
        }

        if ($("#responseLocation").hasClass('text-success')) {
            $("#responseLocation").removeClass('text-success');


        }


        if ($("#responseLocation").hasClass('text-danger')) {
            $("#responseLocation").removeClass('text-success');


        }

        $("#responseLocation").html('');


        //  html +="Check Servicebility <i class='fa-solid fa-arroe-right-long'></i>";
        $("#checkLocatin").html("Check Servicebility <i class='fa-solid fa-arrow-right-long'></i>");
    });





});



// document.addEventListener("DOMContentLoaded", function() {
//     var checkBilling = "{{($billingAddress) ? 'true' :  'false'}}";
//     var checkbox = document.getElementById('flexSwitchCheckDefault');
//     if(checkBilling){
//         //true === enabled
//         checkbox.disabled = false;
//     }
//     else{
//         //false=== disabled
//         checkbox.disabled = true;
//     }
// });


$(document).on("click", "#checkLocatin", () => {
    //validate pincode
    var userPincode = $('input[name="location"]').val();
    $("[name='location']").css("pointer-events", "none");
    console.log(userPincode.length);

    if (userPincode.length == 0) {
        // if()
        $('input[name="location"]').addClass('inputError');
        $('input[name="location"]').css('pointer-events', 'auto');
    } else {
        var html = 'Checking Servicebility <i class="fa fa-spinner fa-spin" ></i>';
        $("#checkLocatin").html(html);
        $('input[name="pincode"]').val(userPincode);
        $("#servicecheckForm").submit();
        // if ($('input[name="location"]').hasClass('inputError')) {
        //     $('input[name="location"]').removeClass('inputError');
        //     $('input[name="location"]').addClass('inputSuccess');
        // } else {
        //     $('input[name="location"]').addClass('inputSuccess');
        // }




    }


});



$("#servicecheckForm").on("submit", (event) => {
    event.preventDefault();
    let formElement = event.target;
    let formAction = formElement.getAttribute('action');
    let formData = new FormData(formElement);
    var pincode = formData.get("location");

    fetch(formAction, {
            method: 'POST',
            body: formData,
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

                localStorage.setItem('service_pincode', data.pincode);

                $("#add_cart").css('pointer-events', 'auto');
                $("#add_cart_btn").css('background', '#004a8c');


                $("[name='location']").css("pointer-events", "auto");
                var html = data.message + ' <i class="fa-solid fa-circle-check"></i>';


                if ($("#responseLocation").hasClass('checkButton')) {
                    $("#responseLocation").html(html);
                    $("#checkLocatin").html("");
                    $("#responseLocation").addClass('text-success');

                }

                if ($("#responseLocation").hasClass('text-danger')) {
                    $("#responseLocation").html(html);
                    $("#checkLocatin").html("");
                    $("#responseLocation").removeClass('text-danger');
                    $("#responseLocation").addClass('text-success');

                }

                if ($('input[name="location"]').hasClass('inputError')) {
                    $('input[name="location"]').removeClass('inputError');
                    $('input[name="location"]').addClass('inputSuccess');
                } else {
                    $('input[name="location"]').addClass('inputSuccess');
                }



            } else if (data.code == 210) {
                $("[name='location']").css("pointer-events", "auto");
                //toastr.error(data.msg);
                var html = data.message + ' <i class="fa-solid fa-circle-exclamation"></i>';
                if ($("#responseLocation").hasClass('checkButton')) {
                    $("#responseLocation").html(html);
                    $("#checkLocatin").html("");
                    $("#responseLocation").addClass('text-danger');

                }

                if ($("#responseLocation").hasClass('text-success')) {
                    $("#responseLocation").html(html);
                    $("#checkLocatin").html("");
                    $("#responseLocation").removeClass('text-success');
                    $("#responseLocation").addClass('text-danger');

                }

                if ($('input[name="location"]').hasClass('inputSuccess')) {
                    $('input[name="location"]').removeClass('inputSuccess');
                    $('input[name="location"]').addClass('inputError');
                } else {
                    $('input[name="location"]').addClass('inputError');
                }



            }

            //$('input[name="pincode"]').val(pincode);
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });

});


$(document).ready(() => {
    $('input[name="location"]').on("keyup keypress", (event) => {
        let ele = event.target;
        $("#add_cart").css('pointer-events', 'none');
        $("#add_cart_btn").css('background', '#004a8cab');


        if ($(ele).hasClass('inputError')) {
            $(ele).removeClass('inputError');

        }
    });
});


$(document).on("click", "#add_cart", (e) => {

        var html = '<i class="fa fa-spinner fa-spin" ></i>';
        var resetbtn = "<i class='fa-solid fa-cart-shopping'></i> Go to cart";
        var targetEl = e.target;

        $("#add_cart_btn").css({'pointer-events':'none','background':'#004a8cab'}).html(html);
    
         $("#add_cart").css('pointer-events','none');

      $("#cart_form").on("submit", (event) => {
       event.preventDefault();
      
        let formElement = event.target;
        let formAction = formElement.getAttribute('action');
        let formData = new FormData(formElement);


        fetch(formAction, {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(result => {



                // $("#add_cart_btn").html(resetbtn).prop('type', 'button').attr('onclick', 'window.location.href="/shippingCart";').css({'pointer-events': 'auto', 'background': '#004a8c'});
                $("#add_cart_btn").html(resetbtn).prop('type', 'button').attr('onclick', `window.location.href = window.baseUrl + '/shippingCart';`).css({'pointer-events': 'auto', 'background': '#004a8c'});


                
                if (result.code == 200) {
                    toastr.success(result.message,'Success',{
                                onHidden: function() {
                                       //cart icon needs to update
                                       cartCount();
                                },
                            });


                } else if (result.code == 210) {
                    console.log(result.data);
                    let newCartItem = result.data;
                    let existingCartData = localStorage.getItem('cartData');

                    if (!existingCartData) {
                        existingCartData = [];
                    } else {
                       
                        existingCartData = JSON.parse(existingCartData);
                    }

                    if (existingCartData.length > 0) {
                        
                        const updatedItemIndex = existingCartData.findIndex(item => item.productId === newCartItem.productId);


                        if (updatedItemIndex !== -1) {

                            var quantity = parseInt(existingCartData[updatedItemIndex].quantity) + parseInt(newCartItem.quantity);

                            existingCartData[updatedItemIndex].quantity = quantity;
                            localStorage.setItem('cartData', existingCartData);
                        } else {
                            existingCartData.push(newCartItem);
                        }
                    } else {
                        existingCartData.push(newCartItem);
                    }


                    localStorage.setItem('cartData', JSON.stringify(existingCartData));
                  
                    toastr.success(result.message,'Success',{
                                onHidden: function() {
                                    //cart icon needs to update
                                    cartCount();
                                },
                            });

                }

                //$("#servicecheckForm").trigger('reset');
                //settimeout for redirect to cart page

             
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });

      });
});


$(document).ready(() => {

    var carts = JSON.parse(localStorage.getItem('cartData'));
    if (carts && carts.length > 0) {
        console.log(carts);
        var html1 = "";
        var html2 = "";
        var html3 = "";
        var html4 = "";

        var totalPrice = 0;

        carts.forEach((cart, key) => {
            var totalPriceIndividual = cart.price * cart.quantity;
            totalPrice = totalPrice + totalPriceIndividual;

            var productTitle = cart.title;
            if (productTitle.length > 15) {
                truncatedTitle = productTitle.substring(0, 15) + '...';
            }
            else{
                truncatedTitle = productTitle;
            }

            if (cart.hasOwnProperty('custom_image') && !cart.hasOwnProperty('custom_text')) {
                //if only image has been uploaded
                html1 += '<div class="orderSummaryCard"><div class="row"><div class="col-lg-5"><div class="row"><div class="col-lg-6"><div class="imgCartPro"><img src="' + window.imgUrl +"products/"+cart.product_image + '" alt="cart_1"></div></div><div class="col-lg-6"><div class="nameAndPrice1"><p>' + cart.title + '</p><h3><i class="fa-solid fa-indian-rupee-sign"></i> ' + cart.price + '</h3></div><div class="quantity-selector1"><div class="quantityBtn1"><b>Quantity</b></div><button class="quantity-btn1 quantity-decrease1" data-id="' + cart.id + '">-</button><input type="text" class="quantity-input1"value="' + cart.quantity + '" data-id="' + cart.id + '" price="' + cart.price + '"><button class="quantity-btn1 quantity-increase1" data-id="' + cart.id + '" >+</button></div></div></div></div><div class="col-lg-3"><div class="titleDel"><p>Delivery time</p><h6> Metros - 2 to 3 days, Tier 2 cities - 3 to 5 days, Others - 4 to 6 days</h6></div></div><div class="col-lg-4"><div class="totalPriceAM"><p>Total</p><h6><strong id="totalPriceAM_' + cart.id + '"><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPriceIndividual + '</strong></h6><div class="uploadAndDelBtn mt-4" ><button class="showimageBTN d-flex my-2" id="'+cart.id+'" data-id="' + cart.custom_image + '" ><div class="iconshowUpload showimageBTN_div" id="'+cart.id+'" data-id="' + cart.custom_image + '" style="margin-right: 8px;" ><i class="fa-solid fa-cloud-arrow-up showimageBTN_i" id="'+cart.id+'" data-id="' + cart.custom_image + '" ></i> </div><span id="showimageBTN_span" id="'+cart.id+'" data-id="' + cart.custom_image + '" >Show Image</span><i class="fa-solid fa-square-xmark" data-id="' + cart.id + '" title="Change Image" data-bs-toggle="tooltip" data-bs-placement="top" ></i></button><button class="textBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload textBTN_div" style="margin-right: 8px;" data-id="' + cart.id + '"><i class="fa-solid fa-envelope-open-text textBTN_i" data-id="' + cart.id + '"></i></div><span id="textBTN_span" data-id="' + cart.id + '">Add Message</span></button><button type="button" class="deleteBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload" style="margin-right: 8px;"><i class="fa-solid fa-trash-can"></i></div><span>Delete</span></button></div></div></div></div></div>';
            }
            if (cart.hasOwnProperty('custom_text') && !cart.hasOwnProperty('custom_image')) {
                //if only text has been uploaded
                html1 += '<div class="orderSummaryCard"><div class="row"><div class="col-lg-5"><div class="row"><div class="col-lg-6"><div class="imgCartPro"><img src="' + window.imgUrl +"products/"+cart.product_image + '" alt="cart_1"></div></div><div class="col-lg-6"><div class="nameAndPrice1"><p>' + cart.title + '</p><h3><i class="fa-solid fa-indian-rupee-sign"></i> ' + cart.price + '</h3></div><div class="quantity-selector1"><div class="quantityBtn1"><b>Quantity</b></div><button class="quantity-btn1 quantity-decrease1" data-id="' + cart.id + '">-</button><input type="text" class="quantity-input1"value="' + cart.quantity + '" data-id="' + cart.id + '" price="' + cart.price + '"><button class="quantity-btn1 quantity-increase1" data-id="' + cart.id + '" >+</button></div></div></div></div><div class="col-lg-3"><div class="titleDel"><p>Delivery time</p><h6> Metros - 2 to 3 days, Tier 2 cities - 3 to 5 days, Others - 4 to 6 days</h6></div></div><div class="col-lg-4"><div class="totalPriceAM"><p>Total</p><h6><strong id="totalPriceAM_' + cart.id + '"><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPriceIndividual + '</strong></h6><div class="uploadAndDelBtn mt-4" ><button class="uploadBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload uploadBTN_div" data-id="' + cart.id + '" style="margin-right: 8px;" ><i class="fa-solid fa-cloud-arrow-up uploadBTN_i" data-id="' + cart.id + '"></i> </div><span id="uploadBTN_span" data-id="' + cart.id + '">Upload Image</span></button><button class="showtextBTN d-flex my-2" id="'+cart.id+'" data-id="' + cart.custom_text + '"><div class="iconshowUpload showtextBTN_div" id="'+cart.id+'" style="margin-right: 8px;" data-id="' + cart.custom_text + '"><i class="fa-solid fa-envelope-open-text showtextBTN_i" id="'+cart.id+'" data-id="' + cart.custom_text + '"></i></div><span class="showtextBTN_span"  id="'+cart.id+'" data-id="' + cart.custom_text + '">Show Message</span></button><button type="button" class="deleteBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload" style="margin-right: 8px;"><i class="fa-solid fa-trash-can"></i></div><span>Delete</span></button></div></div></div></div></div>';
            }
            if (!cart.hasOwnProperty('custom_text') && !cart.hasOwnProperty('custom_image')) {
                //if both are not exist
                html1 += '<div class="orderSummaryCard"><div class="row"><div class="col-lg-5"><div class="row"><div class="col-lg-6"><div class="imgCartPro"><img src="' + window.imgUrl +"products/"+cart.product_image + '" alt="cart_1"></div></div><div class="col-lg-6"><div class="nameAndPrice1"><p>' + cart.title + '</p><h3><i class="fa-solid fa-indian-rupee-sign"></i> ' + cart.price + '</h3></div><div class="quantity-selector1"><div class="quantityBtn1"><b>Quantity</b></div><button class="quantity-btn1 quantity-decrease1" data-id="' + cart.id + '">-</button><input type="text" class="quantity-input1"value="' + cart.quantity + '" data-id="' + cart.id + '" price="' + cart.price + '"><button class="quantity-btn1 quantity-increase1" data-id="' + cart.id + '">+</button></div></div></div></div><div class="col-lg-3"><div class="titleDel"><p>Delivery time</p><h6> Metros - 2 to 3 days, Tier 2 cities - 3 to 5 days, Others - 4 to 6 days</h6></div></div><div class="col-lg-4"><div class="totalPriceAM"><p>Total</p><h6><strong id="totalPriceAM_' + cart.id + '"><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPriceIndividual + '</strong></h6><div class="uploadAndDelBtn mt-4" ><button class="uploadBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload uploadBTN_div" data-id="' + cart.id + '" style="margin-right: 8px;" ><i class="fa-solid fa-cloud-arrow-up uploadBTN_i" data-id="' + cart.id + '"></i> </div><span id="uploadBTN_span" data-id="' + cart.id + '">Upload Image</span></button><button class="textBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload textBTN_div" style="margin-right: 8px;" data-id="' + cart.id + '"><i class="fa-solid fa-envelope-open-text textBTN_i" data-id="' + cart.id + '"></i></div><span id="textBTN_span" data-id="' + cart.id + '">Add Message</span></button><button type="button" class="deleteBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload" style="margin-right: 8px;"><i class="fa-solid fa-trash-can"></i></div><span>Delete</span></button></div></div></div></div></div>';
            }
            if (cart.hasOwnProperty('custom_text') && cart.hasOwnProperty('custom_image')) {
                //if both are  exist
                html1 += '<div class="orderSummaryCard"><div class="row"><div class="col-lg-5"><div class="row"><div class="col-lg-6"><div class="imgCartPro"><img src="' + window.imgUrl +"products/"+cart.product_image + '" alt="cart_1"></div></div><div class="col-lg-6"><div class="nameAndPrice1"><p>' + cart.title + '</p><h3><i class="fa-solid fa-indian-rupee-sign"></i> ' + cart.price + '</h3></div><div class="quantity-selector1"><div class="quantityBtn1"><b>Quantity</b></div><button class="quantity-btn1 quantity-decrease1" data-id="' + cart.id + '">-</button><input type="text" class="quantity-input1"value="' + cart.quantity + '" data-id="' + cart.id + '" price="' + cart.price + '"><button class="quantity-btn1 quantity-increase1" data-id="' + cart.id + '">+</button></div></div></div></div><div class="col-lg-3"><div class="titleDel"><p>Delivery time</p><h6> Metros - 2 to 3 days, Tier 2 cities - 3 to 5 days, Others - 4 to 6 days</h6></div></div><div class="col-lg-4"><div class="totalPriceAM"><p>Total</p><h6><strong id="totalPriceAM_' + cart.id + '"><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPriceIndividual + '</strong></h6><div class="uploadAndDelBtn mt-4" ><button class="showimageBTN d-flex my-2" id="'+cart.id+'" data-id="' + cart.custom_image + '" ><div class="iconshowUpload showimageBTN_div" id="'+cart.id+'" data-id="' + cart.custom_image + '" style="margin-right: 8px;" ><i class="fa-solid fa-cloud-arrow-up showimageBTN_i" id="'+cart.id+'" data-id="' + cart.custom_image + '" ></i> </div><span id="showimageBTN_span" id="'+cart.id+'" data-id="' + cart.custom_image + '" >Show Image</span><i class="fa-solid fa-square-xmark" data-id="' + cart.id + '" title="Change Image" data-bs-toggle="tooltip" data-bs-placement="top" ></i></button><button class="showtextBTN d-flex my-2" id="'+cart.id+'" data-id="' + cart.custom_text + '"><div class="iconshowUpload showtextBTN_div" id="'+cart.id+'" style="margin-right: 8px;" data-id="' + cart.custom_text + '"><i class="fa-solid fa-envelope-open-text showtextBTN_i" id="'+cart.id+'" data-id="' + cart.custom_text + '"></i></div><span class="showtextBTN_span" id="'+cart.id+'" data-id="' + cart.custom_text + '" >Show Message</span></button><button type="button" class="deleteBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload" style="margin-right: 8px;"><i class="fa-solid fa-trash-can"></i></div><span>Delete</span></button></div></div></div></div></div>';
            }

            // html1 += '<div class="orderSummaryCard"><div class="row"><div class="col-lg-5"><div class="row"><div class="col-lg-6"><div class="imgCartPro"><img src="' + window.imgUrl +"products/"+cart.product_image + '" alt="cart_1"></div></div><div class="col-lg-6"><div class="nameAndPrice1"><p>' + cart.title + '</p><h3><i class="fa-solid fa-indian-rupee-sign"></i> ' + cart.price + '</h3></div><div class="quantity-selector1"><div class="quantityBtn1"><b>Quantity</b></div><button class="quantity-btn1 quantity-decrease1">-</button><input type="text" class="quantity-input1"value="' + cart.quantity + '"><button class="quantity-btn1 quantity-increase1">+</button></div></div></div></div><div class="col-lg-4"><div class="titleDel"><p>Delivery time</p><h6> Metros - 2 to 3 days, Tier 2 cities - 3 to 5 days, Others - 4 to 6 days</h6></div></div><div class="col-lg-3"><div class="totalPriceAM"><p>Total</p><h6><strong><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPriceIndividual + '</strong></h6><div class="uploadAndDelBtn mt-4" ><button class="uploadBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload uploadBTN_div" data-id="' + cart.id + '" style="margin-right: 8px;" ><i class="fa-solid fa-cloud-arrow-up uploadBTN_i" data-id="' + cart.id + '"></i> </div><span id="uploadBTN_span" data-id="' + cart.id + '">Image</span></button><button class="textBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload textBTN_div" style="margin-right: 8px;" data-id="' + cart.id + '"><i class="fa-solid fa-envelope-open-text textBTN_i" data-id="' + cart.id + '"></i></div><span id="textBTN_span" data-id="' + cart.id + '">Message</span></button><button type="button" class="deleteBTN d-flex my-2" data-id="' + cart.id + '"><div class="iconUpload" style="margin-right: 8px;"><i class="fa-solid fa-trash-can"></i></div><span>Delete</span></button></div></div></div></div></div>';


            html2 += '<div class="itemName"><p data-bs-toggle="tooltip" data-bs-placement="top" title="' + productTitle + '">' + truncatedTitle + '</p></div>';
            html3 += '<div class="amountPrice"><p><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPriceIndividual + ' </p></div>';

        });

        html4 += '<div class="amountPrice"><p><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPrice + '</p></div>';

        $("#shippingInfoDiv").append(html1);
        $("#itemDetails").append(html2);
        $("#priceDetails").append(html3);
        $("#totalDetails").append(html4);
        $("#guestCart").css("display", "flex");
    } else {
        $(".emptyCart").css({
            "display": "block"
        });
    }

});




$(document).ready(() => {

    $(".fa-square-xmark").click((event) => {
        event.stopPropagation();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var uid = event.target.getAttribute('data-id');
                const csrfToken = getCsrfToken();
                getUserStatus()
                    .then(status => {

                        if (status) {
                            //fetch will be called

                            const form_datas = {
                                id: uid,
                            };

                            fetch(window.baseUrl +"/normalCartImgDelete", {
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


                                 

                                          toastr.success("Image removed successfully.",'Success',{
                                                onHidden: function() {
                                                    window.location.reload();
                                                },
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

                                    const updatedItemIndex = cartDatas.findIndex(item => item.id === uid);

                                    if (updatedItemIndex !== -1) {

                                        if (cartDatas[updatedItemIndex].custom_image != undefined) {

                                            guestcrtImg = cartDatas[updatedItemIndex].custom_image;
                                            const form_datas = {
                                                custom_image: guestcrtImg,
                                            };

                                            fetch(window.baseUrl +"/guestCartImgDelete", {
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

                                                    //delete the cart image from localstorage

                                                    delete cartDatas[updatedItemIndex].custom_image;
                                                    const updatedCartDataString = JSON.stringify(cartDatas);

                                                    localStorage.setItem('cartData', updatedCartDataString);

                                                    toastr.success("Image removed successfully.");
                                                    setTimeout(() => {
                                                        window.location.reload();
                                                    }, 2000);


                                                })
                                                .catch(error => {
                                                    console.error('Fetch error:', error);
                                                });

                                        }


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
            }
        });


    });

    $(".showimageBTN").click((event) => {

        var data_id = event.target.getAttribute('data-id');
        var cart_id = event.target.getAttribute('id');

        console.log(data_id);
        console.log(cart_id);

        var imageUrl = window.imgUrl +"cart/" + data_id;

        // Open the image in a new tab
        window.open(imageUrl, '_blank');
    });
});




$(document).ready(() => {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});


$(document).ready(function () {
    const csrfToken = getCsrfToken();
    // Use $.each() to attach a click event to each button with the class "my-button"
    $('.deleteBTN').each(function () {
        $(this).on('click', function () {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#004a8c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $(".deleteBTN").prop("disabled", true);

                    var dataId = $(this).attr('data-id');



                    fetch(window.baseUrl + '/checkUser', {
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

                                const form_datas = {
                                    id: dataId,
                                };

                                fetch(window.baseUrl +"/deleteCart", {
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
                                        toastr.error(data.msg,'Oops!',{
                                             onHidden: function() {
                                                 window.location.reload();
                                            },
                                        });

                                    })
                                    .catch(error => {
                                        console.error('Fetch error:', error);
                                    });




                            } else if (result.code == 210) {


                                var parsedData = JSON.parse(localStorage.getItem("cartData"));


                                const updatedItemIndex = parsedData.findIndex(item => item.id === dataId);

                                if (updatedItemIndex !== -1) {


                                    if (parsedData[updatedItemIndex].custom_image != undefined) {
                                        guestcrtImg = parsedData[updatedItemIndex].custom_image;
                                        const form_datas = {
                                            custom_image: guestcrtImg,
                                        };

                                        fetch(window.baseUrl +"/guestCartImgDelete", {
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

                                                //delete the cart from localstorage
                                                if (parsedData.length > 0) {
                                                    NewData = parsedData.filter(row => row.id != dataId);
                                                    localStorage.setItem('cartData', JSON.stringify(NewData));
                                                   
                                                     toastr.error("Cart Details Deleted Successfully",'Oops!',{
                                                            onHidden: function() {
                                                                 window.location.reload();
                                                            },
                                                        });

                                                }


                                            })
                                            .catch(error => {
                                                console.error('Fetch error:', error);
                                            });

                                    } else {
                                        if (parsedData.length > 0) {
                                            NewData = parsedData.filter(row => row.id != dataId);
                                            localStorage.setItem('cartData', JSON.stringify(NewData));
                                            toastr.error("Cart Details Deleted Successfully",'Oops!',{
                                                            onHidden: function() {
                                                                 window.location.reload();
                                                            },
                                                        });

                                        }
                                    }


                                } else {

                                  

                                     toastr.error("Something went wrong!",'Oops!',{
                                                            onHidden: function() {
                                                                 window.location.reload();
                                                            },
                                        });


                                }


                            }


                            

                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });






                }

            });

        });
    });
});




$(document).ready(() => {
    cartCount();
});


function cartCount(){
    fetch(window.baseUrl + '/checkUser', {
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
                if (result.data && result.data.length > 0) {
                    $(".cart-count").html(result.data.length);
                    $(".cart-count").css("display", "block");
                }

            } else if (result.code == 210) {
                //get cart data from localstorage
                var cartStr = localStorage.getItem('cartData');
                var cartData = JSON.parse(cartStr);
                if (cartData) {
                    if (cartData.length > 0) {
                        $(".cart-count").html(cartData.length);
                        $(".cart-count").css("display", "block");
                    }

                }

            }

        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
}



$(document).on("click", ".checkoutBtn", () => {



    fetch(window.baseUrl + '/checkUser', {
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
                //logged in user

                fetch(window.baseUrl +'/cartValidation', {
                                method: 'GET',
                        }).then(res => {
                                if (!res.ok) {
                                    throw new Error('Network response was not ok');
                            }
                            return res.json();
                    }).then(res => {
                        console.log(res);
                        if(res.code==200){
                            window.location.href = window.baseUrl +'/shippingInformation';
                        }
                        else{
                            toastr.error(res.msg);
                        }
                    }).catch(err => {
                            console.error('Fetch error:', err);
                    });
                

            } else if (result.code == 210) {
                //guest user
                //window.location.href = '/signin';
               
                const localStorageData = JSON.parse(localStorage.getItem('cartData'));
                const hasBothCustomData = localStorageData.every(item => {
                    return item.custom_image && item.custom_text;
                });

               
                if (hasBothCustomData) {
                  
                    
                    window.location.href = window.baseUrl +'/signin';
                } else {
                  
                    console.log("Please make sure each item has both 'custom-text' and 'custom-image' present.");
                   
                    toastr.error("Image or Message is missing for atleast one item in the cart");     
                }


            }

        })
        .catch(error => {
            console.error('Fetch error:', error);
        });


});




$(document).ready(() => {
    var localCart = localStorage.getItem('cartData');
    var cart_parse = JSON.parse(localCart);
    var empty = "";

    if (!cart_parse) {
        empty += '<p class="text-center">Cart is Empty</p>';
        $("#guest-cart").append(empty);
    } else {
        if (cart_parse.length == 0) {
            empty += '<p class="text-center">Cart is Empty</p>';
            $("#guest-cart").append(empty);


        }
    }

});




function hideDropdown(event) {
    const dropdown = event.currentTarget.parentNode;
    const isDropdownOpen = dropdown.classList.contains("show-dropdown");
    if (isDropdownOpen) {
        dropdown.classList.remove("show-dropdown");
    }
}



const toggleBtn = document.getElementById('toggle-btn');
const closeBtn = document.getElementById('close-btn');
const nav = document.querySelector('nav');

closeBtn.addEventListener('click', () => {
    toggleBtn.checked = false;
});

toggleBtn.addEventListener('click', () => {
    if (toggleBtn.checked) {
        nav.classList.add('open');
    } else {
        nav.classList.remove('open');
    }
});


// carousal

// let currentSlide = 0;
// const slides = document.querySelectorAll(".slider-slide");
// const slideCount = slides.length;

// function showSlide() {
//     for (let i = 0; i < slideCount; i++) {
//         if (i === currentSlide) {
//             slides[i].style.transform = "translateX(0)";
//         } else {
//             slides[i].style.transform = "translateX(100%)";
//         }
//     }
// }

// function nextSlide() {
//     if (currentSlide < slideCount - 1) {
//         currentSlide++;
//     } else {
//         currentSlide = 0;
//     }
//     showSlide();
// }

// function prevSlide() {
//     if (currentSlide > 0) {
//         currentSlide--;
//     } else {
//         currentSlide = slideCount - 1;
//     }
//     showSlide();
// }

// setInterval(() => {
//     nextSlide();
// }, 3000);

// showSlide();



// carousal 2

let currentSlide1 = 0;
const slides1 = document.querySelectorAll(".slider-slide1");
const slideCount1 = slides1.length;

function showSlide1() {
    for (let i = 0; i < slideCount1; i++) {
        slides1[i].style.transform = `translateX(-${currentSlide1 * 100}%)`;
    }
}

function nextSlide1() {
    if (currentSlide1 < slideCount1 - 1) {
        currentSlide1++;
    } else {
        currentSlide1 = 0;
    }
    showSlide1();
}

function prevSlide1() {
    if (currentSlide1 > 0) {
        currentSlide1--;
    } else {
        currentSlide1 = slideCount1 - 1;
    }
    showSlide1();
}




// carousal 3

let currentSlide2 = 0;
const slides2 = document.querySelectorAll(".owl-slide");
const slideCount2 = slides2.length;

function showSlide2() {
    for (let i = 0; i < slideCount2; i++) {
        slides2[i].style.transform = `translateX(-${currentSlide2 * 100}%)`;
    }
}

function nextSlide2() {
    if (currentSlide2 < slideCount2 - 1) {
        currentSlide2++;
    } else {
        currentSlide2 = 0;
    }
    showSlide2();
}

function prevSlide2() {
    if (currentSlide2 > 0) {
        currentSlide2--;
    } else {
        currentSlide2 = slideCount2 - 1;
    }
    showSlide2();
} 







// carousal 4

let currentSlide3 = 0;
const slides3 = document.querySelectorAll(".slider-slide3");
const slideCount3 = slides3.length;

function showSlide3() {
    for (let i = 0; i < slideCount3; i++) {
        slides3[i].style.transform = `translateX(-${currentSlide3 * 100}%)`;
    }
}

function nextSlide3() {
    if (currentSlide3 < slideCount3 - 1) {
        currentSlide3++;
    } else {
        currentSlide3 = 0;
    }
    showSlide3();
}

function prevSlide3() {
    if (currentSlide3 > 0) {
        currentSlide3--;
    } else {
        currentSlide3 = slideCount3 - 1;
    }
    showSlide3();
}



// Popup

$(document).ready(function () {

    $(".filterBtn").click(function () {
        console.log("Filter button is clicked");
        $(".popup-overlay").show();
    });

    $(".closeBtn").click(function () {
        console.log("Close button is clicked");
        $(".popup-overlay").hide();
    });
});




// Side picture to main picture changes

$(document).ready(function () {
    $('.sideProductImg').click(function () {
        var newImgSrc = $(this).find('img').attr('src');
        $('.mainProductImg img').attr('src', newImgSrc);
    });
});



// Increase decrease button

$(document).ready(function () {
    const decreaseBtn = $(".quantity_decrease");
    const increaseBtn = $(".quantity_increase");
    // const quantity_input = $(".quantity_input");
    let product_quantity = $('#product_quantity');



    decreaseBtn.on('click', function (event) {

        let container = $(event.target).closest('.quantity_selector');
        let quantityInput = container.find('.quantity_input');

        let value = parseInt(quantityInput.val());


        if (!isNaN(value) && value > 1) {
            quantityInput.val(value - 1);
            product_quantity.val(value - 1);
        }

    });


    increaseBtn.on('click', function (event) {

        let container = $(event.target).closest('.quantity_selector');
        let quantityInput = container.find('.quantity_input');

        let value = parseInt(quantityInput.val());
        let max = parseInt(quantityInput.attr("max"));

        if (isNaN(max) || value1 < max) {
            if (isNaN(value)) {
                quantityInput.val(1);
                product_quantity.val(1);
            } else {

                quantityInput.val(value + 1);
                product_quantity.val(value + 1);
            }
        }

    });



});


// Increase decrease for product details

$(document).ready(function () {
    const decreaseBtn1 = $(".quantity-decrease1");
    const increaseBtn1 = $(".quantity-increase1");
    // const quantityInput1 = $(".quantity-input1");


    decreaseBtn1.on('click', function (event) {

        let container = $(event.target).closest('.quantity-selector1');
        let quantityInput = container.find('.quantity-input1');

        let value1 = parseInt(quantityInput.val());
        let dataId = quantityInput.attr("data-id");
        let price = quantityInput.attr("price");

        if (!isNaN(value1) && value1 > 1) {

            quantityInput.val(value1 - 1);

            //quantyUpdate depend on user status
            quantityUpdate(value1 - 1, dataId, price);

        }

    });


    increaseBtn1.on('click', function (event) {

        let container = $(event.target).closest('.quantity-selector1');
        let quantityInput = container.find('.quantity-input1');

        let value1 = parseInt(quantityInput.val());
        let max1 = parseInt(quantityInput.attr("max1"));
        let dataId = quantityInput.attr("data-id");
        let price = quantityInput.attr("price");

        if (isNaN(max1) || value1 < max1) {
            if (isNaN(value1)) {
                quantityInput.val(1);
                //quantyUpdate depend on user status
                quantityUpdate(1, dataId, price);
            } else {

                quantityInput.val(value1 + 1);
                //quantyUpdate depend on user status
                quantityUpdate(value1 + 1, dataId, price);
            }
        }

    });


});


function quantityUpdate(quantity, dataId, price) {

    var loader = document.querySelector(".loader-container");
    loader.style.display = "flex";


    getUserStatus()
        .then(status => {
            console.log('quantity:', quantity);
            console.log('UID:', dataId);
            console.log('product price:', price);
            console.log("totalPriceAM_" + dataId);

            if (status) {

                const form_datas = {
                    id: dataId,
                    quantity: quantity,

                };
                const csrfToken = getCsrfToken();

                fetch(window.baseUrl +"/cartUpdateNormal", {
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

                        if (data.code == 200) {


                            var cartDatas = data.response;
                            if (cartDatas.length > 0) {

                                let totalprice = 0;
                                totalprice = totalprice + (price * quantity);
                                var html = '<i class="fa-solid fa-indian-rupee-sign"></i> ' + totalprice;
                                $("#totalPriceAM_" + dataId).html(html);

                                var html3 = "";
                                var html4 = "";
                                var totalPrice = 0;

                                cartDatas.forEach((cart, key) => {

                                    var product = cart.product;
                                    var totalPriceIndividual = product.price * cart.quantity;
                                    totalPrice = totalPrice + totalPriceIndividual;

                                    html3 += '<div class="amountPrice"><p><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPriceIndividual + ' </p></div>';

                                });


                                html4 += '<div class="amountPrice"><p><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPrice + '</p></div>';

                                $("#priceDetails").html(html3);
                                $("#totalDetails").html(html4);

                                setTimeout(() => {
                                    loader.style.display = "none";
                                }, 5000);

                            }


                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });


                loader.style.display = "none";

            } else {

                let totalprice = 0;
                totalprice = totalprice + (price * quantity);
                var html = '<i class="fa-solid fa-indian-rupee-sign"></i> ' + totalprice;
                $("#totalPriceAM_" + dataId).html(html);
                const cartDataString = localStorage.getItem('cartData');

                if (cartDataString) {
                    cartDatas = JSON.parse(cartDataString);
                    if (cartDatas.length > 0) {

                        const updatedItemIndex = cartDatas.findIndex(item => item.id ===
                            dataId);

                        if (updatedItemIndex !== -1) {

                            cartDatas[updatedItemIndex].quantity = quantity;
                            const updatedCartDataString = JSON.stringify(cartDatas);
                            localStorage.setItem('cartData', updatedCartDataString);


                            var html3 = "";
                            var html4 = "";
                            var totalPrice = 0;

                            cartDatas.forEach((cart, key) => {
                                var totalPriceIndividual = cart.price * cart.quantity;
                                totalPrice = totalPrice + totalPriceIndividual;
                                html3 += '<div class="amountPrice"><p><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPriceIndividual + ' </p></div>';
                            });
                            html4 += '<div class="amountPrice"><p><i class="fa-solid fa-indian-rupee-sign"></i> ' + totalPrice + '</p></div>';

                            $("#priceDetails").html(html3);
                            $("#totalDetails").html(html4);

                            loader.style.display = "none";


                        } else {
                            console.log(
                                `Product with productId ${dataId} not found in the cart.`);
                        }
                    }
                }

            }
        });
}


function getUserStatus() {
    return new Promise((resolve, reject) => {
        fetch(window.baseUrl + '/checkUser', {
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


// Order Track status 



$(document).ready(function () {
    var orderTrackPoints = $('.orderTrackPoints li');

    // Set the initial active status
    orderTrackPoints.first().addClass('active');

    // Set the click event for order tracking points
    orderTrackPoints.click(function () {
        // Remove the active status from all points
        orderTrackPoints.removeClass('active');

        // Set the active status to the clicked point
        $(this).addClass('active');

        // Update the order status text
        var orderStatusText = $(this).data('status-text');
        $('.orderStatusText').text(orderStatusText);
    });
});





$(document).ready(function () {

    $("#edit-icon").on("click", function () {
        $(".modal").css("display", "block");
    });

    $(".uploadBTN,.uploadBTN_div,#uploadBTN_span,.uploadBTN_i ").on("click", function (event) {
        var dataId = event.target.getAttribute('data-id');
        $("#uidforimage").val(dataId);
        $(".modal5").css("display", "block");


    });

    $(".textBTN,.textBTN_div,#textBTN_span,.textBTN_i").on("click", function (event) {
        $(".modal6").css("display", "block");
        var dataId = event.target.getAttribute('data-id');
        $("#uidfortext").val(dataId);

    });


    $(".showtextBTN,.showtextBTN_div,.showtextBTN_i").on("click", function (event) {
        $(".modal7").css("display", "block");
        var dataId = event.target.getAttribute('data-id');
        var cart_id = event.target.getAttribute('id');
        console.log(cart_id);
        console.log(dataId);

        $("#uidfortext2").val(cart_id);
        $("#mytextarea2").val(dataId);

    });


    // $("#showtextBTN_span").on("click",function(event){
    //     $(".modal7").css("display", "block");
    //     var dataId = event.target.getAttribute('data-id');
    //     var cart_id = event.target.getAttribute('cart-id');
    //     console.log(cart_id);
    //     console.log(dataId);
    //     $("#uidfortext2").val(cart_id);
    //     $("#mytextarea2").val(dataId);


    // });

    // function editCustomMessage(id,msg){

    // }




    $("#save-button").on("click", function () {
        var input = document.getElementById("profile-picture-input");
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#profile-pic").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
        $(".modal").css("display", "none");
    });
});



// information edit

$(document).ready(function () {
    // When the edit icon is clicked, open the modal
    $("#edit-icon1").on("click", function () {
        $(".modal1").css("display", "block");
    });

    $("#editmodalicon").on("click", function () {
        $(".modal3").css("display", "block");
    });



    $("#addShippingBtn").on("click", function () {
        $(".modal2").css("display", "block");
    });


    $(document).ready(function () {
        $('.edit_shipping,.edit_ship').each(function () {
            $(this).click((event) => {
                var dataId = event.target.getAttribute('data-id');
                $("#AddressId").val(dataId);

                const form_datas = {
                    id: dataId
                };
                const csrfToken = getCsrfToken();

                fetch(window.baseUrl +"/getShippingAddress", {
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
                        $(".modal4").css("display", "block");

                        $("#name_ship").val(data.name);
                        $("#address1_ship").val(data.street_address1);
                        $("#address2_ship").val(data.street_address2);
                        $("#address3_ship").val(data.street_address3);

                        var selectedState = data.state;
                        var state_ship = document.getElementById('state_ship');

                        for (var i = 0; i < state_ship.options.length; i++) {
                            if (state_ship.options[i].value === selectedState) {
                                state_ship.options[i].selected = true;
                                break;
                            }
                        }

                        $("#city_ship").val(data.city);
                        $("#postal_code_ship").val(data.postal_code);


                        $("#phone_ship").val(data.phone);
                        $("#alternate_phone_ship").val(data.alternate_phone);



                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            });


        });
    });


    $("#close-button2,.closeIcon").on("click", function () {
        $(".modal2").css("display", "none");
    });

    $("#close-button3,.closeIcon1").on("click", function () {
        $(".modal3").css("display", "none");
    });

    $("#close-button4,.closeIcon2").on("click", function () {
        $(".modal").css("display", "none");
    });

    $("#close-button6,.closeIcon5").on("click", function () {
        $(".uploaderrorSpan").html("");
        if ($("#custom_image").hasClass('inputError')) {
            $("#custom_image").removeClass('inputError')
        }
        $(".modal5").css("display", "none");

    });

    $("#close-button7,.closeIcon6").on("click", function () {
        $(".modal6").css("display", "none");
    });

    $("#close-button8,.closeIcon7").on("click", function () {
        $(".modal7").css("display", "none");
    });


    $("#close-button5,.closeIcon4").on("click", function () {
        $(".modal4").css("display", "none");
    });




    $(".btnShippingInfo").on("click", function () {
        $("#editBillingForm").submit();
    });



    $(document).ready(() => {
        const radioButtons = document.querySelectorAll('.form-check-select');

        radioButtons.forEach(function (radioButton) {
            radioButton.addEventListener('change', function (event) {
                if (this.checked) {
                    var address_id = event.target.value;
                    var obj = {
                        'id': address_id
                    };

                    const csrfToken = getCsrfToken();

                    fetch(window.baseUrl +'/selectShipping', {
                            method: 'POST',
                            body: JSON.stringify(obj),
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
                           

                            toastr.success(data.msg,'Success',{
                                onHidden: function() {
                                    window.location.reload();
                                },
                            });



                           
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });
                }

            });

        });
    });




    $(document).ready(() => {
        const delAddress = document.querySelectorAll('.delAddress');

        

                $(".delAddress , .del_ship").click(function(event){

               

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#004a8c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var address_id = event.target.getAttribute('data-id');
                        var obj = {
                            'id': address_id
                        };

                        const csrfToken = getCsrfToken();

                        fetch(window.baseUrl +'/deleteShipping', {
                                method: 'POST',
                                body: JSON.stringify(obj),
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
                               
                                toastr.success(data.msg,'Success',{
                                onHidden: function() {
                                    window.location.reload();
                                },
                            });




                            })
                            .catch(error => {
                                console.error('Fetch error:', error);
                            });
                    }
                });

                 });

    });




    $(document).ready(function () {
        $('[name="postal_code"]').on('input', function () {
            var inputValue = $(this).val();
            var numericValue = getNumericSix(inputValue);

            if (numericValue !== null) {
                $(this).val(numericValue);
            }
        });


        $('[name="phone"]').on('input', function () {
            var inputValue = $(this).val();
            var numericValue = getNumericTen(inputValue);

            if (numericValue !== null) {
                $(this).val(numericValue);
            }
        });

        $('[name="alternate_phone"]').on('input', function () {
            var inputValue = $(this).val();
            var numericValue = getNumericTen(inputValue);

            if (numericValue !== null) {
                $(this).val(numericValue);
            }
        });


        function getNumericSix(input) {
            var numericValue = input.replace(/\D/g, '');


            if (numericValue.length > 6) {
                numericValue = numericValue.slice(0, 6);
            }

            return numericValue;
        }

        function getNumericTen(input) {
            var numericValue = input.replace(/\D/g, '');


            if (numericValue.length > 10) {
                numericValue = numericValue.slice(0, 10);
            }

            return numericValue;
        }




    });







    $(document).ready(() => {
        $("#editBillingForm").on("submit", (event) => {
            event.preventDefault();
            let formElement = event.target;
            let formAction = formElement.getAttribute('action');
            let formData = new FormData(formElement);


            fetch(formAction, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                  toastr.success(data.msg,'Success',{
                                onHidden: function() {
                                    window.location.reload();
                                },
                            });

                   
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });

        });

    });



    // When the save button is clicked, validate and update the user info, and close the modal
    $("#save-button1").on("click", function () {
        var username = $("#username").val();
        var useremail = $("#useremail").val();
        var usertel = $("#usertel").val();


        // Update the text fields and close the modal
        $("#username_name").text(username);
        $("#useremail_email").text(useremail);
        $("#usertel_phone").text(usertel);
        $(".modal1").css("display", "none");
    });
});


$(document).on("click", "#order-toggle", () => {
    $("#answer-toggle").slideToggle(200);
});

$(document).on("click", "#address-btn", () => {
    $("#address-toggle").slideToggle(200);
});



// $(document).ready(function(){
//     $('.carousel-test').slick({
//     slidesToShow: 1,
//     dots:true,
//     arrows: true,
//       autoplay:true
//     });
//   });



$(document).ready(function () {
    $('.user-icon').click(function (e) {
        e.preventDefault();
        $('.user-content').toggle();
    });
});
