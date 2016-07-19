

    <!-- Main content -->
    <section class="content">
	@if(Session::has('flash_message'))
		<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ Session::get('flash_message') }}
              </div>
     
   @endif
       <div class="col-md-12">
	     
          <!-- /.box -->
            @if(count($users_data)>0)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> User List</h3>
			  <a class="add-link btn btn-success btn-flat btn-grid" href="#user/add"><i class="fa fa-plus-square"></i> Add User</a>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                <?php foreach($users_data as $val){ ?>
                <tr>
                  <td>{{ $val->id }}</td>
                  <td>{{ $val->name }}</td>
                  <td>{{ $val->email }}</td>
                  <td><a href="#user/edit/{{ $val->id }}"><i class="fa fa-edit" style="cursor:pointer"></i></a> <i class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal{{ $val->id }}"></i>
                 
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal{{  $val->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this user ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <form action = "{{url('/admin/user/delete')}}" method="post">
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
                  <th>User Name</th>
                  <th>Email</th>
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
