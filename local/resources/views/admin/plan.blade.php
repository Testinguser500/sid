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
              <h3 class="box-title"><i class="fa fa-list"></i> Plan List</h3>
              <div class="pull-right"> <a href="javascript:void(0);" ng-click="add()" ng-init="success_flash=false" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a></div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table    id="example1"   class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Plan Name</th>
                  <th>Status</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
               
                <tr ng-repeat="val in categories">
                  <td><% val.id %></td>
                  <td><% val.plan_name %></td>
                  <td><% val.plan_status %></td>
                  <td>
                      <i class="fa fa-edit" title="Edit" ng-click="editcategory(val)" style="cursor:pointer" ></i> 
                 
                  <!-- Modal -->
               
                  </td>
                  
                </tr>
               
                </tbody>
                <tfoot>
                 <tr>
                  <th>#</th>
                  <th>Pan Name</th>
                  <th>Status</th>
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
                <h3 class="box-title"><i class="fa fa-plus"></i> Create Plan</h3>
                <div class="pull-right"><a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Plan Name" ng-model="plan.plan_name">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Plan Duration</label>
                  <input type="text" class="form-control" id="" name="plan_duration" placeholder="Plan Duration In Days" ng-model="plan.plan_duration">Days
		  <div class="help-block"></div>
                </div>
		<div class="form-group">
                  <label for="exampleInputEmail1">Plan Price</label>
                  <input type="text" class="form-control" id="" name="plan_price" placeholder="Plan Price" ng-model="plan.plan_price">Days
		  <div class="help-block"></div>
                </div>
		
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <div text-angular ng-model="plan.description" name="demo-editor" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div> 
                                    
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
<% plans.image %>
                  <div class="form-group col-xs-12 show-pn">
                <img src="{{URL::asset('uploads/plan')}}/<% plansimage %>" width="310" height="210" ng-show="files" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" >  
                  <br/>
                  <span class="btn btn-primary btn-file" ng-hide="files">
		   Upload <input type="file" onchange="angular.element(this).scope().uploadedFile(this)" >
		  </span>
		<em>Image size is(310x210) and not  more than 1 mb.</em>
		<a ng-show="display_cross==1" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" class="bnr-del " title="Delete" ng-click="delcatefiles(files);display_cross=0" href="javascript:void(0);">
                    <img src="{{URL::asset('admin/img/del.png')}}">
                </a>
				  
		  <div class="help-block"></div>
                </div>
                </div> 
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                   <input type="radio"  id="" name="status" ng-model="plan.status"  value="Active" ng-init="plan.status='Active'"  >Active <input type="radio" id="" name="status" value="Inactive" ng-model="plan.status"   >Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="store(plan);" class="btn btn-primary">Submit</button>
              </div>
          
          </div>
          <!-- /.box -->
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
        

       

    </section>
   
  <!-- /.content-wrapper -->
 
   
