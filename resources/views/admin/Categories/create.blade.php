@extends('admin.layouts.master')
@section('title','Create Category')
@section('page title','Create Category')
@section('big title','Home')
@section('small title','create category')

@section('content')
<form action="{{route('categories.store')}}" method="POST">
    <div class="card-body">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter Name">
        </div>
      
        <div class="card-footer">
            <button type="button" onclick="Store()" class="btn btn-primary">Submit</button>
          </div>
</form>

@endsection
@section('scripts')
<script>
    function Store(){
        function post(){
    axios.post( 'admin/categories' )
  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);
    window.location.href="/admin/categories/";
  })
  .catch(function (error) {
    // handle error
    console.log(error);
    toastr.success(error.response.data.message);
  })
  .then(function () {
    // always executed
  });

}
    }
</script>

@endsection
