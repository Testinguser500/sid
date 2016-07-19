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
                <h3 class="box-title"><i class="fa fa-plus"></i>Edit User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{url('/admin/user/update')}}" method="post" enctype= "multipart/form-data">
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
				  <input type="hidden" class="form-control" id="" name="user_id" value="{{$data->id}}">
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" value="{{$data->name}}">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" id="" name="email" placeholder="Email" value="{{ $data->email }}">
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select class="form-control" id="" name="gender">
				  <option value="male" @if( $data->gender=='male')  selected  @endif>Male</option>
				  <option value="female" @if( $data->gender=='female')  selected  @endif>Female</option>
				  </select>
		  <div class="help-block"></div>
                </div>

				<div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="address" >{{ $data->address }}</textarea>
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <img class='' src="{{URL::asset('uploads/user/')}}/{{$data->image}}" width="100">
                  <input type="file"  name="image">
		  <div class="help-block"></div>
                </div> 
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active"  @if($data->status=='Active') checked @endif >Active <input type="radio" id="" name="status" value="Inactive" @if($data->status=='Inactive') checked @endif >Inactive 
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

  <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
   // CKEDITOR.replace('editor1');
  
    $(".textarea").wysihtml5();
  });
</script>
@endsection

