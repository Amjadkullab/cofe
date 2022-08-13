@extends('admin.layouts.master')
@section('title', 'update user')
@section('page-title', 'update user')
@section('main-page-title', 'Home')
@section('small-page-title', 'users')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update User</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="created_form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" class="form-control" id="name" placeholder="Enter name"
                                        value="@if (old('name')) {{ old('name') }}
                                    @else  {{ $user->name }} @endif">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email"
                                        value="@if (old('email')) {{ old('email') }}
                                    @else  {{ $user->email }} @endif">
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active"

                                        @if ($user->active) checked @endif>
                                    <label class="custom-control-label" for="active">Active</label>
                                </div>
                                {{-- @if ($admin->id == auth('admin')->id) disabled @endif --}}


                                <div class="form-group">
                                    <!-- <label for="customFile">Custom File</label> -->






                                    <!-- /.card-body -->
                                    <div class="card-footer">

                                        <button type="button" onclick="update({{ $user->id }})"
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
        function update(id) {
            axios.put('/admin/user/' + id, {
                    name: document.getElementById('name').value,
                    email : document.getElementById('email').value,
                    active : document.getElementById('active').value
                })
                .then(function(response) {
                    // handle success
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = "/admin/user/";
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
