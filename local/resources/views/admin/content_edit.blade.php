@extends('admin/layout')
@section('content')

    <!-- Main content -->
    <section class="content">
       <div class="col-md-12">
	     <?php // echo $this->session->flashdata('succ_msg'); ?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i>Edit Content</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{url('/admin/static-content/update')}}" method="post" enctype= "multipart/form-data">
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="hidden" class="form-control" id="" name="content_id" value="{{$static->id}}">
                  <input type="text" class="form-control" id="" name="title" placeholder="Name" value="{{$static->title}}">
		  <div class="help-block"></div>
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Short Description</label>
                  <textarea name="short_description" class="textarea" placeholder="Short Description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$static->short_description}}</textarea>  
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea name="description" class="textarea" placeholder="Description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$static->description}}</textarea>  
		  <div class="help-block"></div>
                </div> 
				@if($static->image)
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <img class='' src="{{URL::asset('uploads/static/')}}/{{$static->image}}" width="100">
                  <input type="file"  name="image">
		  <div class="help-block"></div>
                </div> 
                 @endif  
                  
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" onclick="window.location='{{url('admin/static-content')}}'" class="btn btn-default">Cancel</button>
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