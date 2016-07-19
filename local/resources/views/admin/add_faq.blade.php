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
                <h3 class="box-title"><i class="fa fa-plus"></i> Create FAQ Questions</h3>
                <div class="pull-right"> <a href="{{ url('admin/faq')}}" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{url('/admin/faq/store')}}" method="post" enctype= "multipart/form-data">
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Question</label>
                  <input type="text" class="form-control" id="" name="question" placeholder="Question" value="{{ old('question') }}">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Answer</label>
                  <textarea name="answer" class="textarea" placeholder="Answer" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                     {{ old('answer') }}
                  </textarea>  
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

  <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
   // CKEDITOR.replace('editor1');
  
    $(".textarea").wysihtml5();
  });
</script>
@endsection	