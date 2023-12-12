@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')


    <div class="main-panel">

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

                                <table class="table table-striped" id="usersTable1">


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


    <script>
        $(() => {
            getAlluserDatatable();
        });
        //All users datatable

        function getAlluserDatatable() {


            const url = "{{ url('admin/getAllUsers') }}";

            const tableId = "usersTable1";


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
    <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUser(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUser(${row.id})"></i>
    
`;
                                    } else {
                                        return `
    <i class="fa-regular fa-eye"  style="margin-left:4px;font-size:20px;" data-id="${row.id}" onclick="viewUser(event)"></i>
    <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeUser(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Delete User" style="margin-left:4px;font-size:22px;" onclick="deleteUser(${row.id})"></i>
    
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


        function changeUser(id) {
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
                                    $('#usersTable1').DataTable().destroy();
                                    getAlluserDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }


        function deleteUser(id) {
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
                                    $('#usersTable1').DataTable().destroy();
                                    getAlluserDatatable();
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
