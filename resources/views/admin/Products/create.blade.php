@extends('admin.layouts.master')
@section('title', 'Create Product')
@section('page-title', 'Create Product')
@section('main-page-title', 'Home')
@section('small-page-title', 'Products')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="created_form" action="{{ route('products.store') }}" mes enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="admin_id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" class="form-control" name="name" id="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" name="description" id="description"
                                        placeholder=" Enter Description.....">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="image" class="form-control" id="image" placeholder=" Enter Image.....">
                                </div> --}}
                                <div class="form-group">
                                    <label for="image">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Select Category</label>

                                    <select id="category_id" name="category_id" class="form-control">
                                        <option value="" selected disabled>Selected Category</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }} </option>
                                            @endforeach
                                    </select>


                                </div>








                                <!-- /.card-body -->
                                <div class="card-footer">

                                    <button type="button" onclick="store()" class="btn btn-primary">Store</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->



                </div>
                <!--/.col (left) -->
                <!-- right column -->

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    </div>
@endsection
@section('scripts')
    <script>
        function store() {
            let formData = new FormData;
            formData.append('name', document.getElementById('name').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('category_id', document.getElementById('category_id').value);
            axios.post('/admin/products/',formData)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = "/admin/products/";
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    toastr.error(error.response.data.message);
                })
                .then(function() {
                    // always executed
                });
        }



        //     function store(){
        //         let formData = new FormData;
        //         formData.append('name' , document.getElementById('name').value);
        //         formData.append('active', document.getElementById('active').checked ? 1: 0);
        //         formData.append('image', document.getElementById('image').files[0]);
        //         axios.post('/admin/categories/',formData )
        //   .then(function (response) {
        //     // handle success
        //     console.log(response);
        //     toastr.success(response.data.message);
        //     window.location.href="/admin/categories/";
        //   })
        //   .catch(function (error) {
        //     // handle error
        //     console.log(error);
        //     toastr.error(error.response.data.message);
        //   })
        //   .then(function () {
        //     // always executed
        //   });




        // }
    </script>

@endsection
