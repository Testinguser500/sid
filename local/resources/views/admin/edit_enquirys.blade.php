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
                <h3 class="box-title"><i class="fa fa-reply"></i> Enquiry Reply</h3>
                <div class="pull-right"> <a href="{{ url('admin/enquiry')}}" class="btn btn-default">Back</a></div>
            </div>
              <table class="table table-bordered table-striped">
                  <tr>
                      <td>Name</td>
                      <td>{{ $enquirys->name }}</td>
                  </tr>
                  <tr>
                      <td>E-mail</td>
                      <td>{{ $enquirys->email }}</td>
                  </tr>
                  <tr>
                      <td>Subject</td>
                      <td>{{ $enquirys->subject }}</td>
                  </tr>
                   <tr>
                      <td>Message</td>
                      <td>{{ $enquirys->message }}</td>
                  </tr>
              </table>
            <!-- /.box-header -->
            @if($replys>0)
                @foreach($replys as $val)
                    <div class="col-md-12">
                         <div class="box box-default box-solid collapsed-box">
                          <div class="box-header with-border bg-aqua ">
                              <h3 class="box-title"><i class="fa fa-reply" title="Reply"></i> </h3>

                            <div class="box-tools pull-right">
                                 
                              <button data-widget="collapse" class="btn btn-box-tool" type="button">{{ $val->created_at }}
                              </button>
                            </div>
                            <!-- /.box-tools -->
                          </div>

                          <!-- /.box-header -->
                          <div class="box-body" style="display: none;">
                           {!! $val->message !!}
                          </div>
                          <!-- /.box-body -->
                        </div>
                    </div>
                @endforeach
           @endif
           
            <form role="form" action="{{url('/admin/enquiry/update')}}" method="post" enctype= "multipart/form-data">
            <div class="box-body">
                
                 {{ csrf_field() }}
                 <input type="hidden" name="reply_to" value="{{ $enquirys->id }}"/>
                 <input type="hidden" name="email" value="{{ $enquirys->email }}"/>
                 <input type="hidden" name="subject" value="{{ $enquirys->subject }}"/>
                 <input type="hidden" name="name" value="{{ $enquirys->name }}"/>
                 <textarea name="reply" class="textarea" placeholder="Reply" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea> 
                 
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Send</button>
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