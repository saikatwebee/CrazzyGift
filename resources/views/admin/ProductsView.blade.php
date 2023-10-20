@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

      <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">


          <div class="text-left mb-5 "><h3>{{$title}}</h3></div>

          <div class="row">
           
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{$heading}}</h4>
                  <p class="card-description">
                    
                  </p>

                  <div class="table-responsive">

                    <table class="table table-striped" id="productTable">


                      <thead>
                        <tr>
                           <th>Action</th>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Code</th>
                          <th>Category</th>
                          <th>Subcategory</th>
                          <th>Description</th>
                          <th>Price</th>
                         
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

<div class="modal fade" id="editproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
       <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
      </div>
      <div class="modal-body">

        <form id="editProductForm" method="post" action="{{url('/admin/editProduct')}}" enctype="multipart/form-data">
            <input type="hidden" name="id" id="eid" >
              <div class="form-group">
                  <label for="edit_title">Title</label>
                  <input type="text" name="title" id="edit_title" required placeholder="Enter Title" class="form-control">
              </div>
              <div class="form-group">
                <label for="edit_code"></label>
                 <input type="text" name="code" id="edit_code" required placeholder="Enter Code" class="form-control">
              </div>
              <div class="form-group">
                <label for="edit_category">Category</label>
                <select name="main_category" id="edit_category" required class="form-control">
                  <option value="">Select</option>
                  <option value="1">Anniversary</option>
                  <option value="2">Birthday</option>
                  <option value="3">Valentines Day</option>
                </select>
              </div>
              <div class="form-group">
                <label for="edit_subcategory">Subcategory</label>
                <select name="sub_category" id="edit_subcategory" required class="form-control">
                  <option>Select</option>
                  <option value="1">3D Crystals</option>
                  <option value="2">Wooden Engraved</option>
                  <option value="3">Photo Frames</option>
                </select>
              </div>
              <div class="form-group">
                <label for="edit_description">Description</label>
                <textarea name="description" id="edit_description" cols="30" rows="10" required placeholder="Enter Description" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label for="edit_weight">Weight</label>
                <input type="number" name="weight" id="edit_weight" required placeholder="Enter Weight" class="form-control">
              </div>
              <div class="form-group">
                <label for="edit_height">Height</label>
                <input type="number" name="height" id="edit_height" required placeholder="Enter Height" class="form-control">
              </div>
              <div class="form-group">
                 <label for="edit_length">Length</label>
                <input type="number" name="length" id="edit_length" required placeholder="Enter Length" class="form-control">
              </div>
              <div class="form-group">
                 <label for="edit_breadth">Breadth</label>
                <input type="number" name="breadth" id="edit_breadth" required placeholder="Enter Breadth" class="form-control">
              </div>

              <div class="form-group">
                 <label for="edit_price">Price</label>
                <input type="number" name="price" id="edit_price" required placeholder="Enter Price" class="form-control">
              </div>
              <div class="form-group">
                <label for="edit_product_status">Status</label>
                <select name="status" id="edit_product_status" required class="form-control">
                  <option>Select</option>
                  <option value="0">Deactive</option>
                  <option value="1">Active</option>
                  <option value="2">Best Selling</option>
                </select>
              </div>

              <div class="form-group">
                <label for="edit_product_image">Product Image</label>
              <input class="form-control" type="file" id="edit_product_image" name="product_image" accept="image/*">
              <span id="uploadErrorSpan" class="text-danger"></span>
              </div>

        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editProductBtn">Save changes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


  @endsection




    






  
