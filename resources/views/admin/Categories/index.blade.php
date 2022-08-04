@extends('admin.layouts.master')
@section('title','categories')
@section('page title','categories Page')
@section('big title','Home')
@section('small title','categories page')
@section('content')
<div class="card-body table-responsive p-0" style="height: 300px;">
    <table class="table table-head-fixed text-nowrap">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Settings</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category )
        <tr>
          <td>{{$category->id}}</td>
          <td>{{$category->name}}</td>
          <td>{{$category->created_at}}</td>
          <td>{{$category->updated_at}}</td>
          <td>
            <td>
                <div class="btn-group">
                 <a class="btn btn-info" href="{{route('categories.edit',$category->id)}} "><i class="fas fa-edit"></i></a>


                 <a href="#" class="btn btn-danger" onclick=" confirmdestroy({{$category->id}},this)" >
                    <i class="fas fa-trash"></i>
                </a>

                </div>
              </td>





          </td>

        </tr>
      </tbody>
      @endforeach

    </table>
  </div>

@endsection
@section('scripts')
<script>

function confirmdestroy(id,reference){

    Swal.fire({
  title: 'Are you sure?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    destroy(id,reference);
  }
})
function destroy(id,reference){
    axios.delete('admin/categories/'+ id)
  .then(function (response) {
    // handle success
    console.log(response);
    reference.closest(tr)->remove();
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
  icon:data.icon,
  title: data.title,
  text: data.text,
  showConfirmButton: false,
  timer: 1500
})



}




}





</script>

@endsection
