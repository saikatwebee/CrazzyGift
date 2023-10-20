@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

  <div class="main-panel">

  	   <div class="content-wrapper">

  	   	<div class="text-left mb-5 "><h3>{{$title}}</h3></div>

          <div class="row">

          	<div class="col-md-12 grid-margin transparent">

              <div class="row">

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4" style="font-size: 18px;"><i class="fa-solid fa-bookmark"></i> Total Users</p>
                      <p class="fs-30 mb-2">{{$user['totalUser']}}</p>
                      <!-- <p>10.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4" style="font-size: 18px;"><i class="fa-solid fa-key"></i> Verified Users</p>
                      <p class="fs-30 mb-2">{{$user['verifiedUser']}}</p>
                      <!-- <p>22.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>

                <div class="col-md-6 mb-4 stretch-card transparent">
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
                            <input type="text" class="form-control" id="startDate" placeholder="Start Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="endDate" placeholder="End Date" readonly>
                        </div>
                    </div>
                </div>

                    <div class="text-right">
                    	<button id="filter_user" class="btn btn-outline-info btn-sm">Filter</button>
                    	<button id="reset_user" class="btn btn-outline-warning btn-sm">Reset</button>
                	</div>
                </div>
                
                
            	</div>

                </div>

              </div>
            
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{$heading}}</h4>
                  <p class="card-description">
                    
                  </p>

                  <div class="table-responsive">

                    <table class="table table-striped" id="usersTable2">


                      <thead>
                        <tr>
                          <th>Action</th>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>status</th>
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

  @endsection