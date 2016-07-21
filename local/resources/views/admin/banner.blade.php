

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
       <div class="col-md-12">
	     
          <!-- /.box -->
            
          <div class="box" ng-if="page=='index'">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Banner List</h3>
		<a class="add-link btn btn-success btn-flat btn-grid" href="javascript:void(0);" ng-click="add()"><i class="fa fa-plus-square"></i> Add Banner</a>	  
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                 
                  <th>Action </th>                 
                </tr>
                </thead>
                <tbody>
                
                <tr ng-repeat="val in banners">
                  <td><% val.id %></td>
                  <td><% val.title %></td>
                  
                  <td><i ng-click="editbanner(val)" class="fa fa-edit" style="cursor:pointer"></i>
                      <i class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
                      <!-- Modal -->
                    <div class="modal fade" id="del_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this banner ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                                  {{ csrf_field() }}
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button data-dismiss="modal" ng-click="deleteBanner($index)" class="btn btn-primary" >Delete</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                 
                  </td>
                  
                </tr>
                
                </tbody>
                
              </table>
            </div>
            
            <!-- /.box-body -->
          </div>
         
          <!-- /.box -->
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
         

        </div>

		<div class="col-md-12">
	     <?php // echo $this->session->flashdata('succ_msg'); ?>
          <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i>Create Banner</h3>
				<div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" class="form-control" id="" name="title" placeholder="Name" ng-model="banner.title">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Banner Type</label>
                  <select name="banner_type" id="" class="form-control" ng-model="banner.position_id"                                          ng-change="onCategoryChange(banner.position_id)" 
        >
		
		<option ng-repeat="val in bannerType" ng-value="$index+1"><%val.position%></option>
   
    </select>
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">URL</label>
                  <input type="text" class="form-control" id="" name="url" ng-model="banner.url">
				  
		  <div class="help-block"></div>
                </div>
		
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <input type="file"  name="image" ng-model="banner.image" onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>
                </div> 
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active" ng-model="banner.status">Active
                  <input type="radio" id="" name="status" value="Inactive" ng-model="banner.status" ng-init="banner.status='Inactive'">Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-hide="loading" ng-click="store(banner)" class="btn btn-primary">Submit</button>
				<button ng-show="loading"  class="btn btn-primary">Loading...</button>
              </div>
            
          </div>
          <!-- /.box -->
         
        
          
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
         

        </div>
		<div class="col-md-12">
	     <?php // echo $this->session->flashdata('succ_msg'); ?>
          <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='edit'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i>Edit Banner</h3>
				<div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="hidden" class="form-control" id="" name="id" ng-model="banner.id" value="<%banner.id%>">
				  <input type="text" class="form-control" id="" name="title" placeholder="Name" ng-model="banner.title" value="<%banner.title%>">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Banner Type</label>
                  <select name="banner_type" id="" class="form-control" ng-model="banner.position_id"                                          ng-change="onCategoryChange(banner.position_id)" 
        >
		
		<option ng-repeat="val in bannerType" ng-value="$index+1" ng-selected="banner.position_id"><%val.position%></option>
   
    </select>
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">URL</label>
                  <input type="text" class="form-control" id="" name="url" ng-model="banner.url" value="<%banner.url%>">
				  
		  <div class="help-block"></div>
                </div>
		
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
				  <img class='' ng-if="banner.image" src="{{URL::asset('uploads/banner')}}/<% banner.image %>" width="100">
                  <input type="file"  name="image" ng-model="banner.image" onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>
                </div> 
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active" ng-model="banner.status" ng-checked="banner.status">Active
                  <input type="radio" id="" name="status" value="Inactive" ng-model="banner.status" ng-checked="banner.status">Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-hide="loading" ng-click="update(banner)" class="btn btn-primary">Submit</button>
				<button ng-show="loading"  class="btn btn-primary">Loading...</button>
              </div>
            
          </div>
          <!-- /.box -->
         
        
          
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
         

        </div>
    </section>
   
  <!-- /.content-wrapper -->
