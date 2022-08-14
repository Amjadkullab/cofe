@extends('admin.layouts.master')
@section('title', 'Change Password')
@section('page-title', 'Change Password')
@section('main-page-title', 'Home')
@section('small-page-title', 'change password')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="created_form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" placeholder="Enter current password">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" id="new_password" placeholder="Enter new password">
                                </div>
                                <div class="form-group">
                                    <label for="new_password_confirmation">New Password Confirmation</label>
                                    <input type="password" class="form-control" id="new_password_confirmation" placeholder="Enter new password">
                                </div>



                                <div class="form-group">
                                    <!-- <label for="customFile">Custom File</label> -->






                                <!-- /.card-body -->
                                <div class="card-footer">

                                    <button type="button" onclick="updatepassword()" class="btn btn-primary">Store</button>
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
    function updatepassword(){
        axios.put('/admin/admin/',{
            current_password : document.getElementById('current_password').value,
            new_password : document.getElementById('new_password').value,
            new_password_confirmation : document.getElementById('new_password_confirmation').value,

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
