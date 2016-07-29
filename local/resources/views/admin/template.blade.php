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
              <h3 class="box-title"><i class="fa fa-list"></i> Template List</h3>
              <div class="pull-right"> <a href="javascript:void(0);" ng-click="add();" class="btn btn-primary"><i class="fa fa-plus"></i> Add Template</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Template Subject</th>                 
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="val in templates">
                  <td><% val.id %></td>
                  <td><% val.subject %></td>
                 
                  <td>
                      <a href="javascript:void(0);" ng-click="edittemplate(val)"><i class="fa fa-edit" title="Edit" ></i> </a>
                      <a href="javascript:void(0);" ng-click="sendtemplate(val)"><i class="fa fa-reply" title="Send" ></i> </a>
                      <i class="fa fa-trash" title ="Delete" style="cursor:pointer" data-toggle="modal" data-target="#del_modal<% val.id %>"></i>
                 <!-- Modal -->
                    <div class="modal fade" id="del_modal<% val.id  %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this template ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            
                               <input type="hidden" name="del_id" value="<% val.id  %>" />
                               <button  ng-click="deletetemplate($index)" data-dismiss="modal" class="btn btn-primary" >Delete</button>
                           
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
                  <th>Template Subject</th> 
                  <th> </th>                 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
          <!-- /.box -->
        <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='add'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-plus"></i> Create Template</h3>
                <div class="pull-right"> <a href="javascript:void(0);" ng-click="init();" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject</label>
                  <input type="text" class="form-control" id="" name="subject" placeholder="Subject" ng-model="template.subject">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Message</label>
                  <div placeholder="Message"  text-angular ng-model="template.message" name="demo-editor" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div> 
		  <div class="help-block"></div>
                </div> 
                
                  
                  
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="store(template);" class="btn btn-primary">Submit</button>
              </div>
           
          </div>
          <!-- /.box -->
           <!-- general form elements -->
          <div class="box box-primary"  ng-if="page=='edit'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit Template</h3>
                <div class="pull-right"> <a href="javascript:void(0);" ng-click="init();" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->         
            
              <div class="box-body">
			 
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject</label>
                  <input type="text" class="form-control" id="" name="subject" placeholder="Subject" ng-model="template.subject">
		  <div class="help-block"></div>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Message</label>
                   <div placeholder="Message"  text-angular ng-model="template.content" name="demo-editor" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>  
		  <div class="help-block"></div>
                </div> 
               
             </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button ng-click="update(template);" class="btn btn-primary">Submit</button>
              </div>
           
          </div>
          <!-- /.box -->
           <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='send'">
            <div class="box-header with-border">
                 <h3 class="box-title"><i class="fa fa-reply"></i> Send Template</h3>
                 <div class="pull-right"> <a href="javascript:void(0);" ng-click="init();" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
              <table  class="table table-bordered table-striped">
               
                <tbody>               
                    <tr>
                       <td>Subject</td>                               
                       <td><% temp.subject %></td> 
                    </tr>  
                    <tr>
                        <td>Message</td>                               
                        <td ng-bind-html="temp.content"></td> 
                    </tr>  
                </tbody>
               
              </table>
            </div>
            <div class="box-body">
               <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="user[]" ng-model="user_send.subscriber" value="subscriber">
                       All Newsletter Subscribers
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="user[]" ng-model="user_send.seller" value="seller">
                        All Sellers 
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                     <input type="checkbox" name="user[]" ng-model="user_send.customer" value="customer">
                       All Customer 
                    </label>
                  </div>
                </div>                        
                <div class="form-group">
                  <button ng-click="send_email(user_send,temp.id);" class="btn btn-primary">Send</button>
                </div>
            </div>
            <!-- /.box-body -->
            <!-- form start -->
            
          </div>
          <!-- /.box -->
          <!-- Form Element sizes -->
 
    </section>
   
  <!-- /.content-wrapper -->
 