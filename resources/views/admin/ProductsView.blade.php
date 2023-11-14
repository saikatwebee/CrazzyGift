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
                            <input type="number" name="actual_price" id="edit_actual_price"  placeholder="Enter Actual Price"
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
                                data-live-search="true" name="tags[]"  id="edit_tags">

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
                            <label>Upload Image</label>
                            <label class="uploadFile">
                                <i class="fas fa-paperclip fa-md mr-2"></i>
                                <span class="filename">Attachment</span>
                                <input type="file" class="inputfile form-control" name="product_image"
                                    id="edit_product_image" accept="image/*" onchange="read_url(event)">
                            </label>
                            <p class="text-danger font-weight-bolder">Note : Image size should less than 5MB </p>

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
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
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


@endsection
