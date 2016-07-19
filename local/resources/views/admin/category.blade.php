  <section class="content" >
       <div class="col-md-12">
	
        <div class="alert alert-success" ng-if="success_flash">
            <p >
            <% success_flash %>
            </p>
        </div>
        <div class="alert alert-danger"  ng-if="errors">>
            <ul>
                <li ng-repeat ="er in errors"><% er %></li>
         
            </ul>
        </div>
      
          <!-- /.box -->
         
          <div class="box" ng-if="page=='index'">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Category List</h3>
              <div class="pull-right"> <a href="javascript:void(0);" ng-click="add()" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table  if="categories"id="example1" class="table table-bordered table-striped">
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
            
                 {{ csrf_field() }}
                  <input type="hidden" class="form-control" id="" name="category_id" ng-model="category.id" placeholder="Name" value="<% category.id %>">
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" ng-model="category.category_name"  placeholder="Name" value="<% category.category_name %>">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea name="description" class="textarea" placeholder="Description" ng-model="category.description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><% category.description %></textarea>  
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <img class='' src="{{URL::asset('uploads')}}/<% category.image %>" width="100">
                  <input type="file"  name="image" ng-model="category.file">
		  <div class="help-block"></div>
                </div> 
                 <div class="form-group">
                  <label for="exampleInputEmail1">Parent Category</label>
                  <select class="form-control" name="parent_cat"  ng-model="category.parent_cat">
                      <option value="0">Please select</option>
                      
                      <option ng-repeat="cat in all_cat" ng-if="cat.id !=  category.id" ng-selected="category.parent_id"><% cat.category_name %></option>
                       
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
                  <label for="exampleInputEmail1">Description</label>
                  <textarea name="description" class="textarea" placeholder="Description" ng-model="cat.description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                     
                  </textarea>  
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <input type="file"  name="image" ng-model="cat.image">
		  <div class="help-block"></div>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Parent Category</label>
                  <select class="form-control" name="parent_cat"  ng-model="cat.parent_id">
                      <option value="0">Please select</option>
                                            
                      <option ng-repeat="cast in all_cat" ng-if="cast.id !=  category.id" ng-selected="cat.parent_id"><% cast.category_name %></option>
                  </select>
		  <div class="help-block"></div>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                   <input type="radio"  id="" name="status" ng-model="cat.status"  value="Active" checked   >Active <input type="radio" id="" name="status" value="Inactive" ng-model="cat.status"   >Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          
          </div>
          <!-- /.box -->
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
        

        </div>

    </section>
   
  <!-- /.content-wrapper -->
 
    <script>
                $(function () {
                $("#example1").DataTable();


              });
             </script>
              <script>
            $(function () {
              // Replace the <textarea id="editor1"> with a CKEditor
              // instance, using default configuration.
             // CKEDITOR.replace('editor1');

              $(".textarea").wysihtml5();
            });
          </script>