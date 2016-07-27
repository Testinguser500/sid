

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
              <h3 class="box-title"><i class="fa fa-list"></i> Country List</h3>
			  <a class="add-link btn btn-success btn-flat btn-grid" href="javascript:void(0);" ng-click="add()"><i class="fa fa-plus-square"></i> Add Country</a>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Country</th>
                 <th>State</th>
				 <th>City</th>
                  <th>Action </th>                 
                </tr>
                </thead>
                <tbody ng-repeat="val in contents">
                
                <tr >
                  <td><% val.id %></td>
                  <td ng-if="val.pid==0"><% val.name %> </td>
                  <td>
				  
				  </td><td>&nbsp;</td>
                  <td><i ng-click="editcontent(val)" class="fa fa-edit" style="cursor:pointer"></i>
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
                            Are you sure you want to delete this country ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                                  {{ csrf_field() }}
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button data-dismiss="modal" ng-click="deleteCountry($index)" class="btn btn-primary" >Delete</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>				  
                 
                  </td>
				  <td ng-if="val.pid!=0">			  
                 
                  </td>
                 
                </tr>
                <tr ng-repeat="st in val.state">
				<td>&nbsp;</td><td>&nbsp;</td>
				<td > <%st.name%> </td><td>
					<table>
					<tr ng-repeat="ct in st.city"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td > <%ct.name%>&nbsp; <i title="Delete City" class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_city<% ct.id %>"></i>
<!--Delete City Model-->
					<div class="modal fade" id="del_city<% ct.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this city ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                                  {{ csrf_field() }}
                               <input type="hidden" name="del_id" value="<% ct.id %>" />
							   
                               <button data-dismiss="modal" ng-click="deleteCity(ct.id)" class="btn btn-primary" >Delete</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>					</td><td>&nbsp;</td></tr>
					</table>
					</td><td>
					<i title="Add City" data-toggle="modal" data-target="#city_modal<% st.id %>" class="fa fa-plus" style="cursor:pointer"></i>
				  <i title="Edit State" ng-click="editcontent(st)" class="fa fa-edit" style="cursor:pointer"></i>
					<i title="Delete State" class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% st.id %>"></i>
                 <!--City Model-->
				 <div class="modal fade" id="city_modal<% st.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add City</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
							  <label for="exampleInputEmail1">City Name</label>
							  {{ csrf_field() }}
                               <input type="" name="id" ng-init="country.id=st.id" ng-model="country.id" value="<% st.id %>" />
							  <input type="text" class="form-control" id="" name="name" placeholder="Name" ng-model="country.name" >
								<div class="help-block"></div>
						</div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                                  
							   
                               <button data-dismiss="modal" ng-click="store(country)" class="btn btn-primary" >Submit</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal<% st.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this state ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                                  {{ csrf_field() }}
                               <input type="hidden" name="del_id" value="<% st.id %>" />
							   
                               <button data-dismiss="modal" ng-click="deleteCity(st.id)" class="btn btn-primary" >Delete</button>
                            
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
		
		<div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Add Country</h3>
                 <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
                 {{ csrf_field() }}
				 
				 <div class="box-body">
			 <div class="form-group">
                  <label for="exampleInputEmail1">Country List</label>
                  <select class="form-control" id="" name="country" ng-model="country.id" value="<% country.id %>">
				  <option value="">Select Country</option>
				  <option ng-repeat="con in all_country" ng-value="con.id"><%con.name%></option>
                  </select>
				  <em>If you want to add state please select country</em>
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" ng-model="country.name" >
		  <div class="help-block"></div>
                </div>
                  
				
                 
                 
                  
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="store(country)" class="btn btn-primary">Submit</button>
                
              </div>
			  
			  </div>

		<div class="box box-primary" ng-if="page=='edit'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit </h3>
                 <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
                 {{ csrf_field() }}
				 
				 <div class="box-body">
			 <div class="form-group">
                  <label for="exampleInputEmail1">Country List</label>
                  <select class="form-control" id="" name="country" ng-model="country.pid" >
				  <option value="">Select Country</option>
				  <option ng-repeat="con in all_country" ng-value="con.id" ng-selected="<%country.pid==con.id%>"><%con.name%></option>
                  </select>
		  <div class="help-block"></div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="hidden" class="form-control" id="" name="id"  ng-model="country.id" value="<% country.id %>">
                  <input type="text" class="form-control" id="" name="name" placeholder="Name" ng-model="country.name" value="<% country.name %>">
		  <div class="help-block"></div>
                </div>
                  
				
                 
                 
                  
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(country)" class="btn btn-primary">Submit</button>
                
              </div>
			  
			  </div>
			  
    </section>
   
  <!-- /.content-wrapper -->
