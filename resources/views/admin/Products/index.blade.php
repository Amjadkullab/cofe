@extends('admin.layouts.master')
@section('title','Products')
@section('page title','Products Page')
@section('big title','Home')
@section('small title','products page')
@section('content')
<div class="card-body table-responsive p-0" style="height: 300px;">
    <table class="table table-head-fixed text-nowrap">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Description</th>
          <th>image</th>
          <th>category</th>
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
          <td>{{$product->slug}}</td>
          <td>{{$product->description}}</td>
          <td>{{$product->image}}</td>
          <td>{{$product->category_id}}</td>
          <td>{{$product->created_at}}</td>
          <td>{{$product->updated_at}}</td>
         
        </tr>






      </tbody>
      @endforeach

    </table>
  </div>

@endsection
