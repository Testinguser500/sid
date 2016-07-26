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
              <h3 class="box-title"><i class="fa fa-list"></i> Seller List</h3>
			  <a class="add-link btn btn-success btn-flat btn-grid" href="javascript:void(0);" ng-click="add()"><i class="fa fa-plus-square"></i> Add Seller</a>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Seller Name</th>
                  <th>Email</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                
                <tr ng-repeat="val in users">
                  <td><% val.id %></td>
                  <td><% val.name %></td>
                  <td><% val.email %></td>
                  <td><i ng-click="editseller(val)" class="fa fa-edit" style="cursor:pointer"></i> <i class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
                 
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this seller ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                                  {{ csrf_field() }}
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button data-dismiss="modal" ng-click="deleteSeller($index)" class="btn btn-primary" >Delete</button>
                            
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
        <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i>Create Seller</h3>
				<div class="pull-right"><a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" ng-model="seller.name">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" id="" name="email" placeholder="Email" ng-model="seller.email">
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select class="form-control" id="" name="gender" ng-model="seller.gender">
				  <option value="male">Male</option>
				  <option value="female">Female</option>
				  </select>
		  <div class="help-block"></div>
                </div>

				<div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="address" ng-model="seller.address"></textarea>
		  <div class="help-block"></div>
                </div>
				
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <input type="file"  name="image" ng-model="seller.image" onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>
                </div> 
                
                  <div class="form-group">
                  <label for="exampleInputMobile">Mobile</label>
                  <input type="text" class="form-control" id="" name="mobile" placeholder="Mobile" ng-model="seller.mobile">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company Name</label>
                  <input type="text" class="form-control" id="" name="company_name" placeholder="Company Name" ng-model="seller.company_name">
		  <div class="help-block"></div>
                </div>
                  <div class="form-group">
                  <label for="exampleInputMobile">Store Link</label>
                  <input type="text" class="form-control" id="" name="store_link" placeholder="Store Link" ng-model="seller.store_link">
		  <div class="help-block"></div>
                </div>
                  <div class="form-group">
                  <label for="exampleInputMobile">Company PAN Number</label>
                  <input type="text" class="form-control" id="" name="company_pan_no" placeholder="Company PAN Number" ng-model="seller.company_pan_no">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company TIN/VAT Number</label>
                  <input type="text" class="form-control" id="" name="company_tin_no" placeholder="Company TIN Number" ng-model="seller.company_tin_no">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Company Address</label>
                  <textarea class="form-control" id="" name="company_address" ng-model="seller.company_address"></textarea>
		  <div class="help-block"></div>
                </div>
                
                  
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active" ng-model="seller.status">Active <input type="radio" id="" name="status" value="Inactive" ng-model="seller.status" ng-init="seller.status='Inactive'">Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-hide="loading" ng-click="store(seller);" class="btn btn-primary">Submit</button>
				<button ng-show="loading" class="btn btn-primary">Loading...</button>
              </div>
            </form>
          </div> 
			<div class="box box-primary" ng-if="page=='edit'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i>Edit Seller</h3>
				<div class="pull-right"><a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
                 {{ csrf_field() }}
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" ng-model="seller.name" value="<%seller.name%>">
				  <input type="hidden" class="form-control" id="" name="id" placeholder="Name" ng-model="seller.id" value="<%seller.id%>">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control" readonly="readonly" id="" name="email" placeholder="Email" ng-model="seller.email" value="<%seller.email%>">
		  <div class="help-block"></div>
                </div>
				
				<div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select class="form-control" id="" name="gender" ng-model="seller.gender">
				  <option value="male" ng-selected="seller.gender=='male'">Male</option>
				  <option value="female" ng-selected="seller.gender=='female'">Female</option>
				  </select>
		  <div class="help-block"></div>
                </div>

				<div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" id="" name="address" ng-model="seller.address"><%seller.email%></textarea>
		  <div class="help-block"></div>
                </div>
				
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
				  <img class='' src="{{URL::asset('uploads/seller/')}}/<% seller.image %>" width="100">
                  <input type="file"  name="image" ng-model="seller.image" onchange="angular.element(this).scope().uploadedFile(this)">
		  <div class="help-block"></div>
                </div> 
                
                  <div class="form-group">
                  <label for="exampleInputMobile">Mobile</label>
                  <input type="text" class="form-control" id="" name="mobile" placeholder="Mobile" ng-model="seller.mobile" value="<%seller.mobile%>">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company Name</label>
                  <input type="text" class="form-control" id="" name="company_name" placeholder="Company Name" ng-model="seller.company_name" value="<%seller.company_name%>">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company PAN Number</label>
                  <input type="text" class="form-control" id="" name="company_pan_no" placeholder="Company PAN Number" ng-model="seller.company_pan_no" value="<%seller.company_pan_no%>">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputMobile">Company TIN/VAT Number</label>
                  <input type="text" class="form-control" id="" name="company_tin_no" placeholder="Company TIN Number" ng-model="seller.company_tin_no" value="<%seller.company_tin_no%>">
		  <div class="help-block"></div>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Company Address</label>
                  <textarea class="form-control" id="" name="company_address" ng-model="seller.company_address"><%seller.company_address%></textarea>
		  <div class="help-block"></div>
                </div>
                
                  
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Status </label>
                  <input type="radio"  id="" name="status" value="Active" ng-model="seller.status">Active <input type="radio" id="" name="status" value="Inactive" ng-model="seller.status">Inactive 
		  <div class="help-block"></div>
                </div> 
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-hide="loading" ng-click="update(seller);" class="btn btn-primary">Submit</button>
				<button ng-show="loading" class="btn btn-primary">Loading...</button>
              </div>
            </form>
          </div>
        

    </section>
