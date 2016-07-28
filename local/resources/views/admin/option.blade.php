
    <!-- Main content -->
    <section class="content">
       
	 <div class="alert alert-success" ng-if="success_flash">
            <p >
            <% success_flash %>
            </p>
        </div>
        <div class="alert alert-danger"  ng-if="errors">
            <ul>
                <li ng-repeat ="er in errors"><% er %></li>
         
            </ul>
        </div> 
          <!-- /.box -->
         
          <div class="box" ng-if="page=='index'">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Option List</h3>
              <div class="pull-right"> <a href="javascript:void(0)" ng-click="add();"class="btn btn-primary"><i class="fa fa-plus"></i> Add</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Option Name</th>
                  <th>Status</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                
                <tr ng-repeat="val in options"> 
                  <td><% val.id %></td>
                  <td><% val.option_name %></td>
                  <td><% val.status %></td>
                  <td><a href="javascript:void(0);" ng-click="editoption(val)"><i class="fa fa-edit" title="Edit"></i></a>
		  <i class="fa fa-trash" title ="Delete" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
                 
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this faq question ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button type="submit" class="btn btn-primary" data-dismiss="modal" ng-click="deleteoption($index)" >Delete</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  
                </tr>
              
                </tbody>
                <tfoot>
                 <tr>
                  <th>#</th>
                  <th>Option Name</th>
                  <th>Status</th>
                  <th> </th>                 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Create FAQ Questions</h3>
                <div class="pull-right"> <a href="javascript:void(0);" ng-click="init();" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Option Name</label>
                  <input type="text" class="form-control" id="" name="option_name" placeholder="Question" ng-model="option.option_name">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1" ng-init="option.status='Active'" >Status </label>
                  <input type="radio" ng-model="option.status" ng-checked="option.status" id="" name="status"  value="Active">Active <input ng-model="option.status" type="radio" id="" name="status" value="Inactive" checked>Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="store(option)" type="submit" class="btn btn-primary">Submit</button>
              </div>
            
          </div>
        
          <!-- /.box -->
         <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='edit'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit Option</h3>
                 <div class="pull-right"> <a href="javascript:void(0)" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          
             <input type="hidden" class="form-control" id="" ng-model="option.id" name="option_id" placeholder="ID" >
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Option Name</label>
                  <input type="text" class="form-control" id=""  ng-model="option.option_name" name="option_name" placeholder="Option Name" >
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Option Name</label>
		  <input type="text" class="form-control" id=""  ng-model="option.option_value" name="option_value" placeholder="Option Value" >
		  <div class="help-block"></div>
                </div>                
                 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active"  ng-model="option.status">Active <input type="radio" id="" name="status"  ng-model="option.status" value="Inactive">Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(option)" type="submit" class="btn btn-primary">Submit</button>
              </div>
           
          </div>



          <!-- Form Element sizes -->
         

      

    </section>
   
  <!-- /.content-wrapper -->
  