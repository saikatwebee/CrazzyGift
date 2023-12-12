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


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $heading }}</h4>
                            <p class="card-description">

                            </p>

                            <div class="table-responsive">

                                <table class="table table-striped" id="allOrdersTable1">


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
        // all orders DataTable

        $(() => {
            getAllorderDatatable();
        });

        function getAllorderDatatable() {


            const url = "{{ url('admin/getAllOrders') }}";

            const tableId1 = "allOrdersTable1";
            //  const tableId2 = "allOrdersTable2";

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
    <i class="fa-solid fa-trash text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="deleteOrderAll(${row.id})"></i>
    
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

                        // {
                        //     data: 'order_status'
                        // },
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


                        // {
                        //     data: 'transaction_id'
                        // },

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
                                    return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                        minutes + ':' + seconds;
                                } else {
                                    return data;
                                }
                            }
                        }


                    ];

                    populateTable(data, tableId1, columns);

                })
                .catch(error => console.error(error));
        }

        function deleteOrderAll(id) {
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
                                    //location.reload();

                                    $('#allOrdersTable1').DataTable().destroy();
                                    getAllorderDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });

        }
    </script>

@endsection
