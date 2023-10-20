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

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-sliders"></i> Upload Banner</h4>

                            <div class="card-wrapper">
                                <form id="banner_form" method="post" action="{{ url('admin/addBanner') }}"
                                    enctype="multipart/form-data">


                                    <div class="form-group">
                                        <label>Upload Banner</label>
                                        <label class="uploadFile">
                                            <i class="fas fa-paperclip fa-md mr-2"></i>
                                            <span class="filename">Attachment</span>
                                            <input type="file" class="inputfile form-control" name="image"
                                                accept="image/*">
                                        </label>
                                        <p class="text-danger font-weight-bolder">Note : Image size (1116*405) </p>

                                    </div>
                                    <div class="form-group">
                                        <label for="rget_url">Target URL</label>
                                        <input type="text" class="form-control" name="target" id="target_url" required>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-sm btn-primary" id="first-btn">Submit</button>
                                    </div>

                                </form>
                            </div>


                            <div class="card-wrapper">
                                <h4 class="card-title"><i class="fa-solid fa-sliders"></i> Show Banner</h4>



                            </div>



                        </div>
                    </div>

                </div>





                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-sliders"></i> Add Slider</h4>

                            <div class="card-wrapper">
                                <form id="slider_form" method="post" action="{{ url('admin/addSlider') }}">
                                    <div class="form-group">
                                        <label for="slide_type">Select Type</label>
                                        <select name="type" class="form-control">
                                            <option value="1">Featured Collection</option>
                                            <option value="2">Best Selling</option>


                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top:33px;">
                                        <label for="slide_products">Latest Products</label>

                                        <select class="selectpicker" multiple aria-label="Default select example"
                                            data-live-search="true" name="products[]" onchange="countProduct(event)">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                                            @endforeach

                                        </select>
                                        <p class="text-danger font-weight-bolder">Note : Minimum 4 Product needs to add.
                                        </p>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-sm btn-primary" id="second-btn">Submit</button>
                                    </div>
                                </form>
                            </div>



                        </div>
                    </div>
                </div>


            </div>


        </div>




        @include('common.common')
    </div>
    <!-- main-panel ends -->

    <script>
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
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {

                        console.log(data);

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
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {

                        console.log(data);

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
