@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')
    <style>
        #edit_menu_url {
            position: relative;
        }

        #edit_create_url {
            position: absolute;
            right: 35px;
            top: 28vh;
        }

        #edit_create_url:hover {
            cursor: pointer;
        }
    </style>
    <div class="main-panel">

        <!-- variable content for each page -->

        <div class="content-wrapper">

            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <h3 class="card-title font-weight-bolder">{{ $title }}</h3>
                </div>


                <div class="col-lg-12 grid-margin stretch-card justify-content-end">
                    <button class="btn btn-sm btn-primary" onclick="window.location.href='{{ url('/admin/add-menu') }}';">Add
                        New Menu</button>
                </div>


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $heading }}</h4>
                            <p class="card-description">

                            </p>

                            <div class="table-responsive">

                                <table class="table table-striped" id="menuTable">

                                    <thead class="text-center">
                                        <tr>
                                            <th>Action</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Url</th>
                                            <th>Parent ID</th>
                                            <th>Icon</th>
                                            <th>Menu Status</th>

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


    <!-- menu model -->

    <div class="modal fade" id="MenuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menu Details</h5>

                    <i class="fa-solid fa-delete-left" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">

                    <form id="editMenuForm" method="post" action="{{ url('/admin/editMenu') }}">
                        <input type="hidden" name="id" id="mid">
                        <div class="form-group">
                            <label for="edit_menu_name">Menu Name</label>
                            <input type="text" name="name" id="edit_menu_name" required placeholder="Enter Menu Name"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="edit_menu_url"></label>
                            <input type="text" name="url" id="edit_menu_url" required placeholder="Enter URL"
                                class="form-control">
                            <span class="text-primary" id="edit_create_url"><i class="fa-solid fa-gear"></i> Create
                                Url</span>
                        </div>

                        <div class="form-group">
                            <label for="edit_menu_icon">Icon</label>
                            <input type="text" name="icon" id="edit_menu_icon" placeholder="Enter Menu Icon"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="edit_parent_id">Parent ID</label>
                            <select name="parent_id" id="edit_parent_id" class="form-control">
                                <option value="">Select</option>
                                @foreach ($menus as $menu)
                                    @if ($menu->parent_id == null && $menu->status == 1)
                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        {{-- div.form-group --}}



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editMenuBtn">Save changes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
                </form>
            </div>
        </div>
    </div>




    <script>
        tinymce.init({
            selector: 'textarea#add_page_content',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let ch = document.getElementById('show');


            if (ch) {

                ch.onclick = function() {
                    console.log(tinymce.get('add_page_content').getContent());
                }
            }


        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {


            let create = document.getElementById('edit_create_url');



            if (create) {

                create.onclick = function() {
                    let edit_menu_name = document.getElementById('edit_menu_name').value;


                    if (edit_menu_name != "") {
                        $slugUrl = createSlug(edit_menu_name);
                        console.log($slugUrl);
                        document.getElementById('edit_menu_url').value = $slugUrl;
                    } else {
                        toastr.warning('Kindly add a menu name first');
                    }


                };
            }
        });

        function createSlug(str) {
            str = str.replace(/^\s+|\s+$/g, '');
            str = str.toLowerCase();

            const from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            const to = "aaaaeeeeiiiioooouuuunc------";

            for (let i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            return str;
        }
    </script>

    <script>
        //menu data table 

        function getAllMenuDatatable() {


            const url = "{{ url('admin/getAllMenus') }}";
            const tableId = "menuTable";


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
    <i class="fa-regular fa-pen-to-square" title="Edit" style="margin-left:4px;font-size:20px;" onclick="editMenu(${row.id})"></i>
    <i class="fa-solid fa-toggle-on text-success" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeMenu(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteMenu(${row.id})"></i>
    
`;
                                    } else {
                                        return `
    <i class="fa-regular fa-pen-to-square"  style="margin-left:4px;font-size:20px;" onclick="editMenu(${row.id})"></i>
    <i class="fa-solid fa-toggle-off text-danger" title="Change Status" style="margin-left:4px;font-size:22px;" onclick="changeMenu(${row.id})"></i>
    <i class="fa-solid fa-trash text-danger" title="Delete" style="margin-left:4px;font-size:22px;" onclick="deleteMenu(${row.id})"></i>
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
                            data: 'url'
                        },

                        {
                            data: 'parent_name',
                            render: function(data) {
                                return data ? data : "NA"; // Display "NA" if 'icon' is blank or null
                            }
                        },

                        // {
                        //     data: 'parent_id',
                        //     render: function(data) {
                        //         return data ? data : "NA"; // Display "NA" if 'icon' is blank or null
                        //     }
                        // },

                        {
                            data: 'icon',
                            render: function(data) {
                                return data ? data : "NA"; // Display "NA" if 'icon' is blank or null
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


                    ];

                    populateTable(data, tableId, columns);
                })
                .catch(error => console.error(error));
        }


        // delete menu
        function deleteMenu(id) {
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

                    fetch("{{ url('/admin/menuDelete') }}", {
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


                            toastr.success('Menu deleted successfully', 'Success', {
                                onHidden: function() {
                                    $('#menuTable').DataTable().destroy();
                                    getAllMenuDatatable();

                                }
                            });


                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                        });



                }
            });
        }


        // change menu
        function changeMenu(id) {
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

                    fetch("{{ url('/admin/menuChange') }}", {
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


                            toastr.success('Menu status changed successfully', 'Success', {
                                onHidden: function() {
                                    $('#menuTable').DataTable().destroy();
                                    getAllMenuDatatable();
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
