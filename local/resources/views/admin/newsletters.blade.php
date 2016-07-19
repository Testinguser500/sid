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
            @if(count($newsletters)>0)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Newsletter List</h3>
             
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Newsletter Name</th>
                  <th>Newsletter Status</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                <?php foreach($newsletters as $val){ ?>
                <tr>
                  <td>{{ $val->id }}</td>
                  <td>{{ $val->name }}</td>
                  <td>@if($val->subscribe=='1') Subscribe @else Unsubscribe @endif</td>
                  <td>
                  <i title="View" class="fa fa-eye" style="cursor:pointer" data-toggle="modal" data-target="#view_modal{{ $val->id }}"></i>
                  <i title="Edit"  class="fa fa-edit" style="cursor:pointer" data-toggle="modal" data-target="#edit_modal{{ $val->id }}"></i>  
                  <i title="Delete" class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal{{ $val->id }}"></i>
                  <!-- Modal -->
                    <div class="modal fade" id="view_modal{{  $val->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">View</h4>
                          </div>
                          <div class="modal-body">
                              <table  class="table table-bordered table-striped">
                                  <tr>
                                      <td> Name </td>
                                      <td> {{  $val->name  }} </td>                                      
                                  </tr> 
                                  <tr>
                                      <td> Email </td>
                                      <td> {{  $val->email  }} </td> 
                                  </tr>
                                  <tr>
                                      <td> Mobile No. </td>
                                      <td> {{  $val->mob_no  }} </td>
                                  </tr>
                                  <tr>
                                      <td> Occupation </td>
                                      <td> {{  $val->occupation  }} </td> 
                                  </tr>
                                  <tr>
                                      <td> City </td>
                                      <td> {{  $val->city  }} </td>
                                  </tr>
                                   <tr>
                                      <td> Gender </td>
                                      <td> {{  ucfirst($val->gender)  }} </td>
                                  </tr>
                                   <tr>
                                      <td> Subscribe </td>
                                      <td> @if($val->subscribe=='1') Subscribe @else Unsubscribe @endif</td>
                                  </tr>
                              </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                   <!-- Modal -->
                    <div class="modal fade" id="edit_modal{{  $val->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                         <form action = "{{url('/admin/newsletter/update')}}" method="post">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit</h4>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <label for="subscribe">Subscribe : </label>
                                <select class="form-control" name="subscribe">
                                    <option value="1"  @if($val->subscribe=='1') selected @endif >Subscribe</option>
                                    <option value="0"  @if($val->subscribe=='0') selected @endif >Unsubscribe</option>
                                </select>
                                
                                <div class="help-block"></div>
                              </div> 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                           
                                  {{ csrf_field() }}
                               <input type="hidden" name="edit_id" value="{{  $val->id  }}" />
                               <button type="submit" class="btn btn-primary" >Update</button>                            
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal{{  $val->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this newsletter ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <form action = "{{url('/admin/newsletter/delete')}}" method="post">
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
                  <th>Newsletter Name</th>
                  <th>Newsletter Status</th>
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