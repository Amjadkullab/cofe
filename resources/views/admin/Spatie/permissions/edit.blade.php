@extends('admin.layouts.master')
@section('title', 'update Role')
@section('page-title', 'update Role')
@section('main-page-title', 'Home')
@section('small-page-title', 'Roles')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="created_form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" class="form-control" id="name" placeholder="Enter name"
                                    value="{{$role->name}}">
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="guard">Guard</label>
                                        <input type="name" class="form-control" id="guard" placeholder="Enter name"
                                        value="{{$role->guard_name}}">
                                    </div>

                                <div class="form-group">
                                    <!-- <label for="customFile">Custom File</label> -->






                                <!-- /.card-body -->
                                <div class="card-footer">

                                    <button type="button" onclick="update({{$role->id}})" class="btn btn-primary">Update</button>
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
    function update(id){
        axios.put('/admin/roles/'+ id,{
            name : document.getElementById('name').value,
            guard_name : document.getElementById('guard').value,

         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/roles/";
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
