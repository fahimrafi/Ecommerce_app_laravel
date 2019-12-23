@extends('backend.layouts.master')

<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Manage Product</h3>
            </div>
            <div class="card-body">
              {{--  my code --}}
              <table class="table table-hover table-striped" id="dataTable">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th >Quantity</th>
                    <th >Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <td>#</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                      <a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-success">Edit</a>
                      <a href="{{route('admin.product.delete', $product->id)}}" class="btn btn-danger" id="delete">Delete</a>
                    </td>
                    
                    
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
              {{--  my code ends --}}
            </div>
            
          </div>
        </div>
        
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
@endsection