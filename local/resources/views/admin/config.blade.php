
    <!-- Main content -->
    <section class="content">
       
	<div class="alert alert-success" ng-if="success_flash">
            <p >
            <% success_flash %>
            </p>
        </div>
        <div class="alert alert-danger" ng-if="errors">
            <ul>
                <li >All Fields must be filled</li>
         
            </ul>
        </div> 
          <!-- /.box -->
           
          <div class="box" ng-if="page=='index'" >
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Configuration List</h3>
              <div class="pull-right"> <a href="javascript:void(0);" ng-click="edit();" class="btn btn-primary"><i class="fa fa-edit"></i> EDIT</a></div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table  class="table table-bordered table-striped">
               
                <tbody>
               
                <tr ng-repeat="val in configs">
                   <td><% val.key %></td>                               
                   <td><% val.value %></td> 
                </tr>
              
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        <div class="box" ng-if="page=='edit'">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-edit"></i> Configuration Edit</h3>
             <div class="pull-right"> <a href="javascript:void(0);" ng-click="init()" class="btn btn-default">Back</a></div>
            </div>
            <!-- /.box-header -->
         
            <div class="box-body">
              <table  class="table table-bordered table-striped" >
               
                <tbody>
              
                <tr ng-repeat="val in configs" >
                   <td><% val.key %></td>                               
                   <td>
                       <input type="text" ng-model="configs[$index].value" class="form-control"/>
                     
                   </td> 
                </tr>
               
                </tbody>
               
              </table>              
              
            </div>
            <!-- /.box-body -->
            <div class="box-body">
                <div class="pull-left"> 
                    <button ng-click="update(configs)" class="btn btn-primary" type="submit">UPDATE</button>
                    
                </div> 
            </div>
           
          </div>
         
          <!-- /.box -->
         <!-- Form Element sizes -->
   
        
    </section>
   
  <!-- /.content-wrapper -->
 
	