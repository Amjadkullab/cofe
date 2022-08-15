@extends('admin.layouts.master')
@section('title', 'Product')
@section('page-title','product page')
@section('main-page-title','Home')
@section('small-page-title','products')
@section('content')

<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Products</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Description</th>
              <th>Image</th>
              <th>Category</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Setting</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product )
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td><img width="110" src="{{asset('uploads/'. $product->image)}}" alt=""></td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->updated_at}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>

                        <a href="#" class="btn btn-danger" onclick="confirmdestroy({{$product->id}},this)" >
                         <i class="fas fa-trash"></i></a>
                    </div>

                </td>
              </tr>
            @endforeach


          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
@section('scripts')
<script>

  function confirmdestroy(id,reference){
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    destroy(id,reference)
  }
})
function destroy(id,reference){
    axios.delete('/admin/products/'+ id)
  .then(function (response) {
    // handle success
    console.log(response);
    reference.closest('tr').remove();
    showmessage(response.data);

  })
  .catch(function (error) {
    // handle error
    console.log(error);
    showmessage(error.response.data);
  })
  .then(function () {
    // always executed
  });
}
function showmessage(data){
    Swal.fire({
  icon: data.icon,
  title: data.title,
  text:data.text,
  showConfirmButton: false,
  timer: 1500
})
}


  }




</script>

@endsection
