@extends('admin.layouts.master')
@section('title', 'Create Admin')
@section('page-title', 'Create Admin')
@section('main-page-title', 'Home')
@section('small-page-title', 'Admins')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="created_form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" class="form-control" id="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter name">
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active">
                                    <label class="custom-control-label" for="active">Active</label>
                                  </div>

                                <div class="form-group">
                                    <!-- <label for="customFile">Custom File</label> -->






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
    function store(){
        axios.post('/admin/admin/',{
            name : document.getElementById('name').value,
            email : document.getElementById('email').value,
            active : document.getElementById('active').checked,

         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/admin/";
  })
  .catch(function (error) {
    // handle error
    console.log(error);
    toastr.error(error.response.data.message);
  })
  .then(function () {
    // always executed
  });




    }


</script>

@endsection
