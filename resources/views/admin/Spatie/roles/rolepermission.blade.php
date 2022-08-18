@extends('admin.layouts.master')
@section('title', 'Role-permission')
@section('page-title','Role-permission page')
@section('main-page-title','Home')
@section('small-page-title','Role-permission')
@section('styles')
<link rel="stylesheet" href="{{asset('admin_asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection
@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">


      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$role->name}} permissions</h3>

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
              <table class="table table-hover table-bordered table-striped text-nowrap">
                <thead>
                  <tr>

                    <th>Name</th>
                    <th>Guard</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
@foreach ($permissions as $permission)
<tr>
  {{-- {{ dd($category)}} --}}
    <td>{{ $permission->name}}</td>
    <td><span class="badge bg-success">{{$permission->guard_name}}</span></td>
    <td> <div class="col-sm-6">
        <!-- checkbox -->

          <div class="icheck-primary d-inline">
            <input type="checkbox" onchange="assignpermission({{$role->id}},{{$permission->id}})" id="permission_{{$permission->id}}" @if($permission->assigned) checked @endif>
            <label for="permission_{{$permission->id}}">
            </label>
          </div>
         </td>







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
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection
@section('scripts')
<script>
    function assignpermission(roleId,permissionId){
        axios.post('/admin/roles/'+roleId+'/permissions',{
            permission_id : permissionId
        })

  .then(function (response) {
    // handle success
    console.log(response);
    toastr.success(response.data.message);

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

    }


</script>


@endsection

