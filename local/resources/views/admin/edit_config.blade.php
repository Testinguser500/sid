@extends('admin/layout')
@section('content')

    <!-- Main content -->
    <section class="content">
       <div class="col-md-12">
	
          <!-- /.box -->
         @if(count($configs)>0)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-edit"></i> Configuration Edit</h3>
             <div class="pull-right"> <a href="{{ url('admin/config')}}" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <form action="{{url('/admin/config/update')}}"  method="post">
                 {{ csrf_field() }}
            <div class="box-body">
              <table  class="table table-bordered table-striped">
               
                <tbody>
                <?php foreach($configs as $val){ ?>
                <tr>
                   <td>{{ $val->key }}</td>                               
                   <td class="@if($errors->has("key_$val->id")) has-error @endif">
                       <input type="text" name="key_{{ $val->id }}" value="{{ $val->value }}" class="form-control"/>
                       <div class="help-block"> @if($errors->has("key_$val->id")){{ $val->key }} must be filled. @endif</div>
                   </td> 
                </tr>
                <?php } ?>
                </tbody>
               
              </table>              
             
            </div>
            <!-- /.box-body -->
            <div class="box-body">
                <div class="pull-left"> 
                    <button class="btn btn-primary" type="submit">UPDATE</button>
                    
                </div> 
            </div>
            </form>
          </div>
         
         @endif
          <!-- /.box -->
      
          <!-- Form Element sizes -->

        </div>

    </section>
   
  <!-- /.content-wrapper -->
 
@endsection	