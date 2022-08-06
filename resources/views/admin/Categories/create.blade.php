@extends('admin.layouts.master')
@section('title', 'Create Category')
@section('page-title', 'Create Category')
@section('main-page-title', 'Home')
@section('small-page-title', 'Categories')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 ">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Category</h3>
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
        axios.post('/admin/categories/',{
            name : document.getElementById('name').value,
  
         })
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/categories/";
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
