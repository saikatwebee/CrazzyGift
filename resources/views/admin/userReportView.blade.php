@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')

    <div class="main-panel">

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
                                        Users</p>
                                    <p class="fs-30 mb-2">{{ $user['totalUser'] }}</p>
                                    <!-- <p>10.00% (30 days)</p> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4" style="font-size: 18px;"><i class="fa-solid fa-key"></i> Verified
                                        Users</p>
                                    <p class="fs-30 mb-2">{{ $user['verifiedUser'] }}</p>
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
                                                <input type="text" class="form-control" id="startDate"
                                                    placeholder="Start Date" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                                            class="fas fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="endDate"
                                                    placeholder="End Date" readonly>
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
                            <h4 class="card-title">{{ $heading }}</h4>
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
                                            <th>Is Verified</th>
                                            <th>Status</th>
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



    <script>
        $(() => {
            userReport();

        });

        function userReport() {
            const url = "{{ url('admin/getAllUsers') }}";

            const tableId = "usersTable2";


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

                                    if (row.status == 1) {
                                        return `
            <i class="fa-regular fa-eye" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUserReport(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUserReport(${row.id})"></i>
            
        `;
                                    } else {
                                        return `
            <i class="fa-regular fa-eye"  style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUserReport(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUserReport(${row.id})"></i>
            
        `;
                                    }


                                }
                                return data;
                            }
                        },

                        {
                            data: 'id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'email'
                        },

                        {
                            data: 'phone'
                        },
                        {
                            data: 'is_verified',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 0) {
                                        return 'Not Verified';
                                    } else if (data == 1) {
                                        return 'Verified';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'Unknown Status';
                                    }
                                }
                                return data;
                            }
                        },
                        {
                            data: 'status',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 1) {
                                        return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                    } else if (data == 2) {
                                        return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'Unknown Status';
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
                                    var date = new Date(data);
                                    var year = date.getFullYear();
                                    var month = (date.getMonth() + 1).toString().padStart(2,
                                        '0'); // Add 1 to month because it's zero-based
                                    var day = date.getDate().toString().padStart(2, '0');
                                    return year + '-' + month + '-' + day;
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


        //reset userreport 

        $(document).on("click", "#reset_user", function(e) {
            e.preventDefault();

            $("#startDate").val(''); // empty value
            $("#endDate").val('');

            $('#usersTable2').DataTable().destroy();
            userReport();


        });


        //filter for user-report datatable

        $(document).on("click", "#filter_user", function(e) {
            e.preventDefault();

            var startDate = $("#startDate").val();
            var endDate = $("#endDate").val();

            if (startDate == "" || endDate == "") {
                toastr.warning("Start and end date are required!");
            } else {
                $('#usersTable2').DataTable().destroy();
                filterRecords(startDate, endDate);
            }
        });


        function filterRecords(startDate, endDate) {
            console.log(startDate);
            console.log(endDate);

            const url = "{{ url('admin/getFilterUsers') }}";

            const tableId = "usersTable2";

            const csrfToken = getCsrfToken();

            const form_datas = {
                startDate: startDate,
                endDate: endDate
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

                                    if (row.status == 1) {
                                        return `
            <i class="fa-regular fa-eye" title="Edit" style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUserReport(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUserReport(${row.id})"></i>
            
        `;
                                    } else {
                                        return `
            <i class="fa-regular fa-eye"  style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
            <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUserReport(${row.id})"></i>
            <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUserReport(${row.id})"></i>
            
        `;
                                    }


                                }
                                return data;
                            }
                        },

                        {
                            data: 'id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'email'
                        },

                        {
                            data: 'phone'
                        },
                        {
                            data: 'is_verified',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 0) {
                                        return 'Not Verified';
                                    } else if (data == 1) {
                                        return 'Verified';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'Unknown Status';
                                    }
                                }
                                return data;
                            }
                        },
                        {
                            data: 'status',
                            render: function(data, type, row) {
                                if (type == 'display') {
                                    if (data == 1) {
                                        return '<i class="fa-solid fa-power-off text-success" title="Active"></i>';
                                    } else if (data == 2) {
                                        return '<i class="fa-solid fa-power-off text-danger" title="Deactive"></i>';
                                    } else {
                                        // Handle any other cases or unexpected values
                                        return 'Unknown Status';
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
                                    var date = new Date(data);
                                    var year = date.getFullYear();
                                    var month = (date.getMonth() + 1).toString().padStart(2,
                                        '0'); // Add 1 to month because it's zero-based
                                    var day = date.getDate().toString().padStart(2, '0');
                                    return year + '-' + month + '-' + day;
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


        function changeUserReport(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/userChange') }}", {
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


                        toastr.success('User status changed successfully', 'Oops', {
                            onHidden: function() {
                                $('#usersTable2').DataTable().destroy();
                                userReport();
                            }
                        });


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });



            }
        });
    }


    function deleteUserReport(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/userDelete') }}", {
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


                        toastr.success('User deleted successfully', 'Oops', {
                            onHidden: function() {
                                // location.reload();
                                // refresh the DataTable
                                $('#usersTable2').DataTable().destroy();
                                userReport();
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
