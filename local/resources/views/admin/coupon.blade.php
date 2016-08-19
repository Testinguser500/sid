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
              <h3 class="box-title"><i class="fa fa-list"></i> Coupon List</h3>
              <div class="pull-right"> <a href="javascript:void(0);" ng-click="add()" ng-init="success_flash=false" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a></div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
		  <div class="row">
                <div class="form-group col-md-2 pull-left">		  
		    <select ng-init="tb_pag=5" class="form-control" ng-model="tb_pag">
                        <option value="5" ng-selected="tb_pag==5">5</option>
                        <option value="10" ng-selected="tb_pag==10">10</option>
                        <option value="100" ng-selected="tb_pag==100">100</option>
                        <option value="1000" ng-selected="tb_pag==1000">1000</option>
                    </select>
		</div>
                <div class="form-group col-md-3 pull-right">		  
		  <input type="text" placeholder="Search" class="form-control ng-valid ng-dirty ng-valid-parse ng-touched" ng-model="search">
		</div>
              </div>
              <table    id="example1"   class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th ng-click="sort('id')" style="cursor:pointer">#</th>
                  <th ng-click="sort('coupon_name')" style="cursor:pointer">Coupon Name<span class="glyphicon sort-icon"  ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
		  <th ng-click="sort('expired_date')" style="cursor:pointer">Expired Date<span class="glyphicon sort-icon"  ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
		  <th ng-click="sort('min_spend')" style="cursor:pointer">Min Amount<span class="glyphicon sort-icon"  ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th ng-click="sort('coupon_status')" style="cursor:pointer">Status<span class="glyphicon sort-icon"  ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
               
                <tr dir-paginate="val in coupons|orderBy:sortKey:reverse|itemsPerPage:tb_pag|filter:search">
                  <td><% val.id %></td>
                  <td><% val.coupon_name %></td>
		  <td><% val.expire_date %></td>
		  <td><% val.min_spend %></td>
                  <td><a href="javascript:void(0);" ng-click="changeStatus(val);"><span class="label <% (val.coupon_status=='Active')?'label-success':'label-danger'%>"><% val.coupon_status %></span></a></td>
                  <td>
                      <i class="fa fa-edit" title="Edit" ng-click="editcoupon(val)" style="cursor:pointer" ></i>
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
                            Are you sure you want to delete this coupon ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                              <button type="submit" class="btn btn-primary" data-dismiss="modal" ng-click="deletecoupon($index)" >Delete</button>
                          </div>
                        </div>
                      </div>
                    </div>
                 
                  <!-- Modal -->
               
                  </td>
                  
                </tr>
               
                </tbody>
                <tfoot>
                 <tr>
                  <th>#</th>
                  <th>Coupan Name</th>
		  <th>Expired Date</th>
		  <th>Min Amount</th>
                  <th>Status</th>
                  <th> </th>                 
                </tr>
                </tfoot>
              </table>
	      <dir-pagination-controls
					max-size="tb_pag"
					direction-links="true"
					boundary-links="true" >
		</dir-pagination-controls>
            </div>
            <!-- /.box-body -->
          
        </div>
        <div class="box box-primary" ng-if="page=='edit'">
	    
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit Category</h3>
                 <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
                
                  <input type="hidden" class="form-control" id="" name="plan_id" ng-model="coupon_datas.id" placeholder="Plan Name" value="<% coupon_datas.id %>">
              <div class="box-body">
                
		<div class="form-group">
                  <label for="exampleInputEmail1">Coupon Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Coupon Name" ng-model="coupon_datas.coupon_name">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea ng-model="coupon_datas.description" class="form-control" name="demo-editor"></textarea>
                  <div class="help-block"></div>
                </div> 
		<div class="col-xs-12 main--tab" >
		<div class="col-md-2">
			 <ul class="nav nav-pills nav-stacked">
			     <li ng-class="{ active: isSet(1) }" data-toggle="pill"><a href ng-click="setTab(1)" >General</a></li>
			     <li ng-class="{ active: isSet(2) }" data-toggle="pill"><a href ng-click="setTab(2)" >Usage Restriction</a></li>
			     <li ng-class="{ active: isSet(3) }" data-toggle="pill"><a href ng-click="setTab(3)" >Usage Limits</a></li>
			     
			 </ul>
		  </div>
		<div class="col-md-8">
		  <div class="jumbotron">
		<div ng-show="isSet(1)">	
		<div class="form-group">
                  <label for="exampleInputEmail1">Discount Type</label>
                  <select class="form-control" id="" name="plan_duration" ng-model="coupon_datas.discount_type">
		  <option ng-value="fixed_cart" ng-selected="coupon_datas.discount_type=='fixed_cart'">Cart Discount</option>
		  <option ng-value="percent" ng-selected="coupon_datas.discount_type=='percent'">Cart % Discount</option>
		  <option ng-value="fixed_product" ng-selected="coupon_datas.discount_type=='fixed_product'">Product Discount</option>
		  <option ng-value="percent_product" ng-selected="coupon_datas.discount_type=='percent_product'">Product % Discount</option>
		  </select>
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Discount Value</label>
                  <input type="text" class="form-control" id=""  name="discount_value" placeholder="Discount Value" ng-model="coupon_datas.discount_value">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Allow free shipping</label>
                  </br>
		  <input type="checkbox" class="" id="" name="free_shipp" ng-checked="coupon_datas.free_shipp=='1'" ng-model="coupon_datas.free_shipp" value="1">Check this box if the coupon grants free shipping. The free shipping method must be enabled and be set to require "a valid free shipping coupon" (see the "Free Shipping Requires" setting).
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
		  
                  <label for="exampleInputEmail1">Expire Date</label>
                 <!-- <input type="text" class="form-control" id="" name="expire_date" placeholder="YYYY-MM-DD" ng-model="coupon_datas.expire_date">-->
			<ng-datepicker view-format="Do MMMM YYYY"  class="hasDatepicker"  ng-model="coupon_datas.expire_date" first-week-day-sunday="true" placeholder="Pick a date">
                                           </ng-datepicker>
		  <div class="help-block"></div>
                </div>
		</div>
		
                
		  
		  
		  <div ng-show="isSet(2)">
		  
	    
		  <div class="form-group">
                  <label for="exampleInputEmail1">Minimum Spend</label>
                  <input type="text" class="form-control" id="" name="min_amount" placeholder="No Minimum" ng-model="coupon_datas.min_spend">
		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Maximum Spend</label>
                  <input type="text" class="form-control" id="" name="max_amount" placeholder="No Maximum" ng-model="coupon_datas.max_spend">
		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Individual use only</label>
                  </br>
		  <input type="checkbox" class="" id="" name="exclude_sale" ng-checked="coupon_datas.individual==1" ng-model="coupon_datas.individual" value="1">Check this box if the coupon cannot be used in conjunction with other coupons.
<!--<em>Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are no sale items in the cart.</em>
-->		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Exclude Sale</label>
                  </br>
		  <input type="checkbox" class="" id="" name="exclude_sale" ng-checked="coupon_datas.exclude_sale==1" ng-model="coupon_datas.exclude_sale" value="1"> Check this box if the coupon should not apply to items on sale.
<!--<em>Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are no sale items in the cart.</em>
-->		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Products</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.product" name="products" placeholder="Search" ng-keyup="getProduct(coupons.product);">
			<ul class="pro-ul" ng-show="err"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="products">
			      <li ng-repeat="pro in products" ng-click="selectedItem(pro);"><%pro.pro_name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			<ul class="select2-selection__rendered">
			      <li class="select2-selection__choice" ng-repeat="item in selectedItems"><%item.pro_name%> <span ng-click="removeItem($index)" style="cursor:pointer">x</span></li>
			</ul>
			</span>
		  </span></span>
			
		  </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Exclude Products</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.exproduct" name="exproducts" placeholder="Search" ng-keyup="getexProduct(coupons.exproduct);">
			<ul class="pro-ul" ng-show="exerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="exproducts">
			      <li ng-repeat="expro in exproducts" ng-click="exselectedItem(expro);"><%expro.pro_name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			<ul class="select2-selection__rendered">
			      <li class="select2-selection__choice" ng-repeat="exitem in exselectedItems"><%exitem.pro_name%> <span ng-click="exremoveItem($index)" style="cursor:pointer">x</span></li>
			</ul>
			</span>
		  </span></span>
			
		  </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Product Category</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.category" name="category" placeholder="Search Category" ng-focus="getCategory(coupons.category);" ng-keyup="getCategory(coupons.category);">
			<ul class="pro-ul" ng-show="cerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="categories">
			      <li ng-repeat="cat in categories" ng-click="selectedCat(cat);"><%cat.category_name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="cats in selectedCats"><%cats.category_name%> <span ng-click="removeCat($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Exclude Category</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.excategory" name="excategory" placeholder="Search Category" ng-focus="getexCategory(coupons.excategory);" ng-keyup="getexCategory(coupons.excategory);">
			<ul class="pro-ul" ng-show="excerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="excategories">
			      <li ng-repeat="cat in excategories" ng-click="exselectedCat(cat);"><%cat.category_name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="cats in exselectedCats"><%cats.category_name%> <span ng-click="exremoveCat($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Email restrictions</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.user" name="user" placeholder="Search" ng-focus="getUser(coupons.user);" ng-keyup="getUser(coupons.user);">
			<ul class="pro-ul" ng-show="cerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="users">
			      <li ng-repeat="u in users" ng-click="selectedUser(u);"><%u.email%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="u in selectedUsers"><%u.email%> <span ng-click="removeUser($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
                </div>
		  
		  <div ng-show="isSet(3)">
		  <div class="form-group">
                  <label for="exampleInputEmail1">Usage limit per Coupon</label>
                  <input type="text" class="form-control" id="" name="usage_limit_coupon" placeholder="Usage Limit" ng-model="coupon_datas.usage_limit_coupon">
		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Usage limit per user</label>
                  <input type="text" class="form-control" id="" name="usage_limit_user" placeholder="Usage Limit" ng-model="coupon_datas.usage_limit_user">
		  <div class="help-block"></div>
                </div>
		  </div>
                 </div>  
             </div>
		</div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                   <input type="radio"  id="" name="status" ng-model="coupon_datas.coupon_status" ng-checked="coupon_datas.coupon_status=='Active'"  value="Active" >Active <input type="radio" id="" name="status" value="Inactive" ng-checked="coupon_datas.coupon_status=='Inactive'" ng-model="coupon_datas.coupon_status"   >Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-hide='loading' ng-click="update(coupon_datas)" class="btn btn-primary">Submit</button>
		<button ng-show='loading' class="btn btn-primary">Loading..</button>
              </div>
            
          </div>
          <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Create Coupon</h3>
                <div class="pull-right"><a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Coupon Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Coupon Name" ng-model="coupons.coupon_name">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea ng-model="coupons.description" class="form-control" name="demo-editor"></textarea>
                  <div class="help-block"></div>
                </div> 
		<div class="col-xs-12 main--tab" >
		<div class="col-md-2">
			 <ul class="nav nav-pills nav-stacked">
			     <li ng-class="{ active: isSet(1) }" data-toggle="pill"><a href ng-click="setTab(1)" >General</a></li>
			     <li ng-class="{ active: isSet(2) }" data-toggle="pill"><a href ng-click="setTab(2)" >Usage Restriction</a></li>
			     <li ng-class="{ active: isSet(3) }" data-toggle="pill"><a href ng-click="setTab(3)" >Usage Limits</a></li>
			     
			 </ul>
		  </div>
		<div class="col-md-8">
		  <div class="jumbotron">
		<div ng-show="isSet(1)">	
		<div class="form-group">
                  <label for="exampleInputEmail1">Discount Type</label>
                  <select class="form-control" id="" name="plan_duration" ng-model="coupons.discount_type">
		  <option value="fixed_cart" selected="selected">Cart Discount</option>
		  <option ng-value="percent">Cart % Discount</option>
		  <option ng-value="fixed_product">Product Discount</option>
		  <option ng-value="percent_product">Product % Discount</option>
		  </select>
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Discount Value</label>
                  <input type="text" class="form-control" id="" name="discount_value" placeholder="Discount Value" ng-model="coupons.discount_value">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Allow free shipping</label>
                  </br>
		  <input type="checkbox" class="" id="" name="free_shipp" ng-model="coupons.free_shipp" value="1">Check this box if the coupon grants free shipping. The free shipping method must be enabled and be set to require "a valid free shipping coupon" (see the "Free Shipping Requires" setting).
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Expire Date</label>
                  <ng-datepicker view-format="Do MMMM YYYY"  class="hasDatepicker"  ng-model="coupons.expire_date" first-week-day-sunday="true" placeholder="Pick a date">
                                           </ng-datepicker>
		  <div class="help-block"></div>
                </div>
		</div>
		
                
		  
		  
		  <div ng-show="isSet(2)">
		  
	    
		  <div class="form-group">
                  <label for="exampleInputEmail1">Minimum Spend</label>
                  <input type="text" class="form-control" id="" name="min_amount" placeholder="No Minimum" ng-model="coupons.min_amount">
		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Maximum Spend</label>
                  <input type="text" class="form-control" id="" name="max_amount" placeholder="No Maximum" ng-model="coupons.max_amount">
		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Individual use only</label>
                  </br>
		  <input type="checkbox" class="" id="" name="exclude_sale" ng-model="coupons.individual" value="1">Check this box if the coupon cannot be used in conjunction with other coupons.
<!--<em>Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are no sale items in the cart.</em>
-->		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Exclude Sale</label>
                  </br>
		  <input type="checkbox" class="" id="" name="exclude_sale" ng-model="coupons.exclude_sale" value="1"> Check this box if the coupon should not apply to items on sale.
<!--<em>Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are no sale items in the cart.</em>
-->		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Products</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.product" name="products" placeholder="Search" ng-keyup="getProduct(coupons.product);">
			<ul class="pro-ul" ng-show="err"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="products">
			      <li ng-repeat="pro in products" ng-click="selectedItem(pro);"><%pro.pro_name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			<ul class="select2-selection__rendered">
			      <li class="select2-selection__choice" ng-repeat="item in selectedItems | filter:{selected:true}"><%item.pro_name%> <span ng-click="removeItem($index)" style="cursor:pointer">x</span></li>
			</ul>
			</span>
		  </span></span>
			
		  </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Exclude Products</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.exproduct" name="exproducts" placeholder="Search" ng-keyup="getexProduct(coupons.exproduct);">
			<ul class="pro-ul" ng-show="exerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="exproducts">
			      <li ng-repeat="expro in exproducts" ng-click="exselectedItem(expro);"><%expro.pro_name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			<ul class="select2-selection__rendered">
			      <li class="select2-selection__choice" ng-repeat="exitem in exselectedItems | filter:{selected:true}"><%exitem.pro_name%> <span ng-click="exremoveItem($index)" style="cursor:pointer">x</span></li>
			</ul>
			</span>
		  </span></span>
			
		  </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Product Category</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.category" name="category" placeholder="Search Category" ng-focus="getCategory(coupons.category);" ng-keyup="getCategory(coupons.category);">
			<ul class="pro-ul" ng-show="cerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="categories">
			      <li ng-repeat="cat in categories" ng-click="selectedCat(cat);"><%cat.category_name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="cats in selectedCats | filter:{selected:true}"><%cats.category_name%> <span ng-click="removeCat($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Exclude Category</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.excategory" name="excategory" placeholder="Search Category" ng-focus="getexCategory(coupons.excategory);" ng-keyup="getexCategory(coupons.excategory);">
			<ul class="pro-ul" ng-show="excerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="excategories">
			      <li ng-repeat="cat in excategories" ng-click="exselectedCat(cat);"><%cat.category_name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="cats in exselectedCats | filter:{selected:true}"><%cats.category_name%> <span ng-click="exremoveCat($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Email restrictions</label>
                  <input type="text" class="form-control" id="" ng-model="coupons.user" name="category" placeholder="Search" ng-focus="getUser(coupons.user);" ng-keyup="getUser(coupons.user);">
			<ul class="pro-ul" ng-show="cerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-show="users">
			      <li ng-repeat="u in users" ng-click="selectedUser(u);"><%u.email%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="u in selectedUsers | filter:{selected:true}"><%u.email%> <span ng-click="removeUser($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
                </div>
		  
		  <div ng-show="isSet(3)">
		  <div class="form-group">
                  <label for="exampleInputEmail1">Usage limit per Coupon</label>
                  <input type="text" class="form-control" id="" name="usage_limit_coupon" placeholder="Usage Limit" ng-model="coupons.usage_limit_coupon">
		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Usage limit per user</label>
                  <input type="text" class="form-control" id="" name="usage_limit_user" placeholder="Usage Limit" ng-model="coupons.usage_limit_user">
		  <div class="help-block"></div>
                </div>
		  </div>
                 </div>  
             </div>
		</div>
		
              <!-- /.box-body -->
		  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                   <input type="radio"  id="" name="status" ng-model="coupons.status"  value="Active" ng-init="coupons.status='Active'"  >Active <input type="radio" id="" name="status" value="Inactive" ng-model="coupons.status"   >Inactive 
		  <div class="help-block"></div>
                </div>
              <div class="box-footer">
                <button ng-hide="loading" ng-click="store(coupons);" class="btn btn-primary">Submit</button>
		<button ng-show='loading'  class="btn btn-primary">Loading</button>
              </div>
		
	      </div>
	  
          </div>
          <!-- /.box -->
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
        

       

    </section>
   
  <!-- /.content-wrapper -->
 
   
