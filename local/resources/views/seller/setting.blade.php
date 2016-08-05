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
              <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <div class="box-body">
            <div class=" banner">
			  <label for="exampleInputEmail1"> Banner</label>
			  <div class="form-group col-xs-12 show-bn">
                <img ng-mouseleave="display_cross=0" ng-mouseover="display_cross=1" ng-show="store_data.banner" src="{{URL::asset('uploads/store_banner')}}/thumb_<% store_data.banner %>" height="300" width="825">  
                  <span ng-hide="store_data.banner" class="btn btn-primary btn-file">
					Upload <input type="file" ng-model="store_data.store_banner" onchange="angular.element(this).scope().uploadedBannerFile(this)">
				</span>
				<em>Upload a banner for your store. Banner size is(1300x400) and not  more than 1 mb.</em>
				<a href="javascript:void(0);" ng-click="delBanner(store_data.banner);display_cross=0" title="Delete" class="bnr-del" ng-mouseleave="display_cross=0" ng-mouseover="display_cross=1" ng-show="display_cross==1"><img src="{{URL::asset('admin/img/del.png')}}"></a>
				  
		  <div class="help-block"></div>
                </div>
			  
			  
	    </div>
            
            <div class="row">
			<div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Store Name</label>
                  
		    <input type="hidden" class="form-control" id="" name="store_id" ng-model="store_data.id">
				  
                  <input type="text" class="form-control" id="" name="store_name" placeholder="Store Name" ng-model="store_data.store_name" value="<%store_data.store_name%>">
		  <div class="help-block"></div>
                </div>
                  <div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Store Link</label>
                  <input type="text" class="form-control" id="" name="store_link" placeholder="Store Link" ng-model="store_data.store_link">
		  <div class="help-block"></div>
                </div>
                  
				</div>
				<div class="row">
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1"> Store Logo</label>
                  <span  class="btn btn-primary btn-file">
					Upload<input type="file"  name="store_logo" ng-model="store_data.store_logo" onchange="angular.element(this).scope().uploadlogo(this)">
					</span>
		  <div class="help-block"></div>
                </div>
				<div ng-if="store_data.logo" class="form-group col-xs-4">
				<img src="{{URL::asset('uploads/store_logo')}}/thumb_<%store_data.logo%>">
				<a href="javascript:void(0);" ng-click="removelogo();"><i class="fa fa-trash"></i></a>
				</div>
				</div>
				<div class="row">
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Country</label>
                  <select class="form-control" id="" name="store_country" placeholder="Country" ng-model="store_data.store_country" ng-change="getState(store_data.store_country,'store');">
				  <option value="">Select Country</option>
				  <option ng-repeat="con in country" ng-value="con.id" ng-selected="store_data.store_country==con.id"><%con.name%></option>
				  </select>
				
                </div>
				
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">State</label>
                  <select class="form-control" id="" name="state" ng-model="store_data.store_state" ng-change="getCity(store_data.store_state,'store');">
				  <option value="">Select State</option>
				  <option ng-repeat="st in store_state" ng-value="st.id" ng-selected="store_data.store_state==st.id"><%st.name%></option>
				  </select>
				<div class="help-block"></div>
                </div>
				<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">City</label>
                  <select class="form-control" id="" name="city" ng-model="store_data.store_city">
				  <option value="">Select City</option>
				  <option ng-repeat="ct in store_city" ng-value="ct.id" ng-selected="store_data.store_city==ct.id"><%ct.name%></option>
				  </select>
				<div class="help-block"></div>
                            </div>
		    </div>
		<div class="row">
		<div class="form-group col-xs-4">
                  <label for="exampleInputEmail1">Store Address</label>
                  <textarea class="form-control" id="" name="store_address" ng-model="store_data.store_address"><%store_data.store_address%></textarea>
				<div class="help-block"></div>
                </div>
		    <div class="form-group col-xs-4">
                  <label for="exampleInputMobile">Phone</label>
                  <input type="text" class="form-control" id="" name="store_phone" placeholder="Phone" ng-model="store_data.phone">
		  <div class="help-block"></div>
                </div>
            
                </div>
                
                <div class="box-footer">
                <button ng-click="update(store_data)" ng-hide="loading" class="btn btn-primary">Update</button>
				<button ng-show="loading" class="btn btn-primary">Loading...</button>
              </div>
            
        </div>