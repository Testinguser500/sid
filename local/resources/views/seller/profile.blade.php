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
        <div class="box" ng-if="page=='index'">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Store Setting</h3>
              
            </div>
            <div class="box-body">
            
            
            <div class="row">
			<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">First Name</label>
                  
		    <input type="hidden" class="form-control" id="" name="id" ng-model="seller.id">
				  
                  <input type="text" class="form-control" id="" name="fname" placeholder="First Name" ng-model="seller.fname" value="<%seller.fname%>">
		  <div class="help-block"></div>
                </div>
                  <div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Last Name</label>
                  <input type="text" class="form-control" id="" name="lname" placeholder="Last Link" ng-model="seller.lname">
		  <div class="help-block"></div>
                </div>
                  
				</div>
				
		<div class="row">
		
		<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" id="" name="email" placeholder="Email" ng-model="seller.email">
				
                </div>
			</div>
			<div class="form-group">
				<h3>Password Change</h3>
			</div>
		<div class="row">	
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Current Password (leave blank to leave unchanged)</label>
                  <input type="password" class="form-control" id="" name="pass" placeholder="Password" ng-model="seller.current_password">
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">New Password (leave blank to leave unchanged)</label>
                  <input type="password" class="form-control" id="" name="new_password" placeholder="New Password" ng-model="seller.new_password">
				<div class="help-block"></div>
                            </div>
		    </div>
		<div class="row">
		
		<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Confirm New Password</label>
                  <input type="password" class="form-control" id="" name="confirm_new_password" placeholder="Confirm New Password" ng-model="seller.confirm_new_password">
				<div class="help-block"></div>
                </div>   
            
                </div>
                
                <div class="box-footer">
                <button ng-click="update(seller)" ng-hide="loading" class="btn btn-primary">Update</button>
				<button ng-show="loading" class="btn btn-primary">Loading...</button>
              </div>
            
        </div>