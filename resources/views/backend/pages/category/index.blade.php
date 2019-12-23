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
              <h3 class="card-title">Manage Category</h3>
            </div>
            <div class="card-body">
              {{--  my code --}}
              <table class="table table-hover table-striped" id="dataTable">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    <th>Parent Category</th>                    
                    <th >Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $row)
                  <tr>
                    <td>#</td>
                    <td>{{$row->name}}</td>
                    <td>
                      <img src="{{  asset('images/categories/'.$row->image) }}" width="100">
                    </td>
                    <td>
                      @if($row->parent_id == NULL)
                        Primary Categoy
                      @else
                        {{$row->parent->name}}
                      @endif
                      </td>                   
                    <td>
                      <a href="{{route('admin.category.edit', $row->id)}}" class="btn btn-success">Edit</a>
                      <a href="{{route('admin.category.delete', $row->id)}}" class="btn btn-danger" id="delete">Delete</a>
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