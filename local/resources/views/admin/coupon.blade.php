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
		  <th ng-click="sort('min_amount')" style="cursor:pointer">Min Amount<span class="glyphicon sort-icon"  ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th ng-click="sort('coupon_status')" style="cursor:pointer">Status<span class="glyphicon sort-icon"  ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
               
                <tr dir-paginate="val in coupons|orderBy:sortKey:reverse|itemsPerPage:tb_pag|filter:search">
                  <td><% val.id %></td>
                  <td><% val.coupon_name %></td>
		  <td><% val.expire_date %></td>
		  <td><% val.min_amount %></td>
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
		  <div class="form-group">
                  <label for="exampleInputEmail1">Coupon Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Coupon Name" ng-model="coupon_datas.coupon_name">
		  <div class="help-block"></div>
                </div>
                  <label for="exampleInputEmail1">Discount Type</label>
                  <select class="form-control" id="" name="discount_type" ng-model="coupon_datas.discount_type">
			
		  <option ng-value="fixed" ng-selected="coupon_datas.discount_type=='fixed'">Fixed</option>
		  <option ng-value="percentage" ng-selected="coupon_datas.discount_type=='percentage'">Percentage</option>
		  </select>
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Discount Value</label>
                  <input type="text" class="form-control" id="" name="discount_value" placeholder="Discount Value" ng-model="coupon_datas.discount_value">
		  <div class="help-block"></div>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea ng-model="coupon_datas.description" class="form-control"></textarea>
                  <div class="help-block"></div>
                </div> 
		  <div class="form-group">
                  <label for="exampleInputEmail1">Usage Limit</label>
                  <input type="text" class="form-control" id="" name="usage_limit" placeholder="Usage Limit" ng-model="coupon_datas.usage_limit">
		  <div class="help-block"></div>
                </div>
		  
		  <div class="form-group">
                  <label for="exampleInputEmail1">Expire Date</label>
                  <input type="text" class="form-control" id="" name="expire_date" placeholder="YYYY-MM-DD" ng-model="coupon_datas.expire_date">
		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Exclude Sale</label>
                  </br>
		  <input type="checkbox" class="" id="" name="exclude_sale" ng-model="coupon_datas.exclude_sale" ng-checked="coupon_datas.exclude_sale==1" value="1"> Check this box if the coupon should not apply to items on sale.
<!--<em>Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are no sale items in the cart.</em>
-->		  <div class="help-block"></div>
                </div>
	    
	    <div class="form-group">
                  <label for="exampleInputEmail1">Min Amount</label>
                  <input type="text" class="form-control" id="" name="min_amount" placeholder="Min Amount" ng-model="coupon_datas.min_amount">
		  <div class="help-block"></div>
                </div>
	    
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                   <input type="radio"  id="" name="status" ng-model="coupon_datas.status" ng-checked="coupon_datas.coupon_status=='Active'"  value="Active" >Active <input type="radio" id="" name="status" value="Inactive" ng-checked="coupon_datas.coupon_status=='Inactive'" ng-model="coupon_datas.status"   >Inactive 
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
                  <label for="exampleInputEmail1">Discount Type</label>
                  <select class="form-control" id="" name="plan_duration" ng-model="coupons.discount_type">
		  <option ng-value="fixed">Fixed</option>
		  <option ng-value="percentage">Percentage</option>
		  </select>
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Discount Value</label>
                  <input type="text" class="form-control" id="" name="discount_value" placeholder="Discount Value" ng-model="coupons.discount_value">
		  <div class="help-block"></div>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <div text-angular ng-model="coupons.description" name="demo-editor" ta-text-editor-class="border-around" ta-html-editor-class="border-around">			</div> 
                  <div class="help-block"></div>
                </div> 
		  <div class="form-group">
                  <label for="exampleInputEmail1">Usage Limit</label>
                  <input type="text" class="form-control" id="" name="usage_limit" placeholder="Usage Limit" ng-model="coupons.usage_limit">
		  <div class="help-block"></div>
                </div>
		  
		  <div class="form-group">
                  <label for="exampleInputEmail1">Expire Date</label>
                  <input type="text" class="form-control" id="" name="expire_date" placeholder="YYYY-MM-DD" ng-model="coupons.expire_date">
		  <div class="help-block"></div>
                </div>
		  <div class="form-group">
                  <label for="exampleInputEmail1">Exclude Sale</label>
                  </br>
		  <input type="checkbox" class="" id="" name="exclude_sale" ng-model="coupons.exclude_sale" value="1"> Check this box if the coupon should not apply to items on sale.
<!--<em>Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are no sale items in the cart.</em>
-->		  <div class="help-block"></div>
                </div>
	    
	    <div class="form-group">
                  <label for="exampleInputEmail1">Min Amount</label>
                  <input type="text" class="form-control" id="" name="min_amount" placeholder="Min Amount" ng-model="coupons.min_amount">
		  <div class="help-block"></div>
                </div>
	    
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                   <input type="radio"  id="" name="status" ng-model="coupons.status"  value="Active" ng-init="coupons.status='Active'"  >Active <input type="radio" id="" name="status" value="Inactive" ng-model="coupons.status"   >Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-hide="loading" ng-click="store(coupons);" class="btn btn-primary">Submit</button>
		<button ng-show='loading'  class="btn btn-primary">Loading</button>
              </div>
          
          </div>
          <!-- /.box -->
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
        

       

    </section>
   
  <!-- /.content-wrapper -->
 
   
