  <section class="content" >
       
	
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
              <h3 class="box-title"><i class="fa fa-list"></i> Role List</h3>
              <!--<div class="pull-right"> <a href="javascript:void(0);" ng-click="add()" ng-init="success_flash=false" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a></div>-->
            </div>
            <!-- /.box-header -->

            <div class="box-body">
		  <div class="col-xs-12 main--tab" >
		  <div class="col-md-2">
			 <ul class="nav nav-pills nav-stacked">
			     <li ng-class="{ active: isSet(val.id) }" data-toggle="pill" ng-repeat="val in roles"><a href ng-click="setTab(val.id)" ><%val.name%></a></li>
			 </ul>
		  </div>
	      <div class="col-md-8">
		  <div class="jumbotron">
		   <div ng-repeat="ro in roles" ng-show="isSet(ro.id)">
			
			    <table id="example1" class="table table-bordered table-striped">
			      <thead><tr>
			      <th>Action</th>
			      <th>Select New Setting</th>
			      <th>Calculated Setting</th>
			      </tr></thead>
			      <tbody>
				    <tr>
					 <td>Site Login</td>
					 <td>
					  <select ng-model="setting.site_login_setting[ro.id]">
						<option ng-value="0">Inherited</option>
					 <option ng-value="1" ng-selected="ro.setting.site_login_setting==1">Allowed</option>
					 <option ng-value="0" ng-selected="ro.setting.site_login_setting==0">Not Allowed</option>
					  </select></td>
					 <td><span ng-show="ro.setting.site_login_setting==1" class="label label-success">Allowed</span><span ng-show="ro.setting.site_login_setting==0" class="label label-danger">Not Allowed</span></td>
				    </tr>
					 <tr><td>Admin Login</td>
					  <td><select ng-model="setting.admin_login_setting[ro.id]">
						<option ng-value="0">Inherited</option>
					 <option ng-value="1" ng-selected="ro.setting.admin_login_setting==1">Allowed</option>
					 <option ng-value="0" ng-selected="ro.setting.admin_login_setting==0">Not Allowed</option>
					  </select></td>
					  <td><span ng-show="ro.setting.admin_login_setting==1" class="label label-success">Allowed</span><span ng-show="ro.setting.admin_login_setting==0" class="label label-danger">Not Allowed</span></td></tr>
					 <tr><td>Create</td>
					  <td><select ng-model="setting.create_setting[ro.id]">
						<option ng-value="0">Inherited</option>
					 <option ng-value="1" ng-selected="ro.setting.create_setting==1">Allowed</option>
					 <option ng-value="0" ng-selected="ro.setting.create_setting==0">Not Allowed</option>
					  </select></td>
					  <td><span ng-show="ro.setting.create_setting==1" class="label label-success">Allowed</span><span ng-show="ro.setting.create_setting==0" class="label label-danger">Not Allowed</span></td></tr>
					 <tr><td>Delete</td>
					  <td><select ng-model="setting.delete_setting[ro.id]">
						<option ng-value="0">Inherited</option>
					 <option ng-value="1" ng-selected="ro.setting.delete_setting==1">Allowed</option>
					 <option ng-value="0" ng-selected="ro.setting.delete_setting==0">Not Allowed</option>
					  </select></td>
					  <td><span ng-show="ro.setting.delete_setting==1" class="label label-success">Allowed</span><span ng-show="ro.setting.delete_setting==0" class="label label-danger">Not Allowed</span></td></tr>
					 <tr><td>Edit</td>
					  <td><select ng-model="setting.edit_setting[ro.id]">
						<option ng-value="0">Inherited</option>
					 <option ng-value="1" ng-selected="ro.setting.edit_setting==1">Allowed</option>
					 <option ng-value="0" ng-selected="ro.setting.edit_setting==0">Not Allowed</option>
					  </select></td>
					  <td><span ng-show="ro.setting.edit_setting==1" class="label label-success">Allowed</span><span ng-show="ro.setting.edit_setting==0" class="label label-danger">Not Allowed</span></td></tr>
					 <!--<tr><td>Edit State</td>
					  <td><select ng-model="setting.edit_state_setting[ro.id]">
						<option ng-value="0">Inherited</option>
					 <option ng-value="1">Allowed</option>
					 <option ng-value="0">Not Allowed</option>
					  </select></td><td></td></tr>-->
					 <tr><td>Edit Own</td><td><select ng-model="setting.edit_own_setting[ro.id]">
						<option ng-value="0">Inherited</option>
					 <option ng-value="1" ng-selected="ro.setting.edit_own_setting==1">Allowed</option>
					 <option ng-value="0" ng-selected="ro.setting.edit_own_setting==0">Not Allowed</option>
					  </select></td><td><span ng-show="ro.setting.edit_own_setting==1" class="label label-success">Allowed</span><span ng-show="ro.setting.edit_own_setting==0" class="label label-danger">Not Allowed</span></td></tr>
				    </tr>
			      </tbody>
			    </table>
			    
		   </div>
		  
		  <div class="box-footer" >
                <button  ng-click="store(setting);" class="btn btn-primary">Submit</button>
				
              </div>
		  </div>
	      </div>
            </div>
            <!-- /.box-body -->
          
        </div>
	  </div>
        
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
        

       

    </section>
   
  <!-- /.content-wrapper -->
 
   
