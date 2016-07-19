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
                <h3 class="box-title"><i class="fa fa-plus"></i>Create Seller</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{url('/admin/seller/store')}}" method="post" enctype= "multipart/form-data">
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" value="{{ old('name') }}">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" id="" name="email" placeholder="Email" value="{{ old('email') }}">
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select class="form-control" id="" name="gender">
				  <option value="male">Male</option>
				  <option value="female">Female</option>
				  </select>
		  <div class="help-block"></div>
                </div>

				<div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="address" >{{ old('address') }}</textarea>
		  <div class="help-block"></div>
                </div>
				
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <input type="file"  name="image">
		  <div class="help-block"></div>
                </div> 
                
                  <div class="form-group">
                  <label for="exampleInputMobile">Mobile</label>
                  <input type="text" class="form-control" id="" name="mobile" placeholder="Name" value="{{ old('mobile') }}">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company Name</label>
                  <input type="text" class="form-control" id="" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company PAN Number</label>
                  <input type="text" class="form-control" id="" name="company_pan_no" placeholder="Company PAN Number" value="{{ old('company_pan_no') }}">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company TIN/VAT Number</label>
                  <input type="text" class="form-control" id="" name="company_tin_no" placeholder="Company TIN Number" value="{{ old('company_tin_no') }}">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Company Address</label>
                  <textarea class="form-control" id="" name="company_address" >{{ old('company_address') }}</textarea>
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Menu Assign</label>
                  <div class="row">
  <div class="col-xs-5">
    <select name="from[]" id="multiselect"  class="form-control" size="8" multiple="multiple">
      <?php foreach((array)  getMenu() as $val)
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
    <select name="menu_assign[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
    </select>
  </div>
</div>

		  <div class="help-block"></div>
                </div>  
                  
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active">Active <input type="radio" id="" name="status" value="Inactive" checked>Inactive 
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

