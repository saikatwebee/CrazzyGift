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

                    <table class="table table-striped" id="completedOrdersTable">


                      <thead>
                        <tr>
                          <th>Action</th>
                          <th>ID</th>
                          <th>User Name</th>
                          <th>Amount</th>
                          <th>order_status</th>
                          <th>transaction_id</th>
                          <th>Placed On</th>
                          
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

{{-- <div class="modal fade" id="editproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
       <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div> --}}


  @endsection




    






  
