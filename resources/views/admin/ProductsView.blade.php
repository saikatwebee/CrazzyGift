@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

    <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">


            <div class="text-left mb-5 ">
                <h3>{{ $title }}</h3>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                    <button class="btn btn-sm btn-primary"
                        onclick="window.location.href='{{ url('/admin/Addproducts') }}';">Add New Product</button>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $heading }}</h4>
                            <p class="card-description">

                            </p>

                            <div class="table-responsive">

                                <table class="table table-striped" id="productTable">


                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>SKU</th>
                                            <th>HSN</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Tags</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Offer Price</th>
                                            <th>Actual Price</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Created On</th>

                                        </tr>
                                    </thead>

                                    <tbody></tbody>

                                </table>

                            </div>

                        </div>
                    </div>
                </div>


            </div>


        </div>


        @include('common.common')


    </div>
    <!-- main-panel ends -->


    <!--Edit modal for products datatable -->

    <div class="modal fade" id="editproductModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Details</h5>
                    <i class="fa-solid fa-delete-left" data-dismiss="modal" onclick='FormReset("editProductForm")'></i>
                </div>
                <div class="modal-body">
                    <div class="profilebox-item">

                        <div class="profile-picture2">

                            <img src="https://www.pacificfoodmachinery.com.au/media/catalog/product/placeholder/default/no-product-image-400x400.png"
                                id="edit_product_img" alt="Profile Picture"
                                style="width: 255px;height: 255px;border-radius: 10px;border-color: transparent;">

                        </div>


                    </div>
                    <!-- Add this div in your modal -->
                    <div id="altImagesContainer" class="alt-images-container"></div>

                    <form id="editProductForm" method="post" action="{{ url('/admin/editProduct') }}"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" id="eid">
                        <div class="form-group">
                            <label for="edit_title">Title</label>
                            <input type="text" name="title" id="edit_title" required placeholder="Enter Title"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_code">HSN Code</label>
                            <input type="text" name="code" id="edit_code" required placeholder="Enter Code"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="edit_sku">SKU</label>

                            <input type="text" class="form-control" name="sku" id="edit_sku" required
                                placeholder="Enter Product Code" />

                        </div>

                        <div class="form-group">
                            <label for="edit_category">Category</label>
                            <select name="main_category" id="edit_category" required class="form-control"
                                onchange="get_dependent(event)">
                                <option value="">Select Category</option>
                                @if ($categories)
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_subcategory">Subcategory</label>
                            <select name="sub_category" id="edit_subcategory" required class="form-control">
                                <option value="">Select Subcategory</option>
                                @if ($subcategories)
                                    @if (count($subcategories) > 0)
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                        @endforeach
                                    @endif
                                @endif

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Description</label>
                            <textarea name="description" id="edit_description" cols="30" rows="10" placeholder="Enter Description"
                                class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_weight">Weight</label>
                            <input type="number" name="weight" id="edit_weight" required placeholder="Enter Weight"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_height">Height</label>
                            <input type="number" name="height" id="edit_height" required placeholder="Enter Height"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_length">Length</label>
                            <input type="number" name="length" id="edit_length" required placeholder="Enter Length"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_breadth">Breadth</label>
                            <input type="number" name="breadth" id="edit_breadth" required placeholder="Enter Breadth"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="edit_product_height">Product Height</label>

                            <input type="text" class="form-control" name="product_height" id="edit_product_height"
                                required placeholder="Enter Product height" />

                        </div>


                        <div class="form-group">
                            <label class="edit_product_breadth">Product Breadth</label>

                            <input type="text" class="form-control" name="product_breadth" id="edit_product_breadth"
                                required placeholder="Enter Product Breadth" />

                        </div>


                        <div class="form-group">
                            <label class="edit_product_length">Product Length</label>

                            <input type="text" class="form-control" name="product_length" id="edit_product_length"
                                required placeholder="Enter Product length" />

                        </div>

                        <div class="form-group">
                            <label for="edit_price">Offer Price</label>
                            <input type="number" name="price" id="edit_price" required placeholder="Enter Price"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_actual_price">Actual Price</label>
                            <input type="number" name="actual_price" id="edit_actual_price"
                                placeholder="Enter Actual Price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_gst">GST</label>
                            <input type="number" name="gst" id="edit_gst" placeholder="Enter GST"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="edit_product_status">Status</label>
                            <select name="status" id="edit_product_status" required class="form-control">
                                <option>Select</option>
                                <option value="2">Deactive</option>
                                <option value="1">Active</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_slug">Slug</label>
                            <input type="text" name="slug" id="edit_slug" required placeholder="Enter Slug"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="slide_products">Select Tags</label>

                            <select class="selectpicker" multiple aria-label="Default select example"
                                data-live-search="true" name="tags[]" id="edit_tags">

                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                                @foreach ($subcategories as $sub_category)
                                    <option value="{{ $sub_category->name }}">{{ $sub_category->name }}
                                    </option>
                                @endforeach


                            </select>
                            @error('tags')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                        </div>



                        <div class="form-group">
                            <label>Upload Product Image</label>
                            <label class="uploadFile">
                                <i class="fas fa-paperclip fa-md mr-2"></i>
                                <span class="filename">Attachment</span>
                                <input type="file" class="inputfile form-control" name="product_image"
                                    id="edit_product_image" accept="image/*" onchange="read_url(event)">
                            </label>
                            <p class="text-danger font-weight-bolder">Note : Image size should less than 5MB </p>

                        </div>


                        <div class="form-group">
                            <label>Upload Product Alternative Images</label>
                            <label class="uploadFile">
                                <i class="fas fa-paperclip fa-md mr-2"></i>
                                <span class="filename">Attachment</span>
                                <input type="file" class="inputfile form-control" name="product_alt_image[]"
                                    id="edit_product_alt_image" accept="image/*" multiple>
                            </label>
                            <p class="text-danger font-weight-bolder">Note : Note :Upload Multiple Image</p>

                        </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editProductBtn">Save changes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"
                        onclick='FormReset("editProductForm")'>Close</button>

                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
     
        tinymce.init({
            selector: 'textarea#edit_description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });




        function FormReset(id) {
            var form = document.getElementById(id);
            form.reset();
        }

        function read_url(event) {

            let input = event.target;
            console.log(input);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#edit_product_img").attr("src", e.target.result);

                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function get_dependent(event) {
            const category = event.target.value;
            var selectElement = document.getElementById("edit_subcategory");
            selectElement.innerHTML = "";

            const url = "{{ url('admin/getDependent') }}";
            const formData = {
                id: category
            };
            console.log(category);
            const csrfToken = getCsrfToken();
            fetch(url, {
                    method: 'POST',
                    body: JSON.stringify(formData),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                })
                .then((response) => response.json())
                .then(data => {

                    console.log();

                    selectElement.innerHTML = '<option value="">Select Subcategory</option>';
                    data.forEach(item => {
                        const option = document.createElement("option");
                        option.value = item.id;
                        option.textContent = item.name;
                        selectElement.appendChild(option);
                    });



                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });

        }
    </script>
    <script>
        $(() => {
            AllProductsDatatable();
        });
        //All products datatable

        function AllProductsDatatable() {


            const url = "{{ url('admin/getAllProducts') }}";
            const tableId = "productTable";
            fetch(url, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    const columns = [



                        {
                            data: null,
                            render: function(data, type, row) {
                                if (type === 'display') {

                                    if (row.status == 1) {
                                        return `
    <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editProduct(${row.id},event)"></i>
    <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="ProductChange(${row.id})"></i>
    
`;
                                    } else {
                                        return `
    <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editProduct(${row.id},event)"></i>
    <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="ProductChange(${row.id})"></i>
    
`;
                                    }


                                }
                                return data;
                            }
                        },




                        {
                            data: 'id'
                        },
                        {
                            data: 'title'
                        },
                        {
                            data: 'sku'
                        },
                        {
                            data: 'code'
                        },
                        {
                            data: 'main_category.name',
                            name: 'main_category.name',
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    if (row.main_category && row.main_category.name !== null) {
                                        return row.main_category.name;
                                    } else {
                                        return 'NA';
                                    }
                                }
                                return data;
                            }
                        },

                        {
                            data: 'sub_category.name',
                            name: 'sub_category.name',
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    if (row.sub_category && row.sub_category.name !== null) {
                                        return row.sub_category.name;
                                    } else {
                                        return 'NA';
                                    }
                                }
                                return data;
                            }
                        },

                        {
                            "data": 'tags',
                            "render": function(data, type, row) {
                                if (data === null || data === '') {
                                    return 'NA';
                                } else {
                                    var tagsArray = data.split(', '); // Split the string into an array
                                    var buttons = '';

                                    tagsArray.forEach(function(tag) {
                                        buttons +=
                                            '<button class="btn btn-primary tag-button p-2">' +
                                            tag + '</button> ';
                                    });

                                    return buttons;
                                }
                            }
                        },



                        {
                            data: 'price'
                        },
                        {
                            data: 'actual_price',
                            render: function(data) {
                                if (data !== "" && data !== null) {
                                    return data;
                                } else {
                                    return 'NA';
                                }
                            }
                        },



                        {
                            data: 'created_at',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    // Assuming 'created_at' is in the default ISO 8601 format
                                    var datetime = new Date(data);
                                    var year = datetime.getFullYear();
                                    var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                    var day = datetime.getDate().toString().padStart(2, '0');
                                    var hours = datetime.getHours().toString().padStart(2, '0');
                                    var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                    var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                    // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                    return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                        minutes + ':' + seconds;
                                } else {
                                    return data;
                                }
                            }
                        }



                    ];

                    populateTable(data, tableId, columns);
                })
                .catch(error => console.error(error));
        }


        // get product details

        function editProduct(id, event) {

            document.getElementById('edit_subcategory').innHTML = "";
            var loader = document.querySelector(".loader-container");
            loader.style.display = "flex";

            const csrfToken = getCsrfToken();

            const form_datas = {
                id: id,
            };

            fetch("{{ url('/admin/getProduct') }}", {
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

                    console.log(data.slug);

                    const imgurl = "{{ asset('/products') }}/" + data.product_image;
                    $("#edit_product_img").attr('src', imgurl);

                    // Clear existing alt images
                    $("#altImagesContainer").empty();

                    // Display product_alt_images
                    const altImages = JSON.parse(data.product_alt_images);


                    // Check if altImages is an array
                    if (Array.isArray(altImages) && altImages.length > 0) {
                        altImages.forEach(altImage => {
                            const altImageUrl = "{{ asset('/product_alt') }}/" + altImage;
                            const altImageElement =
                                `<img src="${altImageUrl}" class="img-thumbnail" alt="Product Alt Image">`;
                            $("#altImagesContainer").append(altImageElement);
                        });
                    } else {
                        console.log(typeof(data.product_alt_images));
                        console.error('product_alt_images is not an array or is empty');
                    }


                    $("#edit_title").val(data.title);
                    $("#edit_code").val(data.code);
                    $("#edit_sku").val(data.sku);
                    $("#edit_slug").val(data.slug);

                    loader.style.display = "none";
                    $("#editproductModal").modal('show');


                    var edit_category = document.getElementById('edit_category');

                    var edit_subcategory = document.getElementById('edit_subcategory');
                    var edit_product_status = document.getElementById('edit_product_status');

                    for (var i = 0; i < edit_category.options.length; i++) {

                        if (edit_category.options[i].value == data.main_category) {

                            edit_category.options[i].selected = true;
                        }

                    }

                    for (var i = 0; i < edit_subcategory.options.length; i++) {

                        if (edit_subcategory.options[i].value == data.sub_category) {

                            edit_subcategory.options[i].selected = true;
                        }

                    }


                    for (var i = 0; i < edit_product_status.options.length; i++) {

                        if (edit_product_status.options[i].value == data.status) {

                            edit_product_status.options[i].selected = true;
                        }

                    }

                    $("#eid").val(data.id);

                    tinymce.get('edit_description').setContent(data.description);
                    $("#edit_weight").val(data.weight);
                    $("#edit_height").val(data.height);
                    $("#edit_length").val(data.length);

                    $("#edit_breadth").val(data.breadth);
                    $("#edit_price").val(data.price);
                    $("#edit_gst").val(data.gst);

                    console.log("Actual price" + data.actual_price);

                    if (data.actual_price != "" && data.actual_price != null) {
                        $("#edit_actual_price").val(data.actual_price);

                    }

                    $("#edit_product_height").val(data.product_height);
                    $("#edit_product_breadth").val(data.product_breadth);
                    $("#edit_product_length").val(data.product_length);

                    var tagstr = data.tags;
                    console.log(tagstr);

                    if (tagstr && tagstr !== "") {
                        // Trim any whitespace and then split the string by commas
                        var tags = tagstr.split(',').map(tag => tag.trim());

                        $('#edit_tags').selectpicker('val', tags);
                    } else {
                        $('#edit_tags').selectpicker('val', []);
                    }



                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });

        }


        //  product status change

        function ProductChange(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#004a8c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    const csrfToken = getCsrfToken();
                    const form_datas = {
                        id: id,
                    };

                    fetch("{{ url('/admin/productChange') }}", {
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


                            toastr.success('Product status changed successfully', 'Oops', {
                                onHidden: function() {
                                    // location.reload();
                                    $('#productTable').DataTable().destroy();
                                    AllProductsDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });

        }

        // form submit for product edit

        document.addEventListener("DOMContentLoaded", function() {
            var editProductForm = document.getElementById('editProductForm');

            if (editProductForm) {
                editProductForm.onsubmit = function(event) {

                    event.preventDefault();

                    let formElement = event.target;
                    const formData = new FormData(formElement);
                    let content = tinymce.get('edit_description').getContent();
                    formData.set('description', content);
                    let formAction = formElement.getAttribute('action');

                    const csrfToken = getCsrfToken();


                    const edit_product_image = document.getElementById('edit_product_image');
                    var imageFile = edit_product_image.files[0];

                    if (!imageFile) {
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
                                            //window.location.reload();

                                            // refresh the DataTable

                                            $("#editproductModal").modal('hide');
                                            $('#productTable').DataTable().destroy();
                                            AllProductsDatatable();
                                        },
                                    });
                                }


                            })
                            .catch(error => {
                                console.error('Fetch error:', error);
                            });
                    } else {
                        if (imageFile.size > 5 * 1024 * 1024) {
                            $("#uploadErrorSpan").html('Image shoul be less than 5MB');
                        } else {

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
                                                //window.location.reload();

                                                // refresh the DataTable
                                                $("#editproductModal").modal('hide');
                                                $('#productTable').DataTable().destroy();
                                                AllProductsDatatable();
                                            },
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
    </script>

@endsection
