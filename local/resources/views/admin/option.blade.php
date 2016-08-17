
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
              <h3 class="box-title"><i class="fa fa-list"></i> Attribute List</h3>
              <div class="pull-right"> <a href="javascript:void(0)" ng-click="add();"class="btn btn-primary"><i class="fa fa-plus"></i> Add Attribute Group</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
             <div class="row">
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
                  <th ng-click="sort('option_name')" style="cursor:pointer">Option Name
                  <span class="glyphicon sort-icon"  ng-show="sortKey=='option_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-click="sort('status')" style="cursor:pointer">Status
                  <span class="glyphicon sort-icon"  ng-show="sortKey=='status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                
                <tr dir-paginate="val in options|orderBy:sortKey:reverse|itemsPerPage:10|filter:search"> 
                  <td><% val.id %></td>
                  <td><% val.option_name %></td>
                  <td><% val.status %></td>
                  <td><a href="javascript:void(0);" ng-click="editoption(val)"><i class="fa fa-edit" title="Edit"></i></a>
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
                            Are you sure you want to delete this faq question ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button type="submit" class="btn btn-primary" data-dismiss="modal" ng-click="deleteoption($index)" >Delete</button>
                            
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
                  <th>Option Name</th>
                  <th>Status</th>
                  <th> </th>                 
                </tr>
                </tfoot>                
              </table>
                  <dir-pagination-controls
					max-size="10"
					direction-links="true"
					boundary-links="true" >
		</dir-pagination-controls>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Create Attribute</h3>                             
                <div class="pull-right"> <a href="javascript:void(0);" ng-click="init();" class="btn btn-default">Back</a></div>
                 <div class="pull-right save_all_attr" ng-show="opt_grp.length > 1">
                         <button class="btn btn-primary pull-right" ng-show="show_save" ng-click="save_attr(opt_grp);" >Save Attributes</button>
                 </div> 
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body attri">
                <div class="row">
                     <div class="col-md-3">
                          <label for="Category">Category</label>
                    </div>
                      <div class="col-md-9">
                          <div class="col-md-3">
                               <div class="sel_cat">
                                  <input type="radio"  ng-model="cat_select" ng-value="true" value="true" name="selectcat"  > All     
                                  <input type="radio"  ng-model="cat_select" ng-value="false"  value="false" name="selectcat" > Selected
			      </div>
                              <div>
                                  <input type="text" placeholder="Filter Categories" class="form-control" ng-model="test">
			      </div>
			      <div class="all_cats">
			      <script type="text/ng-template" id="categoryTree">
			      <input ng-if="cat_select==true" type="checkbox" ng-init="option.category_id[category.id]=true" ng-model="option.category_id[category.id]" value="<%category.id%>" name="pro_category_id[]" ng-checked="cat_select==true" > 
                               <input ng-if="cat_select==false" type="checkbox" ng-init="option.category_id[category.id]=false" ng-model="option.category_id[category.id]" value="<%category.id%>" name="pro_category_id[]"  > 
                              <% category.category_name %>
			      <ul ng-if="category.all_category">
			      <li class="cat-tree" ng-repeat="category in category.all_category | filter:test" ng-include="'categoryTree'">           
			      </li>
			      </ul>
			      </script>
			      <ul class="ul-cat">
			      <li class="cat-tree" ng-repeat="category in all_cats | filter:test" ng-include="'categoryTree'"></li>
                              </ul>                             
                              </div>
                              <p ng-show="cat_select_error && cat_select_error != false && cat_select_error!=''" class="error_att" ng-bind="cat_select_error"></p>
                          </div>
                         
                    </div>
                </div>
           <div class="row add_gr">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Attribute Group</label>
                  <input type="text" class="form-control" id="" name="option_name" placeholder="Option Name" ng-model="option.option_name">
		  <div class="help-block"></div>
                </div> 
              </div>
               
           </div>
           <div class="row add_gr">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1" ng-init="option.status='Active'" >Status </label>
                    <input type="radio" ng-model="option.status" ng-checked="option.status" id="" name="status"  value="Active">Active <input ng-model="option.status" type="radio" id="" name="status" value="Inactive" checked>Inactive 
                    <div class="help-block"></div>
                  </div>
                </div>
                <div class="col-md-9">
                 <div class="form-group">
                     <button class="btn btn-default" ng-click="store(option)">Add Attribute Group</button>
                 </div> 
               </div>
             </div>
             
              <table class="table table-bordered all_att_rw"  ng-repeat="(ot_ky,ot) in opt_grp" ng-if="ot.opt_id">
                  <tr> 
                      <td>                  
                         <label ><% ot.opt_name %> </label>                        
                      </td>            
                 </tr>
                 <tr><td>
                   <table class="table table-bordered all_att_rw" >
                    <tr ng-if="ot.attribute">
                        <td>
                                            
                         </td>
                         <td>
                           Attribute                 
                         </td>
                         <td>
                           Type                 
                         </td>
                         <td>
                           Options                 
                         </td>
                    </tr>
                     <tr ng-repeat="(ky,atr) in ot.attribute"  ng-if="ot.attribute">
                         <td>
                               <button class="btn btn-danger "  ng-click="pop_attr(ot_ky,ky);" > <i class="icon ion-minus"></i> </button>                 
                         </td>
                         <td>
                             <div class="form-group">
                                 <input ng-blur="duplicate_check_atr_name(ot_ky,ky)" type="text" class="form-control" ng-focus="remove_show_save();" Placeholder="Attribute" ng-model="opt_grp[ot_ky].attribute[ky].atr_name"> 
                                 <p ng-show="opt_grp[ot_ky].attribute[ky].error!=''" class="error_att" ><% opt_grp[ot_ky].attribute[ky].error %></p>
                              </div>           
                         </td>
                         <td>
                              <div class="form-group">
                                  <select class="form-control" ng-model="opt_grp[ot_ky].attribute[ky].atr_type" ng-change="select_change(ot_ky,ky)">
                                      <option value="radio">radio</option>
                                      <option value="yes/no">yes/no</option>
                                  </select> 
                               
                              </div>                   
                         </td>
                         <td>
                            <div class="form-group" ng-repeat="(ke,val) in atr.atr_val" ng-if="atr.atr_val.length > 0">
                                <input type="text" class="form-control" id="" ng-blur="duplicate_check_atr_value(ot_ky,ky,ke)" ng-focus="remove_show_save();"  ng-model="opt_grp[ot_ky].attribute[ky].atr_val[ke].val_name" name="option_name" placeholder="Option" >
                                <p ng-show="opt_grp[ot_ky].attribute[ky].atr_val[ke].error!=''" class="error_att" ><% opt_grp[ot_ky].attribute[ky].atr_val[ke].error %></p>
                                <div class="help-block"></div>
                                <button class="btn btn-success button button-small button-balanced" ng-if="$index == atr.atr_val.length - 1" ng-click="addInput(ot_ky,ky)">
                                  <i class="icon ion-plus"></i>
                                </button>
                                  <button class="btn btn-danger button button-small button-assertive" ng-if="$index != atr.atr_val.length - 1" ng-click="removeInput(ot_ky,ky,ke)">
                                  <i class="icon ion-minus"></i>
                                  </button>
                             </div>                
                         </td>
                    </tr>
                    <tr >
                        <td colspan="4">                            
                           <button class="btn btn-primary pull-right"  ng-click="push_attr(ot_ky);" >Add Attribute Rows </button>                    
                        </td>
                   </tr>
                   </table>                      
                 </td></tr>
             </table> 
             
          </div>
              <!-- /.box-body -->
           
<!--              <div class="box-footer">
                <button ng-click="store(option)" type="submit" class="btn btn-primary">Submit</button>
              </div>-->
            
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
          
             <input type="hidden" class="form-control" id="" ng-model="option.id" name="option_id" placeholder="ID" >
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Option Name</label>
                  <input type="text" class="form-control" id=""  ng-model="option.option_name" name="option_name" placeholder="Option Name" >
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <input type="radio"  id="" name="status"  ng-model="option.status" ng-checked="option.status=='Active'" value="Active" >Active
		  <input type="radio" id="" name="status"  ng-model="option.status" ng-checked="option.status=='Inactive'"  value="Inactive">Inactive 
		  <div class="help-block"></div>
                </div>
	       <label for="exampleInputEmail1">Option Values</label>
		
		
                <div class="form-group" ng-repeat="val in values">
               
		  <input type="text" class="form-control" id=""  ng-model="val.option_name" name="option_name" placeholder="Option Value" >
		  <div class="help-block"></div>
		  <button class="btn btn-success button button-small button-balanced" ng-if="$index == values.length - 1" ng-click="addInput()">
		    <i class="icon ion-plus"></i>
		  </button>
		    <button class="btn btn-danger button button-small button-assertive" ng-if="$index != values.length - 1" ng-click="removeInput($index)">
		    <i class="icon ion-minus"></i>
		    </button>
                </div>
                  
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(option,values)" type="submit" class="btn btn-primary">Submit</button>
              </div>
           
          </div>



          <!-- Form Element sizes -->
         

      

    </section>
   
  <!-- /.content-wrapper -->
  