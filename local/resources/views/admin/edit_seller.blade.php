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

<?php $DB_menu = explode(',', $data->menu_assign);?>
       <div class="col-md-12">
	     <?php // echo $this->session->flashdata('succ_msg'); ?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i>Edit Seller</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{url('/admin/seller/update')}}" method="post" enctype= "multipart/form-data">
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
				  <input type="hidden" class="form-control" id="" name="user_id" value="{{$data->id}}">
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" value="{{old('name')?old('name'):$data->name}}">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" id="" name="email" readonly="readonly" placeholder="Email" value="{{ old('email')?old('email'):$data->email }}">
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select class="form-control" id="" name="gender">
				  <option value="male" @if( (old('gender')?old('gender'):$data->gender)=='male')  selected  @endif>Male</option>
				  <option value="female" @if( (old('gender')?old('gender'):$data->gender)=='female')  selected  @endif>Female</option>
				  </select>
		  <div class="help-block"></div>
                </div>

				<div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="address" >{{ old('address')?old('address'):$data->address }}</textarea>
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <img class='' src="{{URL::asset('uploads/seller/')}}/{{$data->image}}" width="100">
                  <input type="file"  name="image">
		  <div class="help-block"></div>
                </div> 
                
                  <div class="form-group">
                  <label for="exampleInputMobile">Mobile</label>
                  <input type="text" class="form-control" id="" name="mobile" placeholder="Name" value="{{ old('mobile')?old('mobile'):$data->mobile }}">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company Name</label>
                  <input type="text" class="form-control" id="" name="company_name" placeholder="Company Name" value="{{ old('company_name')?old('company_name'):$data->company_name }}">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company PAN Number</label>
                  <input type="text" class="form-control" id="" name="company_pan_no" placeholder="Company PAN Number" value="{{ old('company_pan_no')?old('company_pan_no'):$data->company_pan_no }}">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company TIN/VAT Number</label>
                  <input type="text" class="form-control" id="" name="company_tin_no" placeholder="Company TIN Number" value="{{ old('company_tin_no')?old('company_tin_no'):$data->company_tin_no }}">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Company Address</label>
                  <textarea class="form-control" id="" name="company_address" >{{ old('company_address')?old('company_address'):$data->company_address }}</textarea>
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Menu Assign</label>
                  <div class="row">
                <div class="col-xs-5">
                    {{--*/ $assign_menu = old('menu_assign')?old('menu_assign'):$DB_menu /*--}}
                  <select name="from[]" id="multiselect"  class="form-control" size="8" multiple="multiple">
                    <?php foreach((array)getSelectedmenu('',$assign_menu) as $val)
                    {?>
                      <option value="<?php echo $val->menu_id;?>"><?php echo $val->name;?></option>
                    <?php }?>

                  </select>
                </div>
                <div class="col-xs-2">
                  <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                  <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                  <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                  <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                </div>
                <div class="col-xs-5">
                    {{--*/ $assign_menu = old('menu_assign')?old('menu_assign'):$DB_menu /*--}}
                    <?php 
                    //$assign_id = $_POST['menu_assign'];
                    
                    $assign = getSelectedmenu($assign_menu); //echo $data->menu_assign;//print_r(getSelectedmenu($data->menu_assign));?>
                  <select name="menu_assign[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
                      <?php foreach((array)$assign as $val)
                      {?>
                      <option value="<?php echo $val->menu_id;?>"><?php echo $val->name;?></option>
                      <?php }?>
                  </select>
                </div>
              </div>

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

