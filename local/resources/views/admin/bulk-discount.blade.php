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
              <h3 class="box-title"><i class="fa fa-list"></i> Bulk Discount List</h3>
			  <a class="add-link btn btn-success btn-flat btn-grid" href="javascript:void(0);" ng-click="add()"><i class="fa fa-plus-square"></i> Add Offer</a>
            </div>
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
		<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!--<th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" /></th>-->
				  <th ng-click="sort('id')" style="cursor:pointer">#</th>
                  <th ng-click="sort('offer_name')" style="cursor:pointer">Offer Name
		  <span class="glyphicon sort-icon"  ng-show="sortKey=='offer_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
		  </th>
		  
                  <th ng-click="sort('start_date')" style="cursor:pointer">Start Date
		  <span class="glyphicon sort-icon"  ng-show="sortKey=='start_date'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
				  <th ng-click="sort('end_date')" style="cursor:pointer">End Date
				  <span class="glyphicon sort-icon"  ng-show="sortKey=='end_date'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
				 
				  <th ng-click="sort('offer_status')" style="cursor:pointer">Status
				  <span class="glyphicon sort-icon"  ng-show="sortKey=='offer_status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                
                <tr dir-paginate="val in offers|orderBy:sortKey:reverse|itemsPerPage:tb_pag|filter:search">

                  <!--<td><input type="checkbox" ng-model="users_id[val.id]" ng-change="optionToggled(val.id)" value="<% val.id %>"/></td>-->
				  <td><%$index+1%></td>

                  <td><% val.offer_name %></td>
                  <td><% val.start_date %></td>
				  <td><% val.end_date %></td>
				  
				  <td><a href="javascript:void(0);" ng-click="changeStatus(val);"><span class="label <% (val.offer_status=='Active')?'label-success':'label-danger'%>">
				  <% val.offer_status %></span></a>
				  </td>
                  <td><i ng-click="editoffer(val)" class="fa fa-edit" style="cursor:pointer"></i>
		    <i ng-if="val.status=='Active'" class="fa fa-ban" ng-click="val.status='Block';changeStatus(val);" title="Block" style="cursor:pointer"></i>
		    <i ng-if="val.status=='Block'" class="fa fa-ban" ng-click="val.status='Inactive';changeStatus(val);" title="Unblock" style="cursor:pointer"></i>
		    <i class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
                 
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this offer ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                                  {{ csrf_field() }}
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button data-dismiss="modal" ng-click="deleteoffer($index)" class="btn btn-primary" >Delete</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  
                </tr>
              
                </tbody>
                <tfoot>
                 <tr>
		    <!--<th></th>-->
                  <th ng-click="sort('id')" style="cursor:pointer">#</th>
                  <th ng-click="sort('offer_name')" style="cursor:pointer">Offer Name
		  <span class="glyphicon sort-icon"  ng-show="sortKey=='offer_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
		  </th>
		  
                  <th ng-click="sort('from_date')" style="cursor:pointer">Start Date
		  <span class="glyphicon sort-icon"  ng-show="sortKey=='from_date'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
				  <th ng-click="sort('end_date')" style="cursor:pointer">End Date
				  <span class="glyphicon sort-icon"  ng-show="sortKey=='end_date'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
				  
				  <th ng-click="sort('offer_status')" style="cursor:pointer">Status
				  <span class="glyphicon sort-icon"  ng-show="sortKey=='offer_status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
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
          </div>
          
          <div class="box box-primary" ng-if="page=='add'">

            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Add Offer</h3>
                 <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
	    <div class="box-body">
            <div class="form-group">
                <h3>General Settings</h3>
            </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">Rule Name</label>
                  <input type="text" class="form-control" id="" name="rule_name" placeholder="Role" ng-model="offer.role_name">
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">Quantities based on</label>
                  <select class="form-control" id="" name="quantity_based_on" ng-model="offer.quantity_based_on">
                <optgroup label="Exclusive">
                    <option value="exclusive_product" selected="selected">Quantities of each product individually</option>
                    <option value="exclusive_variation">Quantities of each variation individually</option>
                    <option value="exclusive_configuration">Quantities of each cart line item individually</option>
                </optgroup>
                <optgroup label="Cumulative">
                    <option value="cumulative_categories">Quantities of all selected products split by category</option>
                    <option value="cumulative_all">Quantities of all selected products summed up</option>
                </optgroup>
                  </select>
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">If conditions are matched</label>
                  <select class="form-control" id="" name="condition_match" ng-model="offer.condition_match">
                
                                                
                                                <option value="all" selected="selected">Apply with other matched rules</option>
                                                <option value="this">Apply only this rule (disregard other rules)</option>
                                                <option value="other">Apply only if no other rules are matched</option>
                  </select>
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">Valid From</label>
                  <ng-datepicker view-format="Do MMMM YYYY"  class="hasDatepicker"  ng-model="offer.from_date" first-week-day-sunday="true" placeholder="Pick a date">
                    </ng-datepicker>
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">Valid End</label>
                  <ng-datepicker view-format="Do MMMM YYYY"  class="hasDatepicker"  ng-model="offer.end_date" first-week-day-sunday="true" placeholder="Pick a date">
                    </ng-datepicker>
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                <h3>Conditions</h3>
            </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">Apply to</label>
                  <select class="form-control" id="" name="apply_to" ng-model="offer.apply_to">
                <optgroup label="All products">
                <option value="all">All products</option>
            </optgroup>
            <optgroup label="Specific categories">
                <option value="categories_include" selected="selected">Categories in list</option>
                <option value="categories_exclude">Categories not in list</option>
            </optgroup>
            <optgroup label="Specific products">
                <option value="products_include">Products in list</option>
                <option value="products_exclude">Products not in list</option>
            </optgroup>
                  </select>
		  <div class="help-block"></div>
                </div>
            <div class="form-group" ng-show="offer.apply_to=='products_include' || offer.apply_to=='products_exclude'">
                  <label for="exampleInputEmail1">Products List</label>
                  <input type="text" class="form-control" id="" ng-model="offer.product" name="products" placeholder="Search" ng-keyup="getProduct(offer.product);">
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
            <div class="form-group" ng-show="offer.apply_to=='categories_include' || offer.apply_to=='categories_exclude'">
                  <label for="exampleInputEmail1">Category List</label>
                  <input type="text" class="form-control" id="" ng-model="offer.category" name="category" placeholder="Search Category" ng-focus="getCategory(offer.category);" ng-keyup="getCategory(offer.category);">
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
                  <label for="exampleInputEmail1">Customers</label>
                  <select class="form-control" id="" name="customers" ng-model="offer.customers">
                <optgroup label="All customers">
                    <option value="all">All customers</option>
                </optgroup>
                <optgroup label="Specific roles">
                    <option value="roles_include" selected="selected">Roles in list</option>
                    <option value="roles_exclude">Roles not in list</option>
                </optgroup>
                <optgroup label="Specific customers">
                    <option value="users_include">Customers in list</option>
                    <option value="users_exclude">Customers not in list</option>
                </optgroup>
                  </select>
		  <div class="help-block"></div>
                </div>
	    <div class="form-group" ng-show="offer.customers=='roles_include'||offer.customers=='roles_exclude'">
                  <label for="exampleInputEmail1">Role List</label>
                  <input type="text" class="form-control" id=""  ng-model="offer.role" name="role" placeholder="Search" ng-click="getRole(offer.user);" ng-keyup="getRole(offer.user); ">
			
			<ul class="pro-ul" ng-show="rerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-if="role ">
			      <li ng-repeat="r in role" ng-click="selectedRole(r);"><%r.name%></li>
			</ul>
			
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="r in selectedRoles"><%r.name%> <span ng-click="removeRole($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
	    
            <div class="form-group" ng-show="offer.customers=='users_include'||offer.customers=='users_exclude'">
                  <label for="exampleInputEmail1">Customers List</label>
                  <input type="text" class="form-control" id=""  ng-model="offer.user" name="user" placeholder="Search" ng-click="getUser(offer.user);" ng-keyup="getUser(offer.user);">
			
			<ul class="pro-ul" ng-show="uerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-if="users ">
			      <li ng-repeat="u in users" ng-click="selectedUser(u);"><%u.name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="u in selectedUsers"><%u.name%> <span ng-click="removeUser($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
	    <div class="form-group">
                <h3>Quantity Discount</h3>
            </div>
		 <div class="form-group col-xs-12 list list-inset">
			<div class="row item-input">
		<label class="item-input-wrapper col-xs-2">Min quantity</label>
		<label class="item-input-wrapper col-xs-2">Max quantity</label>
		<label class="item-input-wrapper col-xs-2">Adjustment type</label>
		<label class="item-input-wrapper col-xs-2">Value</label>
		</div>
		<div class="row item-input" ng-repeat="input in inputs">
		<label class="item-input-wrapper col-xs-2">
		
		<input type="text" class="form-control" ng-model="input.min_qty">
		</label>
		<label class="item-input-wrapper col-xs-2">
		 <input type="text" class="form-control" placeholder="e.g. 9" ng-model="input.max_qty" />
		</label>
		<label class="item-input-wrapper col-xs-2">
		 <select class="form-control" ng-model="input.adjustment_type">
			<option value="percentage">Percentage discount</option>
			<option value="price">Price discount</option>
			<option value="fixed">Fixed price</option>
		 </select>
		</label>
		<label class="item-input-wrapper col-xs-2">
		 <input type="text" class="form-control" placeholder="e.g. 9" ng-model="input.adjustment_value" />
		</label>
		
		<button class="btn btn-success button button-small button-balanced" ng-if="$index == inputs.length - 1" ng-click="addInput()">
		    <i class="icon ion-plus"></i>
		</button>
		    <button class="btn btn-danger button button-small button-assertive" ng-if="$index != inputs.length - 1" ng-click="removeInput($index)">
		    <i class="icon ion-minus"></i>
		</button>
		</div>
		</div>
	    <div class="box-footer">
                <button  ng-click="store(offer);" class="btn btn-primary">Submit</button>
				
              </div>
	    </div>
	    </div>
	  
	  <div class="box box-primary" ng-if="page=='edit'">

            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit Offer</h3>
                 <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
	    <div class="box-body">
            <div class="form-group">
                <h3>General Settings</h3>
            </div>
	    <input type="hidden" name="" ng-model="offer_datas.id">
            <div class="form-group">
                  <label for="exampleInputEmail1">Rule Name</label>
                  <input type="text" class="form-control" id="" name="rule_name" placeholder="Role" ng-model="offer_datas.offer_name">
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">Quantities based on</label>
                  <select class="form-control" id="" name="quantity_based_on" ng-model="offer_datas.quantity_based_on">
                <optgroup label="Exclusive">
                    <option value="exclusive_product">Quantities of each product individually</option>
                    <option value="exclusive_variation">Quantities of each variation individually</option>
                    <option value="exclusive_configuration">Quantities of each cart line item individually</option>
                </optgroup>
                <optgroup label="Cumulative">
                    <option value="cumulative_categories">Quantities of all selected products split by category</option>
                    <option value="cumulative_all">Quantities of all selected products summed up</option>
                </optgroup>
                  </select>
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">If conditions are matched</label>
                  <select class="form-control" id="" name="condition_match" ng-model="offer_datas.condition_match">
                
                                                
                                                <option value="all">Apply with other matched rules</option>
                                                <option value="this">Apply only this rule (disregard other rules)</option>
                                                <option value="other">Apply only if no other rules are matched</option>
                  </select>
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">Valid From</label>
                  <ng-datepicker view-format="Do MMMM YYYY"  class="hasDatepicker"  ng-model="offer_datas.start_date" first-week-day-sunday="true" placeholder="Pick a date">
                    </ng-datepicker>
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                  <label for="exampleInputEmail1">Valid End</label>
                  <ng-datepicker view-format="Do MMMM YYYY"  class="hasDatepicker"  ng-model="offer_datas.end_date" first-week-day-sunday="true" placeholder="Pick a date">
                    </ng-datepicker>
		  <div class="help-block"></div>
                </div>
            <div class="form-group">
                <h3>Conditions</h3>
            </div>
            <div class="form-group">
		
                  <label for="exampleInputEmail1">Apply to</label>
                  <select class="form-control" id="" name="apply_to" ng-model="offer_datas.apply_to">
                <optgroup label="All products">
                <option ng-value="all">All products</option>
            </optgroup>
            <optgroup label="Specific categories">
                <option ng-value="categories_include">Categories in list</option>
                <option ng-value="categories_exclude">Categories not in list</option>
            </optgroup>
            <optgroup label="Specific products">
                <option ng-value="products_include">Products in list</option>
                <option ng-value="products_exclude">Products not in list</option>
            </optgroup>
                  </select>
		  <div class="help-block"></div>
                </div>
            <div class="form-group" ng-show="offer_datas.apply_to=='products_include' || offer_datas.apply_to=='products_exclude'">
                  <label for="exampleInputEmail1">Products List</label>
                  <input type="text" class="form-control" id="" ng-model="offer.product" name="products" placeholder="Search" ng-keyup="getProduct(offer.product);">
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
	   
            <div class="form-group" ng-show="offer_datas.apply_to=='categories_include' || offer_datas.apply_to=='categories_exclude'">
                  <label for="exampleInputEmail1">Category List</label>
                  <input type="text" class="form-control" id="" ng-model="offer.category" name="category" placeholder="Search Category" ng-focus="getCategory(offer.category);" ng-keyup="getCategory(offer.category);">
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
                  <label for="exampleInputEmail1">Customers</label>
                  <select class="form-control" id="" name="customers" ng-model="offer_datas.customers">
                <optgroup label="All customers">
                    <option value="all">All customers</option>
                </optgroup>
                <optgroup label="Specific roles">
                    <option value="roles_include">Roles in list</option>
                    <option value="roles_exclude">Roles not in list</option>
                </optgroup>
                <optgroup label="Specific customers">
                    <option value="users_include">Customers in list</option>
                    <option value="users_exclude">Customers not in list</option>
                </optgroup>
                  </select>
		  <div class="help-block"></div>
                </div>
	    <div class="form-group" ng-show="offer_datas.customers=='roles_include'||offer_datas.customers=='roles_exclude'">
                  <label for="exampleInputEmail1">Role List</label>
                  <input type="text" class="form-control" id=""  ng-model="offer.role" name="role" placeholder="Search" ng-click="getRole(offer.user);" ng-keyup="getRole(offer.user); ">
			
			<ul class="pro-ul" ng-show="rerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-if="role">
			      <li ng-repeat="r in role" ng-click="selectedRole(r);"><%r.name%></li>
			</ul>
			
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="r in selectedRoles"><%r.name%> <span ng-click="removeRole($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
	    
            <div class="form-group" ng-show="offer_datas.customers=='users_include'||offer_datas.customers=='users_exclude'">
                  <label for="exampleInputEmail1">Customers List</label>
                  <input type="text" class="form-control" id=""  ng-model="offer.user" name="user" placeholder="Search" ng-click="getUser(offer_datas.user);" ng-keyup="getUser(offer.user);">
			
			<ul class="pro-ul" ng-show="uerr"><li><%msg%></li></ul>
			<ul class="pro-ul" ng-if="users">
			      <li ng-repeat="u in users" ng-click="selectedUser(u);"><%u.name%></li>
			</ul>
		  <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="u in selectedUsers"><%u.name%> <span ng-click="removeUser($index)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
			
		  </div>
	    <div class="form-group">
                <h3>Quantity Discount</h3>
            </div>
		 <div class="form-group col-xs-12 list list-inset">
			<div class="row item-input">
		<label class="item-input-wrapper col-xs-2">Min quantity</label>
		<label class="item-input-wrapper col-xs-2">Max quantity</label>
		<label class="item-input-wrapper col-xs-2">Adjustment type</label>
		<label class="item-input-wrapper col-xs-2">Value</label>
		</div>
		<div class="row item-input" ng-repeat="input in inputs">
		<label class="item-input-wrapper col-xs-2">
		
		<input type="text" class="form-control" ng-model="input.min_qty">
		</label>
		<label class="item-input-wrapper col-xs-2">
		 <input type="text" class="form-control" placeholder="e.g. 9" ng-model="input.max_qty" />
		</label>
		<label class="item-input-wrapper col-xs-2">
		 <select class="form-control" ng-model="input.adjustment_type">
			<option value="percentage">Percentage discount</option>
			<option value="price">Price discount</option>
			<option value="fixed">Fixed price</option>
		 </select>
		</label>
		<label class="item-input-wrapper col-xs-2">
		 <input type="text" class="form-control" placeholder="e.g. 9" ng-model="input.adjustment_value" />
		</label>
		
		<button class="btn btn-success button button-small button-balanced" ng-if="$index == inputs.length - 1" ng-click="addInput()">
		    <i class="icon ion-plus"></i>
		</button>
		    <button class="btn btn-danger button button-small button-assertive" ng-if="$index != inputs.length - 1" ng-click="removeInput($index)">
		    <i class="icon ion-minus"></i>
		</button>
		</div>
		</div>
	    
	    
	    
	    
	    
	    
	    
            
	    <div class="box-footer">
                <button  ng-click="update(offer_datas);" class="btn btn-primary">Submit</button>
				
              </div>
	    </div>
	    </div>
          
</section>