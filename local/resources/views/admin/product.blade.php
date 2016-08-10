
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
              <h3 class="box-title"><i class="fa fa-list"></i> Product List</h3>
              <div class="pull-right"> <a href="javascript:void(0)" ng-click="add();"class="btn btn-primary"><i class="fa fa-plus"></i> Add Product</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">  
              <div class="row">
                <div class="form-group col-md-2 ">		  
                    <button class="btn btn-default" data-toggle="modal" data-target="#screen_opt_modal">Screen Options</button>
                      <!-- Modal -->
               <div class="modal fade" id="screen_opt_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Screen Options</h4>                            
                          </div>
                          <div class="modal-body">
                              <div class="row" ng-init='screen_opt={"pro_name":true,"category_name":true,"status":true}'>
                                  
                                <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox" ng-model="screen_opt.pro_name"> Product Name
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox" ng-model="screen_opt.category_name"> Category Name
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox"  ng-model="screen_opt.status"> Status
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox" ng-model="screen_opt.pro_des"> Product Description
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox" ng-model="screen_opt.pro_short_des"> Product Short Description
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox"  ng-model="screen_opt.pro_feature_des"> Product Feature Description
                                   </div>
                                 </div>
                                    <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox" ng-model="screen_opt.meta_title"> Meta Title
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox" ng-model="screen_opt.meta_description"> Meta Description
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox"  ng-model="screen_opt.meta_keywords"> Meta Keyword
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox" ng-model="screen_opt.length"> Length
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox" ng-model="screen_opt.width"> Width
                                   </div>
                                </div>
                                 <div class="col-md-4">
                                   <div class="form-group">
                                        <input type="checkbox"  ng-model="screen_opt.height"> Height
                                   </div>
                                 </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                         
                                                     
                          </div>
                        </div>
                      </div>
                    </div>
		</div>
              
              </div>
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
                  <th ng-click="sort('id')" style="cursor:pointer">#
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-if="screen_opt.pro_name" ng-click="sort('pro_name')" style="cursor:pointer">Product Name
                    <span class="glyphicon sort-icon"  ng-show="sortKey=='pro_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>                  
		  <th ng-if="screen_opt.category_name" ng-click="sort('category_name')" style="cursor:pointer">Category Name
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='category_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-if="screen_opt.status"  ng-click="sort('status')" style="cursor:pointer">Status
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-if="screen_opt.pro_des" ng-click="sort('pro_des')" style="cursor:pointer">Product Description 
                    <span class="glyphicon sort-icon"  ng-show="sortKey=='pro_des'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>                  
		  <th ng-if="screen_opt.pro_short_des" ng-click="sort('pro_short_des')" style="cursor:pointer">Product Short Description 
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='pro_short_des'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-if="screen_opt.pro_feature_des"  ng-click="sort('pro_feature_des')" style="cursor:pointer"> Product Feature Description   
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='pro_feature_des'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                   <th ng-if="screen_opt.meta_title" ng-click="sort('meta_title')" style="cursor:pointer"> Meta Title
                    <span class="glyphicon sort-icon"  ng-show="sortKey=='meta_title'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>                  
		  <th ng-if="screen_opt.meta_description" ng-click="sort('meta_description')" style="cursor:pointer"> Meta Description
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='meta_description'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-if="screen_opt.meta_keywords"  ng-click="sort('meta_keywords')" style="cursor:pointer"> Meta Keywords
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='meta_keywords'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-if="screen_opt.length" ng-click="sort('length')" style="cursor:pointer"> Length
                    <span class="glyphicon sort-icon"  ng-show="sortKey=='length'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>                  
		  <th ng-if="screen_opt.width" ng-click="sort('width')" style="cursor:pointer"> Width
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='width'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-if="screen_opt.height"  ng-click="sort('height')" style="cursor:pointer"> Height   
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='height'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>                
                <tr dir-paginate="val in products|orderBy:sortKey:reverse|itemsPerPage:tb_pag|filter:search"> 
                  <td><% val.id %></td>
                  <td ng-if="screen_opt.pro_name"><% val.pro_name %></td>
		  <td ng-if="screen_opt.category_name"><% val.category_name %></td>
                  <td ng-if="screen_opt.status"><% val.status %></td>
                  <td ng-if="screen_opt.pro_des" ng-bind-html="val.pro_des"></td>
		  <td ng-if="screen_opt.pro_short_des" ng-bind-html="val.pro_short_des"></td>
                  <td ng-if="screen_opt.pro_feature_des" ng-bind-html="val.pro_feature_des"></td>
                  <td ng-if="screen_opt.meta_title"><% val.meta_title %></td>
		  <td ng-if="screen_opt.meta_description"><% val.meta_description %></td>
                  <td ng-if="screen_opt.meta_keywords"><% val.meta_keywords %></td>
                  <td ng-if="screen_opt.length"><% val.length %></td>
		  <td ng-if="screen_opt.width"><% val.width %></td>
                  <td ng-if="screen_opt.height"><% val.height %></td>
                  <td><a href="javascript:void(0);" ng-click="editproduct(val)"><i class="fa fa-edit" title="Edit"></i></a>
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
                            Are you sure you want to delete this product ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                              <button type="submit" class="btn btn-primary" data-dismiss="modal" ng-click="deleteproduct($index)" >Delete</button>
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
                  <th ng-if="screen_opt.pro_name">Product Name                    
                  </th>                  
		  <th ng-if="screen_opt.category_name" >Category Name
                  </th>
                  <th ng-if="screen_opt.status"  >Status
                  </th>
                  <th ng-if="screen_opt.pro_des">Product Description 
                   </th>                  
		  <th ng-if="screen_opt.pro_short_des" >Product Short Description 
                  </th>
                  <th ng-if="screen_opt.pro_feature_des"  > Product Feature Description   
                  </th>
                   <th ng-if="screen_opt.meta_title" > Meta Title
                   </th>                  
		  <th ng-if="screen_opt.meta_description" > Meta Description
                   </th>
                  <th ng-if="screen_opt.meta_keywords"  > Meta Keywords
                   </th>
                  <th ng-if="screen_opt.length" > Length
                   </th>                  
		  <th ng-if="screen_opt.width" > Width
                  </th>
                  <th ng-if="screen_opt.height" > Height   
                  </th>
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
        <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Create Products</h3>
                <div class="pull-right"> <a href="javascript:void(0);" ng-click="init();" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">
	       <div class="col-xs-9">	
		    <div class="form-group">
		      <label for="exampleInputEmail1">Product Name</label>
		      <input type="text" class="form-control" id="" name="pro_name" placeholder="Product Name" ng-model="product.pro_name">
		      <div class="help-block"></div>
		    </div>
		    <div class="form-group">
		      <label for="exampleInputEmail1">Product Description</label>
		      <div text-angular ng-model="product.pro_des" name="pro_des" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>
		      <div class="help-block"></div>
		    </div>
		    <div class="form-group">
		      <label for="exampleInputEmail1">Product Short Description</label>
		      <div text-angular ng-model="product.pro_short_des" name="pro_short_des" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>
		      <div class="help-block"></div>
		    </div>
		    <div class="form-group">
		      <label for="exampleInputEmail1">Product Feature Description</label>
		      <div text-angular ng-model="product.pro_feature_des" name="pro_feature_des" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>
		      <div class="help-block"></div>
		    </div>
		    <div class="form-group">
		      <label for="exampleInputEmail1">Sellers</label>
		       <select class="form-control" id="" name="seller_id" placeholder="Sellers" ng-model="product.seller_id">
			<option value="">Select Seller</option>
			<option ng-repeat="ss in sellers" ng-value="ss.id" ng-selected="ss.id==product.seller_id"><%ss.fname%></option> 
		       </select>
		      <div class="help-block"></div>
		    </div>
		    <!--<div class="form-group">
		      <label for="exampleInputEmail1">Product Category</label>
		       <select class="form-control" id="" name="pro_category_id" placeholder="Product Category" ng-model="product.pro_category_id">
			<option value="">Select Product Category</option>
			<option ng-repeat="cat in categories" ng-value="cat.id" ng-selected="cat.id==product.pro_category_id"><%cat.category_name%></option> 
		       </select>
		      <div class="help-block"></div>
		    </div>-->
		    <!--<div class="form-group">
		      <label for="exampleInputEmail1">Product Brand</label>
		       <select class="form-control" id="" name="brand_id" placeholder="Product Brand" ng-model="product.brand_id">
			<option value="">Select Product Brand</option>
			<option ng-repeat="br in brands" ng-value="br.id" ng-selected="br.id==product.brand_id"><%br.brand_name%></option> 
		       </select>
		      <div class="help-block"></div>
		    </div>-->
		    <div class="form-group">
		      <label for="exampleInputEmail1">Product Tags</label>
		      <input type="text" class="form-control" id="" name="product_tags" placeholder="Product Tags" ng-model="product.product_tags">
		      <div class="help-block"></div>
		    </div>
		    <!--<div class="form-group">
		      <label for="exampleInputEmail1">Price</label>
		      <input type="text" class="form-control" id="" name="price" placeholder="Price" ng-model="product.price">
		      <div class="help-block"></div>
		    </div>-->
		    <div class="form-group">
		      <label for="exampleInputEmail1">No. of Stocks</label>
		      <input type="text" class="form-control" id="" name="no_stock" placeholder="No. of Stocks" ng-model="product.no_stock">
		      <div class="help-block"></div>
		    </div>
		    <!--<div class="form-group">
		      <label for="exampleInputEmail1">Image</label>
		      <!--<img class='' src="{{URL::asset('uploads')}}/<% category.image %>" width="100">-->
		      <!--onchange="angular.element(this).scope().uploadedFile(this)"-->
		      <!--<input type="file"  name="image" ng-model="images.image" accept="image/*" onchange="angular.element(this).scope().uploadedMultipleFile(this)">
		      <div class="help-block"></div>
		    </div>-->
		    <div class="form-group">
		      <label for="exampleInputEmail1">Meta Title</label>
		      <input type="text" class="form-control" id="" name="meta_title" placeholder="Meta Title" ng-model="product.meta_title">
		      <div class="help-block"></div>
		    </div>
		    <div class="form-group">
		      <label for="exampleInputEmail1">Meta Description</label>
		      <input type="text" class="form-control" id="" name="meta_description" placeholder="Meta Description" ng-model="product.meta_description">
		      <div class="help-block"></div>
		    </div>
		    <div class="form-group">
		      <label for="exampleInputEmail1">Meta Keywords</label>
		      <input type="text" class="form-control" id="" name="meta_keywords" placeholder="Meta Keywords" ng-model="product.meta_keywords">
		      <div class="help-block"></div>
		    </div>
		    <div class="form-group">
		      <label for="exampleInputEmail1" ng-init="product.status='Active'" >Status </label>
		      <input type="radio" ng-model="product.status" ng-checked="product.status" id="" name="status"  value="Active">Active <input ng-model="product.status" type="radio" id="" name="status" value="Inactive" checked>Inactive 
		      <div class="help-block"></div>
		    </div> 
		    
		    <div class="main-form-pro row">
		    <label for="exampleInputEmail1">Product Data-</label>
			<select name="pro_data_type" ng-model="product.pro_datatype_id" ng-init="product.pro_datatype_id=1">
			 <optgroup label="Product Type">
			 <option ng-repeat="dt in datatyps" ng-value="dt.id" ng-selected="dt.id==product.pro_datatype_id" value="<%dt.id%>"><%dt.data_type%></option> 
			 </optgroup>
			</select>   
		    <span title="Click to toggle" class="handlediv" ng-click="myFunc3()"><i class="fa fa-caret-down custom"></i></span>
			 <div class="col-xs-12 main--tab" ng-show="showMe3">
			     <div class="col-md-2">
				   <div class="first-box" ng-if="product.pro_datatype_id == '1'">
					<ul class="nav nav-pills nav-stacked">
					<li ng-class="{ active: isSet(1) }">
					<a href ng-click="setTab(1)"><i class="fa fa-bars" aria-hidden="true"></i>General</a>
					</li>
					<li ng-class="{ active: isSet(2) }">
					<a href ng-click="setTab(2)"><i class="fa fa-line-chart" aria-hidden="true"></i>Inventory</a>
					</li>
					<li ng-class="{ active: isSet(3) }">
					<a href ng-click="setTab(3)"><i class="fa fa-bus" aria-hidden="true"></i>Shipping</a>
					</li>
					<li ng-class="{ active: isSet(4) }">
					<a href ng-click="setTab(4)"><i class="fa fa-link" aria-hidden="true"></i>Linked Products</a>
					</li>
					<li ng-class="{ active: isSet(5) }">
					<a href ng-click="setTab(5)"><i class="fa fa-minus-square-o" aria-hidden="true"></i>Attributes</a>
					</li>
					<li ng-class="{ active: isSet(6) }">
					<a href ng-click="setTab(6)"><i class="fa fa-cog" aria-hidden="true"></i>Advanced</a>
					</li>
					</ul>
				   </div>
				   <div class="second-box" ng-if="product.pro_datatype_id == '2'">
					<ul class="nav nav-pills nav-stacked">
					<li ng-class="{ active: isSet(2) }">
					<a href ng-click="setTab(2)"><i class="fa fa-line-chart" aria-hidden="true"></i>Inventory</a>
					</li>
				       <li ng-class="{ active: isSet(4) }">
					<a href ng-click="setTab(4)"><i class="fa fa-link" aria-hidden="true"></i>Linked Products</a>
					</li>
					<li ng-class="{ active: isSet(5) }">
					<a href ng-click="setTab(5)"><i class="fa fa-minus-square-o" aria-hidden="true"></i>Attributes</a>
					</li>
					<li ng-class="{ active: isSet(6) }">
					<a href ng-click="setTab(6)"><i class="fa fa-cog" aria-hidden="true"></i>Advanced</a>
					</li>
					</ul>
				   </div>
				   <div class="third-box" ng-if="product.pro_datatype_id == '3'">
					<ul class="nav nav-pills nav-stacked">
					<li ng-class="{ active: isSet(1) }">
					<a href ng-click="setTab(1)"><i class="fa fa-bars" aria-hidden="true"></i>General</a>
					</li>
					<li ng-class="{ active: isSet(4) }">
					<a href ng-click="setTab(4)"><i class="fa fa-link" aria-hidden="true"></i>Linked Products</a>
					</li>
					<li ng-class="{ active: isSet(5) }">
					<a href ng-click="setTab(5)"><i class="fa fa-minus-square-o" aria-hidden="true"></i>Attributes</a>
					</li>
					<li ng-class="{ active: isSet(6) }">
					<a href ng-click="setTab(6)"><i class="fa fa-cog" aria-hidden="true"></i>Advanced</a>
					</li>
					</ul>
				   </div>
				   
				   <div class="third-box" ng-if="product.pro_datatype_id == '4'">
					<ul class="nav nav-pills nav-stacked">
					<li ng-class="{ active: isSet(1) }">
					<a href ng-click="setTab(1)"><i class="fa fa-bars" aria-hidden="true"></i>General</a>
					</li>
					<li ng-class="{ active: isSet(2) }">
					<a href ng-click="setTab(2)"><i class="fa fa-line-chart" aria-hidden="true"></i>Inventory</a>
					</li>
					<li ng-class="{ active: isSet(3) }">
					<a href ng-click="setTab(3)"><i class="fa fa-bus" aria-hidden="true"></i>Shipping</a>
					</li>
					<li ng-class="{ active: isSet(4) }">
					<a href ng-click="setTab(4)"><i class="fa fa-link" aria-hidden="true"></i>Linked Products</a>
					</li>
					<li ng-class="{ active: isSet(5) }">
					<a href ng-click="setTab(5)"><i class="fa fa-minus-square-o" aria-hidden="true"></i>Attributes</a>
					</li>
					<li ng-class="{ active: isSet(6) }">
					<a href ng-click="setTab(6)"><i class="fa fa-cog" aria-hidden="true"></i>Advanced</a>
					</li>
					</ul>
				   </div>
			     </div>
			     <div class="col-md-8">
				   <div class="jumbotron">
					 <div ng-show="isSet(1)">
					     <div class="form-group">
					     <label for="exampleInputEmail1">SKU</label>
					     <input type="text" placeholder="" class="form-control" value="" id="sku" name="sku" ng-model="product.sku">
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Regular Price (Rs.)</label>
					     <!--<input type="text" placeholder="" value="" id="regular_price" name="regular_price">-->
					     <input type="text" class="form-control" id="" name="price" placeholder="Price" ng-model="product.price">
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Sale Price (Rs.)</label>
					     <input type="text" placeholder="" class="form-control" value="" id="sale_price" name="sale_price" ng-model="product.sale_price">
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Sale Price Dates From</label>
					     <input type="text" placeholder="YYYY-MM-DD" class="form-control" id="date_from" name="date_from"  ng-model="product.date_from">
                                           
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Sale Price Dates To</label>
					     <input type="text" placeholder="YYYY-MM-DD" class="form-control" id="date_to" name="date_to" ng-model="product.date_to">
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Youtube Link</label>
					     <textarea cols="20" rows="2" class="form-control" placeholder="Youtube Link for multiple enter in new line" id="video" name="video" ng-model="product.video"></textarea>
					     </div>
					 </div>
					 <div ng-show="isSet(2)">
					 <div class="form-group">
					     <label for="exampleInputEmail1">Manage stock?</label>
					     <input type="checkbox" name=""> Enable stock management at product level
					     </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Stock status</label>
					     <select class="form-control">
						  <option value="in_stock">In stock</option>
						  <option value="out_stock">Out stock</option>
					     </select>
					     </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Sold Individually</label>
					     <input type="checkbox" name=""> Enable this to only allow one of this item to be bought in a single order
					     </div>
					 </div>
					 <div ng-show="isSet(3)">
					 <div class="form-group">
					     <label for="exampleInputEmail1">Weight(kg)</label>
					     <input type="text" class="form-control" placeholder="0" name="weight" ng-model="product.weight">
					     </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Dimensions (cm)</label>
					     <input type="text" placeholder="Length" name="length" class="form-control" ng-model="product.length">
					     <input type="text" placeholder="Width" name="width" class="form-control" ng-model="product.width">
					     <input type="text" placeholder="Height" name="height" class="form-control" ng-model="product.height">
					     </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Shipping class</label>
					     <select class="form-control">
						  <option value="no_shipping">No shipping class</option>
					     </select>
					     </div>
					 </div>
					 <div ng-show="isSet(4)">
					 <h1>Messages4</h1>
					 <p> Some messages4 </p>
					 </div>
					 <div ng-show="isSet(5)">
					 <div class="form-group">
					     <label for="exampleInputEmail1">Custom Product option</label>
					     <!--<select class="form-control" name="pro_opt_name_id" ng-model="product.pro_opt_name_id"  ng-change="GetSelectedOptions(product.pro_opt_name_id)">
						<option ng-repeat="opnam in options" ng-value="opnam.id" ng-selected="opnam.id==product.pro_opt_name_id" value="<%opnam.id%>"><% opnam.option_name %></option>
					     </select>-->
					     <select class="form-control" name="pro_opt_name_id" ng-model="product.pro_opt_name_id"  ng-change="">
						<option ng-repeat="opnam in options" ng-if="check_exist(opnam.id)" ng-value="opnam.id" ng-selected="opnam.id==product.pro_opt_name_id" value="<%opnam.id%>"><% opnam.option_name %></option>
					     </select>
					     <button ng-click="addData(product.pro_opt_name_id);product.pro_opt_name_id=''" type="submit" class="btn btn-primary">Add</button>
					  </div>
					 <div class="form-group" ng-repeat="newvalue in optval">
					    <% newvalue.parent_name[0].option_name %>
					     <select class="form-control" name="pro_opt_values_id" ng-model="product.pro_opt_values_id[newvalue.optid]" multiple>
						<option ng-repeat="opv in newvalue.all" ng-value="opv.id"  value="<%opv.id%>"><% opv.option_name %></option>
					     </select>
					     <a href="" ng-click="removeData($index);">Remove</a>
					 </div>
					 
					 <!--<div class="form-group">
					 <select class="form-control" name="pro_opt_values_id" ng-model="product.pro_opt_values_id" multiple>
						<option ng-repeat="opv in optionvalues" ng-value="opv.id" ng-selected="opv.id==product.pro_opt_values_id" value="<%opv.id%>"><% opv.option_name %></option>
					     </select>
					  </div>-->
					 </div>
					 <div ng-show="isSet(6)">
					 <div class="form-group">
					     <label for="exampleInputEmail1">Purchase Note</label>
					     <textarea cols="20" rows="2" placeholder="" id="" name="" class="form-control"></textarea>
					  </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Menu Order</label>
					     <input type="number" class="form-control" step="1" placeholder="" value="0" id="menu_order" name="menu_order" style="" class="short">
					 </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Enable reviews</label>
					     <input type="checkbox" name="">
					 </div>
					 </div>
					
				    </div>
			     </div>
			 </div>
		    </div>
	       </div>
	       <div class="col-xs-3">
		    <div class="row">
		    <div>
		    <!--<script type="text/ng-template" id="categoryTree">
   <% category.name %>
   <ul ng-if="category.all_category">
       <li ng-repeat="category in category.all_category" ng-include="'categoryTree'">           
       </li>
   </ul>
</script>
<ul>
   <li ng-repeat="category in all_category" ng-include="'categoryTree'"></li>
</ul> -->
		    </div>
		      <div class="col-xs-12">
			 <div class="main-form-chk">
			 <label for="exampleInputEmail1">Product Categories</label>
			 <span title="Click to toggle" class="handlediv" ng-click="myFunc()"><i class="fa fa-caret-down custom"></i></span>
			 <div class="form-chk" ng-show="showMe">
			 <input type="text" placeholder="Filter Categories" ng-model="test"><br>
			 <div class="frm-cat">
			     <script type="text/ng-template" id="categoryTree">
  
   <input type="checkbox" ng-model="product.pro_category_id[category.id]" value="<%category.id%>" name="pro_category_id[]" ><% category.category_name %>
   <ul ng-if="category.all_category">
       <li class="cat-tree" ng-repeat="category in category.all_category | filter:test" ng-include="'categoryTree'">           
       </li>
   </ul>
</script>
<ul class="ul-cat">
   <li class="cat-tree" ng-repeat="category in all_category | filter:test" ng-include="'categoryTree'"></li>
</ul> 
			 <!--<span ng-repeat="cat1 in categories | filter : test">
			      <input type="checkbox" ng-model="product.pro_category_id[cat1.id]" name="pro_category_id[]" > <%cat1.category_name%><br>
			  </span>-->
			 </div>
			 </div>
			 </div>
		      </div>
		      <div class="col-xs-12">
		      <div class="main-form-chk">
		      <label for="exampleInputEmail1">Images</label>
		      <span title="Click to toggle" class="handlediv" ng-click="myFuncimg()"><i class="fa fa-caret-down custom" ></i></span>
		      <div class="form-img-chk" ng-show="showMeimg">
			<div class="imgs_ro" ng-repeat="val in pr_imgs">               
			    <img src="{{URL::asset('uploads')}}/<% val.img %>"  alt="" ng-mouseleave="tr_dis[$index]=0" ng-mouseover="tr_dis[$index]=1"/>
			     <a class="ms_ov" href="javascript:void(0);" ng-if="$index != values.length - 1" ng-mouseleave="tr_dis[$index]=0" ng-mouseover="tr_dis[$index]=1" ng-show="tr_dis[$index]==1" >
				 <i class="fa fa-check" title="Set default" ng-show="val.def==0"  ng-click="setdefault($index)"></i>
				 <i class="fa fa-check grr_ic"  title="Unset default"  ng-show="val.def==1"  ng-click="unsetdefault($index)"></i>
				 <i class="fa fa-trash" title="Delete"  ng-click="removeimgs(val.img,$index)" ></i>
			     </a>
			 </div>
			 <div style="clear:both"></div>
			<div class="btn btn-primary btn-file" ng-show="pr_imgs.length < 8">
			    <i class="fa fa-plus"></i> <input type="file" onchange="angular.element(this).scope().uploadedFile(this)" >
			</div>
		      </div>
		      </div>
		      </div>
		      <div class="col-xs-12">
		      <div class="main-form-chk">
		      <label for="exampleInputEmail1">Product Brands</label>
		      <span title="Click to toggle" class="handlediv" ng-click="myFunc1()"><i class="fa fa-caret-down custom" ></i></span>
		      <div class="form-chk" ng-show="showMe1">
			 <input type="text" placeholder="Filter Brands" ng-model="brd"><br>
			 <div class="frm-cat">
			      <span class="form-brd" ng-repeat="br in brands | filter : brd">
			       <input type="radio" id="" name="brand_id" ng-model="product.brand_id" ng-value="br.id"><%br.brand_name%><br>
			    </span>
			 </div>
		      </div>
		      </div>
		      </div>
		    </div> 
	       </div>
		 </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="store(product,pr_imgs)" type="submit" class="btn btn-primary">Submit</button>
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
             <input type="hidden" class="form-control" id="" name="id" ng-model="product.id" placeholder="ID" value="<% product.id %>">
              <div class="box-body">
		<div class="col-xs-9"> 	 
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Name</label>
                  <input type="text" class="form-control" id="" name="pro_name" placeholder="Product Name" ng-model="product.pro_name">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Product Description</label>
                  <div text-angular ng-model="product.pro_des" name="pro_des" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Product Short Description</label>
                  <div text-angular ng-model="product.pro_short_des" name="pro_short_des" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Product Feature Description</label>
                  <div text-angular ng-model="product.pro_feature_des" name="pro_feature_des" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Sellers</label>
                   <select class="form-control" id="" name="seller_id" placeholder="Sellers" ng-model="product.seller_id">
		    <option value="">Select Seller</option>
		    <option ng-repeat="ss in sellers" ng-value="ss.id" ng-selected="ss.id==product.seller_id"><%ss.fname%></option> 
		   </select>
		  <div class="help-block"></div>
                </div>
		<!--<div class="form-group">
                  <label for="exampleInputEmail1">Product Category</label>
                   <select class="form-control" id="" name="pro_category_id" placeholder="Product Category" ng-model="product.pro_category_id">
		    <option value="">Select Product Category</option>
		    <option ng-repeat="cat in categories" ng-value="cat.id" value="cat.id" ng-selected="cat.id==product.pro_category_id"><%cat.category_name%></option> 
		   </select>
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Product Brand</label>
                   <select class="form-control" id="" name="brand_id" placeholder="Product Brand" ng-model="product.brand_id">
		    <option value="">Select Product Brand</option>
		    <option ng-repeat="br in brands" ng-value="br.id" ng-selected="br.id==product.brand_id"><%br.brand_name%></option> 
		   </select>
		  <div class="help-block"></div>
                </div>-->
		<div class="form-group">
                  <label for="exampleInputEmail1">Product Tags</label>
                  <input type="text" class="form-control" id="" name="product_tags" placeholder="Product Tags" ng-model="product.product_tags">
		  <div class="help-block"></div>
                </div>
		<!--<div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="text" class="form-control" id="" name="price" placeholder="Price" ng-model="product.price">
		  <div class="help-block"></div>
                </div>-->
		<div class="form-group">
                  <label for="exampleInputEmail1">No. of Stocks</label>
                  <input type="text" class="form-control" id="" name="no_stock" placeholder="No. of Stocks" ng-model="product.no_stock">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Meta Title</label>
                  <input type="text" class="form-control" id="" name="meta_title" placeholder="Meta Title" ng-model="product.meta_title">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Meta Description</label>
                  <input type="text" class="form-control" id="" name="meta_description" placeholder="Meta Description" ng-model="product.meta_description">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Meta Keywords</label>
                  <input type="text" class="form-control" id="" name="meta_keywords" placeholder="Meta Keywords" ng-model="product.meta_keywords">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <input type="radio"  id="" name="status"  ng-model="product.status" ng-checked="product.status=='Active'" value="Active" >Active
		  <input type="radio" id="" name="status"  ng-model="product.status" ng-checked="product.status=='Inactive'"  value="Inactive">Inactive 
		  <div class="help-block"></div>
                </div>
		
		<div class="main-form-pro row">
		    <label for="exampleInputEmail1">Product Data-</label>
			<select name="pro_data_type" ng-model="product.pro_datatype_id" ng-init="product.pro_datatype_id=1">
			 <optgroup label="Product Type">
			 <option ng-repeat="dt in datatyps" ng-value="dt.id" ng-selected="dt.id==product.pro_datatype_id" value="<%dt.id%>"><%dt.data_type%></option> 
			 </optgroup>
			</select>   
		    <span title="Click to toggle" class="handlediv" ng-click="myFunc3()"><i class="fa fa-caret-down custom"></i></span>
			 <div class="col-xs-12 main--tab" ng-show="showMe3">
			     <div class="col-md-2">
				   <div class="first-box" ng-if="product.pro_datatype_id == '1'">
					<ul class="nav nav-pills nav-stacked">
					<li ng-class="{ active: isSet(1) }">
					<a href ng-click="setTab(1)"><i class="fa fa-bars" aria-hidden="true"></i>General</a>
					</li>
					<li ng-class="{ active: isSet(2) }">
					<a href ng-click="setTab(2)"><i class="fa fa-line-chart" aria-hidden="true"></i>Inventory</a>
					</li>
					<li ng-class="{ active: isSet(3) }">
					<a href ng-click="setTab(3)"><i class="fa fa-bus" aria-hidden="true"></i>Shipping</a>
					</li>
					<li ng-class="{ active: isSet(4) }">
					<a href ng-click="setTab(4)"><i class="fa fa-link" aria-hidden="true"></i>Linked Products</a>
					</li>
					<li ng-class="{ active: isSet(5) }">
					<a href ng-click="setTab(5)"><i class="fa fa-minus-square-o" aria-hidden="true"></i>Attributes</a>
					</li>
					<li ng-class="{ active: isSet(6) }">
					<a href ng-click="setTab(6)"><i class="fa fa-cog" aria-hidden="true"></i>Advanced</a>
					</li>
					</ul>
				   </div>
				   <div class="second-box" ng-if="product.pro_datatype_id == '2'">
					<ul class="nav nav-pills nav-stacked">
					<li ng-class="{ active: isSet(2) }">
					<a href ng-click="setTab(2)"><i class="fa fa-line-chart" aria-hidden="true"></i>Inventory</a>
					</li>
				       <li ng-class="{ active: isSet(4) }">
					<a href ng-click="setTab(4)"><i class="fa fa-link" aria-hidden="true"></i>Linked Products</a>
					</li>
					<li ng-class="{ active: isSet(5) }">
					<a href ng-click="setTab(5)"><i class="fa fa-minus-square-o" aria-hidden="true"></i>Attributes</a>
					</li>
					<li ng-class="{ active: isSet(6) }">
					<a href ng-click="setTab(6)"><i class="fa fa-cog" aria-hidden="true"></i>Advanced</a>
					</li>
					</ul>
				   </div>
				   <div class="third-box" ng-if="product.pro_datatype_id == '3'">
					<ul class="nav nav-pills nav-stacked">
					<li ng-class="{ active: isSet(1) }">
					<a href ng-click="setTab(1)"><i class="fa fa-bars" aria-hidden="true"></i>General</a>
					</li>
					<li ng-class="{ active: isSet(4) }">
					<a href ng-click="setTab(4)"><i class="fa fa-link" aria-hidden="true"></i>Linked Products</a>
					</li>
					<li ng-class="{ active: isSet(5) }">
					<a href ng-click="setTab(5)"><i class="fa fa-minus-square-o" aria-hidden="true"></i>Attributes</a>
					</li>
					<li ng-class="{ active: isSet(6) }">
					<a href ng-click="setTab(6)"><i class="fa fa-cog" aria-hidden="true"></i>Advanced</a>
					</li>
					</ul>
				   </div>
				   
				   <div class="third-box" ng-if="product.pro_datatype_id == '4'">
					<ul class="nav nav-pills nav-stacked">
					<li ng-class="{ active: isSet(1) }">
					<a href ng-click="setTab(1)"><i class="fa fa-bars" aria-hidden="true"></i>General</a>
					</li>
					<li ng-class="{ active: isSet(2) }">
					<a href ng-click="setTab(2)"><i class="fa fa-line-chart" aria-hidden="true"></i>Inventory</a>
					</li>
					<li ng-class="{ active: isSet(3) }">
					<a href ng-click="setTab(3)"><i class="fa fa-bus" aria-hidden="true"></i>Shipping</a>
					</li>
					<li ng-class="{ active: isSet(4) }">
					<a href ng-click="setTab(4)"><i class="fa fa-link" aria-hidden="true"></i>Linked Products</a>
					</li>
					<li ng-class="{ active: isSet(5) }">
					<a href ng-click="setTab(5)"><i class="fa fa-minus-square-o" aria-hidden="true"></i>Attributes</a>
					</li>
					<li ng-class="{ active: isSet(6) }">
					<a href ng-click="setTab(6)"><i class="fa fa-cog" aria-hidden="true"></i>Advanced</a>
					</li>
					</ul>
				   </div>
			     </div>
			     <div class="col-md-8">
				   <div class="jumbotron">
					 <div ng-show="isSet(1)">
					     <div class="form-group">
					     <label for="exampleInputEmail1">SKU</label>
					     <input type="text" placeholder="" class="form-control" value="" id="sku" name="sku" ng-model="product.sku">
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Regular Price (Rs.)</label>
					     <!--<input type="text" placeholder="" value="" id="regular_price" name="regular_price">-->
					     <input type="text" class="form-control" id="" name="price" placeholder="Price" ng-model="product.price">
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Sale Price (Rs.)</label>
					     <input type="text" placeholder="" class="form-control" id="" name="sale_price" ng-model="product.sale_price">
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Sale Price Dates From</label>
					     <input type="text" placeholder="YYYY-MM-DD" class="form-control" id="date_from" name="date_from" ng-model="product.date_from">
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Sale Price Dates To</label>
					     <input type="text" placeholder="YYYY-MM-DD" class="form-control" id="date_to" name="date_to" ng-model="product.date_to">
					     </div>
					     <div class="form-group">
					     <label for="exampleInputEmail1">Youtube Link</label>
					     <textarea cols="20" rows="2" class="form-control" placeholder="Youtube Link for multiple enter in new line" id="video" name="video" ng-model="product.video"></textarea>
					     </div>
					 </div>
					 <div ng-show="isSet(2)">
					 <div class="form-group">
					     <label for="exampleInputEmail1">Manage stock?</label>
					     <input type="checkbox" name=""> Enable stock management at product level
					     </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Stock status</label>
					     <select class="form-control">
						  <option value="in_stock">In stock</option>
						  <option value="out_stock">Out stock</option>
					     </select>
					     </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Sold Individually</label>
					     <input type="checkbox" name=""> Enable this to only allow one of this item to be bought in a single order
					     </div>
					 </div>
					 <div ng-show="isSet(3)">
					 <div class="form-group">
					     <label for="exampleInputEmail1">Weight(kg)</label>
					     <input type="text" class="form-control" placeholder="0" name="weight" ng-model="product.weight">
					     </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Dimensions (cm)</label>
					     <input type="text" placeholder="Length" name="length" class="form-control" ng-model="product.length">
					     <input type="text" placeholder="Width" name="width" class="form-control" ng-model="product.width">
					     <input type="text" placeholder="Height" name="height" class="form-control" ng-model="product.height">
					     </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Shipping class</label>
					     <select class="form-control">
						  <option value="no_shipping">No shipping class</option>
					     </select>
					     </div>
					 </div>
					 <div ng-show="isSet(4)">
					 <h1>Messages4</h1>
					 <p> Some messages4 </p>
					 </div>
					 <div ng-show="isSet(5)">
					 <div class="form-group">
					     <label for="exampleInputEmail1">Custom Product option</label>
					     <!--<select class="form-control" name="pro_opt_name_id" ng-model="product.pro_opt_name_id"  ng-change="GetSelectedOptions(product.pro_opt_name_id)">
						<option ng-repeat="opnam in options" ng-value="opnam.id" ng-selected="opnam.id==product.pro_opt_name_id" value="<%opnam.id%>"><% opnam.option_name %></option>
					     </select>-->
					     <select class="form-control" name="pro_opt_name_id" ng-model="product.pro_opt_name_id"  ng-change="">
						<option ng-repeat="opnam in options" ng-if="check_exist(opnam.id)" ng-value="opnam.id" ng-selected="opnam.id==product.pro_opt_name_id" value="<%opnam.id%>"><% opnam.option_name %></option>
					     </select>
					     <button ng-click="addData(product.pro_opt_name_id);product.pro_opt_name_id=''" type="submit" class="btn btn-primary">Add</button>
					  </div>
					 <div class="form-group" ng-repeat="newvalue in optval" ng-init="product.pro_opt_values_id[newvalue.optid]=newvalue.opt_ids">
					    <% newvalue.parent_name[0].option_name %>
					     <select class="form-control" name="pro_opt_values_id" ng-model="product.pro_opt_values_id[newvalue.optid]" multiple="multiple">
						<option ng-repeat="opv in newvalue.all" ng-value="opv.id" value="<%opv.id%>"><% opv.option_name %></option>
					     </select>
					     <a href="" ng-click="removeData($index);">Remove</a>
					 </div>
					 
					 <% product.pro_opt_values_id %><!--<div class="form-group">
					 <select class="form-control" name="pro_opt_values_id" ng-model="product.pro_opt_values_id" multiple>
						<option ng-repeat="opv in optionvalues" ng-value="opv.id" ng-selected="opv.id==product.pro_opt_values_id" value="<%opv.id%>"><% opv.option_name %></option>
					     </select>
					  </div>-->
					 </div>
					 <div ng-show="isSet(6)">
					 <div class="form-group">
					     <label for="exampleInputEmail1">Purchase Note</label>
					     <textarea cols="20" rows="2" placeholder="" id="" name="" class="form-control"></textarea>
					  </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Menu Order</label>
					     <input type="number" class="form-control" step="1" placeholder="" value="0" id="menu_order" name="menu_order" style="" class="short">
					 </div>
					 <div class="form-group">
					     <label for="exampleInputEmail1">Enable reviews</label>
					     <input type="checkbox" name="">
					 </div>
					 </div>
					
				    </div>
			     </div>
			 </div>
		    </div>
                  
	      </div>
	      <div class="col-xs-3">
		    <div class="row">
		      <div class="col-xs-12">
			 <div class="main-form-chk">
			 <label for="exampleInputEmail1">Product Categories</label>
			 <span title="Click to toggle" class="handlediv" ng-click="myFunc()"><i class="fa fa-caret-down custom"></i></span>
			 <div class="form-chk" ng-show="showMe">
			 <input type="text" placeholder="Filter Categories" ng-model="test"><br>
			 <div class="frm-cat"> <% product.pro_category_id %> 
			     <script type="text/ng-template" id="categoryTree">
  
   <input type="checkbox" ng-model="product.pro_category_id[category.id]" ng-selected="" value="<%category.id%>" name="pro_category_id[]" ><% category.category_name %>
   <ul ng-if="category.all_category">
       <li class="cat-tree" ng-repeat="category in category.all_category | filter:test" ng-include="'categoryTree'">           
       </li>
   </ul>
</script><% all_category %>
<ul class="ul-cat">
   <li class="cat-tree" ng-repeat="category in all_category | filter:test" ng-include="'categoryTree'"></li>
</ul>
			 <!--<span ng-repeat="cat1 in categories | filter : test">
			      <input type="checkbox" ng-model="product.pro_category_id[cat1.id]" name="pro_category_id[]" > <%cat1.category_name%><br>
			  </span>-->
			 </div>
			 </div>
			 </div>
		      </div>
		      <div class="col-xs-12">
		      <div class="main-form-chk">
		      <label for="exampleInputEmail1">Images</label>
		      <span title="Click to toggle" class="handlediv" ng-click="myFuncimg()"><i class="fa fa-caret-down custom" ></i></span>
		      <div class="form-img-chk" ng-show="showMeimg">
			<div class="imgs_ro" ng-repeat="val in pr_imgs">               
			    <img src="{{URL::asset('uploads')}}/<% val.img %>"  alt="" ng-mouseleave="tr_dis[$index]=0" ng-mouseover="tr_dis[$index]=1"/>
			     <a class="ms_ov" href="javascript:void(0);" ng-if="$index != values.length - 1" ng-mouseleave="tr_dis[$index]=0" ng-mouseover="tr_dis[$index]=1" ng-show="tr_dis[$index]==1" >
				 <i class="fa fa-check" title="Set default" ng-show="val.def==0"  ng-click="setdefault($index)"></i>
				 <i class="fa fa-check grr_ic"  title="Unset default"  ng-show="val.def==1"  ng-click="unsetdefault($index)"></i>
				 <i class="fa fa-trash" title="Delete"  ng-click="removeimgs(val.img,$index)" ></i>
			     </a>
			 </div>
			 <div style="clear:both"></div>
			<div class="btn btn-primary btn-file" ng-show="pr_imgs.length < 8">
			    <i class="fa fa-plus"></i> <input type="file" onchange="angular.element(this).scope().uploadedFile(this)" >
			</div>
		      </div>
		      </div>
		      </div>
		      <div class="col-xs-12">
		      <div class="main-form-chk">
		      <label for="exampleInputEmail1">Product Brands</label>
		      <span title="Click to toggle" class="handlediv" ng-click="myFunc1()"><i class="fa fa-caret-down custom" ></i></span>
		      <div class="form-chk" ng-show="showMe1">
			 <input type="text" placeholder="Filter Brands" ng-model="brd"><br>
			 <div class="frm-cat">
			      <span class="form-brd" ng-repeat="br in brands | filter : brd">
			       <input type="radio" id="" name="brand_id" ng-model="product.brand_id" ng-value="br.id" ng-selected="product.brand_id==br.id"><%br.brand_name%><br>
			    </span>
			 </div>
		      </div>
		      </div>
		      </div>
		    </div>
	      </div>
	      </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(product,pr_imgs)" type="submit" class="btn btn-primary">Submit</button>
              </div>
           
          </div>



          <!-- Form Element sizes -->
    </section>
   
  <!-- /.content-wrapper -->
  