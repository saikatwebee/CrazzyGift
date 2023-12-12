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
                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                    <button class="btn btn-sm btn-primary"
                        onclick="window.location.href='{{ url('/admin/Addproducts') }}';">Add New Product</button>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $heading }}</h4>
                            <p class="card-description">

                            </p>

                            <div class="table-responsive">

                                <table class="table table-striped" id="productInactive">


                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>SKU</th>
                                            <th>Code</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Offer Price</th>
                                            <th>Actual Price</th>
                                            {{-- <th>Status</th> --}}
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
        //inactive products datatable

        $(() => {
            getAllInactiveDatatable();
        });

        function getAllInactiveDatatable() {


            const url = "{{ url('admin/getAllInactiveProducts') }}";
            const tableId = "productInactive";
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
<i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="ProductChangeInactive(${row.id})"></i>
<i class="fa-solid fa-trash text-danger" title="Delete Product" style="margin-left:4px;font-size:20px;" onclick="deleteProduct(${row.id})"></i>

`;
                                    } else {
                                        return `
<i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="ProductChangeInactive(${row.id})"></i>
<i class="fa-solid fa-trash text-danger"  title="Delete Product" style="margin-left:4px;font-size:20px;" onclick="deleteProduct(${row.id})"></i>

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
                            data: 'title'
                        },
                        {
                            data: 'sku'
                        },
                        {
                            data: 'code'
                        },

                        {
                            data: 'main_category.name',
                            name: 'main_category.name',
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    return data;
                                }
                                return data;
                            }
                        },
                        {
                            data: 'sub_category.name',
                            name: 'sub_category.name',
                            render: function(data, type, row) {
                                if (type === 'display') {
                                    return data;
                                }
                                return data;
                            }
                        },


                        {
                            data: 'price'
                        },
                        {
                            data: 'actual_price',
                            render: function(data) {
                                if (data !== "" && data !== null) {
                                    return data;
                                } else {
                                    return 'NA';
                                }
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
                                    return year + '-' + month + '-' + day + ' ' + hours + ':' +
                                        minutes + ':' + seconds;
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


        //delete product

        function deleteProduct(id) {
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

                    fetch("{{ url('/admin/productDelete') }}", {
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


                            toastr.success('Product deleted successfully', 'Oops', {
                                onHidden: function() {
                                    $('#productInactive').DataTable().destroy();
                                    getAllInactiveDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });

        }

          //product status change

        function ProductChangeInactive(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#004a8c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes Delete It'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = getCsrfToken();
                const form_datas = {
                    id: id,
                };

                fetch("{{ url('/admin/productChange') }}", {
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


                        toastr.success('Product status changed successfully', 'Oops', {
                            onHidden: function() {
                                // location.reload();
                                $('#productInactive').DataTable().destroy();
                                getAllInactiveDatatable();
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
