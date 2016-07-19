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
            @if(count($configs)>0)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Configuration List</h3>
              <div class="pull-right"> <a href="{{ url('admin/config/edit')}}" class="btn btn-primary"><i class="fa fa-edit"></i> EDIT</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table  class="table table-bordered table-striped">
               
                <tbody>
                <?php foreach($configs as $val){ ?>
                <tr>
                   <td>{{ $val->key }}</td>                               
                   <td>{{ $val->value }}</td> 
                </tr>
                <?php } ?>
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
         @endif
          <!-- /.box -->
         <!-- Form Element sizes -->
   
        </div>

    </section>
   
  <!-- /.content-wrapper -->
 
@endsection	