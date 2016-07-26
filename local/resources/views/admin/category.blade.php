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
              <div class="pull-right"> <a href="javascript:void(0);" ng-click="add()" ng-init="success_flash=false" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a></div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table  if="categories"  id="example1"   class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Category Name</th>
                  <th>Category Status</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
               
                <tr ng-repeat="val in categories">
                  <td><% val.id %></td>
                  <td><% val.category_name %></td>
                  <td><% val.status %></td>
                  <td>
                      <i class="fa fa-edit" title="Edit" ng-click="editcategory(val)" style="cursor:pointer" ></i> <i class="fa fa-trash" title ="Delete" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
                 
                  <!-- Modal -->
               <div class="modal fade" id="del_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            
                                
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button ng-click="deleteCategory($index)" class="btn btn-primary" data-dismiss="modal" >Delete</button>
                           
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
                  <th>Category Name</th>
                  <th>Category Status</th>
                  <th> </th>                 
                </tr>
                </tfoot>
              </table>
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
                  <img class='' src="{{URL::asset('uploads')}}/<% category.image %>" width="100">
                  <input type="file"  name="image" ng-model="category.file" onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>
                </div> 
                 <div class="form-group">
                  <label for="exampleInputEmail1">Parent Category</label>
                  <select class="form-control" name="parent_cat"  ng-model="category.parent_id">
                      <option value="0">Please select</option>
                      
                      <option ng-repeat="cat in all_cat" ng-if="cat.id !=  category.id" ng-selected="category.parent_id" ng-value="cat.id"><% cat.category_name %></option>
                       
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
                  <input type="file"  name="image" ng-model="cat.image" onchange="angular.element(this).scope().uploadedFile(this)" >
		  <div class="help-block"></div>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Parent Category</label>
                  <select class="form-control" name="parent_cat"  ng-model="cat.parent_id" ng-init="cat.parent_id=0">
                      <option value="0">Please select</option>
                                            
                      <option ng-repeat="cast in all_cat" ng-value="cast.id" ng-if="cast.id !=  category.id" ng-selected="cat.parent_id"><% cast.category_name %></option>
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
 
   
<!--              <script>
            $(function () {
              // Replace the <textarea id="editor1"> with a CKEditor
              // instance, using default configuration.
             // CKEDITOR.replace('editor1');

              $(".textarea").wysihtml5();
            });
          </script>-->