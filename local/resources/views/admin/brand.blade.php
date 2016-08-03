

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
              <h3 class="box-title"><i class="fa fa-list"></i> Brand List</h3>
              <div class="pull-right"> <a href="javascript:void(0);" ng-click="add()" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Brand Name</th>
                  <th>Brand Status</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                
                <tr ng-repeat="val in brands">
                  <td><% val.id %></td>
                  <td><% val.brand_name %></td>
                  <td><% val.status %></td>
                  <td><i ng-click="editbrand(val)" class="fa fa-edit" title="Edit" style="cursor:pointer" ></i> <i title="Delete" class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
                 
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this brand ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                                  {{ csrf_field() }}
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button data-dismiss="modal" ng-click="deleteBrand($index)" class="btn btn-primary" >Delete</button>
                            
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
                  <th>Brand Name</th>
                  <th>Brand Status</th>
                  <th> </th>                 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
          <!-- /.box -->
        <!-- Button trigger modal -->

          <!-- Form Element sizes -->
         <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Create Brand</h3>
                <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" ng-model="brand.brand_name" placeholder="Name" >
		  <div class="help-block"></div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Meta Title</label>
                  <input type="text" class="form-control" id="" name="meta_title" placeholder="Meta Title" ng-model="brand.meta_title">
		  <div class="help-block"></div>
                </div> 
                 <div class="form-group">
                  <label for="exampleInputEmail1">Meta Description</label>
                  <input type="text" class="form-control" id="" name="meta_description" placeholder="Meta Description" ng-model="brand.meta_description">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Meta Keyword</label>
                  <input type="text" class="form-control" id="" name="meta_keyword" placeholder="Meta Keyword" ng-model="brand.meta_keyword">
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <div text-angular ng-model="brand.description" name="description" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>  
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>

                <div class="form-group col-xs-12 show-bn">
                <img src="{{URL::asset('uploads/brand')}}/<% files %>" width="200" height="80" ng-show="files" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" >  
                  <br/>
                  <span class="btn btn-primary btn-file" ng-hide="files">
		   Upload <input type="file" onchange="angular.element(this).scope().uploadedFile(this)" >
		  </span>
		<em>Upload a brand image for your store. Image size is(200x80) and not  more than 1 mb.</em>
		<a ng-show="display_cross==1" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" class="bnr-del " title="Delete" ng-click="delbrandfiles(files);display_cross=0" href="javascript:void(0);">
                    <img src="{{URL::asset('admin/img/del.png')}}">
                </a>
				  
		  <div class="help-block"></div>
                </div>
                </div> 
                 
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" ng-model="brand.status" ng-init="brand.status='Active'" value="Active">Active <input type="radio" id="" name="status" value="Inactive" ng-model="brand.status" >Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="store(brand)" class="btn btn-primary">Submit</button>
              </div>
           
          </div>

   <!--- Edit Brand------>
         <div class="box box-primary" ng-if="page=='edit'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit Brand</h3>
                 <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
                 {{ csrf_field() }}
                  <input type="hidden" class="form-control" id="" name="brand_id" ng-model="brand.id" placeholder="Name" value="<% brands.id %>">
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="brand_name" ng-model="brand.brand_name" placeholder="Name" >
		  <div class="help-block"></div>
                </div> 
                   <div class="form-group">
                  <label for="exampleInputEmail1">Meta Title</label>
                  <input type="text" class="form-control" id="" name="meta_title" placeholder="Meta Title" ng-model="brand.meta_title">
		  <div class="help-block"></div>
                </div> 
                 <div class="form-group">
                  <label for="exampleInputEmail1">Meta Description</label>
                  <input type="text" class="form-control" id="" name="meta_description" placeholder="Meta Description" ng-model="brand.meta_description">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Meta Keyword</label>
                  <input type="text" class="form-control" id="" name="meta_keyword" placeholder="Meta Keyword" ng-model="brand.meta_keyword">
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <div text-angular ng-model="brand.description" name="description" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>  
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                 <div class="form-group col-xs-12 show-bn">
                <img src="{{URL::asset('uploads/brand')}}/<% files %>" width="200" height="80" ng-show="files" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" >  
                  <br/>
                  <span class="btn btn-primary btn-file" ng-hide="files">
		   Upload <input type="file" onchange="angular.element(this).scope().uploadedFile(this)" >
		  </span>
		<em>Upload a brand image for your store. Image size is(200x80) and not  more than 1 mb.</em>
		<a ng-show="display_cross==1" ng-mouseover="display_cross=1" ng-mouseleave="display_cross=0" class="bnr-del " title="Delete" ng-click="delbrandfiles(files);display_cross=0" href="javascript:void(0);">
                    <img src="{{URL::asset('admin/img/del.png')}}">
                </a>
				  
		  <div class="help-block"></div>
                </div>
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active" ng-model="brand.status" ng-checked="brands.status">Active <input type="radio" id="" name="status" value="Inactive" ng-model="brand.status" ng-checked="brands.status" >Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(brand)" class="btn btn-primary">Submit</button>
              </div>
          
          </div>

    </section>
   
  <!-- /.content-wrapper -->
  