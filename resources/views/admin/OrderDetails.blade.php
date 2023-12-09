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
        $totalAmount = str_replace('.00', '', $order->amount);

    @endphp

    @if ($order->track_shipping)
        @php

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
        @endphp
    @endif


    <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">
            <div class="row">


                <div class="col-lg-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-left mb-3">
                                <h3>Order Details</h3>
                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class=" table-responsive ">

                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th>Order ID</th>
                                                <td>{{ $order_id }}</td>
                                            </tr>

                                            <tr>
                                                <th>Customer Name</th>
                                                <td>{{ $customer->name }}</td>
                                            </tr>

                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $customer->email }}</td>
                                            </tr>

                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $customer->phone }}</td>
                                            </tr>

                                            <tr>
                                                <th>Amount</th>
                                                <td>Rs. {{ $totalAmount }}</td>
                                            </tr>

                                            <tr>
                                                <th>Payment Status</th>
                                                <td>{{ $order->payment_status == 'captured' ? 'Payment Received' : 'Payment Failed' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Billing Address</th>
                                                <td>{{ $order->billing_address }}</td>
                                            </tr>

                                            <tr>
                                                <th>Shipping Address</th>
                                                <td>{{ $order->shipping_address }}</td>
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

                        @if ($order->order_status == 0)
                            <div class="ribbon-box">
                                <div class="ribbon ribbon-top-right ribbon-cancelled"><span>Order Cancelled</span></div>
                            </div>
                        @endif

                        @if ($order->track_shipping)
                            @if (
                                ($order->order_status == 1 ||
                                    $order->order_status == 2 ||
                                    $order->order_status == 3 ||
                                    $order->order_status == 4) &&
                                    $order->order_status != 5)
                                <div class="ribbon-box">
                                    <div class="ribbon ribbon-top-right ribbon-processing"><span>Order Processing</span>
                                    </div>
                                </div>
                            @endif

                            @if ($order->order_status == 5 && $reason_code_number == 999)
                                <div class="ribbon-box">
                                    <div class="ribbon ribbon-top-right ribbon-delivered"><span>Order Delivered</span></div>
                                </div>
                            @endif
                        @endif

                        <div class="card-body">
                            <div class="text-left mb-3">
                                <h3>Product Details</h3>
                            </div>



                            <div class="row">
                                @foreach (json_decode($products) as $product)
                                    <div class="col-lg-12">

                                        <div class="productContent">
                                            <img src="{{ $product->product_image ? asset('/products') . '/' . $product->product_image : asset('/products/dummyProduct.jpg') }}"
                                                class="ordersImage flex-item">

                                            <p class="flex-item">{{ $product->title }}</p>


                                        </div>

                                        <div class="text-center my-3">
                                            <button class="btn btn-sm btn-primary" data-id="{{ $product->custom_image }}"
                                                onclick="showImg(event)"><i class="fa-solid fa-cloud-arrow-up"
                                                    onclick="showImg(event)"></i> View Image</button>

                                            <button class="btn btn-sm btn-success" data-id="{{ $product->custom_text }}"
                                                onclick="showText(event)"><i class="fa-solid fa-envelope-open-text"
                                                    onclick="showText(event)"></i> View Meassage</button>
                                        </div>

                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            @if ($order->order_status != 0)
                <div class="row">
                    @if ($awb)

                        <div class="col-lg-12 grid-margin stretch-card">

                            <div class="card">
                                <div class="card-body">
                                    <div class="text-left">
                                        <h4>Track Shipment</h4>
                                    </div>

                                    @if ($order->track_shipping)


                                        <div class="text-right">
                                            <p class="mt-3" style="font-size: 13px;" id="deliveredMsg">
                                                Order Placed on {{ $orderDate }}</p>


                                            @if ($order->track_shipping->object->field[14] == 999 && $order->order_status == 5)
                                                @if ($delivery_date != '')
                                                    <p class="mt-3" style="font-size: 12px;" id="deliveredMsg">
                                                        Order Delivered on {{ $deliveryDate }}</p>
                                                @endif
                                            @else
                                                @if ($expected_date != '')
                                                    <p class="mt-3" style="font-size: 12px;" id="deliveredMsg">
                                                        <?= 'Expected Delivery on ' . $expectedDate ?> </p>
                                                @endif
                                            @endif
                                        </div>



                                    @endif


                                    <div class="row">
                                        <div class="col-lg-12">


                                            <div class="w-100 p-3">
                                                @if ($order->track_shipping)
                                                    <div class="orderTrack">
                                                        <div class="orderTrackBar"></div>
                                                        <ul class="orderTrackPoints">

                                                            <li class="tracking-item active" data-status-text="Order Placed"
                                                                data-date="{{ $order->created_at }}">Order
                                                                Placed<br><br><br><br>

                                                            </li>

                                                            <li
                                                                class="tracking-item {{ $reason_code_number == 003 || $reason_code_number == 005 || $reason_code_number == 006 || $reason_code_number == 999 ? 'active' : '' }}">
                                                                Order Shipped
                                                                <br><br><br><br>

                                                            </li>
                                                            <li
                                                                class="tracking-item {{ $reason_code_number == 005 || $reason_code_number == 006 || $reason_code_number == 999 ? 'active' : '' }}">
                                                                Reached Hub
                                                                <br><br><br><br>

                                                            <li class="tracking-item {{ $reason_code_number == 006 || $reason_code_number == 999 ? 'active' : '' }}"
                                                                data-status-text="Out for Delivery">Out for
                                                                Delivery<br><br><br><br>

                                                            </li>
                                                            <li class="tracking-item {{ ($reason_code_number == 999 && $order->order_status == 5) ? 'active' : '' }}"
                                                                data-status-text="Delivered">Order
                                                                Delivered<br><br><br><br>

                                                            </li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <div class="orderTrack">
                                                        <div class="orderTrackBar"></div>
                                                        <ul class="orderTrackPoints">

                                                            <li class="tracking-item active"
                                                                data-status-text="Order Placed static"
                                                                data-date="{{ $order->created_at }}">Order
                                                                Placed<br><br><br><br>

                                                            </li>

                                                            <li class="tracking-item "
                                                                data-status-text="Order Shipped static">
                                                                Order Shipped
                                                                <br><br><br><br>

                                                            </li>
                                                            <li class="tracking-item "
                                                                data-status-text="Reached Hub static">
                                                                Reached Hub
                                                                <br><br><br><br>

                                                            <li class="tracking-item"
                                                                data-status-text="Out for Delivery static">
                                                                Delivery<br><br><br><br>

                                                            </li>
                                                            <li class="tracking-item" data-status-text="Delivered static">
                                                                Order
                                                                Delivered<br><br><br><br>

                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif


                                            </div>

                                        </div>

                                        @if ($order->order_status != 0)

                                            @if ($order->track_shipping)

                                                @if ($reason_code_number == 001 || $reason_code_number == 1220 || $reason_code_number == 1340)
                                                    <div class="w-100" style="text-align:right;"><button
                                                            class="btn btn-outline-danger" style="border-radius:20px;"
                                                            onclick="cancelOrder({{ $order->id }})">Cancel
                                                            Order</button>
                                                    </div>
                                                @endif

                                                @if ($reason_code_number == 999 && $order->order_status == 5)
                                                    <div class="w-100" style="text-align:right;"><button
                                                            class="btn btn-outline-success" style="border-radius:20px;"
                                                            onclick="downloadInvoice({{ $order->id }})">Download
                                                            Invoice</button></div>
                                                @endif
                                            @else
                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function() {
                                                        toastr.warning("Kindly Reattempt the Shipment for OrderId {{ $order->order_id }}")
                                                    });
                                                </script>
                                                <div class="w-100" style="text-align:right;"><button
                                                        class="btn btn-outline-success" style="border-radius:20px;"
                                                        onclick="reattemptShipment({{ $order->id }})">Reattempt
                                                        Shipment</button></div>
                                            @endif

                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif


            @include('common.common')


        </div>
        <!-- main-panel ends -->


        <!--Edit modal for  datatable -->

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
                        {{-- <button type="button" class="btn btn-primary" id="editProductBtn">Save changes</button> --}}
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>



        <script type="text/javascript">
            function showImg(event) {
                let custom_image = event.target.getAttribute('data-id');
                let url = "{{ asset('/cart') }}/" + custom_image;
                window.open(url, '_blank');
            }

            function showText(event) {
                let custom_msg = event.target.getAttribute('data-id');
                $("#textMsg").val(custom_msg);
                $("#showTextModal").modal('show');
            }

            function downloadInvoice(order_id) {

                const url = "{{ url('/generateInvoice') }}/" + order_id;
                window.open(url, '_blank');
            }



            function cancelOrder(order_id) {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to cancel the order",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#004a8c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //put all code if yes

                        const url = "{{ url('/cancellShipment') }}";

                        const csrfToken = getCsrfToken();

                        const form_datas = {
                            id: order_id,

                        };

                        fetch(url, {
                                method: 'POST',
                                body: JSON.stringify(form_datas),
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log(data);

                                if (data.code == 200) {
                                    toastr.success(data.msg, 'Success', {
                                        onHidden: function() {
                                            location.reload();
                                        }
                                    })
                                } else {
                                    toastr.error("Something went wrong!", 'oops', {
                                        onHidden: function() {
                                            location.reload();
                                        }
                                    })
                                }
                            })
                            .catch(error => console.error(error));
                    }
                })

            }


           
        </script>

    @endsection
