  <section class="content" >
       <div class="col-md-12">
	@if(Session::has('flash_message'))
        <div class="alert alert-success">
            <p >
            {{ Session::get('flash_message') }}
            </p>
        </div>
       @endif   
          <!-- /.box -->
            @if(count($categories)>0)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Category List</h3>
              <div class="pull-right"> <a href="{{ url('admin/category/add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Category Name</th>
                  <th>Category Status</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                <?php foreach($categories as $val){ ?>
                <tr>
                  <td>{{ $val->id }}</td>
                  <td>{{ $val->category_name }}</td>
                  <td>{{ $val->status }}</td>
                  <td><a href="{{url('/admin/category/edit') }}/{{ $val->id }}"><i class="fa fa-edit" title="Edit" ></i> </a><i class="fa fa-trash" title ="Delete" style="cursor:pointer" data-toggle="modal" data-target="#del_modal{{ $val->id }}"></i>
                 
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal{{  $val->id  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this category ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <form action = "{{url('/admin/category/delete')}}" method="post">
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
                  <th>Category Name</th>
                  <th>Category Status</th>
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