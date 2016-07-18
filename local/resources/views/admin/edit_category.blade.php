@extends('admin/layout')
@section('content')

    <!-- Main content -->
    <section class="content">
       <div class="col-md-12">
	 @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit Category</h3>
                 <div class="pull-right"> <a href="{{ url('admin/category')}}" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{url('/admin/category/update')}}" method="post" enctype= "multipart/form-data">
                 {{ csrf_field() }}
                  <input type="hidden" class="form-control" id="" name="category_id" placeholder="Name" value="{{$categ->id}}">
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" value="{{$categ->category_name}}">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea name="description" class="textarea" placeholder="Description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$categ->description}}</textarea>  
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <img class='' src="{{URL::asset('uploads')}}/{{$categ->image}}" width="100">
                  <input type="file"  name="image">
		  <div class="help-block"></div>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Parent Category</label>
                  <select class="form-control" name="parent_cat">
                      <option value="0">Please select</option>
                      @if(count($categories)>0)
                        @foreach ($categories as $cat)
                            <option value="{{$cat->id}}"  @if($cat->id==$categ->id) selected @endif>{{ $cat->category_name }}</option>
                        @endforeach
                      @endif
                  </select>
		  <div class="help-block"></div>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active"  @if($cat->status=='Active') checked @endif >Active <input type="radio" id="" name="status" value="Inactive" @if($cat->status=='Inactive') checked @endif >Inactive 
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