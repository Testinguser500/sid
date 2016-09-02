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
              <!-- general form elements -->
              <div class="box box-primary promot">
  
              <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Setting</h3>
              <button type="button" ng-click="save_setting(setting_data)" class="btn btn-primary pull-right">Save Setting</button>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">Ad Types</label>
               <div class="col-sm-10">
                   <select class="form-control" ng-model="setting_addtype" ng-change="change_Ad(setting_addtype)">
                       <option value="text_ad">Text Ad</option>
                       <option value="banner_ad">Banner Ad</option>
                   </select>
                 
            </div>
              
          </div>
             <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">Enable/Disable</label>
               <div class="col-sm-10">
                  <label class="form-check-inline">
                      <input class="form-check-input" ng-checked="setting_data.prom_all[0].field_name=='ad_type' && setting_data.prom_all[0].status=='1'" ng-model="setting_data.prom_all[0].status" type="radio" id="inlineCheckbox1"> Enable
                  </label>
                  <label class="form-check-inline">
                      <input class="form-check-input" ng-model="setting_data.prom_all[0].status" ng-checked="setting_data.prom_all[0].field_name=='ad_type' && setting_data.prom_all[0].status=='0'" type="radio" id="inlineCheckbox2" > Disable
                  </label>
                 
            </div>              
          </div> 
                  <!--------------------------Ad_Text---------------------------->
                  <div class="box-body" ng-if="setting_data.prom_all[0].ad_type=='text_ad'">    
            <div class="col-sm-12 main--tab">   
                <div class="col-sm-4">
                    <ul class="nav nav-pills nav-stacked tabb">
                        <li ng-class="{ active: isSet(1) }">
                           <a href ng-click="setTab(1)">
                               Step 1- Plan and Package</a>
                         </li>
                         <li ng-class="{ active: isSet(2) }">
                           <a href ng-click="setTab(2)">
                               Step 2- Choose Products</a>
                         </li>
                         <li ng-class="{ active: isSet(3) }">
                           <a href ng-click="setTab(3)">
                               Step 3- Review and Payment</a>
                         </li>
                         
                     </ul>  
                </div>
                
                <div class="col-sm-8">
                    <div class="jumbotron">
                        <div ng-show="isSet(1)">
                             <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Create Package</label>
                                     <div class="col-sm-9">
                                       
                                       <div ng-repeat="creat_pkg in setting_data.create_package" class="col-sm-12" >
                                         <div class="col-sm-5">
                                               <input class="form-control" type="text" id="inlineCheckbox1" value="" ng-model="setting_data.create_package[$index].nview ">
                                           </div>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" id="inlineCheckbox1" value="" ng-model="setting_data.create_package[$index].price ">
                                           </div>
                                           <div class="col-sm-2 ad_minus" ng-if="$index+1 !=setting_data.create_package.length ">
                                             <a href="javascript:void(0)" ng-click="splice_field($index)">
                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                           <div class="col-sm-2 ad_pls" ng-if="$index+1 ==setting_data.create_package.length ">
                                             <a href="javascript:void(0)" ng-click="apnd_field()">
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                       </div>  
                                         

                                  </div> 
                                   
                             </div> 
                            
                            <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Enable/Disable Schedule</label>
                                     <div class="col-sm-8">
                                         <div class="col-sm-12">
                                             <div class="form-check" ng-repeat="shedule in setting_data.schedule_status">
                                            <label class="form-check-label">
                                                <input class="form-check-input" ng-checked="shedule.status=='1'" ng-model="setting_data.schedule_status[$index].status" type="checkbox" ng-true-value="'1'" ng-false-value="'0'">
                                               <% shedule.field_value %>
                                            </label>
                                          </div>
                                     
                                         </div>   
                                  </div>              
                             </div> 
                            
                            <div class="form-group">
                                    <label class="control-label col-sm-4">Tooltip</label>
                                     <div class="col-sm-8 tltip">
                                         <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_Create_Compaign'} : true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                           </div>
                                            <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Ad_Type'}: true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                           </div>
                                         <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_views_per_product'}: true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                           </div>
                                          <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Schedule'}: true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                           </div>

                                  </div>              
                             </div> 
                            
                       </div>
                        <div ng-show="isSet(2)">
                              <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Destination Category</label>
                                     <div class="col-sm-8">
                                         <div class="col-sm-12">
                                             <div class="form-check" ng-repeat="destina in setting_data.destination_cat">
                                            <label class="form-check-label">
                                                <input class="form-check-input" ng-checked="destina.status=='1'" ng-model="setting_data.destination_cat[$index].status" type="checkbox"  ng-true-value="'1'" ng-false-value="'0'">
                                              <% destina.field_value %>
                                            </label>
                                          </div>
                              
                                         </div>   
                                  </div>              
                             </div> 
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Ad Content Character Limit</label>
                                     <div class="col-sm-8">
                                           <div class="col-sm-6" ng-repeat="title_limit in setting_data.prom_all |filter:{field_name:'adcont_title_limit'} : true ">
                                                <label for="exampleTextarea">Title</label>
                                                <input class="form-control" type="text" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(title_limit)].field_value" id="inlineCheckbox1" >
                                           </div>
                                            <div class="col-sm-6" ng-repeat="descrip_limit in setting_data.prom_all |filter:{field_name:'adcont_desc_limit'} : true ">
                                                <label for="exampleTextarea">Description</label>
                                                <input class="form-control" type="text" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(descrip_limit)].field_value" id="inlineCheckbox1" value="">
                                           </div>
                                        

                                  </div>              
                             </div> 
                            
                          
                            
                            <div class="form-group">
                                    <label class="control-label col-sm-4">Tooltip</label>
                                     <div class="col-sm-8 tltip">
                                             <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_Your_Product'} : true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                           </div>
                                       <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_Category'} : true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                           </div>
                                          <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Ad_Content'} : true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                           </div>

                                  </div>              
                             </div> 
                       </div>
                        <div ng-show="isSet(3)">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Payment Option</label>
                                     <div class="col-sm-8">
                                         <div class="col-sm-12">
                                          <div class="form-check" ng-repeat="payment in setting_data.payment_opt">
                                            <label class="form-check-label">
                                                <input class="form-check-input" ng-checked="payment.status=='1'" ng-model="setting_data.payment_opt[$index].status" type="checkbox" ng-true-value="'1'" ng-false-value="'0'">
                                              <% payment.field_value %>
                                            </label>
                                          </div>
                                    
                            
                                         </div>   
                                  </div>              
                             </div> 
                             <div class="form-group">
                                    <label class="control-label col-sm-4">Messages</label>
                                     <div class="col-sm-8 tltip">
                                         <div class="col-sm-12" ng-repeat="insuf in setting_data.prom_all | filter:{field_name:'insufficient_bal'}: true ">
                                               <label class="control-label " for="insufficient_balance">Insufficient Balance Message</label>
                                               <textarea class="form-control" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(insuf)].field_value" id="insufficient_balance" rows="3"></textarea>
                                           </div>
                                           <div class="col-sm-12" ng-repeat="success in setting_data.prom_all | filter:{field_name:'success_msg'}: true ">
                                               <label class="control-label " for="successful_message">Successful Message</label>
                                               <textarea class="form-control"  ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(success)].field_value" id="successful_message" rows="3"></textarea>
                                           </div>
                                         
                                        

                                  </div>              
                             </div> 
                            
                       </div>
                    </div>   
                </div>
            </div>   
                  </div>   
                  
                  <!--------------------------Ad_Banner---------------------------->
                  <div class="box-body" ng-if="setting_data.prom_all[0].ad_type=='banner_ad'">    
            <div class="col-sm-12 main--tab">   
                <div class="col-sm-4">
                    <ul class="nav nav-pills nav-stacked tabb">
                        <li ng-class="{ active: isSet(1) }">
                           <a href ng-click="setTab(1)">
                               Step 1- Plan and Package</a>
                         </li>
                         <li ng-class="{ active: isSet(2) }">
                           <a href ng-click="setTab(2)">
                               Step 2- Choose Products</a>
                         </li>
                         <li ng-class="{ active: isSet(3) }">
                           <a href ng-click="setTab(3)">
                               Step 3- Review and Payment</a>
                         </li>
                         
                     </ul>  
                </div>
                
                <div class="col-sm-8">
                    <div class="jumbotron">
                        <div ng-show="isSet(1)">
                             <div class="form-group">
                                    <label class="control-label col-sm-3" for="pwd">Create Package</label>
                                     <div class="col-sm-9">
                                         <div class="col-sm-12">
                                       <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" >
                                               Home Page- Top/Bottom Banner
                                            </label>
                                          </div>
                                       <div  class="col-sm-12" >
                                         <div class="col-sm-5">
                                               <input class="form-control" type="text" id="inlineCheckbox1" value="" >
                                           </div>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" id="inlineCheckbox1" value="" >
                                           </div>
                                           <div class="col-sm-2 ad_minus" >
                                             <a href="javascript:void(0)">
                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                           <div class="col-sm-2 ad_pls" >
                                             <a href="javascript:void(0)" >
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                       </div>  
                                         
                                         </div>
                                         
                                          <div class="col-sm-12">
                                       <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" >
                                               Home Page- Right Box Banner
                                            </label>
                                          </div>
                                       <div  class="col-sm-12" >
                                         <div class="col-sm-5">
                                               <input class="form-control" type="text" id="inlineCheckbox1" value="" >
                                           </div>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" id="inlineCheckbox1" value="" >
                                           </div>
                                           <div class="col-sm-2 ad_minus" >
                                             <a href="javascript:void(0)">
                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                           <div class="col-sm-2 ad_pls" >
                                             <a href="javascript:void(0)" >
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                       </div>  
                                         
                                         </div>
                                         
                                           <div class="col-sm-12">
                                       <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" >
                                                Category Page- Left/Bottom Banner
                                            </label>
                                          </div>
                                       <div  class="col-sm-12" >
                                         <div class="col-sm-5">
                                               <input class="form-control" type="text" id="inlineCheckbox1" value="" >
                                           </div>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" id="inlineCheckbox1" value="" >
                                           </div>
                                           <div class="col-sm-2 ad_minus" >
                                             <a href="javascript:void(0)">
                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                           <div class="col-sm-2 ad_pls" >
                                             <a href="javascript:void(0)" >
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                       </div>  
                                         
                                         </div>
                                         
                                         <div class="col-sm-12">
                                       <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" >
                                               Product Page- Left/Bottom Banner
                                            </label>
                                          </div>
                                       <div  class="col-sm-12" >
                                         <div class="col-sm-5">
                                               <input class="form-control" type="text" id="inlineCheckbox1" value="" >
                                           </div>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" id="inlineCheckbox1" value="" >
                                           </div>
                                           <div class="col-sm-2 ad_minus" >
                                             <a href="javascript:void(0)">
                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                           <div class="col-sm-2 ad_pls" >
                                             <a href="javascript:void(0)" >
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                       </div>  
                                         
                                         </div>
                                  </div> 
                                     
                                    
                                   
                             </div> 
                            
                            <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Enable/Disable Schedule</label>
                                     <div class="col-sm-8">
                                         <div class="col-sm-12">
                                             <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" >
                                                  One week starting today
                                            </label>
                                          </div>
                                     
                                         </div>   
                                  </div>              
                             </div> 
                            
                            <div class="form-group">
                                    <label class="control-label col-sm-4">Tooltip</label>
                                     <div class="col-sm-8 tltip">
                                         <div class="col-sm-12" >
                                               <input class="form-control" type="text"  value="" >
                                           </div>
                                            

                                  </div>              
                             </div> 
                            
                       </div>
                        <div ng-show="isSet(2)">
                              <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Destination Category</label>
                                     <div class="col-sm-8">
                                         <div class="col-sm-12">
                                             <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" >
                                              
                                            </label>
                                          </div>
                              
                                         </div>   
                                  </div>              
                             </div> 
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Ad Content Character Limit</label>
                                     <div class="col-sm-8">
                                           <div class="col-sm-6" >
                                                <label for="exampleTextarea">Title</label>
                                                <input class="form-control" type="text"  >
                                           </div>
                                            <div class="col-sm-6" >
                                                <label for="exampleTextarea">Description</label>
                                                <input class="form-control" type="text" >
                                           </div>
                                        

                                  </div>              
                             </div> 
                            
                          
                            
                            <div class="form-group">
                                    <label class="control-label col-sm-4">Tooltip</label>
                                     <div class="col-sm-8 tltip">
                                             <div class="col-sm-12" >
                                               <input class="form-control" type="text"  value=""  placeholder="Select or Create Compaign">
                                           </div>
                                  

                                  </div>              
                             </div> 
                       </div>
                        <div ng-show="isSet(3)">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Payment Option</label>
                                     <div class="col-sm-8">
                                         <div class="col-sm-12">
                                          <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" >
                                              <% payment.field_value %>
                                            </label>
                                          </div>
                                    
                            
                                         </div>   
                                  </div>              
                             </div> 
                             <div class="form-group">
                                    <label class="control-label col-sm-4">Messages</label>
                                     <div class="col-sm-8 tltip">
                                         <div class="col-sm-12" >
                                               <label class="control-label " for="insufficient_balance">Insufficient Balance Message</label>
                                               <textarea class="form-control"  id="insufficient_balance" rows="3"></textarea>
                                           </div>
                                           <div class="col-sm-12" >
                                               <label class="control-label " for="successful_message">Successful Message</label>
                                               <textarea class="form-control"  id="successful_message" rows="3"></textarea>
                                           </div>
                                         
                                        

                                  </div>              
                             </div> 
                            
                       </div>
                    </div>   
                </div>
            </div>   
                  </div>   
                  
       
              <style>
                  .promot{width:100%;display:table}
                  .promot label{font-weight: normal;}
                  .promot .form-group{width:100%;display:table}
                  .ad_minus { margin-bottom: 5px;}
                  .ad_minus a{ background: #0f8c96; padding: 2px 6px;}
                  .ad_minus a i{color:#fff;} 
                  .ad_pls a{ background: #0f8c96; padding: 2px 6px;}
                  .ad_pls a i{color:#fff;} 
                  .tltip input{margin-bottom:14px;}
              </style>
 </section>

