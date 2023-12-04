@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

    <div class="main-panel">

        <div class="content-wrapper">
            <div class="text-left mb-5 ">
                <h3>{{ $title }}</h3>
            </div>
            <div class="row">


                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $heading }}</h4>
                            <form class="form-sample" id="add_product_form" method="post"
                                action="{{ url('/admin/subproducts') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Product Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="title" id="add_title"
                                                    required placeholder="Enter Product Title" />
                                                @error('title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">HSN Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="code" id="add_code"
                                                    required placeholder="Enter Product Code" />

                                                @error('code')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">SKU</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="sku" id="add_sku"
                                                    required placeholder="Enter Product Code" />

                                                @error('sku')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Category</label>
                                            <div class="col-sm-9">
                                                {{-- <input type="text" class="form-control" name="main_category" id="add_category"
                                                    required placeholder="Enter Product Code" /> --}}

                                                <select name="main_category" id="edit_category" required=""
                                                    class="form-control" onchange="getDependent(event)">
                                                    <option value="">Select Category</option>
                                                    @if ($categories)
                                                        @if (count($categories) > 0)
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </select>

                                                @error('main_category')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Sub Category</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="sub_category" id="add_sub_category"
                                                    style="position:relative;">
                                                    <option value="">Select Subcategory</option>


                                                </select>
                                                <span
                                                    style="color:#6c6666;font-size:16px;position:absolute;top:12px; right:40px;"
                                                    id="cat_loader"></span>


                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">weight</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="weight" id="add_weight"
                                                    required placeholder="Enter Weight (For ECOM)" />
                                                @error('weight')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>


                                    </div>



                                </div>


                                <div class="row">





                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">height</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="height" id="add_height"
                                                    required placeholder="Eneter Height (For ECOM)" />
                                                @error('height')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">length</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="length" id="add_length"
                                                    required placeholder="Enter Length (For ECOM)" />
                                                @error('length')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>


                                </div>


                                <div class="row">



                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Breadth</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="breadth"
                                                    id="add_breadth" required placeholder="Enter Breadth (For ECOM)" />
                                                @error('breadth')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Product Height</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="product_height"
                                                    id="add_product_height" required placeholder="Enter Product Height" />
                                                @error('product_height')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <div class="row">




                                    <!-- new field -->


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Product Thickness</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="product_breadth"
                                                    id="add_product_breadth" required
                                                    placeholder="Enter Product Thickness" />
                                                @error('product_breadth')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Product Length</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="product_length"
                                                    id="add_product_length" required placeholder="Enter Product Length" />
                                                @error('product_length')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>





                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Offer price</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="price" id="add_price"
                                                    required placeholder="Enter Selling Price" />
                                                @error('price')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Actual Price</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="actual_price"
                                                    id="add_actual_price" required placeholder="Enter Product Price" />
                                                @error('price')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">GST</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="gst" id="add_gst"
                                                    required placeholder="Enter GST" />
                                                @error('gst')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="status" id="add_status" required>
                                                    <option>Select</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Deactive</option>

                                                </select>

                                                @error('add_status')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="slide_products">Select Tags</label>
                                            <select class="selectpicker" multiple aria-label="Default select example"
                                                data-live-search="true" name="tags[]">

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->name }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                                @foreach ($subcategories as $sub_category)
                                                    <option value="{{ $sub_category->name }}">
                                                        {{ $sub_category->name }}
                                                    </option>
                                                @endforeach


                                            </select>
                                            @error('tags')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">


                                        <div class="form-group">
                                            <label>Product Image</label>

                                            <label class="uploadFile">
                                                <i class="fas fa-paperclip fa-md mr-2"></i>
                                                <span class="filename">Attachment</span>
                                                <input type="file" class="inputfile form-control" name="product_image"
                                                    id="add_product_image" accept="image/*">
                                            </label>

                                            <p class="text-danger font-weight-bolder">Note : Image size (261*265.2)
                                            </p>

                                            @error('product_image')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror


                                        </div>

                                    </div>

                                    <div class="col-lg-6">


                                        <div class="form-group">
                                            <label>Alternative Product Images</label>

                                            <label class="uploadFile">
                                                <i class="fas fa-paperclip fa-md mr-2"></i>
                                                <span class="filename">Attachment</span>
                                                <input type="file" class="inputfile form-control"
                                                    name="product_alt_image[]" id="add_product_alt_image"
                                                    accept="image/*" multiple>
                                            </label>

                                            <p class="text-danger font-weight-bolder">Note :Upload Multiple Image
                                            </p>

                                            @error('product_alt_image')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror


                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>

                                            <textarea class="form-control" rows="10" cols="8" name="description" id="add_description"
                                                placeholder="Enter Description"></textarea>
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror


                                        </div>

                                    </div>
                                </div>





                                <div class="text-right mb-3">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>





                            </form>
                        </div>
                    </div>
                </div>



            </div>

        </div>


        @include('common.common')

    </div>

    <script>
        // tinymce.init({
        //     selector: 'textarea#add_description',
        //     plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        //     tinycomments_mode: 'embedded',
        //     tinycomments_author: 'Author name',
        //     mergetags_list: [{
        //             value: 'First.Name',
        //             title: 'First Name'
        //         },
        //         {
        //             value: 'Email',
        //             title: 'Email'
        //         },
        //     ],
        //     ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
        //         "See docs to implement AI Assistant")),
        // });

        tinymce.init({
            selector: 'textarea#add_description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });



        // function showLoader(){
        //     var loader = document.querySelector(".loader-container");
        //     loader.style.display = "flex";

        // }

        function getDependent(event) {
            const category = event.target.value;
            document.getElementById('add_sub_category').style.pointerEvents = 'none';
            document.getElementById('cat_loader').innerHTML = '<i class="fa fa-spinner fa-spin" ></i>';


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

                    document.getElementById('add_sub_category').style.pointerEvents = 'auto';
                    document.getElementById('cat_loader').innerHTML = '';

                    const selectElement = document.getElementById("add_sub_category");
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
