@extends('admin.layouts.master')
@section('title', 'Create Permission')
@section('page-title', 'Create Permission')
@section('main-page-title', 'Home')
@section('small-page-title', 'Permissions')
@section('styles')
<link rel="stylesheet" href="{{asset('admin_asset/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin_asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Permission</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="created_form" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Minimal</label>
                                    <select class="form-control guards" id="guards" style="width: 100%;">
                                      <option value="admin">Admin</option>
                                      <option value="user">User</option>

                                    </select>
                                  </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" class="form-control" id="name" placeholder="Enter name">
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
<script src="{{asset('admin_asset/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
        // $('.guards').select2()
         //Initialize Select2 Elements
    $('.guards').select2({
      theme: 'bootstrap4'
    })


    function store(){
        axios.post('/admin/permissions/',{
            name : document.getElementById('name').value,
            guard_name: document.getElementById('guards').value,
         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/permissions/";
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














//     function store(){








//         let formData = new FormData;
//         formData.append('name' , document.getElementById('name').value);
//         formData.append('active', document.getElementById('active').checked ? 1: 0);
//         formData.append('image', document.getElementById('image').files[0]);
//         axios.post('/admin/roles/',formData )
//   .then(function (response) {
//     // handle success
//     console.log(response);
//     toastr.success(response.data.message);
//     window.location.href="/admin/roles/";
//   })
//   .catch(function (error) {
//     // handle error
//     console.log(error);
//     toastr.error(error.response.data.message);
//   })
//   .then(function () {
//     // always executed
//   });




//     }



</script>

@endsection
