@extends('admin/layout')
@section('content')

    <!-- Main content -->
    <section class="content">
       <div class="col-md-12">
	@if(Session::has('flash_message'))
        <div class="alert alert-success">
            <p >
            {{ Session::get('flash_message') }}
            </p>
        </div>
       @endif   
          <!-- /.box -->
            @if(count($enquirys)>0)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Enquiry List</h3>
             
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Enquiry Name</th>
                  <th>Enquiry E-mail</th>
                  <th>Enquiry Subject</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                <?php foreach($enquirys as $val){ ?>
                <tr>
                  <td>{{ $val->id }}</td>
                  <td>{{ $val->name }}</td>
                  <td>{{ $val->email }}</td>
                  <td>{{ $val->subject }}</td>
                  <td>
                      <a href="{{url('/admin/enquiry/edit') }}/{{ $val->id }}"><i class="fa fa-reply" title="Reply" ></i></a>
                      <i class="fa fa-trash" style="cursor:pointer" data-toggle="modal" title="Delete"  data-target="#del_modal{{ $val->id }}"></i>
                      
                    <div class="modal fade" id="del_modal{{  $val->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this Enquiry ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <form action = "{{url('/admin/enquiry/delete')}}" method="post">
                                  {{ csrf_field() }}
                               <input type="hidden" name="del_id" value="{{  $val->id  }}" />
                               <button type="submit" class="btn btn-primary" >Delete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>

                  
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                 <tr>
                  <th>#</th>
                  <th>Enquiry Name</th>
                  <th>Enquiry E-mail</th>
                  <th>Enquiry Subject</th>
                  <th> </th>                 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
         @endif
          <!-- /.box -->
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
         

        </div>

    </section>
   
  <!-- /.content-wrapper -->
   <script>
    $(function () {
    $("#example1").DataTable();
    
   
  });
 </script>
@endsection	