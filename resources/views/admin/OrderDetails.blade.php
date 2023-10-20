@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

@php
  


  	$products = $order->product_details;
                        
   
     $amount = $order->amount;
     $order_id = $order->order_id;
      $order_status = $order->order_status;
   		$awb = $order->awb;
        
            $dateObj = new DateTime($order->created_at);
              $formattedDate = $dateObj->format('jS M Y');
                 $orderDate = $formattedDate;
                    $totalAmount = str_replace(".00", "", $order->amount);




  	@endphp


 <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">
          <div class="row">
           
            
            <div class="col-lg-7 grid-margin stretch-card">
              	<div class="card">
              		<div class="card-body">
              			<div class="text-left mb-3"><h3>Order Details</h3></div>
              			<div class="row">
              				
              				<div class="col-lg-12">
              					<div class=" table-responsive ">

              						<table class="table table-striped table-bordered table-hover">
              									<tr>
              								<th>Order ID</th>
              								<td>{{$order_id}}</td>
              							</tr>

              							<tr>
              								<th>Customer Name</th>
              								<td>{{$customer->name}}</td>
              							</tr>

              							<tr>
              								<th>Email</th>
              								<td>{{$customer->email}}</td>
              							</tr>

              							<tr>
              								<th>Phone</th>
              								<td>{{$customer->phone}}</td>
              							</tr>

              							<tr>
              								<th>Amount</th>
              								<td>Rs. {{$totalAmount}}</td>
              							</tr>

              							<tr>
              								<th>Payment Status</th>
              								<td>{{($order->payment_status=="captured") ? "Payment Received" : "Payment Failed"}}</td>
              							</tr>

              							<tr>
              								<th>Billing Address</th>
              								<td>{{$order->billing_address}}</td>
              							</tr>

              							<tr>
              								<th>Shipping Address</th>
              								<td>{{$order->shipping_address}}</td>
              							</tr>
              						</table>


              					</div>
              					
              						
              							

              				</div>
              			</div>
              		</div>
            	</div> 
			</div>

             <div class="col-lg-5 grid-margin stretch-card">
                 <div class="card">
                     <div class="card-body">
                        <div class="text-left mb-3"><h3>Product Details</h3></div>
                        <div class="row">
                         @foreach(json_decode($products) as $product)
                            <div class="col-lg-12">
                                
                                <div class="productContent">
                                    <img src="{{($product->product_image) ? asset('/products').'/'.$product->product_image : asset('/products/dummyProduct.jpg') }}" class="ordersImage flex-item">
                                    
                                        <p class="flex-item">{{$product->title}}</p>
                                        
                                    
                                </div>

                                <div class="text-center my-3">
                                         <button class="btn btn-sm btn-primary" data-id="{{$product->custom_image}}" onclick="showImg(event)"><i class="fa-solid fa-cloud-arrow-up" onclick="showImg(event)"></i> View Image</button>

                                          <button class="btn btn-sm btn-success" data-id="{{$product->custom_text}}" onclick="showText(event)"><i class="fa-solid fa-envelope-open-text" onclick="showText(event)"></i> View Meassage</button>
                                    </div>

                            </div>
                            <hr>
                         @endforeach
                     </div>
                     </div>
                 </div>
             </div>
				

        </div>

        <div class="row">
        	@if($awb)

			 <div class="col-lg-12 grid-margin stretch-card">
              	<div class="card">
              		<div class="card-body">
              			<div class="text-left"><h4>Track Shipment</h4></div>
                        <div class="row">
                             <div class="col-lg-12">

                                            <div class="w-100 p-3">
                                                @if ($order->track_shipping)
                                                    @php
                                                        
                                                        $scan_stages = $order->track_shipping->object->field[36]->object;
                                                        
                                                        $orderId_tracking = $order->track_shipping->object->field[1]; //orderid
                                                        
                                                        $status = $order->track_shipping->object->field[10]; //status
                                                        
                                                        $reason_code_number = $order->track_shipping->object->field[14]; //reason_code_number

                                                        $last_update_datetime = $order->track_shipping->object->field[20]; // last_update_datetime  

                                                        $delivery_date = $order->track_shipping->object->field[21]; //delivery_date

                                                        $expected_date = $order->track_shipping->object->field[18]; //expected_date


                                                       

                                                    @endphp

                                                    <div class="orderTrack">
                                                        <div class="orderTrackBar"></div>
                                                        <ul class="orderTrackPoints">

                                                            <li class="tracking-item active" data-status-text="Order Placed"
                                                                data-date="{{$order->created_at}}">Order
                                                                Placed<br><br><br><br>
                                                            <!-- <small>{{$order->created_at}}</small> -->
                                                            </li>

                                                            <li class="tracking-item {{($reason_code_number == 1260 || $reason_code_number == 11 || $reason_code_number == 400 || $reason_code_number == 127 || $reason_code_number == 5 || $reason_code_number == 6 || $reason_code_number == 999) ? 'active' : ''}}" data-status-text="Order Shipped"
                                                                data-date="May 6, 2023">Order Shipped
                                                                <br><br><br><br>
                                                                {{-- <small>{{($reason_code_number == 1260 || $reason_code_number == 11 || $reason_code_number == 400) ? $last_update_datetime : ''}}</small> --}}
                                                            </li>
                                                            <li class="tracking-item {{($reason_code_number == 127 || $reason_code_number == 5 || $reason_code_number == 6 || $reason_code_number == 999) ? 'active' : ''}}" data-status-text="Reached Hub"
                                                                data-date="May 8, 2023">Reached Hub
                                                                <br><br><br><br>
                                                                {{-- <small>{{($reason_code_number == 127 || $reason_code_number == 5 ) ? $last_update_datetime : ''}}</small></li> --}}
                                                            <li class="tracking-item {{($reason_code_number == 6 || $reason_code_number == 999) ? 'active' : ''}}" data-status-text="Out for Delivery"
                                                                data-date="May 10, 2023">Out for
                                                                Delivery<br><br><br><br>
                                                                {{-- <small>May 10, 2023</small> --}}
                                                            </li>
                                                            <li class="tracking-item {{($reason_code_number == 999 ) ? 'active' : ''}}" data-status-text="Delivered"
                                                                data-date="May 12, 2023">Order
                                                                Delivered<br><br><br><br>
                                                                <small>{{($reason_code_number == 999) ? $last_update_datetime : ''}}</small>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif


                                            </div>

                                        </div> 
                        </div>
              		</div>
            	</div> 
			</div>
			@endif
        </div>

      
        @include('common.common')
      

      </div>
      <!-- main-panel ends -->


            <!--Edit modal for products datatable -->

<div class="modal fade" id="showTextModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Show Message</h5>
       <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
      </div>
      <div class="modal-body">

        <div class="form-group">
            <textarea class="form-control" disabled id="textMsg"></textarea>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editProductBtn">Save changes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>



      <script type="text/javascript">

          function showImg(event){
                let custom_image = event.target.getAttribute('data-id');
                let url = "{{asset('/cart')}}/"+custom_image;
               window.open(url,'_blank');
          }

          function showText(event){
            let custom_msg = event.target.getAttribute('data-id');
                $("#textMsg").val(custom_msg);
                $("#showTextModal").modal('show');
          }


      </script>

@endsection