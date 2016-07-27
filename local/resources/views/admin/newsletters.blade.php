    <!-- Main content -->
    <section class="content">
        <div class="alert alert-success" ng-if="success_flash">
            <p>
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
              <h3 class="box-title"><i class="fa fa-list"></i> Newsletter Subscribers</h3>
              <div class="pull-right"><a href="javascript:void(0);" data-toggle="modal" data-target="#add_modal" ng-click="newsl.gender='male'" class="btn btn-primary"><i class="fa fa-plus"></i> Add Subscribers</a></div>
              <div class='pull-right'><a href="{{ URL('admins/newsletter/export') }}" class="btn btn-primary" style="margin-right:10px"><i class="fa fa-file-excel-o"></i> Export as CSV</a></div>
            </div>
            <!-- /.box-header -->
             <!-- Modal -->
            <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"  ng-click="newsl = {};success_flash_modal=false;errors_modal=false;"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add</h4>
                          </div>
                          <div class="modal-body">
                              <div class="alert alert-success" ng-if="success_flash_modal">
                                  <p>
                                  <% success_flash_modal %>
                                  </p>
                              </div>
                              <div class="alert alert-danger"  ng-if="errors_modal">
                                  <ul>
                                      <li ng-repeat ="er in errors_modal"><% er %></li>

                                  </ul>
                              </div>
                              <table  class="table table-bordered table-striped">
                                  <tr>
                                      <td> Name </td>
                                      <td> <input type="text" ng-model="newsl.name" name="name"/></td>                                      
                                  </tr> 
                                  <tr>
                                      <td> Email </td>
                                      <td> <input type="text" ng-model="newsl.email" /> </td> 
                                  </tr>
                                  <tr>
                                      <td> Mobile No. </td>
                                      <td> <input type="text" ng-model="newsl.mob_no" /> </td>
                                  </tr>
                                  <tr>
                                      <td> Occupation </td>
                                      <td> <input type="text" ng-model="newsl.occupation" /></td> 
                                  </tr>
                                  <tr>
                                      <td> City </td>
                                      <td> <input type="text" ng-model="newsl.city"  /> </td>
                                  </tr>
                                   <tr>
                                      <td> Gender </td>
                                      <td > <input type="radio" ng-model="newsl.gender"  name="gender" value="male" ng-checked="newsl.gender=='male'" ng-value="'male'"/> Male <input type="radio" name="gender" ng-model="newsl.gender" value="female" ng-value="'female'"/> Female </td>
                                 
                                   </tr>
                                
                              </table>
                          </div>
                          <div class="modal-footer">
                             
                            <button type="button" class="btn btn-primary pull-left" ng-click="store(newsl)">Submit</button>  
                            <button type="button" class="btn btn-default " data-dismiss="modal" ng-click="newsl = {};success_flash_modal=false;errors_modal=false;">Close</button>                                 
                                                        
                          </div>
                         
                        </div>
                      </div>
            </div>
            <div class="box-body">
              <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Newsletter Name</th>
                  <th>Newsletter Status</th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="val in newsletters">
                  <td><% val.id %></td>
                  <td><% val.name %></td>
                  <td ng-if="val.subscribe=='1'"  ><a href="javascript:void(0);" data-toggle="modal" data-target="#subscribe_modal<% val.id %>" > Subscribe   <i class="fa fa-pencil"></i></a></td>
                  <td ng-if="val.subscribe=='0'" ><a href="javascript:void(0);"   data-toggle="modal" data-target="#subscribe_modal<% val.id %>" > Unsubscribe   <i class="fa fa-pencil"></i></a></td>
                  <td>
                  <i title="View" class="fa fa-eye" style="cursor:pointer" data-toggle="modal" data-target="#view_modal<% val.id %>"></i>
                  <i title="Edit"  class="fa fa-edit" style="cursor:pointer" data-toggle="modal" data-target="#edit_modal<% val.id %>"></i>  
                  <i title="Delete" class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
                    <!-- Modal -->
                    <div class="modal fade" id="subscribe_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit</h4>
                          </div>
                          <div class="modal-body">
                                <div class="form-group">
                                <label for="subscribe">Subscribe : </label>
                                <select class="form-control" name="subscribe" ng-model="val.subscribe">
                                    <option value="1"  ng-selected="val.subscribe==1" ng-value="1"  >Subscribe</option>
                                    <option value="0"   ng-selected="val.subscribe==0" ng-value="0" >Unsubscribe</option>
                                </select>
                                
                                <div class="help-block"></div>
                              </div> 
                                                       
                          </div>
                          <div class="modal-footer">
                                               
                            <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"  ng-click="update_sub(val)">Update</button>  
                            <button type="button" class="btn btn-default " data-dismiss="modal" >Close</button>    
                               
                                                        
                          </div>
                         
                        </div>
                      </div>
                    </div>
                  <!-- Modal -->
                    <div class="modal fade" id="view_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">View</h4>
                          </div>
                          <div class="modal-body">
                              <table  class="table table-bordered table-striped">
                                  <tr>
                                      <td> Name </td>
                                      <td> <% val.name  %> </td>                                      
                                  </tr> 
                                  <tr>
                                      <td> Email </td>
                                      <td> <% val.email  %> </td> 
                                  </tr>
                                  <tr>
                                      <td> Mobile No. </td>
                                      <td> <% val.mob_no  %> </td>
                                  </tr>
                                  <tr>
                                      <td> Occupation </td>
                                      <td> <% val.occupation  %> </td> 
                                  </tr>
                                  <tr>
                                      <td> City </td>
                                      <td> <% val.city  %> </td>
                                  </tr>
                                   <tr>
                                      <td> Gender </td>
                                      <td> <% val.gender | capitalize %> </td>
                                  </tr>
                                   <tr>
                                      <td> Subscribe </td>
                                      <td ng-if="val.subscribe=='1'"> Subscribe   </td>
                                      <td ng-if="val.subscribe=='0'"> Unsubscribe </td>
                                  </tr>
                              </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
               <!-- Modal -->
                    <div class="modal fade" id="edit_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="success_flash_modal=false;errors_modal=false;init();"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit</h4>
                          </div>
                          <div class="modal-body">
                               <div class="alert alert-success" ng-if="success_flash_modal">
                                  <p>
                                  <% success_flash_modal %>
                                  </p>
                              </div>
                              <div class="alert alert-danger"  ng-if="errors_modal">
                                  <ul>
                                      <li ng-repeat ="er in errors_modal"><% er %></li>

                                  </ul>
                              </div>
                              <table  class="table table-bordered table-striped">
                                  <tr>
                                      <td> Name </td>
                                      <td> <input type="text" ng-model="val.name" /></td>                                      
                                  </tr> 
                                  <tr>
                                      <td> Email </td>
                                      <td> <input type="text" ng-model="val.email" /> </td> 
                                  </tr>
                                  <tr>
                                      <td> Mobile No. </td>
                                      <td> <input type="text" ng-model="val.mob_no" /> </td>
                                  </tr>
                                  <tr>
                                      <td> Occupation </td>
                                      <td> <input type="text" ng-model="val.occupation" /></td> 
                                  </tr>
                                  <tr>
                                      <td> City </td>
                                      <td> <input type="text" ng-model="val.city"  /> </td>
                                  </tr>
                                   <tr>
                                       <td > Gender </td>
                                       <td><input type="radio"  ng-model="val.gender"  name="gender_<% val.id %>" value="male"/> Male <input type="radio" name="gender_<% val.id %>" ng-model="val.gender" value="female"   /> Female </td>
                                   </tr>
                                
                              </table>                              
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="edit_id" value="<% val.id %>" />                        
                            <button type="button" class="btn btn-primary pull-left" ng-click="update(val)">Update</button>  
                            <button type="button" class="btn btn-default " data-dismiss="modal" ng-click="success_flash_modal=false;errors_modal=false;init();">Close</button>    
                               
                                                        
                          </div>
                         
                        </div>
                      </div>
                    </div>
               
                  <!-- Modal -->
                    <div class="modal fade" id="del_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this newsletter ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          
                               <input type="hidden" name="del_id" value="<% val.id %>" />
                               <button type="submit" class="btn btn-primary" ng-click="delete($index)" data-dismiss="modal">Delete</button>
                            
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
                  <th>Newsletter Name</th>
                  <th>Newsletter Status</th>
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
         

        </div>

    </section>
   
  <!-- /.content-wrapper -->
