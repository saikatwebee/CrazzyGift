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
                        <div class="card-body  d-flex justify-content-center align-items-center panel-active" onclick="toggleSlider(event),openTab('catTab')">
                            Category
                        </div>

                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card slider-hearder-card">
                        <div class="card-body  d-flex justify-content-center align-items-center panel-inactive" onclick="toggleSlider(event),openTab('subTab')">
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
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#AddCategoryModal">Add New Category</button>
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
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#AddSubcategoryModal">Add New Subcategory</button>
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

       <div class="modal fade" id="AddSubcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            @if($categories)
                                @if(count($categories)> 0)
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
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
                            @if($categories)
                                @if(count($categories)> 0)
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
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

       

        document.addEventListener("DOMContentLoaded", function() {
            var category_form = document.getElementById('category_form');

            category_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
               // const formData = new FormData(formElement);
               let name = document.getElementById('category_name').value;
                let form_data={name:name}
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
                                    window.location.reload();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


        document.addEventListener("DOMContentLoaded", function() {
            var edit_category_form = document.getElementById('edit_category_form');

            edit_category_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                let name = document.getElementById('edit_category_name').value;
                let id = document.getElementById('cid').value;
               const formData = {
                name:name,
                id:id
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
                                    window.location.reload();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });




        document.addEventListener("DOMContentLoaded", function() {
            var subcategory_form = document.getElementById('subcategory_form');

            subcategory_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                //const formData = new FormData(formElement);
                let formAction = formElement.getAttribute('action');
               let name = document.getElementById('add_sub_name').value;
               let main_category = document.getElementById('add_main_category').value;
                const formData={
                    name:name,
                    main_category:main_category
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
                                    window.location.reload();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });

        document.addEventListener("DOMContentLoaded", function() {
            var edit_subcat_form = document.getElementById('edit_subcat_form');

            edit_subcat_form.onsubmit = function(event) {

                event.preventDefault();

                let formElement = event.target;
                //const formData = new FormData(formElement);

              let name= document.getElementById('edit_sub_name').value; 
              let main_category =document.getElementById('edit_main_category').value;  
                let id = document.getElementById('subid').value; 

                const formData = {
                    name:name,
                    main_category:main_category,
                    id:id
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
                                    window.location.reload();
                                },
                            });
                        }


                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
            }

        });


        // document.addEventListener("DOMContentLoaded", function() {
        //     var slider_form = document.getElementById('slider_form');

        //     slider_form.onsubmit = function(event) {

        //         event.preventDefault();

        //         let formElement = event.target;
        //         const formData = new FormData(formElement);
        //         let formAction = formElement.getAttribute('action');

        //         const csrfToken = getCsrfToken();

        //         fetch(formAction, {
        //                 method: 'POST',
        //                 body: formData,
        //                 headers: {
        //                     'X-CSRF-TOKEN': csrfToken,
        //                 },
        //             })
        //             .then((response) => response.json())
        //             .then(data => {

        //                 console.log(data);

        //                 if (data.errors) {
        //                     var error = data.errors;
        //                     for (const fieldName in error) {
        //                         if (error.hasOwnProperty(fieldName)) {
        //                             const errorMessages = error[fieldName];
        //                             errorMessages.forEach(errorMessage => {
        //                                 toastr.error(errorMessage);
        //                             });
        //                         }
        //                     }
        //                 }

        //                 if (data.code == 200) {
        //                     toastr.success(data.msg, 'Success', {
        //                         onHidden: function() {
        //                             window.location.reload();
        //                         },
        //                     });
        //                 }


        //             })
        //             .catch(error => {
        //                 console.error('Fetch error:', error);
        //             });
        //     }

        // });

        // document.addEventListener("DOMContentLoaded", function() {
        //     var slider_form = document.getElementById('slider_form2');

        //     slider_form.onsubmit = function(event) {

        //         event.preventDefault();

        //         let formElement = event.target;
        //         const formData = new FormData(formElement);
        //         let formAction = formElement.getAttribute('action');

        //         const csrfToken = getCsrfToken();

        //         fetch(formAction, {
        //                 method: 'POST',
        //                 body: formData,
        //                 headers: {
        //                     'X-CSRF-TOKEN': csrfToken,
        //                 },
        //             })
        //             .then((response) => response.json())
        //             .then(data => {

        //                 console.log(data);

        //                 if (data.errors) {
        //                     var error = data.errors;
        //                     for (const fieldName in error) {
        //                         if (error.hasOwnProperty(fieldName)) {
        //                             const errorMessages = error[fieldName];
        //                             errorMessages.forEach(errorMessage => {
        //                                 toastr.error(errorMessage);
        //                             });
        //                         }
        //                     }
        //                 }

        //                 if (data.code == 200) {
        //                     toastr.success(data.msg, 'Success', {
        //                         onHidden: function() {
        //                             window.location.reload();
        //                         },
        //                     });
        //                 }


        //             })
        //             .catch(error => {
        //                 console.error('Fetch error:', error);
        //             });
        //     }

        // });
    </script>

@endsection
