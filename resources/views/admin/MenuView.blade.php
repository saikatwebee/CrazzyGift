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
                    <button class="btn btn-sm btn-primary" onclick="window.location.href='{{url('/admin/add-menu')}}';">Add New Menu</button>
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
        // tinymce.init({
        //     selector: 'textarea#add_page_content',
        //     plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        //     tinycomments_mode: 'embedded',
        //     tinycomments_author: 'Author name',
        //     mergetags_list: [{
        //             value: 'First.Name',
        //             title: 'First Name'
        //         },
        //         {
        //             value: 'Email',
        //             title: 'Email'
        //         },
        //     ],
        //     ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
        //         "See docs to implement AI Assistant")),
        // });

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


@endsection
