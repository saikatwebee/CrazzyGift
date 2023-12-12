@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

    <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">

            <div class="text-left mb-5 ">
                <h3>{{ $title }}</h3>
            </div>

            <div class="row">

                <div class="col-md-12 grid-margin transparent">

                    <div class="row">

                        <div class="col-md-3 mb-4 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4" style="font-size: 18px;"><i class="fa-solid fa-bookmark"></i> Total
                                        Orders</p>
                                    <p class="fs-30 mb-2">{{ $order['totalOrder'] }}</p>
                                    <!-- <p>10.00% (30 days)</p> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4" style="font-size: 18px;"><i class="fa-solid fa-dollar-sign"></i>
                                        Completed Orders</p>
                                    <p class="fs-30 mb-2">{{ $order['completedOrder'] }}</p>
                                    <!-- <p>22.00% (30 days)</p> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4" style="font-size: 18px;"><i class="fa-regular fa-paper-plane"></i>
                                        Pending Orders</p>
                                    <p class="fs-30 mb-2">{{ $order['pendingOrder'] }}</p>
                                    <!-- <p>22.00% (30 days)</p> -->
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4" style="font-size: 18px;"><i class="fa-solid fa-right-left"></i>
                                        Cancelled Orders</p>
                                    <p class="fs-30 mb-2">{{ $order['cancelledOrder'] }}</p>
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
                                        <input type="text" class="form-control" id="start_date" placeholder="Start Date"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                                    class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="end_date" placeholder="End Date"
                                            readonly>
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
                            <h4 class="card-title">{{ $heading }}</h4>



                            <div class="table-responsive">

                                <table class="table table-striped" id="allOrdersTable2">


                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Phone</th>
                                            <th>Products</th>
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


    <script>
        $(() => {

            orderReport();
        });

        function orderReport() {
            const url = "{{ url('admin/getAllOrders') }}";


            const tableId = "allOrdersTable2";

            fetch(url, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    const columns = [

                        {
                            data: null,
                            render: function(data, type, row) {
                                if (type === 'display') {


                                    return `
            <i class="fa-regular fa-eye text-primary" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewOrder(event)"></i>
            <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteOrder(${row.id})"></i>
            
        `;




                                }
                                return data;
                            }
                        },

                        {
                            data: 'order_id'
                        },
                        {
                            data: 'user.name'
                        },
                        {
                            data: 'user.phone'
                        },
                        {
                            "data": "products",
                            "render": function(data, type, row) {
                                if (type === 'display' && data.length > 20) {
                                    return '<span data-toggle="tooltip" title="' + data + '">' + data
                                        .substr(0, 20) + '...</span>';
                                } else {
                                    return data;
                                }
                            }
                        },
                        {
                            data: 'amount'
                        },


                        {
                            data: 'order_status',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 0) {
                                        return '<button class="btn-danger btn btn-sm" style="padding: 7px 10px 7px 10px;">Cancelled Order</button>';
                                    } else if (data == 1) {
                                        return '<button class="btn-primary btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Placed</button>';
                                    } else if (data == 2) {
                                        return '<button class="btn-info btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Shipped</button>';
                                    } else if (data == 3) {
                                        return '<button class="btn-warning btn btn-sm" style="padding: 7px 10px 7px 10px;">Reached Hub</button>';
                                    } else if (data == 4) {
                                        return '<button class="btn-light btn btn-sm" style="padding: 7px 10px 7px 10px;">Out for Delivery</button>';
                                    } else if (data == 5) {
                                        return '<button class="btn-success btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Delivered</button>';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return '<button class="btn-default btn btn-sm" style="padding: 7px 10px 7px 10px;">Status Unknown</button>';
                                    }
                                }
                                return data;
                            }
                        },


                        {
                            data: 'created_at',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    // Assuming 'created_at' is in the default ISO 8601 format
                                    var datetime = new Date(data);
                                    var year = datetime.getFullYear();
                                    var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                    var day = datetime.getDate().toString().padStart(2, '0');
                                    var hours = datetime.getHours().toString().padStart(2, '0');
                                    var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                    var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                    // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                    return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' +
                                        seconds;
                                } else {
                                    return data;
                                }
                            }
                        }



                    ];


                    populateTable(data, tableId, columns);
                })
                .catch(error => console.error(error));
        }


        function deleteOrder(id) {
          
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#004a8c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const csrfToken = getCsrfToken();
                    const form_datas = {
                        id: id,
                    };

                    fetch("{{ url('/admin/orderDelete') }}", {
                            method: 'POST',
                            body: JSON.stringify(form_datas),
                            headers: {
                                'Content-Type': 'application/json',
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


                            toastr.error('Order deleted successfully', 'Oops', {
                                onHidden: function() {
                                    $('#allOrdersTable2').DataTable().destroy();
                                    orderReport();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });

        }

        //filter records for order report

        $(document).on("click", "#filter", function(e) {
            e.preventDefault();

            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();

            if (start_date == "" || end_date == "") {
                toastr.warning("Start and end date are required!");
            } else {
                $('#allOrdersTable2').DataTable().destroy();
                filter_records(start_date, end_date);
            }
        });



        function filter_records(start_date, end_date) {
            console.log(start_date);
            console.log(end_date);

            const url = "{{ url('admin/getFilterOrders') }}";

            const tableId = "allOrdersTable2";

            const csrfToken = getCsrfToken();

            const form_datas = {
                start_date: start_date,
                end_date: end_date
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

                    const columns = [

                        {
                            data: null,
                            render: function(data, type, row) {
                                if (type === 'display') {


                                    return `
            <i class="fa-regular fa-eye text-primary" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewOrder(event)"></i>
            <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteOrder(${row.id})"></i>
            
        `;




                                }
                                return data;
                            }
                        },
                        {
                            data: 'order_id'
                        },
                        {
                            data: 'user.name'
                        },
                        {
                            data: 'user.phone'
                        },
                        {
                            "data": "products",
                            "render": function(data, type, row) {
                                if (type === 'display' && data.length > 20) {
                                    return '<span data-toggle="tooltip" title="' + data + '">' + data
                                        .substr(0, 20) + '...</span>';
                                } else {
                                    return data;
                                }
                            }
                        },
                        {
                            data: 'amount'
                        },


                        {
                            data: 'order_status',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 0) {
                                        return '<button class="btn-danger btn btn-sm" style="padding: 7px 10px 7px 10px;">Cancelled Order</button>';
                                    } else if (data == 1) {
                                        return '<button class="btn-primary btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Placed</button>';
                                    } else if (data == 2) {
                                        return '<button class="btn-info btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Shipped</button>';
                                    } else if (data == 3) {
                                        return '<button class="btn-warning btn btn-sm" style="padding: 7px 10px 7px 10px;">Reached Hub</button>';
                                    } else if (data == 4) {
                                        return '<button class="btn-light btn btn-sm" style="padding: 7px 10px 7px 10px;">Out for Delivery</button>';
                                    } else if (data == 5) {
                                        return '<button class="btn-success btn btn-sm" style="padding: 7px 10px 7px 10px;">Order Delivered</button>';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return '<button class="btn-default btn btn-sm" style="padding: 7px 10px 7px 10px;">Status Unknown</button>';
                                    }
                                }
                                return data;
                            }
                        },


                        {
                            data: 'created_at',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    // Assuming 'created_at' is in the default ISO 8601 format
                                    var datetime = new Date(data);
                                    var year = datetime.getFullYear();
                                    var month = (datetime.getMonth() + 1).toString().padStart(2, '0');
                                    var day = datetime.getDate().toString().padStart(2, '0');
                                    var hours = datetime.getHours().toString().padStart(2, '0');
                                    var minutes = datetime.getMinutes().toString().padStart(2, '0');
                                    var seconds = datetime.getSeconds().toString().padStart(2, '0');

                                    // Format the date and time as 'yyyy-mm-dd HH:MM:SS'
                                    return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' +
                                        seconds;
                                } else {
                                    return data;
                                }
                            }
                        }

                    ];

                    populateTable(data, tableId, columns);

                })
                .catch(error => console.error(error));

        }




        $(document).on("click", "#reset", function(e) {
            e.preventDefault();

            $("#start_date").val(''); // empty value
            $("#end_date").val('');

            $('#allOrdersTable2').DataTable().destroy();
            orderReport();


        });
    </script>

@endsection
