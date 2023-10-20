@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')


<div class="main-panel">

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

                    <table class="table table-striped" id="usersTable1">


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


@endsection