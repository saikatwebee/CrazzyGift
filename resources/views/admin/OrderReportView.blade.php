@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

      <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">

        	<div class="text-left mb-5 "><h3>{{$title}}</h3></div>

          <div class="row">

			<div class="col-md-12 grid-margin transparent">

              <div class="row">

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4" style="font-size: 18px;"><i class="fa-solid fa-bookmark"></i> Total Orders</p>
                      <p class="fs-30 mb-2">{{$order['totalOrder']}}</p>
                      <!-- <p>10.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4" style="font-size: 18px;"><i class="fa-solid fa-dollar-sign"></i> Completed Orders</p>
                      <p class="fs-30 mb-2">{{$order['completedOrder']}}</p>
                      <!-- <p>22.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4" style="font-size: 18px;"><i class="fa-regular fa-paper-plane"></i> Pending Orders</p>
                      <p class="fs-30 mb-2">{{$order['pendingOrder']}}</p>
                      <!-- <p>22.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>


                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4" style="font-size: 18px;"><i class="fa-solid fa-right-left"></i> Cancelled Orders</p>
                      <p class="fs-30 mb-2">{{$order['cancelledOrder']}}</p>
                      <!-- <p>22.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>

              </div>
            
            </div>
           
           <div class="col-lg-12 grid-margin stretch-card">
           			<div class="card">
            		 <div class=" card-body">
            		 	 <h4 class="card-title">Search With Date Range</h4>
            		 	<div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                        </div>
                    </div>
                </div>

                    <div class="text-right">
                    	<button id="filter" class="btn btn-outline-info btn-sm">Filter</button>
                    	<button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
                	</div>
                </div>
                
                
            	</div>
           </div>
            
            <div class="col-lg-12 grid-margin stretch-card">


              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{$heading}}</h4>



                  <div class="table-responsive">

                    <table class="table table-striped" id="allOrdersTable2">


                      <thead>
                        <tr>
                        	<th>Action</th>
                          <th>ID</th>
                          <th>User Name</th>
                          <th>Phone</th>
                          <th>Amount</th>
                          <th>order Status</th>
                          {{-- <th>transaction ID</th> --}}
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

  @endsection




    






  
