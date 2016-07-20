

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
       <div class="col-md-12">
	     
          <!-- /.box -->
            
          <div class="box" ng-if="page=='index'">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> User List</h3>
			  <a class="add-link btn btn-success btn-flat btn-grid" href="javascript:void(0);" ng-click="add()"><i class="fa fa-plus-square"></i> Add User</a>
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
                
                <tr ng-repeat="val in users">
                  <td><% val.id %></td>
                  <td><% val.name %></td>
                  <td><% val.email %></td>
                  <td><i ng-click="edituser(val)" class="fa fa-edit" style="cursor:pointer"></i> <i class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
                 
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this brand ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                                  {{ csrf_field() }}
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button data-dismiss="modal" ng-click="deleteUser($index)" class="btn btn-primary" >Delete</button>
                            
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
                  <th>User Name</th>
                  <th>Email</th>
                  <th> </th>                 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
       
          <!-- /.box -->
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
         

        </div>
<!--------------------------------------Edit User ----------------------->
<div class="box box-primary" ng-if="page=='edit'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit User</h3>
                 <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
                 {{ csrf_field() }}
                  <input type="hidden" class="form-control" id="" name="user_id" ng-model="user.id" placeholder="Name" value="<% category.id %>">
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" ng-model="user.name"  placeholder="Name" value="<% user.name %>">
		  <div class="help-block"></div>
                </div> 
                 
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" id="" name="email" ng-model="user.email" placeholder="Email" value="<% user.name %>">
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select class="form-control" id="" name="gender">
				  <option value="male" ng-selected="user.gender">Male</option>
				  <option value="female" ng-selected="user.gender">Female</option>
				  </select>
		  <div class="help-block"></div>
                </div>

				<div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="address" ng-model="user.address" ><% user.name %></textarea>
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <img class='' src="{{URL::asset('uploads/user/')}}/<% user.image %>" width="100">
                  <input type="file"  name="image" ng-model="user.image"  onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>
                </div> 
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" ng-model="user.status"  value="Active" ng-checked="user.status"   >Active <input type="radio" id="" name="status" value="Inactive" ng-model="user.status"  ng-checked="user.status" >Inactive
		  <div class="help-block"></div>
                </div>  
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(user)" class="btn btn-primary">Submit</button>
              </div>
            
          </div>
		  
		  <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Add User</h3>
                <div class="pull-right"><a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
		  <!------ Add User ---------------->
		  <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" ng-model="user.name" ng-init="user.name">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" id="" name="email" placeholder="Email" ng-model="user.email">
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select class="form-control" id="" name="gender" ng-model="user.gender">
				  <option value="male" ng-selected="user.gender">Male</option>
				  <option value="female" ng-selected="user.gender">Female</option>
				  </select>
		  <div class="help-block"></div>
                </div>

				<div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="address" ng-model="user.address"></textarea>
		  <div class="help-block"></div>
                </div>
				
                <div class="form-group">
                  <label for="exampleInputEmail1"> Image</label>
                  <input type="file"  name="image" ng-model="user.image" onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>
                </div> 
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active" ng-model="user.status">Active <input type="radio" id="" name="status" value="Inactive" ng-model="user.status" checked>Inactive 
		  <div class="help-block"></div>
                </div> 
				 </div>
				<div class="box-footer">
                <button ng-click="store(user);" class="btn btn-primary">Submit</button>
              </div>
            
			 </div>
		  
    </section>
   
  <!-- /.content-wrapper -->
