@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

    <div class="main-panel">

        <div class="content-wrapper">
            <div class="text-left mb-5 "><h3>{{$title}}</h3></div>
            <div class="row">


                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{$heading}}</h4>
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
                                            <label class="col-sm-3 col-form-label">Product Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="code" id="add_code"
                                                    required placeholder="Enter Product Code" />

                                                @error('code')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Category</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="main_category" id="add_main_category"
                                                    required>
                                                    <option>Select</option>
                                                    <option value="1">Anniversary</option>
                                                    <option value="2">Birthday</option>
                                                    <option value="3">Valentines Day</option>

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
                                                    required>
                                                    <option>Select</option>
                                                    <option value="1">3D Crystals</option>
                                                    <option value="2">Wooden Engraved</option>
                                                    <option value="3">Photo Frames</option>

                                                </select>
                                                @error('sub_category')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">


                                    <div class="col-lg-6">
                                        {{-- <div class="form-group row">

                                            <div class="col-sm-3 col-form-label"><label>Image</label></div>

                                            <div class="col-sm-9">
                                                <input class="form-control" type="file" id="add_product_image"
                                                    name="product_image" accept="image/*">
                                                @error('product_image')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>

                                        </div> --}}


                                        <div class="form-group row">
                                            <div class="col-sm-3 col-form-label"><label>Image</label></div>
                                            <div class="col-sm-9">
                                                <label class="uploadFile">
                                                    <i class="fas fa-paperclip fa-md mr-2"></i>
                                                    <span class="filename">Attachment</span>
                                                    <input type="file" class="inputfile form-control" name="product_image" id="add_product_image" accept="image/*">
                                                </label>
                                                <p class="text-danger font-weight-bolder">Note : Image size (261*265.2) </p>
                                            </div>
                                            
    
                                        </div>



                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">weight</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="weight" id="add_weight"
                                                    required placeholder="Enter Weight" />
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
                                                    required placeholder="Eneter Height" />
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
                                                    required placeholder="Enter Length" />
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
                                                    id="add_breadth" required placeholder="Enter Breadth" />
                                                @error('breadth')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">price</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="price" id="add_price"
                                                    required placeholder="Enter Price" />
                                                @error('price')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror


                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="status" id="add_status" required>
                                                    <option>Select</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Deactive</option>
                                                    <option value="2">Best Selling</option>
                                                </select>

                                                @error('add_status')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="description" id="add_description" required placeholder="Enter Description"></textarea>
                                                @error('description')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>





                                </div>

                                <div class="text-right mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>





                            </form>
                        </div>
                    </div>
                </div>



            </div>

        </div>


        @include('common.common')

    </div>

@endsection
