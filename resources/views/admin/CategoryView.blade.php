@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')
    <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">

            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <h3 class="card-title font-weight-bolder">{{ $title }}</h3>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card banner-hearder-card">
                        <div class="card-body  d-flex justify-content-center align-items-center panel-active"
                            onclick="toggleSlider(event),openTab('catTab'),getAllCategoryDatatable()">
                            Category
                        </div>

                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card slider-hearder-card">
                        <div class="card-body  d-flex justify-content-center align-items-center panel-inactive"
                            onclick="toggleSlider(event),openTab('subTab'),getAllSubcategoryDatatable()">
                            Subcategory
                        </div>

                    </div>
                </div>


                <div class="col-lg-12 grid-margin stretch-card tab" id="catTab" style="display: block;">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-sliders"></i> All Categories</h4>

                            <div class="card-wrapper">

                                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#AddCategoryModal">Add New Category</button>
                                </div>

                            </div>


                            <div class="table-responsive">

                                <table class="table table-striped table-hover w-100" id="categoryTable">

                                    <thead class="text-center">
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Created On</th>

                                        </tr>
                                    </thead>

                                    <tbody class="text-center"></tbody>

                                </table>

                            </div>



                        </div>
                    </div>

                </div>





                <div class="col-lg-12 grid-margin stretch-card tab" id="subTab">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-sliders"></i> All Subcategories</h4>

                            <div class="card-wrapper">
                                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#AddSubcategoryModal">Add New Subcategory</button>
                                </div>
                            </div>

                            <div class="table-responsive">

                                <table class="table table-striped table-hover w-100" id="subcategoryTable">

                                    <thead class="text-center">
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Main Category</th>
                                            <th>Status</th>
                                            <th>Created On</th>

                                        </tr>
                                    </thead>

                                    <tbody class="text-center"></tbody>

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


    <!--Add category model -->

    <div class="modal fade" id="AddCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>

                    <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <form id="category_form" method="post" action="{{ url('admin/addCategory') }}">

                        <div class="form-group">
                            <label for="rget_url">Category Name</label>
                            <input type="text" class="form-control" name="name" id="category_name" required>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" id="addcategoryBtn">Add</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>




                    </form>
                </div>
            </div>
        </div>
    </div>



    <!--edit category model -->

    <div class="modal fade" id="EditCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>

                    <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">

                    <form id="edit_category_form" method="post" action="{{ url('admin/updateCategory') }}">
                        <input type="hidden" id="cid" name="cid">


                        <div class="form-group">
                            <label for="rget_url">Category Name</label>
                            <input type="text" class="form-control" name="name" id="edit_category_name" required>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" id="editCategoryBtn">Save changes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>


                </div>

                </form>
            </div>
        </div>
    </div>



    <!--Add subcategory model -->

    <div class="modal fade" id="AddSubcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Subcategory</h5>

                    <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <form id="subcategory_form" method="post" action="{{ url('admin/addSubcategory') }}">

                        <div class="form-group">
                            <label for="main_category">Select Main Category</label>
                            <select name="main_category" class="form-control" id="add_main_category" required>
                                <option value="">Select</option>
                                @if ($categories)
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                @endif


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Subcategory Name</label>
                            <input type="text" class="form-control" name="name" id="add_sub_name" required>
                        </div>




                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" id="addSubcategoryBtn">Save changes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>


                </div>


            </div>
        </div>
    </div>


    <div class="modal fade" id="EditSubModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subcategory</h5>

                    <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <form id="edit_subcat_form" method="post" action="{{ url('admin/updateSubcategory') }}">
                        <input type="hidden" id="subid" name="id">
                        <div class="form-group">
                            <label for="name">Subcategory Name</label>
                            <input type="text" class="form-control" name="name" id="edit_sub_name" required>
                        </div>


                        <div class="form-group">
                            <label for="main_category">Select Main Category</label>
                            <select name="main_category" class="form-control" id="edit_main_category" required>
                                <option value="">Select</option>
                                @if ($categories)
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                @endif


                            </select>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" id="editsubcatBtn">Save changes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>


                </div>


            </div>
        </div>
    </div>






    <script>
        function toggleSlider(event) {
            const allDivs = document.querySelectorAll('.panel-inactive, .panel-active');

            for (const div of allDivs) {
                div.classList.remove('panel-active');
                div.classList.add('panel-inactive');
            }

            event.target.classList.remove('panel-inactive');
            event.target.classList.add('panel-active');
        }

        function openTab(tabId) {
            const tabs = document.querySelectorAll('.tab');
            for (const tab of tabs) {
                tab.style.display = 'none';
            }

            const tabToOpen = document.getElementById(tabId);
            if (tabToOpen) {
                tabToOpen.style.display = 'block';
            }
        }







        $(() => {


            getAllCategoryDatatable();

        });


        function editCategory(id) {

            const csrfToken = getCsrfToken();
            $("#cid").val(id);
            const form_datas = {
                id: id,
            };


            fetch("{{ url('/admin/getCategory') }}", {
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

                    console.log(data);
                    $("#EditCategoryModal").modal('show');
                    $("#edit_category_name").val(data.name);
                    //  const Bannerurl = "{{ asset('/banners') }}/"+data.image;
                    //  $("#edit_banner_img").attr('src',Bannerurl);



                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });

        }




        function editSubcategory(id) {


            const csrfToken = getCsrfToken();
            $("#subid").val(id);
            const form_datas = {
                id: id,
            };

            fetch("{{ url('/admin/getSubcategory') }}", {
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

                    console.log(data);
                    $("#EditSubModal").modal('show');
                    $("#edit_sub_name").val(data.name);

                    console.log(data.main_category);

                    var selectElement = document.getElementById("edit_main_category");
                    for (var i = 0; i < selectElement.options.length; i++) {
                        if (selectElement.options[i].value == data.main_category) {
                            selectElement.options[i].selected = true;
                            break;
                        }
                    }

                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });


        }












        //category datatable


        function getAllCategoryDatatable() {

            $('#categoryTable').DataTable().destroy();

            const url = "{{ url('admin/getAllCategories') }}";
            const tableId = "categoryTable";

            fetch(url, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    const columns = [{
                            data: null,
                            render: function(data, type, row) {
                                if (type === 'display') {

                                    if (row.status == 1) {
                                        return `
<i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editCategory(${row.id})"></i>
<i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeCategory(${row.id})"></i>
<i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteCategory(${row.id})"></i>
`;
                                    } else {
                                        return `
<i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editCategory(${row.id})"></i>
<i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeCategory(${row.id})"></i>
<i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteCategory(${row.id})"></i>
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

                                    if (data === null || data === '1970-01-01') {
                                        return 'NA';
                                    }

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

        // add category

        document.addEventListener("DOMContentLoaded", function() {
            var category_form = document.getElementById('category_form');

            category_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                // const formData = new FormData(formElement);
                let name = document.getElementById('category_name').value;
                let form_data = {
                    name: name
                }
                const formData = JSON.stringify(form_data)
                let formAction = formElement.getAttribute('action');

                const csrfToken = getCsrfToken();

                fetch(formAction, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json'
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        console.log(data);
                        if (data.errors) {
                            var error = data.errors;
                            for (const fieldName in error) {
                                if (error.hasOwnProperty(fieldName)) {
                                    const errorMessages = error[fieldName];
                                    errorMessages.forEach(errorMessage => {
                                        toastr.error(errorMessage);
                                    });
                                }
                            }
                        }

                        if (data.code == 200) {
                            toastr.success(data.msg, 'Success', {
                                onHidden: function() {
                                    $("#category_form").trigger('reset');
                                    $("#AddCategoryModal").modal('hide');
                                    $('#categoryTable').DataTable().destroy();
                                    getAllCategoryDatatable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });

        // edit category
        document.addEventListener("DOMContentLoaded", function() {
            var edit_category_form = document.getElementById('edit_category_form');

            edit_category_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                let name = document.getElementById('edit_category_name').value;
                let id = document.getElementById('cid').value;
                const formData = {
                    name: name,
                    id: id
                }

                let formAction = formElement.getAttribute('action');

                const csrfToken = getCsrfToken();

                fetch(formAction, {
                        method: 'POST',
                        body: JSON.stringify(formData),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json'
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        console.log(data);
                        if (data.errors) {
                            var error = data.errors;
                            for (const fieldName in error) {
                                if (error.hasOwnProperty(fieldName)) {
                                    const errorMessages = error[fieldName];
                                    errorMessages.forEach(errorMessage => {
                                        toastr.error(errorMessage);
                                    });
                                }
                            }
                        }

                        if (data.code == 200) {
                            toastr.success(data.msg, 'Success', {
                                onHidden: function() {
                                    $("#edit_category_form").trigger('reset');
                                    $("#EditCategoryModal").modal('hide');
                                    $('#categoryTable').DataTable().destroy();
                                    getAllCategoryDatatable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


        //change Category

        function changeCategory(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change the status",
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

                    fetch("{{ url('/admin/categoryChange') }}", {
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


                            toastr.success('Category status changed successfully', 'Success', {
                                onHidden: function() {
                                    $('#categoryTable').DataTable().destroy();
                                    getAllCategoryDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }


        //Delete Category

        function deleteCategory(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record",
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

                    fetch("{{ url('/admin/categoryDelete') }}", {
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


                            toastr.success('Category deleted successfully', 'Success', {
                                onHidden: function() {
                                    $('#categoryTable').DataTable().destroy();
                                    getAllCategoryDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }





        //sub category datatable


        function getAllSubcategoryDatatable() {

            $('#subcategoryTable').DataTable().destroy();

            const url = "{{ url('admin/getAllSubcategories') }}";
            const tableId = "subcategoryTable";

            fetch(url, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    const columns = [{
                            data: null,
                            render: function(data, type, row) {
                                if (type === 'display') {

                                    if (row.status == 1) {
                                        return `
<i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editSubcategory(${row.id})"></i>
<i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeSubcategory(${row.id})"></i>
<i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteSubcategory(${row.id})"></i>
`;
                                    } else {
                                        return `
<i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editSubcategory(${row.id})"></i>
<i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeSubcategory(${row.id})"></i>
<i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteSubcategory(${row.id})"></i>
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

                                    if (data === null || data === '1970-01-01') {
                                        return 'NA';
                                    }

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



        // add subcategory
        document.addEventListener("DOMContentLoaded", function() {
            var subcategory_form = document.getElementById('subcategory_form');

            subcategory_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                //const formData = new FormData(formElement);
                let formAction = formElement.getAttribute('action');
                let name = document.getElementById('add_sub_name').value;
                let main_category = document.getElementById('add_main_category').value;
                const formData = {
                    name: name,
                    main_category: main_category
                };

                const csrfToken = getCsrfToken();

                fetch(formAction, {
                        method: 'POST',
                        body: JSON.stringify(formData),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json'
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        console.log(data);
                        if (data.errors) {
                            var error = data.errors;
                            for (const fieldName in error) {
                                if (error.hasOwnProperty(fieldName)) {
                                    const errorMessages = error[fieldName];
                                    errorMessages.forEach(errorMessage => {
                                        toastr.error(errorMessage);
                                    });
                                }
                            }
                        }

                        if (data.code == 200) {
                            toastr.success(data.msg, 'Success', {
                                onHidden: function() {
                                    $("#subcategory_form").trigger('reset');
                                    $("#AddSubcategoryModal").model('hide');

                                    $('#subcategoryTable').DataTable().destroy();
                                    getAllSubcategoryDatatable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


        // edit subcategory
        document.addEventListener("DOMContentLoaded", function() {
            var edit_subcat_form = document.getElementById('edit_subcat_form');

            edit_subcat_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                //const formData = new FormData(formElement);

                let name = document.getElementById('edit_sub_name').value;
                let main_category = document.getElementById('edit_main_category').value;
                let id = document.getElementById('subid').value;

                const formData = {
                    name: name,
                    main_category: main_category,
                    id: id
                };

                console.log(formData);

                let formAction = formElement.getAttribute('action');

                const csrfToken = getCsrfToken();

                fetch(formAction, {
                        method: 'POST',
                        body: JSON.stringify(formData),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json'
                        },
                    })
                    .then((response) => response.json())
                    .then(data => {

                        console.log(data);
                        if (data.errors) {
                            var error = data.errors;
                            for (const fieldName in error) {
                                if (error.hasOwnProperty(fieldName)) {
                                    const errorMessages = error[fieldName];
                                    errorMessages.forEach(errorMessage => {
                                        toastr.error(errorMessage);
                                    });
                                }
                            }
                        }

                        if (data.code == 200) {
                            toastr.success(data.msg, 'Success', {
                                onHidden: function() {

                                    $("#edit_subcat_form").trigger('reset');
                                    $("#EditSubModal").model('hide');

                                    $('#subcategoryTable').DataTable().destroy();
                                    getAllSubcategoryDatatable();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });



        function changeSubcategory(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change the status",
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

                    fetch("{{ url('/admin/subcategoryChange') }}", {
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


                            toastr.success('Subcategory status changed successfully', 'Success', {
                                onHidden: function() {
                                    $('#subcategoryTable').DataTable().destroy();
                                    getAllSubcategoryDatatable();
                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }


        function deleteSubcategory(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record",
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

                    fetch("{{ url('/admin/subcategoryDelete') }}", {
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


                            toastr.success('Subcategory deleted successfully', 'Success', {
                                onHidden: function() {
                                    $('#subcategoryTable').DataTable().destroy();
                                    getAllSubcategoryDatatable();
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
