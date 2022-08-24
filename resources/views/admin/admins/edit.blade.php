@extends('admin.layouts.master')
@section('title', 'update admin')
@section('page-title', 'update admin')
@section('main-page-title', 'Home')
@section('small-page-title', 'admins')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form >
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" class="form-control" id="name" placeholder="Enter name"
                                      value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email"
                                        value="{{old('email')}}">
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active"
                                    @if ($admin->id == auth('admin')->id()) disabled
                                     @endif
                                        @if ($admin->active) checked @endif>
                                    <label class="custom-control-label" for="active">Active</label>
                                </div>



                                <div class="form-group">
                                    <!-- <label for="customFile">Custom File</label> -->






                                    <!-- /.card-body -->
                                    <div class="card-footer">

                                        <button type="button" onclick="update({{$admin->id}},'{{$redirect ?? 'true'}}')"
                                            class="btn btn-primary">Update</button>
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
        function update(id,redirect) {
            axios.put('/admin/admin/' + id, {
                    name: document.getElementById('name').value,
                    email : document.getElementById('email').value,
                    active : document.getElementById('active').value
                })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    if(redirect){
                    window.location.href = "/admin/admin/";
                }
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
    </script>

@endsection
