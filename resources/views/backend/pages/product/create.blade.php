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
              <h3 class="card-title">Add Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.product.store')  }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              @include('backend.partials.messages')
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control" id="name" placeholder="Enter Title">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea name="description" rows="8" cols="80" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="number" name="price" class="form-control" id="name" placeholder="Enter Price">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Quantity</label>
                  <input type="number" name="quantity" class="form-control" id="Quantity" placeholder="Enter Quantity">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"> Category</label>
                  <select class="form-control" name="category_id">
                      <option >Please select a category for the product</option>
                      <option value="{{null}}">Primary Category</option>
                    @foreach (App\Models\Category::orderBy('name','asc')->where('parent_id', NULL)->get() as $parent)
                        <option value="{{$parent->id}}">{{$parent->name}}</option>
                        @foreach (App\Models\Category::orderBy('name','asc')->where('parent_id', $parent->id)->get() as $child)
                            <option value="{{$child->id}}">----------->{{$child->name}}</option> 
                        @endforeach
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Brand</label>
                  <select class="form-control" name="brand_id">
                      <option value="{{NULL}}" >Please select a brand for the product</option>
                    @foreach (App\Models\Brand::orderBy('name','asc')->get() as $brand)
                      <option value="{{$brand->id}}">{{$brand->name}}</option>
                      
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="Product_image">Product_image</label>
                  <div class="row">
                    <div class="col-md-4">
                      <input type="file" name="product_image[]" class="form-control" id="Quantity" >
                    </div>
                    <div class="col-md-4">
                      <input type="file" name="product_image[]" class="form-control" id="Quantity" >
                    </div>
                    <div class="col-md-4">
                      <input type="file" name="product_image[]" class="form-control" id="Quantity" >
                    </div>
                    <div class="col-md-4">
                      <input type="file" name="product_image[]" class="form-control" id="Quantity" >
                    </div>
                    <div class="col-md-4">
                      <input type="file" name="product_image[]" class="form-control" id="Quantity" >
                    </div>
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
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </form>
          </div>
        </div>
        
      </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection