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
              <h3 class="card-title">Manage Orders</h3>
            </div>
            <div class="card-body">
              {{--  my code --}}
              <table class="table table-hover table-striped" id="dataTable">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>                    
                    <th>Order ID</th>
                    <th>Orderer Name</th>
                    <th>Orderer Phone</th>
                    <th>Orderer Status</th>                
                    <th >Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $order)
                  <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$order->id}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->phone_no}}</td>
                    <td>
                      <p>
                        @if ($order->is_seen_by_admin)
                          <button class="btn btn-success btn-sm">Seen</button>
                        @else
                          <button class="btn btn-warning btn-sm">Unseen</button>  
                        @endif
                      </p> 
                      <p>
                        @if ($order->is_completed)
                          <button class="btn btn-success btn-sm">Confirmed</button>
                        @else
                          <button class="btn btn-warning btn-sm">Pending</button>  
                        @endif
                      </p>

                      <p>
                        @if ($order->is_paid)
                          <button class="btn btn-success btn-sm">Paid</button>
                        @else
                          <button class="btn btn-danger btn-sm">Unpaid</button>  
                        @endif
                      </p>  
                    </td>                   
                    <td>
                     {{--  <a href="{{route('admin.category.edit', $order->id)}}" class="btn btn-success">Edit</a> --}}

                      <a href="{{route('admin.order.show', $order->id)}}" class="btn btn-info" id="">View Order Details</a>
                      <a href="{{route('admin.order.delete', $order->id)}}" class="btn btn-danger" id="delete">Delete</a>
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