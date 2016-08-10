
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
              <h3 class="box-title"><i class="fa fa-list"></i> Enquiry List</h3>
             
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <div class="row">
                <div class="form-group col-md-3 pull-right">
		  
		  <input type="text" placeholder="Search" class="form-control ng-valid ng-dirty ng-valid-parse ng-touched" ng-model="search">
		</div>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th ng-click="sort('id')" style="cursor:pointer">#
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-click="sort('name')" style="cursor:pointer">Enquiry Name
                   <span class="glyphicon sort-icon"  ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-click="sort('email')" style="cursor:pointer">Enquiry E-mail
                  <span class="glyphicon sort-icon"  ng-show="sortKey=='email'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th ng-click="sort('subject')" style="cursor:pointer">Enquiry Subject
                  <span class="glyphicon sort-icon"  ng-show="sortKey=='subject'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
                  </th>
                  <th> </th>                 
                </tr>
                </thead>
                <tbody>
                
                <tr dir-paginate="val in enquirys|orderBy:sortKey:reverse|itemsPerPage:10|filter:search">
                  <td><% val.id %></td>
                  <td><% val.name %></td>
                  <td><% val.email %></td>
                  <td><% val.subject %></td>
                  <td>
                      <a href="javascript:void(0);" ng-click="replys(val);"><i class="fa fa-reply" title="Reply" ></i></a>
                      <i class="fa fa-trash" style="cursor:pointer" data-toggle="modal" title="Delete"  data-target="#del_modal<% val.id %>"></i>
                      
                    <div class="modal fade" id="del_modal<% val.id %>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this Enquiry ? 
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                           
                              
                               <button ng-click="deleteenquiry($index)" data-dismiss="modal" class="btn btn-primary" >Delete</button>
                          
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
                  <th>Enquiry Name</th>
                  <th>Enquiry E-mail</th>
                  <th>Enquiry Subject</th>
                  <th> </th>                 
                </tr>
                </tfoot>
              </table>
                 <dir-pagination-controls
					max-size="10"
					direction-links="true"
					boundary-links="true" >
		</dir-pagination-controls>
            </div>
            <!-- /.box-body -->
          </div>
         
          <!-- /.box -->
           <!-- general form elements -->
          <div class="box box-primary" ng-if="page=='reply'">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-reply"></i> Enquiry Reply</h3>
                <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
               <!-- /.box-header -->
            <div class="box-body">  
              <table class="table table-bordered table-striped">
                  <tr>
                      <td>Name</td>
                      <td><% enquiry.name %></td>
                  </tr>
                  <tr>
                      <td>E-mail</td>
                      <td><% enquiry.email %></td>
                  </tr>
                  <tr>
                      <td>Subject</td>
                      <td><% enquiry.subject %></td>
                  </tr>
                   <tr>
                      <td>Message</td>
                      <td><% enquiry.message %></td>
                  </tr>
              </table>
           
            
            <div class="row" ng-repeat="val in reply"> 
                    <div class="col-md-12" >
                         <div class="box box-default box-solid collapsed-box">
                          <div class="box-header with-border bg-aqua ">
                              <h3 class="box-title"><i class="fa fa-reply" title="Reply"></i> </h3>

                            <div class="box-tools pull-right">
                                 
                              <button data-widget="collapse" class="btn btn-box-tool" type="button"><% val.created_at %>
                              </button>
                            </div>
                            <!-- /.box-tools -->
                          </div>

                          <!-- /.box-header -->
                          <div class="box-body" style="display: none;" ng-bind-html="val.message">
                          
                          </div>
                          <!-- /.box-body -->
                        </div>
                    </div>
            </div>
               
                          
                
              
                <div text-angular ng-model="enquiry.reply" name="demo-editor" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div> 
                 
            </div>
            <div class="box-footer">
                <button ng-click="send(enquiry);" class="btn btn-primary">Send</button>
            </div>
           
          </div>
          <!-- /.box -->
        <!-- Button trigger modal -->




          <!-- Form Element sizes -->
         

  

    </section>
   
  <!-- /.content-wrapper -->
