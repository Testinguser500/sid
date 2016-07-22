

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
              <h3 class="box-title"><i class="fa fa-list"></i> Newsletter List</h3>
             
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
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
                  <td ng-if="val.subscribe=='1'"> Subscribe   </td>
                  <td ng-if="val.subscribe=='0'"> Unsubscribe </td>
                  <td>
                  <i title="View" class="fa fa-eye" style="cursor:pointer" data-toggle="modal" data-target="#view_modal<% val.id %>"></i>
                  <i title="Edit"  class="fa fa-edit" style="cursor:pointer" data-toggle="modal" data-target="#edit_modal<% val.id %>"></i>  
                  <i title="Delete" class="fa fa-trash" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
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
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                           
                                
                               <input type="hidden" name="edit_id" value="<% val.id %>" />
                               <button type="submit" class="btn btn-primary" ng-click="update(val)"  data-dismiss="modal" >Update</button>                            
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
