

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
              <h3 class="box-title"><i class="fa fa-list"></i> Static Content List</h3>
			  
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
                
                <tr ng-repeat="val in contents">
                  <td><% val.id %></td>
                  <td><% val.title %> </td>
                  
                  <td><i ng-click="editcontent(val)" class="fa fa-edit" style="cursor:pointer"></i> 
                 
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

		<div class="box box-primary" ng-if="page=='edit'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit User</h3>
                 <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
                 {{ csrf_field() }}
				 
				 <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="hidden" class="form-control" id="" name="content_id" ng-model="content.id" value="<% content.id %>">
                  <input type="text" class="form-control" id="" name="title" placeholder="Name" ng-model="content.title" value="<% content.title %>">
		  <div class="help-block"></div>
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Short Description</label>
                   
				<div text-angular ng-model="content.short_description" name="short_description" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>				  
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                    
				  <div text-angular ng-model="content.description" name="description" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>
		  <div class="help-block"></div>
                </div> 
				
                <div class="form-group" ng-if="content.image">
                  <label for="exampleInputEmail1">Image</label>
                  <img class='' src="{{URL::asset('uploads/static/')}}/<% content.image %>" width="100">
                  <input type="file" ng-file-select  name="image" ng-model="content.image">
		  <div class="help-block"></div>
                </div> 
                 
                  
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(content)" class="btn btn-primary">Submit</button>
                
              </div>
			  
			  </div>
			  
    </section>
   
  <!-- /.content-wrapper -->
