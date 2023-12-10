@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')
    <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">

            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <h3 class="card-title font-weight-bolder">{{ $title }}</h3>
                </div>
                <div class="col-lg-3 grid-margin stretch-card">
                    <div class="card banner-hearder-card">
                        <div class="card-body  d-flex justify-content-center align-items-center panel-active"
                            onclick="toggleSliders(event),openTab('uploadBannerTab'),getAllBannersDatatable()"><i
                                class="fa-solid fa-flag-checkered mr-2"></i> Banners
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 grid-margin stretch-card">
                    <div class="card slider-hearder-card">
                        <div class="card-body  d-flex justify-content-center align-items-center panel-inactive"
                            onclick="toggleSliders(event),openTab('uploadSliderTab'), getAllSlidersDatatable()"><i
                                class="fa-solid fa-sliders mr-2"></i>
                            Products Sliders
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 grid-margin stretch-card">
                    <div class="card slider-hearder-card">
                        <div class="card-body  d-flex justify-content-center align-items-center panel-inactive"
                            onclick="toggleSliders(event),openTab('uploadOtherSliderTab'), getAllTestimonialSlider()"><i
                                class="fa-solid fa-sliders mr-2"></i>
                            Testimonial Sliders
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 grid-margin stretch-card">
                    <div class="card slider-hearder-card">
                        <div class="card-body  d-flex justify-content-center align-items-center panel-inactive"
                            onclick="toggleSliders(event),openTab('uploadImageSliderTab'),getAllOccasionDatatable()"><i
                                class="fa-regular fa-image mr-2"></i>
                            Occasions Image
                        </div>

                    </div>
                </div>


                <div class="col-lg-12 grid-margin stretch-card tab" id="uploadBannerTab" style="display: block;">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-list mr-2"></i>All Banner</h4>

                            <div class="card-wrapper">

                                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#AddBannerModal">Add New Banner</button>
                                </div>

                            </div>


                            <div class="table-responsive">

                                <table class="table table-striped table-hover w-100" id="bannerTable">

                                    <thead class="text-center">
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>Banner URL</th>
                                            <th>Attachment</th>
                                            <th>Status</th>
                                            <th>Created On</th>

                                        </tr>
                                    </thead>

                                    <tbody class="text-center"></tbody>

                                </table>

                            </div>



                        </div>
                    </div>

                </div>





                <div class="col-lg-12 grid-margin stretch-card tab" id="uploadSliderTab">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-list mr-2"></i>All Products Slider</h4>

                            <div class="card-wrapper">
                                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#AddSliderModal">Add New Product Slider</button>
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-hover w-100" id="sliderTable">

                                    <thead class="text-center">
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Products</th>
                                            <th>Status</th>
                                            <th>Created On</th>

                                        </tr>
                                    </thead>

                                    <tbody class="text-center"></tbody>

                                </table>

                            </div>



                        </div>
                    </div>
                </div>

                <div class="col-lg-12 grid-margin stretch-card tab" id="uploadOtherSliderTab">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-sliders"></i> Add Testimonials Slider</h4>

                            <div class="card-wrapper">
                                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#AddTestimonialSliderModal">Add New Testimonial Slider</button>
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-hover w-100" id="sliderTestimonialTable">

                                    <thead class="text-center">
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Created On</th>

                                        </tr>
                                    </thead>

                                    <tbody class="text-center"></tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-lg-12 grid-margin stretch-card tab" id="uploadImageSliderTab">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-image"></i> Add Image</h4>


                            <div class="card-wrapper">
                                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#AddimageModal">Upload Occasion Image</button>
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-hover w-100" id="imageTable">

                                    <thead class="text-center">
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>Target</th>
                                            <th>Image</th>
                                            <th>Image Type</th>
                                            <th>Button Name</th>
                                            <th>Status</th>
                                            <th>Created On</th>

                                        </tr>
                                    </thead>

                                    <tbody class="text-center"></tbody>

                                </table>

                            </div>
                        </div>

                    </div>
                </div>


            </div>


        </div>




        <!--Add banner model -->

        <div class="modal fade" id="AddBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Banner</h5>

                        <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">
                        <div class="profilebox-item">

                            <div class="profile-picture2">
                                <img src="https://www.pacificfoodmachinery.com.au/media/catalog/product/placeholder/default/no-product-image-400x400.png"
                                    id="add_banner_img" alt="Profile Picture"
                                    style="width: 255px;height: 255px;border-radius: 10px;border-color: transparent;">

                            </div>

                        </div>
                        <form id="banner_form" method="post" action="{{ url('admin/addBanner') }}"
                            enctype="multipart/form-data">


                            <div class="form-group">
                                <label>Upload Image</label>
                                <label class="uploadFile">
                                    <i class="fas fa-paperclip fa-md mr-2"></i>
                                    <span class="filename">Attachment</span>
                                    <input type="file" class="inputfile form-control" name="image" accept="image/*"
                                        required onchange="read_url(event)">
                                </label>
                                <p class="text-danger font-weight-bolder">Note : Image size (1116*405) </p>

                            </div>
                            <div class="form-group">
                                <label for="rget_url">Target URL</label>
                                <input type="text" class="form-control" name="target" id="target_url" required>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="addMenuBtn">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>


                    </div>

                    </form>
                </div>
            </div>
        </div>



        <!--edit banner model -->

        <div class="modal fade" id="EditBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>

                        <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">

                        <div class="profilebox-item">

                            <div class="profile-picture2">
                                <img src="https://www.pacificfoodmachinery.com.au/media/catalog/product/placeholder/default/no-product-image-400x400.png"
                                    id="edit_banner_img" alt="Profile Picture"
                                    style="width: 255px;height: 255px;border-radius: 10px;border-color: transparent;">

                            </div>

                        </div>

                        <form id="edit_banner_form" method="post" action="{{ url('admin/updateBanner') }}"
                            enctype="multipart/form-data">
                            <input type="hidden" id="bid" name="bid">

                            <div class="form-group">
                                <label>Upload Image</label>
                                <label class="uploadFile">
                                    <i class="fas fa-paperclip fa-md mr-2"></i>
                                    <span class="filename">Attachment</span>
                                    <input type="file" class="inputfile form-control" name="image" accept="image/*"
                                        onchange="readURL(event)">
                                </label>
                                <p class="text-danger font-weight-bolder">Note : Image size (1116*405) </p>

                            </div>
                            <div class="form-group">
                                <label for="rget_url">Target URL</label>
                                <input type="text" class="form-control" name="target" id="edit_target_url" required>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="editMenuBtn">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>


                    </div>

                    </form>
                </div>
            </div>
        </div>



        <!--Add slider model -->

        <div class="modal fade" id="AddSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5> --}}
                        <h3 class="text-primary modal-title">Add New Slider</h3>
                        <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">
                        <form id="slider_form" method="post" action="{{ url('admin/addSlider') }}">
                            <div class="form-group">
                                <label for="slide_type">Select Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="1">Featured Collection</option>
                                    <option value="2">Best Selling</option>



                                </select>
                            </div>

                            <div class="form-group " style="margin-top:33px;">
                                <label for="slide_products">Select Latest Products</label>

                                <select class="selectpicker" multiple aria-label="Default select example"
                                    data-live-search="true" name="products[]" onchange="countProduct(event)" required>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach

                                </select>
                                <p class="text-danger font-weight-bolder">Note : Minimum 4 Product needs to add.
                                </p>
                            </div>




                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="addSliderBtn">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>


                    </div>


                </div>
            </div>
        </div>


        {{-- add testimonial  slider  --}}

        <div class="modal fade" id="AddTestimonialSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5> --}}
                        <h4 class="text-primary modal-title">Add New Testimonial Slider</h4>
                        <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">
                        <form id="testimonial_slider_form" method="post"
                            action="{{ url('admin/addTestimonialSlider') }}">


                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="testimonial_name" id="testimonial_name" required
                                    placeholder="Enter Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Designation</label>
                                <input type="text" name="testimonial_designation" id="testimonial_designation"
                                    required placeholder="Enter Designation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Upload Testimonials Image</label>
                                <label class="uploadFile">
                                    <i class="fas fa-paperclip fa-md mr-2"></i>
                                    <span class="filename">Attachment</span>
                                    <input type="file" class="inputfile form-control" name="testimonial_image"
                                        id="testimonial_image" accept="image/*" onchange="readURLImg(event)">
                                </label>
                                {{-- <p class="text-danger font-weight-bolder">Note : Image size (1116*405) </p> --}}

                            </div>
                            <div class="form-group">
                                <label for="testimonial_description">Description</label>
                                <textarea class="form-control" rows="10" cols="8" name="testimonial_description"
                                    id="testimonial_description" placeholder="Enter Testimonial Description"></textarea>
                            </div>


                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="addTestimonialSliderBtn">Save
                                    changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>


                    </div>


                </div>
            </div>
        </div>

        {{-- edit product slider modal --}}

        <div class="modal fade" id="EditSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>

                        <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">
                        <form id="slider_form2" method="post" action="{{ url('admin/updateSlider') }}">
                            <input type="hidden" id="sid" name="sid">
                            <div class="form-group">
                                <label for="slide_type">Select Type</label>
                                <select name="type" class="form-control" id="edit_type" required>
                                    <option value="">Select</option>
                                    <option value="1">Featured Collection</option>
                                    <option value="2">Best Selling</option>


                                </select>
                            </div>
                            <div class="form-group" style="margin-top:33px;">
                                <label for="slide_products">Latest Products</label>

                                <select class="selectpicker" multiple aria-label="Default select example"
                                    data-live-search="true" name="products[]" id="edit_products"
                                    onchange="countProduct(event)" required>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach

                                </select>
                                <p class="text-danger font-weight-bolder">Note : Minimum 4 Product needs to add.
                                </p>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="editSliderBtn">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>


                    </div>


                </div>
            </div>
        </div>

        {{-- testimonial edit modal --}}


        <div class="modal fade" id="EditTestimonialSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Testimonial Slider</h5>

                        <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">
                        <form id="edit_testimonial_slider_form" method="post"
                            action="{{ url('admin/updateTestimonialSlider') }}">
                            <input type="hidden" id="tid" name="tid">
                            <div class="form-group">
                                <label for="edit_testimonial_name">Name</label>
                                <input type="text" name="edit_testimonial_name" id="edit_testimonial_name" required
                                    placeholder="Enter Name" class="form-control">
                            </div>

                            <div class="form-group" style="margin-top:33px;">
                                <label for="edit_testimonial_designation">Designation</label>
                                <input type="text" name="edit_testimonial_designation"
                                    id="edit_testimonial_designation" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Upload Testimonials Image</label>
                                <label class="uploadFile">
                                    <i class="fas fa-paperclip fa-md mr-2"></i>
                                    <span class="filename">Attachment</span>
                                    <input type="file" class="inputfile form-control" name="edit_testimonial_image"
                                        id="edit_testimonial_image" accept="image/*">
                                </label>
                                {{-- <p class="text-danger font-weight-bolder">Note : Image size (1116*405) </p> --}}

                            </div>

                            <div class="form-group" style="margin-top:33px;">
                                <label for="edit_testimonial_description">Description</label>
                                <textarea class="form-control" rows="10" cols="8" name="edit_testimonial_description"
                                    id="edit_testimonial_description" placeholder="Enter Testimonial Description"></textarea>
                            </div>


                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="editTestimonialBtn">Save
                                    changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>


                    </div>


                </div>
            </div>
        </div>


        {{-- add occasions image upload modal --}}


        <div class="modal fade" id="AddimageModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Occasion Image</h5>

                        <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">
                        <form id="add_occasion_image_form" method="post" action="{{ url('admin/addOccasionImage') }}">

                            <div class="form-group">
                                <label for="add_target_occasion">Target URL</label>
                                <input type="text" name="add_target_occasion" id="add_target_occasion" required
                                    placeholder="Enter URL" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="image_type">Image Type</label>
                                <select name="image_type" id="image_type" class="form-control" required
                                    onchange="show_note(event)">
                                    <option value="">Select Image Type</option>
                                    <option value="1">Large Image</option>
                                    <option value="2">Small Image</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="add_image_occasion">Upload Testimonials Image</label>
                                <label class="uploadFile">
                                    <i class="fas fa-paperclip fa-md mr-2"></i>
                                    <span class="filename">Attachment</span>
                                    <input type="file" class="inputfile form-control" name="add_image_occasion"
                                        id="add_image_occasion" accept="image/*">
                                </label>
                                <p class="text-danger font-weight-bolder" style="display: none;" id="noteimg"></p>

                            </div>

                            <div class="form-group">
                                <label for="add_button_occasion">Button Name</label>
                                <input type="text" name="add_button_occasion" id="add_button_occasion" required
                                    placeholder="Enter " class="form-control">
                            </div>


                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="addoccasionbtn">Save
                                    changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>


                    </div>


                </div>
            </div>
        </div>


        <!--edit occasion image model -->

        <div class="modal fade" id="EditimageModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Occasion Image</h5>

                        <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">

                        {{-- <div class="profilebox-item">
 
                             <div class="profile-picture2">
                                 <img src="https://www.pacificfoodmachinery.com.au/media/catalog/product/placeholder/default/no-product-image-400x400.png"
                                     id="edit_banner_img" alt="Profile Picture"
                                     style="width: 255px;height: 255px;border-radius: 10px;border-color: transparent;">
 
                             </div>
 
                         </div> --}}

                        <form id="edit_occasion_image_form" method="post"
                            action="{{ url('admin/updateOccasionImage') }}" enctype="multipart/form-data">
                            <input type="hidden" id="iid" name="iid">

                            <div class="form-group">
                                <label for="edit_target_occasion">Target URL</label>
                                <input type="text" name="edit_target_occasion" id="edit_target_occasion" required
                                    placeholder="Enter URL" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="edit_image_type">Image Type</label>
                                <select name="edit_image_type" id="edit_image_type" class="form-control" required
                                    onchange="showNote(event)">
                                    <option value="">Select Image Type</option>
                                    <option value="1">Large Image</option>
                                    <option value="2">Small Image</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_image_occasion">Upload Testimonials Image</label>
                                <label class="uploadFile">
                                    <i class="fas fa-paperclip fa-md mr-2"></i>
                                    <span class="filename">Attachment</span>
                                    <input type="file" class="inputfile form-control" name="edit_image_occasion"
                                        id="edit_image_occasion" accept="image/*">
                                </label>
                                <p class="text-danger font-weight-bolder" style="display: none;" id="note_img"></p>

                            </div>

                            <div class="form-group">
                                <label for="edit_button_occasion">Button Name</label>
                                <input type="text" name="edit_button_occasion" id="edit_button_occasion" required
                                    placeholder="Enter " class="form-control">
                            </div>




                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary" id="editoccasionbtn">Save
                                    changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>



        @include('common.common')
    </div>
    <!-- main-panel ends -->

    <script>
        tinymce.init({
            selector: 'textarea#edit_testimonial_description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });

        tinymce.init({
            selector: 'textarea#testimonial_description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });


        function showNote(event) {
            let selectedValue = event.target.value;
            let noteElement = document.getElementById('note_img');

            if (selectedValue === '1') {
                noteElement.style.display = 'block';
                noteElement.textContent = 'Note: Image size (546*358.25)';
            } else if (selectedValue === '2') {
                noteElement.style.display = 'block';
                noteElement.textContent = 'Note: Image size (546*232.94)';
            } else {
                noteElement.style.display = 'none';
            }
        }

        function show_note(event) {
            let selectedValue = event.target.value;
            let noteElement = document.getElementById('noteimg');

            if (selectedValue === '1') {
                noteElement.style.display = 'block';
                noteElement.textContent = 'Note: Image size (546*358.25)';
            } else if (selectedValue === '2') {
                noteElement.style.display = 'block';
                noteElement.textContent = 'Note: Image size (546*232.94)';
            } else {
                noteElement.style.display = 'none';
            }
        }



        function readURL(event) {

            let input = event.target;
            console.log(input);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#edit_banner_img").attr("src", e.target.result);

                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function read_url(event) {

            let input = event.target;
            console.log(input);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#add_banner_img").attr("src", e.target.result);

                }

                reader.readAsDataURL(input.files[0]);
            }
        }



        function openTab(tabId) {
            const tabs = document.querySelectorAll('.tab');
            for (const tab of tabs) {
                tab.style.display = 'none';
            }

            const tabToOpen = document.getElementById(tabId);
            if (tabToOpen) {
                tabToOpen.style.display = 'block';

            }
        }

        function countProduct(event) {
            const selectedOptions = event.target.selectedOptions;
            console.log(selectedOptions.length);
            var length = selectedOptions.length;

            if (length < 4) {
                document.getElementById('second-btn').disabled = true;
            } else {
                document.getElementById('second-btn').disabled = false;
            }
        }





        $(() => {

            getAllBannersDatatable();

        });


        //banner datatable

        function getAllBannersDatatable() {

            $('#bannerTable').DataTable().destroy();
            const url = "{{ url('admin/getAllBanners') }}";
            const tableId = "bannerTable";


            fetch(url, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    const columns = [{
                            data: null,
                            render: function(data, type, row) {
                                if (type === 'display') {

                                    if (row.status == 1) {
                                        return `
    <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editBanner(${row.id})"></i>
    <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeBanner(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteBanner(${row.id})"></i>
    
`;
                                    } else {
                                        return `
    <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editBanner(${row.id})"></i>
    <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeBanner(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteBanner(${row.id})"></i>
    
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
                            data: 'target'
                        },
                        {
                            data: 'image',
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    const imageUrl = `{{ asset('banners/${data}') }}`;
                                    return `<img src="${imageUrl}"  style="border-radius:5px; width:100px;height:auto;" />`;
                                }
                                return data;
                            }
                        },


                        {
                            data: 'status',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 1) {
                                        return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                    } else if (data == 2) {
                                        return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'Unknown Status';
                                    }
                                }
                                return data;
                            }
                        },

                        {
                            data: 'created_at',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {

                                    if (data === null || data === '1970-01-01') {
                                        return 'NA';
                                    }

                                    // Assuming 'created_at' is in the default ISO 8601 format
                                    var date = new Date(data);
                                    var year = date.getFullYear();
                                    var month = (date.getMonth() + 1).toString().padStart(2,
                                        '0'); // Add 1 to month because it's zero-based
                                    var day = date.getDate().toString().padStart(2, '0');
                                    return year + '-' + month + '-' + day;
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


        //add banner form sub

        document.addEventListener("DOMContentLoaded", function() {
            var banner_form = document.getElementById('banner_form');

            banner_form.onsubmit = function(event) {

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
                                    $("#banner_form").trigger('reset');
                                    $("#AddBannerModal").modal('hide');
                                    $('#bannerTable').DataTable().destroy();
                                    getAllBannersDatatable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


        //edit banner form sub
        document.addEventListener("DOMContentLoaded", function() {
            var edit_banner_form = document.getElementById('edit_banner_form');

            edit_banner_form.onsubmit = function(event) {

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
                                    $("#edit_banner_form").trigger('reset');
                                    $("#EditBannerModal").modal('hide');
                                    $('#bannerTable').DataTable().destroy();
                                    getAllBannersDatatable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


        //delete banner

        function deleteBanner(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record",
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

                    fetch("{{ url('/admin/bannerDelete') }}", {
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


                            toastr.success('Banner deleted successfully', 'Success', {
                                onHidden: function() {

                                    $('#bannerTable').DataTable().destroy();
                                    getAllBannersDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }


        //change banner

        function changeBanner(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change the status",
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

                    fetch("{{ url('/admin/bannerChange') }}", {
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


                            toastr.success('Banner status changed successfully', 'Success', {
                                onHidden: function() {
                                    $('#bannerTable').DataTable().destroy();
                                    getAllBannersDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }



        // product slider DataTable

        function getAllSlidersDatatable() {

            $('#sliderTable').DataTable().destroy();
            const url = "{{ url('admin/getAllSliders') }}";
            const tableId = "sliderTable";



            fetch(url, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    const columns = [{
                            data: null,
                            render: function(data, type, row) {
                                if (type === 'display') {

                                    if (row.status == 1) {
                                        return `
    <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editSlider(${row.id})"></i>
    <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeSlider(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteSlider(${row.id})"></i>
`;
                                    } else {
                                        return `
    <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editSlider(${row.id})"></i>
    <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeSlider(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteSlider(${row.id})"></i>
    
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
                            data: 'type',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 1) {
                                        return 'Featured Collection';
                                    } else if (data == 2) {
                                        return 'Best Selling';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'Unknown Status';
                                    }
                                }
                                return data;
                            }
                        },
                        {
                            data: 'product_images',
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    console.log('data:', data);
                                    const productImages = data.map(image =>
                                        `<img src="{{ asset('products/${image}') }}" alt="Product Image" style="border-radius:5px; width:60px; height:auto;" />`
                                    );
                                    console.log('productImages:', productImages);
                                    return productImages.join(', ');
                                }
                                return data;
                            }
                        },

                        {
                            data: 'status',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 1) {
                                        return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                    } else if (data == 2) {
                                        return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'Unknown Status';
                                    }
                                }
                                return data;
                            }
                        },

                        {
                            data: 'created_at',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {

                                    if (data === null || data === '1970-01-01') {
                                        return 'NA';
                                    }

                                    // Assuming 'created_at' is in the default ISO 8601 format
                                    var date = new Date(data);
                                    var year = date.getFullYear();
                                    var month = (date.getMonth() + 1).toString().padStart(2,
                                        '0'); // Add 1 to month because it's zero-based
                                    var day = date.getDate().toString().padStart(2, '0');
                                    return year + '-' + month + '-' + day;
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


        // add product slider form
        document.addEventListener("DOMContentLoaded", function() {
            var slider_form = document.getElementById('slider_form');

            slider_form.onsubmit = function(event) {

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
                                    // window.location.reload();
                                    $("#slider_form").trigger('reset');
                                    $("#AddSliderModal").modal('hide');
                                    $('#sliderTable').DataTable().destroy();
                                    getAllSlidersDatatable();

                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });

        // edit product slider
        document.addEventListener("DOMContentLoaded", function() {
            var slider_form = document.getElementById('slider_form2');

            slider_form.onsubmit = function(event) {

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
                                    $("#slider_form2").trigger('reset');
                                    $("#EditSliderModal").modal('hide');
                                    $('#sliderTable').DataTable().destroy();
                                    getAllSlidersDatatable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


        //status toggle for product slider

        function changeSlider(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change the status",
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

                    fetch("{{ url('/admin/sliderChange') }}", {
                            method: 'POST',
                            body: JSON.stringify(form_datas),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then((response) => response.json())
                        .then(data => {

                            if (data.errors) {

                                toastr.error(data.errors);

                            }

                            if (data.code == 200) {
                                toastr.success('Slider status changed successfully', 'Success', {
                                    onHidden: function() {
                                        $('#sliderTable').DataTable().destroy();
                                        getAllSlidersDatatable();
                                    }
                                });
                            }



                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }


        //delete product slider

        function deleteSlider(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record",
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

                    fetch("{{ url('/admin/sliderDelete') }}", {
                            method: 'POST',
                            body: JSON.stringify(form_datas),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then((response) => response.json())
                        .then(data => {

                            if (data.errors) {

                                toastr.error(data.errors);

                            }

                            if (data.code == 200) {
                                toastr.success('Slider deleted successfully', 'Success', {
                                    onHidden: function() {
                                        $('#sliderTable').DataTable().destroy();
                                        getAllSlidersDatatable();

                                    }
                                });
                            }



                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }


        //Testimonial datatable

        function getAllTestimonialSlider() {

            $('#sliderTestimonialTable').DataTable().destroy();

            const url = "{{ url('admin/getAllTestimonials') }}";
            const tableId = "sliderTestimonialTable";
            fetch(url, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    const columns = [{
                            data: null,
                            render: function(data, type, row) {
                                if (type === 'display') {

                                    if (row.status == 1) {
                                        return `
    <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editTestimonialSlider(${row.id})"></i>
    <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeTestimonialSlider(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteTestimonialSlider(${row.id})"></i>
    
`;
                                    } else {
                                        return `
    <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editTestimonialSlider(${row.id})"></i>
    <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeTestimonialSlider(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteTestimonialSlider(${row.id})"></i>
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
                            data: 'name'
                        },
                        {
                            data: 'designation'
                        },

                        {
                            data: 'image',
                            render: function(data, type, row) {
                                if (type === 'display' && data) {
                                    const testimonial_image =
                                        `<img src="${baseUrl}/${data}" alt="Testimonial Image" style="border-radius: 5px; width: 60px; height: auto;" />`;
                                    return testimonial_image;
                                }
                                return data;
                            }
                        },

                        {
                            data: 'description'
                        },

                        {
                            data: 'status',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 1) {
                                        return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                    } else if (data == 2) {
                                        return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'Unknown Status';
                                    }
                                }
                                return data;
                            }
                        },

                        {
                            data: 'created_at',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {

                                    if (data === null || data === '1970-01-01') {
                                        return 'NA';
                                    }

                                    // Assuming 'created_at' is in the default ISO 8601 format
                                    var date = new Date(data);
                                    var year = date.getFullYear();
                                    var month = (date.getMonth() + 1).toString().padStart(2,
                                        '0'); // Add 1 to month because it's zero-based
                                    var day = date.getDate().toString().padStart(2, '0');
                                    return year + '-' + month + '-' + day;
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


        // add slider for testimonials

        document.addEventListener("DOMContentLoaded", function() {
            var slider_form = document.getElementById('testimonial_slider_form');

            slider_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;

                let formData = new FormData(formElement);

                let testimonial_name = document.getElementById('testimonial_name').value;
                let testimonial_designation = document.getElementById('testimonial_designation').value;
                let testimonial_description = tinymce.get('testimonial_description').getContent();
                let testimonial_image = document.getElementById('testimonial_image').files[0];


                formData.set('testimonial_name', testimonial_name);
                formData.set('testimonial_designation', testimonial_designation);
                formData.set('testimonial_description', testimonial_description);
                formData.append('testimonial_image', testimonial_image);

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
                                    $("#testimonial_slider_form").trigger('reset');
                                    $("#AddTestimonialSliderModal").modal('hide');
                                    $('#sliderTestimonialTable').DataTable().destroy();
                                    getAllTestimonialSlider();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


        // edit testimonial slider 
        document.addEventListener("DOMContentLoaded", function() {
            var slider_form = document.getElementById('edit_testimonial_slider_form');

            slider_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;

                let formData = new FormData(formElement);

                let edit_testimonial_name = document.getElementById('edit_testimonial_name').value;
                let edit_testimonial_designation = document.getElementById('edit_testimonial_designation')
                    .value;
                let edit_testimonial_description = tinymce.get('edit_testimonial_description').getContent();
                let edit_testimonial_image = document.getElementById('edit_testimonial_image').files[0];


                formData.set('edit_testimonial_name', edit_testimonial_name);
                formData.set('edit_testimonial_designation', edit_testimonial_designation);
                formData.set('edit_testimonial_description', edit_testimonial_description);
                formData.append('edit_testimonial_image', edit_testimonial_image);

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
                                    $("#edit_testimonial_slider_form").trigger('reset');
                                    $("#EditTestimonialSliderModal").modal('hide');
                                    $('#sliderTestimonialTable').DataTable().destroy();
                                    getAllTestimonialSlider();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


        //change testimonial slider

        function changeTestimonialSlider(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change the status",
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

                    fetch("{{ url('/admin/TestimonialChange') }}", {
                            method: 'POST',
                            body: JSON.stringify(form_datas),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then((response) => response.json())
                        .then(data => {

                            if (data.errors) {

                                toastr.error(data.errors);

                            }

                            if (data.code == 200) {
                                toastr.success('Tastimonial status changed successfully', 'Success', {
                                    onHidden: function() {

                                        $('#sliderTestimonialTable').DataTable().destroy();
                                        getAllTestimonialSlider();
                                    }
                                });
                            }



                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }


        //delete testimonial slider

        function deleteTestimonialSlider(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record",
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

                    fetch("{{ url('/admin/TestimonialDelete') }}", {
                            method: 'POST',
                            body: JSON.stringify(form_datas),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        })
                        .then((response) => response.json())
                        .then(data => {

                            if (data.errors) {

                                toastr.error(data.errors);

                            }

                            if (data.code == 200) {
                                toastr.success('Tastimonial deleted successfully', 'Success', {
                                    onHidden: function() {


                                        $('#sliderTestimonialTable').DataTable().destroy();
                                        getAllTestimonialSlider();
                                    }
                                });
                            }



                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }



        //occasion image datatable


        function getAllOccasionDatatable() {

            $('#imageTable').DataTable().destroy();
            const url = "{{ url('admin/getOccasionImages') }}";
            const tableId = "imageTable";



            fetch(url, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    const columns = [{
                            data: null,
                            render: function(data, type, row) {
                                if (type === 'display') {

                                    if (row.status == 1) {
                                        return `
<i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editImage(${row.id})"></i>
<i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeImage(${row.id})"></i>
<i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteImage(${row.id})"></i>
`;
                                    } else {
                                        return `
<i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editImage(${row.id})"></i>
<i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeImage(${row.id})"></i>
<i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteImage(${row.id})"></i>
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
                            data: 'target'
                        },
                        {
                            data: 'image',
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    const imageUrl = `{{ asset('occasions/${data}') }}`;
                                    return `<img src="${imageUrl}"  style="border-radius:5px; width:100px;height:auto;" />`;
                                }
                                return data;
                            }
                        },

                        {
                            data: 'type',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 1) {
                                        return '<p class="text-danger">Large</p>';
                                    } else if (data == 2) {
                                        return '<p class="text-primary">Small</p>';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'NA';
                                    }
                                }
                                return data;
                            }
                        },

                        {
                            data: 'button',
                            render: function(data) {
                                if (data !== "" && data !== null) {
                                    return data;
                                } else {
                                    return 'NA';
                                }
                            }
                        },

                        {
                            data: 'status',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 1) {
                                        return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                    } else if (data == 2) {
                                        return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'Unknown Status';
                                    }
                                }
                                return data;
                            }
                        },

                        {
                            data: 'created_at',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {

                                    if (data === null || data === '1970-01-01') {
                                        return 'NA';
                                    }

                                    // Assuming 'created_at' is in the default ISO 8601 format
                                    var date = new Date(data);
                                    var year = date.getFullYear();
                                    var month = (date.getMonth() + 1).toString().padStart(2,
                                        '0'); // Add 1 to month because it's zero-based
                                    var day = date.getDate().toString().padStart(2, '0');
                                    return year + '-' + month + '-' + day;
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

        //add occasion image form sub

        document.addEventListener("DOMContentLoaded", function() {
            var add_occasion_image_form = document.getElementById('add_occasion_image_form');

            add_occasion_image_form.onsubmit = function(event) {

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

                                    $("#add_occasion_image_form").trigger('reset');
                                    $("#AddimageModal").modal('hide');
                                    $('#imageTable').DataTable().destroy();
                                    getAllOccasionDatatable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });




        //edit occasion image form sub



        document.addEventListener("DOMContentLoaded", function() {
            var edit_occasion_image_form = document.getElementById('edit_occasion_image_form');

            edit_occasion_image_form.onsubmit = function(event) {

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
                                    $("#edit_occasion_image_form").trigger('reset');
                                    $("#EditimageModal").modal('hide');
                                    $('#imageTable').DataTable().destroy();
                                    getAllOccasionDatatable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });



        //change Occasion Image
        function changeImage(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change the status",
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

                    fetch("{{ url('/admin/imageChange') }}", {
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


                            toastr.success('Occasion Image status changed successfully', 'Success', {
                                onHidden: function() {
                                    $('#imageTable').DataTable().destroy();
                                    getAllOccasionDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }

        //Delete Occasion Image
        function deleteImage(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record",
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

                    fetch("{{ url('/admin/imageDelete') }}", {
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


                            toastr.success('Occasion Image deleted successfully', 'Success', {
                                onHidden: function() {
                                    $('#imageTable').DataTable().destroy();
                                    getAllOccasionDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }





        function toggleSliders(event) {
            const allDivs = document.querySelectorAll('.panel-inactive, .panel-active');

            for (const div of allDivs) {
                if (div !== event.currentTarget) {
                    div.classList.remove('panel-active');
                    div.classList.add('panel-inactive');
                }
            }

            if (event.currentTarget.classList.contains('panel-inactive') || event.currentTarget.classList.contains(
                    'panel-active')) {
                event.currentTarget.classList.remove('panel-inactive');
                event.currentTarget.classList.add('panel-active');
            }
        }
    </script>

@endsection
