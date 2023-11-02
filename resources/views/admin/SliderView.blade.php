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
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card banner-hearder-card">
                        <div class="card-body  d-flex justify-content-center align-items-center panel-active" onclick="toggleSlider(event),openTab('uploadBannerTab')">
                             Banners
                        </div>

                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card slider-hearder-card">
                        <div class="card-body  d-flex justify-content-center align-items-center panel-inactive" onclick="toggleSlider(event),openTab('uploadSliderTab')">
                            Sliders
                        </div>

                    </div>
                </div>


                <div class="col-lg-12 grid-margin stretch-card tab" id="uploadBannerTab" style="display: block;">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-sliders"></i> All Banner</h4>

                            <div class="card-wrapper">

                                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#AddBannerModal">Add New Banner</button>
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
                            <h4 class="card-title"><i class="fa-solid fa-sliders"></i> Add Slider</h4>

                            <div class="card-wrapper">
                                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#AddSliderModal">Add New Slider</button>
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
 <form id="banner_form" method="post" action="{{ url('admin/addBanner') }}"
                                    enctype="multipart/form-data">


                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <label class="uploadFile">
                                            <i class="fas fa-paperclip fa-md mr-2"></i>
                                            <span class="filename">Attachment</span>
                                            <input type="file" class="inputfile form-control" name="image"
                                                accept="image/*" required>
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

        <div class="modal fade" id="EditBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
    
                 <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">

                    <div class="profilebox-item">

                        <div class="profile-picture2">
                            <img src="https://www.pacificfoodmachinery.com.au/media/catalog/product/placeholder/default/no-product-image-400x400.png" id="edit_banner_img" alt="Profile Picture"  style="width: 255px;height: 255px;border-radius: 10px;border-color: transparent;">
                            
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
                                                <input type="file" class="inputfile form-control" name="image"
                                                    accept="image/*" onchange="readURL(event)">
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

      <div class="modal fade" id="AddSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5>

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
                    <div class="form-group" style="margin-top:33px;">
                        <label for="slide_products">Latest Products</label>

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


      <div class="modal fade" id="EditSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            data-live-search="true" name="products[]" id="edit_products" onchange="countProduct(event)" required>
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




        @include('common.common')
    </div>
    <!-- main-panel ends -->

    <script>

function readURL(event) {

    let input = event.target;
    console.log(input);
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#edit_banner_img").attr("src", e.target.result);
           
        }

        reader.readAsDataURL(input.files[0]);
    }
}

           function toggleSlider(event) {
            const allDivs = document.querySelectorAll('.panel-inactive, .panel-active');
            
            for (const div of allDivs) {
                div.classList.remove('panel-active');
                div.classList.add('panel-inactive');
            }
            
            event.target.classList.remove('panel-inactive');
            event.target.classList.add('panel-active');
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
                                    window.location.reload();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });



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
                                    window.location.reload();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


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
                                    window.location.reload();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });

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
                                    window.location.reload();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });
    </script>

@endsection
