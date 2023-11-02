@extends('layouts.master')

@section('title', $title)

@section('content')
    <!-- Your page-specific content goes here -->



    <section class="loginRegister container">
        <div class="breadcrumb">
            <div aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                </ol>
            </div>
        </div>

        @if ($orders)
            @if (count($orders) > 0)
                <div class="row my-3">

                    @foreach ($orders as $order)
                        @php
                            $products = $order->product_details;

                            $product_title = $order->title;
                            $amount = $order->amount;
                            $order_id = $order->order_id;
                            $order_status = $order->order_status;
                            $awb = $order->awb_number;

                            $dateObj = new DateTime($order->created_at);
                            $orderDate = $dateObj->format('jS M Y');

                            $totalAmount = str_replace('.00', '', $order->amount);

                            if ($order->track_shipping) {
                               

                                $scan_stages = $order->track_shipping->object->field[36]->object;

                                $orderId_tracking = $order->track_shipping->object->field[1]; //orderid

                                $status = $order->track_shipping->object->field[10]; //status

                                $reason_code_number = $order->track_shipping->object->field[14]; //reason_code_number

                                $last_update_datetime = $order->track_shipping->object->field[20]; // last_update_datetime

                                $delivery_date = $order->track_shipping->object->field[21]; //delivery_date
                                if ($delivery_date != '') {
                                    $dateObj2 = new DateTime($delivery_date);
                                    $deliveryDate = $dateObj2->format('jS M Y h:i A');
                                }

                                $expected_date = $order->track_shipping->object->field[18]; //expected_date

                                if ($expected_date != '') {
                                    $dateObj3 = new DateTime($expected_date);
                                    $expectedDate = $dateObj3->format('jS M Y');
                                }
                               
                        }
                        @endphp


                        <div class="col-lg-12 my-3">
                            <div class="shippingInfo">
                                <div class="orderSummaryCard">
                                  
                                    @if($order->order_status == 0)
                                    <div class="ribbon-box">
                                        <div class="ribbon ribbon-top-right ribbon-cancelled"><span>Order Cancelled</span></div>
                                    </div>
                                    @endif


                                    @if($order->track_shipping) 
                                    @if(($order->order_status == 1 || $order->order_status == 2 || $order->order_status == 3 || $order->order_status == 4) && $order->order_status != 5)
                                    <div class="ribbon-box">
                                        <div class="ribbon ribbon-top-right ribbon-processing"><span>Order Processing</span></div>
                                    </div>
                                    @endif



                                    @if($order->order_status == 5 && $reason_code_number == 999)
                                    <div class="ribbon-box">
                                        <div class="ribbon ribbon-top-right ribbon-delivered"><span>Order Delivered</span></div>
                                    </div>
                                    @endif
                                    @endif

                                    <div class="row">

                                        <div class="col-lg-3">
                                            <div class="order">

                                                @foreach (json_decode($products) as $product)
                                                    <div class="product">
                                                        <img src="{{ asset('/products') . '/' . $product->product_image }}" alt="cart_1">
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>

                                        <div class="col-lg-3">

                                            <div class="row ">
                                                <div class="nameAndPrice2">
                                                    <p>Order Id : {{ $order->order_id }}</p>

                                                    <h3>Total : <i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ ceil($totalAmount) }}</h3>



                                                    <p class="my-4" style="font-size: 13px;">
                                                        {{ $order->shipping_address }}</p>

                                                    <p class="mt-3" style="font-size: 13px;" id="deliveredMsg">
                                                        Order Placed on {{ $orderDate }}</p>


                                                    @if ($order->track_shipping)
                                                   
                                                        @if ($reason_code_number == 999 && $order->order_status == 5)
                                                            @if ($delivery_date != '')
                                                                <p class="mt-3" style="font-size: 12px;"
                                                                    id="deliveredMsg">
                                                                    Order Delivered on {{ $deliveryDate }}</p>
                                                            @endif
                                                        @else
                                                            @if ($expected_date != '')
                                                                <p class="mt-3" style="font-size: 12px;"
                                                                    id="deliveredMsg">
                                                                    <?= 'Expected Delivery on ' . $expectedDate ?> </p>
                                                            @endif
                                                        @endif
                                                       
                                                    @endif
                                                </div>

                                            </div>
                                        </div>


                                        @if($order->order_status != 0)
                                        <div class="col-lg-6" id="dFlex">


                                            <div class="w-100 tracking-container">
                                                @if ($order->track_shipping)
                                                   
                                                    <div class="orderTrack">
                                                        <div class="orderTrackBar"></div>
                                                        <ul class="orderTrackPoints">

                                                            <li class="tracking-item active" data-status-text="Order Placed"
                                                                data-date="{{ $order->created_at }}">Order
                                                                Placed<br><br><br><br>

                                                            </li>

                                                            <li class="tracking-item {{ $reason_code_number == 003 || $reason_code_number == 005 || $reason_code_number == 006 || $reason_code_number == 999 ? 'active' : '' }}"
                                                                data-status-text="Order Shipped" >
                                                                Order Shipped
                                                                <br><br><br><br>

                                                            </li>
                                                            <li class="tracking-item {{ $reason_code_number == 005 || $reason_code_number == 006 || $reason_code_number == 999 ? 'active' : '' }}"
                                                                data-status-text="Reached Hub" >
                                                                Reached Hub
                                                                <br><br><br><br>

                                                            <li class="tracking-item {{ $reason_code_number == 006 || $reason_code_number == 999 ? 'active' : '' }}"
                                                                data-status-text="Out for Delivery"
                                                                data-date="May 10, 2023">Out for
                                                                Delivery<br><br><br><br>

                                                            </li>
                                                            <li class="tracking-item {{ ($reason_code_number == 999 && $order->order_status == 5) ? 'active' : '' }}"
                                                                data-status-text="Delivered" >Order
                                                                Delivered<br><br><br><br>

                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @else
                                                    <div class="orderTrack">
                                                        <div class="orderTrackBar"></div>
                                                        <ul class="orderTrackPoints">

                                                            <li class="tracking-item active" data-status-text="Order Placed static"
                                                                data-date="{{ $order->created_at }}">Order
                                                                Placed<br><br><br><br>

                                                            </li>

                                                            <li class="tracking-item "
                                                                data-status-text="Order Shipped static" >
                                                                Order Shipped
                                                                <br><br><br><br>

                                                            </li>
                                                            <li class="tracking-item "
                                                                data-status-text="Reached Hub static" >
                                                                Reached Hub
                                                                <br><br><br><br>

                                                            <li class="tracking-item"
                                                                data-status-text="Out for Delivery static">
                                                               Delivery<br><br><br><br>

                                                            </li>
                                                            <li class="tracking-item"
                                                                data-status-text="Delivered static">Order
                                                                Delivered<br><br><br><br>

                                                            </li>
                                                        </ul>
                                                    </div>

                                                   
                                                @endif


                                            </div>

                                        </div> {{-- col-lg-6 end --}}
                                        @endif


                                    @if($order->order_status != 0)
                                        @if ($order->track_shipping)
                                       
                                            @if($reason_code_number == 001 || $reason_code_number == 1220 || $reason_code_number == 1340)
                                                <div class="w-100 mb-2" style="text-align:right;"><button class="btn btn-outline-danger" style="border-radius:20px;" onclick="cancelOrder({{$order->id}})">Cancel Order</button></div>
                                            @endif

                                            @if($reason_code_number == 999 && $order->order_status == 5)
                                            <div class="w-100 mb-2" style="text-align:right;"><button class="btn btn-outline-success" style="border-radius:20px;" onclick="downloadInvoice({{$order->id}})">Download Invoice</button></div>
                                            @endif

                                            @else

                                            <script>
                                               document.addEventListener("DOMContentLoaded", function() {toastr.warning("Kindly Reattempt the Shipment for OrderId {{$order->order_id}}")});
                                            </script>
                                            <div class="w-100 mb-2" style="text-align:right;"><button class="btn btn-outline-success" style="border-radius:20px;" onclick="reattemptShipment({{$order->id}})">Reattempt Shipment</button></div>
                                            
                                        @endif
                                    @endif
                                       
                                    </div> {{-- child row end --}}


                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            @else
                <div class="emptyCart  p-3 my-3" style="display: block;">
                    <p class="text-center">No Orders Yet</p>
                </div>
            @endif
        @endif

                

    </section>
@endsection
