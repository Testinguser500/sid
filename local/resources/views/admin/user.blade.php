

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
				  <th>Role</th>
				  <th>Status</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                
                <tr ng-repeat="val in users">
                  <td><% val.id %></td>
                  <td><% val.name %></td>
                  <td><% val.email %></td>
				  <td><% val.role_name %></td>
				  <td><% val.status %></td>
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
                            Are you sure you want to delete this user ? 
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
                  <input type="hidden" class="form-control" id="" name="user_id" ng-model="user_ddata.id" placeholder="Name" value="<% user_ddata.userid %>">
              <div class="box-body">
			  <div class="form-group">
			  <h3>Personal Info</h3>
			  </div>
			  <div class="row">
			  <div class="form-group col-xs-4">
			  
                  <label for="exampleInputEmail1">Role</label>
                  <select class="form-control" id="" name="role" ng-model="user_ddata.role" >
				  <option value="">select role</option>
				  <option ng-repeat="rol in roles" ng-value="rol.id" ng-selected="user_ddata.role==rol.id"><%rol.name%></option>
				  
				  
				  </select>
		  <div class="help-block"></div>
                </div>
				
                <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" ng-model="user_ddata.name"  value="<%user_ddata.name%>">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control" id="" name="username" placeholder="Username" ng-model="user_ddata.username"  value="<%user_ddata.name%>">
		  <div class="help-block"></div>
                </div>
				</div>
				<div class="row">
			<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Nickname</label>
                  <input type="text" class="form-control" id="" name="nickname" placeholder="Nickname" ng-model="user_ddata.nickname" >
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Gender</label>
                  <select class="form-control" id="" name="gender" ng-model="user_ddata.gender">
				  <option value="">Select Gender</option>
				  <option value="male" ng-selected="user_ddata.gender=='male'">Male</option>
				  <option value="female" ng-selected="user_ddata.gender=='female'">Female</option>
				  </select>
		  <div class="help-block"></div>
                </div>
				</div>
				
			<div class="form-group">
			  <h3>Contact Info</h3>
			  </div>
				<div class="row">			  
                <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Email(required)</label>
                  <input type="text" class="form-control" id="" name="email" placeholder="Email" ng-model="user_ddata.email">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Mobile</label>
                  <input type="text" class="form-control" id="" name="mobile" placeholder="Mobile" ng-model="user_ddata.mobile">
		  <div class="help-block"></div>
                </div>
				
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Website</label>
                  <input type="text" class="form-control" id="" name="website" placeholder="Website" ng-model="user_ddata.website">
		  <div class="help-block"></div>
                </div>
				</div>
				<div class="form-group">
			  <h3>About the user</h3>
			  </div>
			  <div class="row">
			  <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Biographical Info</label>
                  <textarea type="text" class="form-control" id="" name="bio" placeholder="Biographical Info" ng-model="user_ddata.bio"></textarea>
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" class="form-control" id="" name="password" placeholder="Password" ng-model="user_ddata.pass">
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Confirm Password</label>
                  <input type="password" class="form-control" id="" name="repassword" placeholder="Confirem password" ng-model="user_ddata.repassword">
				<div class="help-block"></div>
                </div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Nationality</label>
                  <input type="text" class="form-control" id="" name="nationality" placeholder="Nationality" ng-model="user_ddata.nationality">
				<div class="help-block"></div>
                </div>
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Country</label>
                  <select class="form-control" id="" name="country" placeholder="Country" ng-model="user_ddata.country">
				  <option value="">Select Country</option>
				  <option ng-repeat="con in country" ng-value="con.name" ng-selected="con.id==user_ddata.country"><%con.name%></option>
				  
				  </select>
				<div class="help-block"></div>
                </div>

				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="address" ng-model="user_ddata.address"></textarea>
		  <div class="help-block"></div>
                </div>
				</div>
				<div class="row">
                <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1"> Profile Image</label>
                  <input type="file"  name="image" ng-model="user_ddata.image" onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>
                </div>
				</div>
				<div ng-hide="user_ddata.role!='5'">
				<div class="form-group ">
			  <h3>Store Info</h3>
			  </div>
			  <div class="row">
			<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Store Name</label>
				  <input type="" class="form-control" id="" name="store_id" ng-model="user_ddata.store_id">
				  
                  <input type="text" class="form-control" id="" name="store_name" placeholder="Store Name" ng-model="user_ddata.store_name">
		  <div class="help-block"></div>
                </div>
                  <div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Store Link</label>
                  <input type="text" class="form-control" id="" name="store_link" placeholder="Store Link" ng-model="user_ddata.store_link">
		  <div class="help-block"></div>
                </div>
                 <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1"> Banner</label>
                  <input type="file"  name="store_banner" ng-model="user_ddata.store_banner" onchange="angular.element(this).scope().uploadedBannerFile(this)">
		  <div class="help-block"></div>
                </div>
                  
				</div>
				<div class="row">
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Country</label>
                  <select class="form-control" id="" name="store_country" placeholder="Country" ng-model="user_ddata.store_country" ng-change="getState(user_ddata.store_country);">
				  <option value="">Select Country</option>
				  <option ng-repeat="con in country" ng-value="con.id" ng-selected="user_ddata.store_country==con.id"><%con.name%></option>
				  </select>
				
                </div>
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">State</label>
                  <select class="form-control" id="" name="state" ng-model="user_ddata.store_state" ng-change="getCity(user_ddata.store_state);">
				  <option value="">Select State</option>
				  <option ng-repeat="st in store_state" ng-value="st.id" ng-selected="user_ddata.store_state==st.id"><%st.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">City</label>
                  <select class="form-control" id="" name="city" ng-model="user_ddata.store_city">
				  <option value="">Select City</option>
				  <option ng-repeat="ct in store_city" ng-value="ct.id" ng-selected="user_ddata.store_city==ct.id"><%ct.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Store Address</label>
                  <textarea class="form-control" id="" name="store_address" ng-model="user_ddata.store_address"></textarea>
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Phone</label>
                  <input type="text" class="form-control" id="" name="store_phone" placeholder="Phone" ng-model="user_ddata.phone">
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Facebook Link</label>
                  <input type="text" class="form-control" id="" name="facebook_link" placeholder="Facebook Link" ng-model="user_ddata.facebook_link">
		  <div class="help-block"></div>
                </div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Google Plus Link</label>
                  <input type="text" class="form-control" id="" name="google_plus_link" placeholder="Google Plus Link" ng-model="user_ddata.google_link">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Twitter Link</label>
                  <input type="text" class="form-control" id="" name="twitter_link" placeholder="Twitter Link" ng-model="user_ddata.twitter_link">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">LinkedIn Link</label>
                  <input type="text" class="form-control" id="" name="linkedin_link" placeholder="LinkedIn Link" ng-model="user_ddata.linkedin_link">
		  <div class="help-block"></div>
                </div>
				</div>
				
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Youtube Link</label>
                  <input type="text" class="form-control" id="" name="youtube_link" placeholder="Youtube Link" ng-model="user_ddata.youtube_link">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Instagram Link</label>
                  <input type="text" class="form-control" id="" name="instagram_link" placeholder="Instagram Link" ng-model="user_ddata.instagram_link">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Flickr Link</label>
                  <input type="text" class="form-control" id="" name="flickr_link" placeholder="Flickr Link" ng-model="user_ddata.flickr_link">
		  <div class="help-block"></div>
                </div>
				</div>
				
				
				
				</div>
				<div ng-show="user_ddata.role=='3'">	
                <div class="form-group">
			  <h3>Shipping Address</h3>
			  </div>
			  <div class="row">
			  <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Name</label>
				  <input type="" class="form-control" id="" name="shipp_id" ng-model="user_ddata.shipp_id">
				  
                  <input type="text" class="form-control" id="" name="ship_name" placeholder="Name" ng-model="user_ddata.ship_name">
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Mobile</label>
                  <input type="text" class="form-control" id="" name="ship_mobile" placeholder="Mobile" ng-model="user_ddata.ship_mobile">
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="ship_address" placeholder="Address" ng-model="user_ddata.ship_address"></textarea>
				<div class="help-block"></div>
                </div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Country</label>
                  <select class="form-control" id="" name="ship_country" placeholder="Country" ng-model="user_ddata.ship_country" ng-change="getState(user_ddata.ship_country);">
				  <option value="">Select Country</option>
				  <option ng-repeat="con in country" ng-value="con.id"><%con.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">State</label>
                  <select class="form-control" id="" name="ship_state" placeholder="Country" ng-model="user_ddata.ship_state" ng-change="getCity(user_ddata.ship_state);">
				  <option value="">Select State</option>
				  <option ng-repeat="st in store_state" ng-value="st.id"><%st.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">City</label>
                  <select class="form-control" id="" name="ship_city" placeholder="Country" ng-model="user_ddata.ship_city">
				  <option value="">Select City</option>
				  <option ng-repeat="ct in store_city" ng-value="ct.id"><%ct.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				</div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
				<label for="exampleInputEmail1">Status </label>
				<input type="radio"  id="" name="status" value="Active" ng-model="user_ddata.status">Active <input type="radio" id="" name="status" value="Inactive" ng-model="user_ddata.status" >Inactive 
				<div class="help-block"></div>
                </div> 
				</div>
				
            
			 </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(user_ddata)" ng-click="update(user_ddata);" class="btn btn-primary">Update</button>
				<button ng-show="loading" class="btn btn-primary">Loading...</button>
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
			  <h3>Personal Info</h3>
			  </div>
			  <div class="row">
			  <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Role</label>
                  <select class="form-control" id="" name="role" ng-model="user.role" ng-init="user.role">
				  <option value="">select role</option>
				  <option value="1">Administration</option>
				  <option value="2">Shop Manager</option>
				  <option value="3">Customer</option>
				  <option value="4">Courier</option>
					<option value="5">Seller</option>
				  
				  </select>
		  <div class="help-block"></div>
                </div>
				
                <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" ng-model="user.name" ng-init="user.name">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control" id="" name="username" placeholder="Username" ng-model="user.username" ng-init="user.username">
		  <div class="help-block"></div>
                </div>
				</div>
				<div class="row">
			<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Nickname</label>
                  <input type="text" class="form-control" id="" name="nickname" placeholder="Nickname" ng-model="user.nickname" ng-init="user.nickname">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Gender</label>
                  <select class="form-control" id="" name="gender" ng-model="user.gender">
				  <option value="">Select Gender</option>
				  <option value="male" ng-selected="user.gender=='male'">Male</option>
				  <option value="female" ng-selected="user.gender=='female'">Female</option>
				  </select>
		  <div class="help-block"></div>
                </div>
				</div>
				
			<div class="form-group">
			  <h3>Contact Info</h3>
			  </div>
				<div class="row">			  
                <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Email(required)</label>
                  <input type="text" class="form-control" id="" name="email" placeholder="Email" ng-model="user.email">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Mobile</label>
                  <input type="text" class="form-control" id="" name="mobile" placeholder="Mobile" ng-model="user.mobile">
		  <div class="help-block"></div>
                </div>
				
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Website</label>
                  <input type="text" class="form-control" id="" name="website" placeholder="Website" ng-model="user.website">
		  <div class="help-block"></div>
                </div>
				</div>
				<div class="form-group">
			  <h3>About the user</h3>
			  </div>
			  <div class="row">
			  <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Biographical Info</label>
                  <textarea type="text" class="form-control" id="" name="bio" placeholder="Biographical Info" ng-model="user.bio"></textarea>
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" class="form-control" id="" name="password" placeholder="Password" ng-model="user.password">
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Confirm Password</label>
                  <input type="password" class="form-control" id="" name="repassword" placeholder="Confirem password" ng-model="user.repassword">
				<div class="help-block"></div>
                </div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Nationality</label>
                  <input type="text" class="form-control" id="" name="nationality" placeholder="Nationality" ng-model="user.nationality">
				<div class="help-block"></div>
                </div>
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Country</label>
                  <select class="form-control" id="" name="country" placeholder="Country" ng-model="user.country">
				  <option value="">Select Country</option>
				  <option ng-repeat="con in country" ng-value="con.name"><%con.name%></option>
				  
				  </select>
				<div class="help-block"></div>
                </div>

				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="address" ng-model="user.address"></textarea>
		  <div class="help-block"></div>
                </div>
				</div>
				<div class="row">
                <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1"> Profile Image</label>
                  <input type="file"  name="image" ng-model="user.image" onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>
                </div>
				</div>
				<div ng-hide="user.role!='5'">
				<div class="form-group ">
			  <h3>Store Info</h3>
			  </div>
			  <div class="row">
			<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Store Name</label>
                  <input type="text" class="form-control" id="" name="store_name" placeholder="Store Name" ng-model="user.store_name">
		  <div class="help-block"></div>
                </div>
                  <div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Store Link</label>
                  <input type="text" class="form-control" id="" name="store_link" placeholder="Store Link" ng-model="user.store_link">
		  <div class="help-block"></div>
                </div>
                 <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1"> Banner</label>
                  <input type="file"  name="store_banner" ng-model="user.store_banner" onchange="angular.element(this).scope().uploadedBannerFile(this)">
		  <div class="help-block"></div>
                </div>
                  
				</div>
				<div class="row">
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Country</label>
                  <select class="form-control" id="" name="store_country" placeholder="Country" ng-model="user.store_country" ng-change="getState(user.store_country);">
				  <option value="">Select Country</option>
				  <option ng-repeat="con in country" ng-value="con.id"><%con.name%></option>
				  </select>
				
                </div>
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">State</label>
                  <select class="form-control" id="" name="state" ng-model="user.store_state" ng-change="getCity(user.store_state);">
				  <option value="">Select State</option>
				  <option ng-repeat="st in store_state" ng-value="st.id"><%st.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">City</label>
                  <select class="form-control" id="" name="city" ng-model="user.store_city">
				  <option value="">Select City</option>
				  <option ng-repeat="ct in store_city" ng-value="ct.id"><%ct.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Store Address</label>
                  <textarea class="form-control" id="" name="store_address" ng-model="user.store_address"></textarea>
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Phone</label>
                  <input type="text" class="form-control" id="" name="store_phone" placeholder="Phone" ng-model="user.store_phone">
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Facebook Link</label>
                  <input type="text" class="form-control" id="" name="facebook_link" placeholder="Facebook Link" ng-model="user.facebook_link">
		  <div class="help-block"></div>
                </div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Google Plus Link</label>
                  <input type="text" class="form-control" id="" name="google_plus_link" placeholder="Google Plus Link" ng-model="user.google_plus_link">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Twitter Link</label>
                  <input type="text" class="form-control" id="" name="twitter_link" placeholder="Twitter Link" ng-model="user.twitter_link">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">LinkedIn Link</label>
                  <input type="text" class="form-control" id="" name="linkedin_link" placeholder="LinkedIn Link" ng-model="user.linkedin_link">
		  <div class="help-block"></div>
                </div>
				</div>
				
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Youtube Link</label>
                  <input type="text" class="form-control" id="" name="youtube_link" placeholder="Youtube Link" ng-model="user.youtube_link">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Instagram Link</label>
                  <input type="text" class="form-control" id="" name="instagram_link" placeholder="Instagram Link" ng-model="user.instagram_link">
		  <div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Flickr Link</label>
                  <input type="text" class="form-control" id="" name="flickr_link" placeholder="Flickr Link" ng-model="user.flickr_link">
		  <div class="help-block"></div>
                </div>
				</div>
				
				
				
				</div>
				<div ng-show="user.role=='3'">	
                <div class="form-group">
			  <h3>Shipping Address</h3>
			  </div>
			  <div class="row">
			  <div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="ship_name" placeholder="Name" ng-model="user.ship_name">
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Mobile</label>
                  <input type="text" class="form-control" id="" name="ship_mobile" placeholder="Mobile" ng-model="user.ship_mobile">
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="ship_address" placeholder="Address" ng-model="user.ship_address"></textarea>
				<div class="help-block"></div>
                </div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Country</label>
                  <select class="form-control" id="" name="ship_country" placeholder="Country" ng-model="user.ship_country" ng-change="getState(user.ship_country);">
				  <option value="">Select Country</option>
				  <option ng-repeat="con in country" ng-value="con.id"><%con.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">State</label>
                  <select class="form-control" id="" name="ship_state" placeholder="Country" ng-model="user.ship_state" ng-change="getCity(user.ship_state);">
				  <option value="">Select State</option>
				  <option ng-repeat="st in store_state" ng-value="st.id"><%st.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">City</label>
                  <select class="form-control" id="" name="ship_city" placeholder="Country" ng-model="user.ship_city">
				  <option value="">Select City</option>
				  <option ng-repeat="ct in store_city" ng-value="ct.id"><%ct.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				</div>
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
				<label for="exampleInputEmail1">Status </label>
				<input type="radio"  id="" name="status" value="Active" ng-model="user.status">Active <input type="radio" id="" name="status" value="Inactive" ng-model="user.status" ng-init="user.status='Inactive'">Inactive 
				<div class="help-block"></div>
                </div> 
				</div>
				<div class="box-footer">
                <button ng-hide="loading" ng-click="store(user);" class="btn btn-primary">Submit</button>
				<button ng-show="loading" class="btn btn-primary">Loading...</button>
              </div>
            
			 </div>
		  </div>
    </section>
   
  <!-- /.content-wrapper -->
