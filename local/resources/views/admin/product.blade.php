
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
              <div class="pull-right"> <a href="javascript:void(0)" ng-click="add();"class="btn btn-primary"><i class="fa fa-plus"></i> Add</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Product Name</th>
		  <th>Category Name</th>
                  <th>Status</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                
                <tr ng-repeat="val in products"> 
                  <td><% val.id %></td>
                  <td><% val.pro_name %></td>
		  <td><% val.category_name %></td>
                  <td><% val.status %></td>
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
                  <th>Product Name</th>
		  <th>Category Name</th>
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
                <h3 class="box-title"><i class="fa fa-plus"></i> Create Option Name</h3>
                <div class="pull-right"> <a href="javascript:void(0);" ng-click="init();" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">
			 
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
		<div class="form-group">
                  <label for="exampleInputEmail1">Product Category</label>
                   <select class="form-control" id="" name="pro_category_id" placeholder="Product Category" ng-model="product.pro_category_id">
		    <option value="">Select Product Category</option>
		    <option ng-repeat="cat in categories" ng-value="cat.id" ng-selected="cat.id==product.pro_category_id"><%cat.category_name%></option> 
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
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Product Tags</label>
                  <input type="text" class="form-control" id="" name="product_tags" placeholder="Product Tags" ng-model="product.product_tags">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="text" class="form-control" id="" name="price" placeholder="Price" ng-model="product.price">
		  <div class="help-block"></div>
                </div>
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
                  <label for="exampleInputEmail1" ng-init="product.status='Active'" >Status </label>
                  <input type="radio" ng-model="product.status" ng-checked="product.status" id="" name="status"  value="Active">Active <input ng-model="product.status" type="radio" id="" name="status" value="Inactive" checked>Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="store(product)" type="submit" class="btn btn-primary">Submit</button>
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
		<div class="form-group">
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
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Product Tags</label>
                  <input type="text" class="form-control" id="" name="product_tags" placeholder="Product Tags" ng-model="product.product_tags">
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="text" class="form-control" id="" name="price" placeholder="Price" ng-model="product.price">
		  <div class="help-block"></div>
                </div>
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
                  
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(product)" type="submit" class="btn btn-primary">Submit</button>
              </div>
           
          </div>



          <!-- Form Element sizes -->
    </section>
   
  <!-- /.content-wrapper -->
  