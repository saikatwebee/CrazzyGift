@extends('layouts.admin')

@section('title', $title)

@section('Admincontent')
    <style>
        .radioLabel {
            margin-left: 12px;
            font-weight: 600;
        }

        .radioInput {
            margin-left: 12px;
        }

        .active {
            display: block;
        }

        .deactive {
            display: none;
        }

        #add_menu_url,
        #add_menu_icon {
            position: relative;
        }

        #add_create_url {
            position: absolute;
            right: 35px;
            top: 33vh;
        }

        #add_search_icon {
            position: absolute;
            right: 35px;
            top: 50vh;
        }

        #add_search_icon:hover {
            cursor: pointer;
        }
    </style>
    <div class="main-panel">

        <div class="content-wrapper">
            <div class="text-left mb-5 ">
                <h3>{{ $title }}</h3>
            </div>
            <div class="text-right mb-3">
                <button class="btn btn-sm btn-primary"
                    onclick="window.location.href='{{ url('/admin/menu-management') }}';"><i class="fa-solid fa-backward"></i>
                    Back</button>
            </div>
            <div class="row">


                <div class="col-12 grid-margin">
                    <form class="form-sample" id="add_menu_form" method="post" action="{{ url('/admin/addMenu') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title">Enter Menu Details :</h4>
                                <div class="form-group">
                                    <label for="add_menu_name">Menu Name</label>
                                    <input type="text" name="name" id="add_menu_name" required
                                        placeholder="Enter Menu Name" class="form-control" oninput="updatePageTitle(this.value)">
                                </div>
                                <div class="form-group">
                                    <label for="add_menu_url">URL</label>
                                    <input type="text" name="url" id="add_menu_url" required placeholder="Enter URL"
                                        class="form-control">
                                    <span class="text-primary" id="add_create_url"><i class="fa-solid fa-gear"></i> Create
                                        Url</span>
                                </div>
                                {{-- @csrf --}}
                                <div class="form-group">
                                    <label for="add_menu_icon">Icon</label>
                                    <input type="text" name="icon" id="add_menu_icon" placeholder="Enter Menu Icon"
                                        class="form-control">
                                    <span class="text-primary" id="add_search_icon"><i
                                            class="fa-solid fa-magnifying-glass"></i> Search Icons</span>
                                </div>

                                <div class="form-group">
                                    <label for="add_parent_id">Parent ID</label>
                                    <select name="parent_id" id="add_parent_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($menus as $menu)
                                            @if ($menu->parent_id == null)
                                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="card-body">
                                <h4 class="card-title">Enter Associated Page Details :</h4>

                                <div class="form-group">
                                    <label>Page Title</label>

                                    <input type="text" class="form-control" name="title" id="add_page_title" required
                                         disabled/>



                                </div>

                                <div class="form-group">
                                    <label>Template :</label>
                                    @if (!$is_home)
                                        <input type="radio" class="radioInput" name="fetch_all" value="4"
                                            onchange="getSelectedOption(this)" />
                                        <label class="text-primary radioLabel">Home</label>
                                    @endif

                                    <input type="radio" class="radioInput" name="fetch_all" value="0"
                                        onchange="getSelectedOption(this)" />
                                    <label class="text-warning radioLabel">Static</label>

                                    <input type="radio" class="radioInput" name="fetch_all" value="1"
                                        onchange="getSelectedOption(this)" />
                                    <label class="text-success radioLabel">Dynamic</label>


                                    <input type="radio" class="radioInput" name="fetch_all" value="2"
                                        onchange="getSelectedOption(this)" />
                                    <label class="text-danger radioLabel">Show all Products</label>


                                    <input type="radio" class="radioInput" name="fetch_all" value="3"
                                        onchange="getSelectedOption(this)" />
                                    <label class="text-info radioLabel">Show Product with Price Range</label>



                                </div>


                                <div class="deactive" id="contentDiv">
                                    <div class="form-group">
                                        <label>Page Content</label>

                                        <textarea name="content" id="add_page_content" cols="30" rows="10" class="form-control"></textarea>

                                    </div>

                                </div>



                                <div class="deactive" id="categoryDiv">


                                    <div class="form-group">
                                        <label>Category</label>

                                        <select name="main_category" id="add_category" class="form-control"
                                            onchange="getDependent(event)">
                                            <option value="">Select Category</option>
                                            @if ($categories)
                                                @if (count($categories) > 0)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </select>



                                    </div>





                                    <div class="form-group">
                                        <label>Sub Category</label>

                                        <select class="form-control" name="sub_category" id="add_sub_category"
                                            style="position:relative;">
                                            <option value="">Select Subcategory</option>


                                        </select>
                                        <span style="color:#6c6666;font-size:16px;position:absolute;top:12px; right:40px;"
                                            id="cat_loader"></span>

                                    </div>


                                </div>


                                <div class="form-group deactive" id="rangeDiv">
                                    <label for="">Select Price-range for Product</label>
                                    <input type="range" id="priceRange" min="0" max="5000" step="1"
                                        class="form-control">
                                    <p id="priceValue"></p>

                                    <input type="hidden" name="price_range" id="price_range">

                                </div>




                                <div class="text-right mb-3">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>






                            </div>
                        </div>
                    </form>
                </div>



            </div>

        </div>


        @include('common.common')

    </div>

    <script>

function updatePageTitle(value) {
       
        var pageTitleInput = document.getElementById('add_page_title');

        pageTitleInput.value = value;
    }
        
        document.addEventListener("DOMContentLoaded", function() {
            let add_search_icon = document.getElementById('add_search_icon');


            add_search_icon.onclick = function() {

                window.open("https://fontawesome.com/icons", "_blank");


            }
        });


        const priceRange = document.getElementById("priceRange");
        const price_range = document.getElementById("price_range");
        const priceValue = document.getElementById("priceValue");

        priceRange.addEventListener("input", function() {
            const selectedValue = parseInt(priceRange.value);
            console.log(selectedValue);

            if (selectedValue >= 0 && selectedValue <= 500) {
                priceValue.textContent = `0 to ${selectedValue}`;
                price_range.value = "[0,500]";

            } else if (selectedValue >= 501 && selectedValue <= 1000) {
                priceValue.textContent = `501 to ${selectedValue}`;
                price_range.value = "[501,1000]";

            } else if (selectedValue >= 1001 && selectedValue <= 2000) {
                priceValue.textContent = `1001 to ${selectedValue}`;
                price_range.value = "[1001,2000]";
            } else if (selectedValue > 2000) {
                priceValue.textContent = `2000 and above`;
                price_range.value = ">=2000";
            }
        });



        document.addEventListener("DOMContentLoaded", function() {

            let create = document.getElementById('add_create_url');

            if (create) {

                create.onclick = function() {
                    let add_menu_name = document.getElementById('add_menu_name').value;


                    if (add_menu_name != "") {
                        $slugUrl = createSlug(add_menu_name);
                        console.log($slugUrl);
                        document.getElementById('add_menu_url').value = $slugUrl;
                    } else {
                        toastr.warning('Kindly add a menu name first');
                    }


                };
            }


        });




        function getSelectedOption(radio) {
            let contentDiv = document.getElementById('contentDiv');
            let categoryDiv = document.getElementById('categoryDiv');
            let rangeDiv = document.getElementById('rangeDiv');

            if (radio.checked) {
                if (radio.value == 0) {
                    if (categoryDiv.classList.contains('active')) {
                        categoryDiv.classList.remove('active');
                        categoryDiv.classList.add('deactive');
                    }
                    if (rangeDiv.classList.contains('active')) {
                        rangeDiv.classList.remove('active');
                        rangeDiv.classList.add('deactive');
                    }

                    if (contentDiv.classList.contains('deactive')) {
                        contentDiv.classList.remove('deactive');
                        contentDiv.classList.add('active');
                    }

                    document.getElementById('add_category').selectedIndex = -1;
                    document.getElementById('add_sub_category').selectedIndex = -1;


                } else if (radio.value == 1) {


                    tinymce.get('add_page_content').setContent('');

                    if (contentDiv.classList.contains('active')) {
                        contentDiv.classList.remove('active');
                        contentDiv.classList.add('deactive');
                    }

                    if (rangeDiv.classList.contains('active')) {
                        rangeDiv.classList.remove('active');
                        rangeDiv.classList.add('deactive');
                    }


                    if (categoryDiv.classList.contains('deactive')) {
                        categoryDiv.classList.remove('deactive');
                        categoryDiv.classList.add('active');
                    }
                } else if (radio.value == 3) {
                    if (contentDiv.classList.contains('active')) {
                        contentDiv.classList.remove('active');
                        contentDiv.classList.add('deactive');
                    }

                    if (categoryDiv.classList.contains('active')) {
                        categoryDiv.classList.remove('active');
                        categoryDiv.classList.add('deactive');
                    }


                    if (rangeDiv.classList.contains('deactive')) {
                        rangeDiv.classList.remove('deactive');
                        rangeDiv.classList.add('active');
                    }
                } else {
                    if (contentDiv.classList.contains('active')) {
                        contentDiv.classList.remove('active');
                        contentDiv.classList.add('deactive');
                    }

                    if (categoryDiv.classList.contains('active')) {
                        categoryDiv.classList.remove('active');
                        categoryDiv.classList.add('deactive');
                    }


                    if (rangeDiv.classList.contains('active')) {
                        rangeDiv.classList.remove('active');
                        rangeDiv.classList.add('deactive');
                    }
                }
            }
        }

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


        tinymce.init({
            selector: 'textarea#add_page_content',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
        });


        function getDependent(event) {
            const category = event.target.value;
            document.getElementById('add_sub_category').style.pointerEvents = 'none';
            document.getElementById('cat_loader').innerHTML = '<i class="fa fa-spinner fa-spin" ></i>';


            const url = "{{ url('admin/getDependent') }}";
            const formData = {
                id: category
            };
            console.log(category);
            const csrfToken = getCsrfToken();
            fetch(url, {
                    method: 'POST',
                    body: JSON.stringify(formData),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                })
                .then((response) => response.json())
                .then(data => {

                    document.getElementById('add_sub_category').style.pointerEvents = 'auto';
                    document.getElementById('cat_loader').innerHTML = '';

                    const selectElement = document.getElementById("add_sub_category");
                    selectElement.innerHTML = '<option value="">Select Subcategory</option>';
                    data.forEach(item => {
                        const option = document.createElement("option");
                        option.value = item.id;
                        option.textContent = item.name;
                        selectElement.appendChild(option);
                    });


                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });

        }
    </script>

    <script>
        document.getElementById('add_menu_form').addEventListener('submit', function(event) {
            event.preventDefault();

            let formElement = event.target;
            let formAction = formElement.getAttribute('action');

            let name = document.getElementById('add_menu_name').value;
            let url = document.getElementById('add_menu_url').value;
            let icon = document.getElementById('add_menu_icon').value;
            let parent_id = document.getElementById('add_parent_id').value;
            let title = document.getElementById('add_page_title').value;
            let content = tinymce.get('add_page_content').getContent();
            let main_category = document.getElementById('add_category').value;
            let sub_category = document.getElementById('add_sub_category').value;

            var fetch_all_name = document.querySelector('input[name="fetch_all"]:checked');
            if(fetch_all_name){
                var fetch_all = fetch_all_name.value;
            }
            else{
                var fetch_all = null;
            }
            

            const price_range = document.getElementById("price_range").value;





            let formData = {
                name: name,
                url: url,
                icon: icon,
                parent_id: parent_id,
                title: title,
                content: content,
                main_category,
                sub_category,
                fetch_all: fetch_all,
                price_range: price_range
            }




            const csrfToken = getCsrfToken();

            fetch(formAction, {
                    method: 'POST',
                    body: JSON.stringify(formData),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
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
                                location.reload();
                            }
                        });
                    }

                })
                .catch(error => {

                    console.error('There has been a problem with your fetch operation:', error);
                });
        });
    </script>



@endsection
