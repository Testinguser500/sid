@extends('admin/layout')
@section('content')

    <!-- Main content -->
    <section class="content">
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
       <div class="col-md-12">
	     <?php // echo $this->session->flashdata('succ_msg'); ?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i>Create Banner</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{url('/admin/banner/store')}}" method="post" enctype= "multipart/form-data">
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" class="form-control" id="" name="title" placeholder="Name" value="{{ old('title') }}">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Banner Type</label>
                  <select class="form-control" id="" name="position_id" >
                      <option value="">Select Banner Type</option>
                      <?php foreach((array)bannerType() as $key=>$val)
                      {?>
                      <option value="<?php echo $key;?>" @if(old('position_id')==$key) selected @endif><?php echo $val['position'];?></option>
                      <?php }?>
                  </select>
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">URL</label>
                  <input type="text" class="form-control" id="" name="url" value="{{old('url')}}">
				  
		  <div class="help-block"></div>
                </div>
		
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <input type="file"  name="image">
		  <div class="help-block"></div>
                </div> 
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active" @if(old('status')=='Active') checked @endif>Active
                  <input type="radio" id="" name="status" value="Inactive" @if(old('status')=='Inactive') checked @endif>Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
         
        
          
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
         

        </div>

    </section>
   
  <!-- /.content-wrapper -->
  <!-- CK Editor -->

 
@endsection	