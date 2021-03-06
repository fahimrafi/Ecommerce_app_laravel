@extends('backend.layouts.master')
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
              <h3 class="card-title">Add brand</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.brand.update',$brand->id)  }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              @include('backend.partials.messages')
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="name" class="form-control" value="{{$brand->name}}" id="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea name="description" rows="8" cols="80" class="form-control">{!!$brand->description!!}</textarea>
                </div>
               

                <div class="form-group">
                  <div class="border border-light">
                   <label for="image">Brand Current Image</label> <br>
                  <img src="{{  asset('images/brands/'.$brand->image) }}" width="100"> 
                  </div>
                  
                  <br>                   
                  <label>brands new Image</label>
                  <input type="file" name="image" class="form-control" id="image" >
                   </div>
                  </div>
                
                
                
                {{-- <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div> --}}
                
                {{-- <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div>
                  </div>
                </div> --}}
                {{-- <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
              </div>  --}}
              <div class="card-footer">
                <button type="submit" class="btn btn-success">Update brand</button>
              </div>
            </form>
          </div>
        </div>
        
      </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection