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
              <h3 class="box-title"><i class="fa fa-list"></i> Category List</h3>
              <div class="pull-right"> <a href="javascript:void(0);" ng-click="add()" ng-init="success_flash=false" class="btn btn-primary"><i class="fa fa-plus"></i> Add Category</a></div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">

              <!--<div class="row">
                <div class="form-group col-md-3 pull-right">
		  

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
              </div>-->
	      <div class="row">
		    <div class="form-group col-md-2 ">		  
			<button class="btn btn-default" data-toggle="modal" data-target="#screen_opt_modal">Screen Options</button>
			</div>
		   
			  <!-- Modal -->
		    <div class="modal fade" id="screen_opt_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Screen Options</h4>                            
			      </div>
			      <div class="modal-body">
				  <div class="row" ng-init='screen_opt=[{"sr_no":true},{"category_name":true},{"status":true},{"action":true},{"meta_title":false},{"meta_description":false},{"meta_keywords":false},{"image":false},{"product":false}]'>
				      
				     <div class="col-md-4">
				       <div class="form-group">
					    <input type="checkbox" ng-model="screen_opt[1].category_name" > Category Name
				       </div>
				    </div>
				     <div class="col-md-4">
				       <div class="form-group">
					    <input type="checkbox"  ng-model="screen_opt[2].status"> Status
				       </div>
				     </div>
				     
					<div class="col-md-4">
				       <div class="form-group">
					    <input type="checkbox" ng-model="screen_opt[4].meta_title"> Meta Title
				       </div>
				    </div>
				     <div class="col-md-4">
				       <div class="form-group">
					    <input type="checkbox" ng-model="screen_opt[5].meta_description"> Meta Description
				       </div>
				    </div>
				     <div class="col-md-4">
				       <div class="form-group">
					    <input type="checkbox"  ng-model="screen_opt[6].meta_keywords"> Meta Keyword
				       </div>
				     </div>
				     
				     <div class="col-md-4">
				       <div class="form-group">
					    <input type="checkbox"  ng-model="screen_opt[7].image"> Image Thumbnail
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
	      
              <!--<table    id="example1"   class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th ng-click="sort('id')" style="cursor:pointer">#<span class="glyphicon sort-icon" ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
							</th>
                  <th ng-click="sort('category_name')" style="cursor:pointer">Category Name
                  <span class="glyphicon sort-icon"  ng-show="sortKey=='category_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-click="sort('status')" style="cursor:pointer">Category Status
                  <span class="glyphicon sort-icon"   ng-show="sortKey=='status'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th> </th>                 
                </tr>
                </thead>
		
		<script type="text/ng-template" id="categoryTree">
			      
			      
                
             
                <tr class="accordion-toggle collapsed"  data-toggle="collapse" data-target="#collapse<%category.id%>" aria-expanded="false">
                  <td><% $index+1 %></td>
                  <td><% category.category_name %></td>
                  <td><% category.status %></td>
                  <td>
                      <i class="fa fa-edit" title="Edit" ng-click="editcategory(category)" style="cursor:pointer" ></i> <i class="fa fa-trash" title ="Delete" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% category.id %>"></i>
                 
                  
               <div class="modal fade" id="del_modal<% category.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this category ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                           
                                
                               <input type="hidden" name="del_id" value="<% category.id %>" />
                               <button ng-click="deleteCategory($index)" class="btn btn-primary" data-dismiss="modal" >Delete</button>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  
                </tr>
               
<tr id="collapse<%category.parent_id%>" ng-repeat="category in category.all_category" ng-include="'categoryTree'"  class="accordion-toggle collapse"  data-toggle="collapse" data-target="#collapse<%category.id%>" aria-expanded="false">
</tr>
              
      </script>
		
		  <tbody ng-repeat="category in all_category" ng-include="'categoryTree'"  >
		  
		</tbody>
                <tfoot>
                 <tr>
                  <th>#</th>
                  <th>Category Name</th>
                  <th>Category Status</th>
                  <th> </th>                 
                </tr>
                </tfoot>
              </table>-->
                <!--<dir-pagination-controls
					max-size="10"
					direction-links="true"
					boundary-links="true" >
		</dir-pagination-controls>-->
		<div class="row cat-p">
		  <div class="col-xs-12 col-md-2">#</div>
		  <div ng-if="screen_opt[1].category_name" class="col-xs-12 col-md-2">Category Name</div>
		  <div ng-if="screen_opt[4].meta_title" class="col-xs-12 col-md-2">Meta Title</div>
		  <div ng-if="screen_opt[5].meta_description" class="col-xs-12 col-md-2">Meta Description</div>
		  <div ng-if="screen_opt[6].meta_keywords" class="col-xs-12 col-md-2">Meta Keywords</div>
		  <div ng-if="screen_opt[7].image" class="col-xs-12 col-md-2">Thumbnail</div>
		  <div ng-if="screen_opt[2].status" class="col-xs-12 col-md-2">Category Status</div>
		  <div class="col-xs-12 col-md-2">Products</div>
		  <div class="col-xs-12 col-md-2">Action</div>
		  </div>
		
		<script type="text/ng-template" id="categoryTree1">
		  <div class="col-xs-12 col-md-2"><a class="open" ng-class="{'closed' : category.condition}" ng-click="category.condition=!category.condition;" style="cursor:pointer" data-toggle="collapse" data-target="#collapsee<%category.id%>"><span class="plus_ico" ng-show="category.condition">+</span><span class="minus_ico" ng-show="!category.condition">-</span></a></div>
		  <div ng-if="screen_opt[1].category_name" class="col-xs-12 col-md-2"><% category.category_name %></div>
		  <div ng-if="screen_opt[4].meta_title" class="col-xs-12 col-md-2"><%category.meta_title%></div>
		  <div ng-if="screen_opt[5].meta_description" class="col-xs-12 col-md-2"><%category.meta_description%></div>
		  <div ng-if="screen_opt[6].meta_keywords" class="col-xs-12 col-md-2"><%category.meta_keyword%></div>
		  <div ng-if="screen_opt[7].image" class="col-xs-12 col-md-2"><img src="{{URL::asset('uploads/category')}}/<% category.image %>" width="100" height="100"></div>
		  <div ng-if="screen_opt[2].status" class="col-xs-12 col-md-2"><a href="javascript:void(0);" ng-click="changeStatus(category);"><span class="label <% (category.status=='Active')?'label-success':'label-danger'%>"><% category.status %></span></a></div>
		  <div class="col-xs-12 col-md-2"><% category.pro_count %></div>
		  <div class="col-xs-12 col-md-2"><i class="fa fa-edit" title="Edit" ng-click="editcategory(category)" style="cursor:pointer" ></i> <i class="fa fa-trash" title ="Delete" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% category.id %>"></i>
                 
                  <!-- Modal -->
               <div class="modal fade" id="del_modal<% category.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this category ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>                           
                                
                               <input type="hidden" name="del_id" value="<% category.id %>" />
                               <button ng-click="deleteCategory($index)" class="btn btn-primary" data-dismiss="modal" >Delete</button>
                           
                          </div>
                        </div>
                      </div>
                    </div></div>
		    
		  <div  id="collapsee<%category.parent_id%>" ng-repeat="category in category.all_category" ng-include="'categoryTree1'"  class="col-xs-12 accordion-toggle collapse"   aria-expanded="false" ng-class="{'closed' : condition}">
		  
		</div>
		</script>
		<div class="row cat-r" ng-repeat="category in all_category" ng-include="'categoryTree1'">
		  
		</div>
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
            
                
                  <input type="hidden" class="form-control" id="" name="category_id" ng-model="category.id" placeholder="Name" value="<% category.id %>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" ng-model="category.category_name"  placeholder="Name" value="<% category.category_name %>">
		  <div class="help-block"></div>
                </div> 
        
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <div text-angular ng-model="category.description" name="demo-editor" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>  
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Meta Title</label>
                  <input type="text" class="form-control" id="" name="meta_title" placeholder="Meta Title" ng-model="category.meta_title">
		  <div class="help-block"></div>
                </div> 
                 <div class="form-group">
                  <label for="exampleInputEmail1">Meta Description</label>
                  <input type="text" class="form-control" id="" name="meta_description" placeholder="Meta Description" ng-model="category.meta_description">
		  <div class="help-block"></div>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Meta Keyword</label>
                  <input type="text" class="form-control" id="" name="meta_keyword" placeholder="Meta Keyword" ng-model="category.meta_keyword">
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
<!--                  <img class='' src="{{URL::asset('uploads')}}/<% category.image %>" width="100">
                  <input type="file"  name="image" ng-model="category.file" onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>-->
                <div class="form-group col-xs-12 show-bn">
                <img src="{{URL::asset('uploads/category')}}/<% files %>" width="310" height="210" ng-show="files" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" >  
                  <br/>
                  <span class="btn btn-primary btn-file" ng-hide="files">
		   Upload <input type="file" onchange="angular.element(this).scope().uploadedFile(this)" >
		  </span>
		<em>Upload a category image for your store. Image size is(310x210) and not  more than 1 mb.</em>
		<a ng-show="display_cross==1" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" class="bnr-del " title="Delete" ng-click="delcatefiles(files);display_cross=0" href="javascript:void(0);">
                    <img src="{{URL::asset('admin/img/del.png')}}">
                </a>
				  
		  <div class="help-block"></div>
                </div>
                </div> 
                 <div class="form-group">
                  <label for="exampleInputEmail1">Parent Category</label>
                  <select class="form-control" name="parent_cat"  ng-model="category.parent_id">
                      <option value="0">Please select</option>                      
                      <option ng-repeat="cat in all_cat" ng-if="cat.id !=  category.id" ng-selected="category.parent_id==cat.id" value="<% cat.id %>" ng-value="cat.id"><% cat.category_name %></option>                      
                  </select>
		  <div class="help-block"></div>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" ng-model="category.status"  value="Active" ng-checked="category.status"   >Active <input type="radio" id="" name="status" value="Inactive" ng-model="category.status"  ng-checked="category.status" >Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(category)" class="btn btn-primary">Submit</button>
              </div>
            
          </div>
          <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Create Category</h3>
                <div class="pull-right"><a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" ng-model="cat.category_name">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Meta Title</label>
                  <input type="text" class="form-control" id="" name="meta_title" placeholder="Meta Title" ng-model="cat.meta_title">
		  <div class="help-block"></div>
                </div> 
                 <div class="form-group">
                  <label for="exampleInputEmail1">Meta Description</label>
                  <input type="text" class="form-control" id="" name="meta_description" placeholder="Meta Description" ng-model="cat.meta_description">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Meta Keyword</label>
                  <input type="text" class="form-control" id="" name="meta_keyword" placeholder="Meta Keyword" ng-model="cat.meta_keyword">
		  <div class="help-block"></div>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <div text-angular ng-model="cat.description" name="demo-editor" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div> 
                                    
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>

                  <div class="form-group col-xs-12 show-bn">
                <img src="{{URL::asset('uploads/category')}}/<% files %>" width="310" height="210" ng-show="files" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" >  
                  <br/>
                  <span class="btn btn-primary btn-file" ng-hide="files">
		   Upload <input type="file" onchange="angular.element(this).scope().uploadedFile(this)" >
		  </span>
		<em>Upload a category image for your store. Image size is(310x210) and not  more than 1 mb.</em>
		<a ng-show="display_cross==1" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" class="bnr-del " title="Delete" ng-click="delcatefiles(files);display_cross=0" href="javascript:void(0);">
                    <img src="{{URL::asset('admin/img/del.png')}}">
                </a>
				  
		  <div class="help-block"></div>
                </div>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Parent Category</label>
                  <select class="form-control" name="parent_cat"  ng-model="cat.parent_id" ng-init="cat.parent_id=0">
                      <option value="0">Please select</option>                                            
                      <option ng-repeat="cast in all_cat" ng-value="cast.id" ><% cast.category_name %></option>
                  </select>
		  <div class="help-block"></div>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                   <input type="radio"  id="" name="status" ng-model="cat.status"  value="Active" ng-init="cat.status='Active'"  >Active <input type="radio" id="" name="status" value="Inactive" ng-model="cat.status"   >Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="store(cat);" class="btn btn-primary">Submit</button>
              </div>
          
          </div>
          <!-- /.box -->
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
        

       

    </section>
   
  <!-- /.content-wrapper -->
 
   
