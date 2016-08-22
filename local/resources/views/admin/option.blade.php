
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
	       <div class="form-group col-md-2 ">		  
	       <button class="btn btn-default" data-toggle="modal" data-target="#screen_opt_modal">Screen Options</button>
	       </div>
               <div class="form-group col-md-2 ">		  
	       <button class="btn btn-danger " data-toggle="modal" data-target="#delete_opt_modal"><i class="fa fa-trash"></i> Delete</button>               
	       </div>
                 <div class="modal fade" id="delete_opt_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete</h4>                            
			      </div>
			     <div class="modal-body">
				   Are you sure you want to delete these attribute groups ? 
			         
			      </div>
			      <div class="modal-footer">
				  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>			      
				  <button type="submit" class="btn btn-primary" data-dismiss="modal" ng-click="del_attr_gr(selected_attr)" >Delete</button>                         
			      </div>
			    </div>
			  </div>
		    </div>
                 <div class="modal fade" id="screen_opt_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Screen Options</h4>                            
			      </div>
			      <div class="modal-body">
				  <div class="row" ng-init="screen_opt={attr_group:true,status:true}">				      
				    <div class="col-md-4">
				       <div class="form-group">
					    <input ng-model="screen_opt.attr_group"  type="checkbox"> Attribute Group
				       </div>
				    </div>
				     <div class="col-md-4">
				       <div class="form-group">
					    <input ng-model="screen_opt.category"  type="checkbox"> Category
				       </div>
				    </div>
				    <div class="col-md-4">
				       <div class="form-group">
					    <input ng-model="screen_opt.attr"  type="checkbox"> Attributes : Options
				       </div>
				    </div>
                                    <div class="col-md-4">
				       <div class="form-group">
					    <input ng-model="screen_opt.status"  type="checkbox"> Status
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
             <div class="row">
		    <div class="form-group col-md-2 pull-left">		  
			<select ng-init="tb_pag=5" class="form-control ng-pristine ng-valid ng-touched" ng-model="tb_pag">
			    <option value="5" ng-selected="tb_pag==5" selected="selected">5</option>
			    <option value="10" ng-selected="tb_pag==10">10</option>
			    <option value="100" ng-selected="tb_pag==100">100</option>
			    <option value="1000" ng-selected="tb_pag==1000">1000</option>
			</select>
		    </div>
		    <div class="form-group col-md-3 pull-right">		  
		      <input placeholder="Search" class="form-control " ng-model="search" type="text">
		    </div>
	      </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><input type="checkbox" name="sel_att_gr"  ng-model="selectedAll" ng-click="checkAll();"></th>
                  <th ng-click="sort('id')" style="cursor:pointer">ID
                  <span class="glyphicon sort-icon"  ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-if="screen_opt.attr_group" ng-click="sort('option_name')" style="cursor:pointer">Attribute Group
                  <span class="glyphicon sort-icon"  ng-show="sortKey=='option_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-if="screen_opt.category" >Category
                  </th>
                  <th ng-if="screen_opt.attr">Attributes : Options                    
                  </th>
                  <th ng-if="screen_opt.status" ng-click="sort('status')" style="cursor:pointer">Status
                  <span class="glyphicon sort-icon"  ng-show="sortKey=='status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>           
                </tr>
                </thead>
                <tbody>                
                <tr dir-paginate="val in options|orderBy:sortKey:reverse|itemsPerPage:tb_pag|filter:search" > 
                  <td>
                      <input type="checkbox" name="sel_att_gr[]" value="<% val.id %>" ng-model="selected_attr[val.id]" >
                  </td>
                  <td><% val.id %></td>
                  <td data-toggle="modal" data-target="#edit_modal" style="cursor:pointer"  ng-click="edit_modal('attr_gr',val)"  ng-if="screen_opt.attr_group" ><% val.option_name %></td>                
                  <td data-toggle="modal" data-target="#edit_modal" style="cursor:pointer"  ng-click="edit_modal('cats',val);" ng-if="screen_opt.category"><% val.category_name %></td>  
                  <td data-toggle="modal" data-target="#edit_modal" style="cursor:pointer"  ng-click="edit_modal('attribute',val)" ng-if="screen_opt.attr">
                      <p ng-repeat="attr in val.attribute">
                          <span><% attr.option_name %> : </span> 
                          <span ng-repeat="(ky,vy) in attr.options">
                              <span ng-if="ky != 0">,</span>
                              <% vy.option_name %>
                          </span>
                      </p>
                  </td>
                  <td ng-if="screen_opt.status">
                      <span class="label label-success" ng-if="val.status=='Active'" ng-click="val.status='Inactive';update(val,'status');" style="cursor:pointer"> <% val.status %></span>
                      <span class="label label-danger" ng-if="val.status!='Active'" ng-click="val.status='Active';update(val,'status');" style="cursor:pointer"> <% val.status %></span>
                  </td>  
                </tr>
              
                </tbody>
                <tfoot>
                 <tr>
                  <th></th>
                  <th>ID</th>
                  <th ng-if="screen_opt.attr_group">Attribute Group</th>
                  <th ng-if="screen_opt.category">Category
                  </th>
                  <th ng-if="screen_opt.attr">Attributes : Options                        
                  </th>
                  <th ng-if="screen_opt.status">Status</th>                              
                </tr>
                </tfoot>                
              </table>
                  <dir-pagination-controls
					max-size="tb_pag"
					direction-links="true"
					boundary-links="true" >
		</dir-pagination-controls>
                <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" ng-click="init();" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit</h4>                            
			      </div>
			     <div class="modal-body">
                                    <div class="alert alert-success" ng-if="success_flash_pop">
                                        <p>
                                        <% success_flash_pop %>
                                        </p>
                                    </div>
                                    <div class="alert alert-danger"  ng-if="errors_pop">
                                        <ul>
                                            <li ng-repeat ="er in errors_pop"><% er %></li>         
                                        </ul>
                                    </div> 
                                    <div class="form-group" ng-if="edit_field=='attr_gr'">
                                        <label for="exampleInputEmail1">Attribute Group</label>
                                        <input type="text" class="form-control" id="" name="option_name" placeholder="Option Name" ng-model="edit_values.option_name">
                                        <div class="help-block"></div>
                                    </div> 
                                    <div class="form-group attri"  ng-if="edit_field=='cats'">
                                        <div class="sel_cat">
                                        <input type="radio"  ng-model="cat_select" ng-click="sel_al('select');" ng-value="true" name="selectcat1"  > All     
                                        <input type="radio"  ng-model="cat_select" ng-click="sel_al('unselect');"  ng-value="false" name="selectcat1" > Selected
			                </div>
                                        <div>
                                           <input type="text" placeholder="Filter Categories" class="form-control" ng-model="test">
                                        </div>
                                        
                                        <div class="all_cats" >
                                        <script type="text/ng-template" id="categoryTree1" >                                   
                                                 
                                       <input  type="checkbox"  ng-model="edit_values.cats_id[category.id]"  ng-value="true" value="<%category.id%>" name="pro_category_id[]"   > 
                                         <% category.category_name %>
                                        <ul ng-if="category.all_category">
                                        <li class="cat-tree" ng-repeat="category in category.all_category | filter:test" ng-include="'categoryTree1'"  >           
                                        </li>
                                        </ul>
                                        </script>
                                        <ul class="ul-cat">
                                        <li class="cat-tree" ng-repeat="category in all_cats | filter:test"  ng-include="'categoryTree1'" ></li>
                                        </ul>                             
                                        </div>
                                        <p ng-show="cat_select_error && cat_select_error != false && cat_select_error!=''" class="error_att" ng-bind="cat_select_error"></p>
                                    </div> 
                                 <div class="form-group" ng-if="edit_field=='attribute'">                                   
                                     <table class="table table-bordered all_att_rw" >
                                      <tr ng-if="edit_values.attribute">
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
                                       <tr ng-repeat="(ky,atr) in edit_values.attribute"  ng-if="edit_values.attribute">
                                           <td>
                                                 <button class="btn btn-danger sm_att"  ng-click="pop_attr_edit(ky);" > <i class="icon ion-minus"></i> </button>                 
                                           </td>
                                           <td>
                                               <div class="form-group">
                                                   <input ng-blur="duplicate_check_atr_name_edit(ky)" type="text" class="form-control" ng-focus="remove_show_save();" Placeholder="Attribute" ng-model="edit_values.attribute[ky].option_name"> 
                                                   <p ng-show="edit_values.attribute[ky].error!=''" class="error_att" ><% edit_values.attribute[ky].error %></p>
                                                </div>           
                                           </td>
                                           <td>
                                                <div class="form-group">
                                                    <select class="form-control" ng-model="edit_values.attribute[ky].type" >
                                                        <option value="select">select</option>
                                                        <option value="radio">radio</option>
                                                    </select> 

                                                </div>                   
                                           </td>
                                           <td>
                                              <div class="form-group" ng-repeat="(ke,val) in atr.options" ng-if="atr.options.length > 0">
                                                  <input type="text" class="form-control" id="" ng-blur="duplicate_check_atr_value_edit(ky,ke)" ng-focus="remove_show_save();"  ng-model="edit_values.attribute[ky].options[ke].option_name" name="option_name" placeholder="Option" >
                                                  <p ng-show="edit_values.attribute[ky].options[ke].error!=''" class="error_att" ><% edit_values.attribute[ky].options[ke].error %></p>
                                                  <div class="help-block"></div>
                                                  <button class="btn btn-success button button-small sm_att" ng-if="$index == atr.options.length - 1" ng-click="addInput_edit(ky)">
                                                    <i class="icon ion-plus"></i>
                                                  </button>
                                                 <button class="btn btn-danger button button-small sm_att" ng-if="$index != atr.options.length - 1" ng-click="removeInput_edit(ky,ke)">
                                                    <i class="icon ion-minus"></i>
                                                 </button>
                                               </div>                
                                           </td>
                                      </tr>
                                      <tr >
                                          <td colspan="4">                            
                                             <button class="btn btn-primary pull-right"  ng-click="push_attr_edit();" >Add Attribute Rows </button>                    
                                          </td>
                                     </tr>
                                     </table>                      
                                   
                                 </div>
			      </div>
			      <div class="modal-footer">
				  <button type="button" class="btn btn-default pull-left" ng-click="init();" data-dismiss="modal">Close</button>			      
				  <button class="btn btn-primary" ng-if="show_save" ng-click="update(edit_values,'')" >Update</button> 
                                   <button class="btn btn-primary" ng-if="!show_save" >Update</button> 
			      </div>
			    </div>
			  </div>
		  </div>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Create Attribute</h3>                             
                <div class="pull-right"> <a href="javascript:void(0);" ng-click="init();" class="btn btn-default">Back</a></div>
                 <div class="pull-right save_all_attr" ng-show="opt_grp.length > 1">
                         <button class="btn btn-primary pull-right" ng-if="show_save" ng-click="save_attr(opt_grp);" >Save Attributes</button>
                         <button class="btn btn-primary pull-right" ng-if="!show_save" >Save Attributes</button>
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
                               <button class="btn btn-danger sm_att"  ng-click="pop_attr(ot_ky,ky);" > <i class="icon ion-minus"></i> </button>                 
                         </td>
                         <td>
                             <div class="form-group">
                                 <input ng-blur="duplicate_check_atr_name(ot_ky,ky)" type="text" class="form-control" ng-focus="remove_show_save();" Placeholder="Attribute" ng-model="opt_grp[ot_ky].attribute[ky].atr_name"> 
                                 <p ng-show="opt_grp[ot_ky].attribute[ky].error!=''" class="error_att" ><% opt_grp[ot_ky].attribute[ky].error %></p>
                              </div>           
                         </td>
                         <td>
                              <div class="form-group">
                                  <select class="form-control" ng-model="opt_grp[ot_ky].attribute[ky].atr_type" >
                                      <option value="select">select</option>
                                      <option value="radio">radio</option>
                                  </select> 
                               
                              </div>                   
                         </td>
                         <td>
                            <div class="form-group" ng-repeat="(ke,val) in atr.atr_val" ng-if="atr.atr_val.length > 0">
                                <input type="text" class="form-control" id="" ng-blur="duplicate_check_atr_value(ot_ky,ky,ke)" ng-focus="remove_show_save();"  ng-model="opt_grp[ot_ky].attribute[ky].atr_val[ke].val_name" name="option_name" placeholder="Option" >
                                <p ng-show="opt_grp[ot_ky].attribute[ky].atr_val[ke].error!=''" class="error_att" ><% opt_grp[ot_ky].attribute[ky].atr_val[ke].error %></p>
                                <div class="help-block"></div>
                                <button class="btn btn-success button button-small sm_att" ng-if="$index == atr.atr_val.length - 1" ng-click="addInput(ot_ky,ky)">
                                  <i class="icon ion-plus"></i>
                                </button>
                                  <button class="btn btn-danger button button-small sm_att" ng-if="$index != atr.atr_val.length - 1" ng-click="removeInput(ot_ky,ky,ke)">
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
          



          <!-- Form Element sizes -->
         

      

    </section>
   
  <!-- /.content-wrapper -->
  