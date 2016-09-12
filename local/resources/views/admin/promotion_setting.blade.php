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
              
              <button type="button" ng-show="adtxtfunc==true && adbanrfunc==false " ng-click="save_setting(setting_data)" class="btn btn-primary pull-right">Save Setting</button>
            <button type="button" ng-show="adtxtfunc==false && adbanrfunc==true " ng-click="save_adbanner(setting_data)" class="btn btn-primary pull-right">Save Setting</button>
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
                      <input class="form-check-input" name="enabdisble" ng-value="1" ng-checked="setting_data.prom_all[0].field_name=='ad_type' && setting_data.prom_all[0].status=='1'" ng-model="setting_data.prom_all[0].status" type="radio" id="inlineCheckbox1"> Enable
                  </label>
                  <label class="form-check-inline">
                      <input class="form-check-input"  name="enabdisble" ng-value="0" ng-model="setting_data.prom_all[0].status" ng-checked="setting_data.prom_all[0].field_name=='ad_type' && setting_data.prom_all[0].status=='0'" type="radio" id="inlineCheckbox2" > Disable
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
                                             <input class="form-control" type="text" id="inlineCheckbox1" value="" ng-model="setting_data.create_package[$index].nview " placeholder="view">
                                           </div>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" id="inlineCheckbox1" value="" ng-model="setting_data.create_package[$index].price " placeholder="price">
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
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Ad Type">
                                           </div>
                                         <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_views_per_product'}: true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select view per product">
                                           </div>
                                          <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Schedule'}: true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Schedule">
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
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select your product">
                                           </div>
                                       <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_Category'} : true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select category">
                                           </div>
                                          <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Ad_Content'} : true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Ad content">
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
                                    <label class="control-label col-sm-3" for="pwd">Placement and Package</label>
                                     <div class="col-sm-9">
                                         <div class="col-sm-12" >
                                       <div class="form-check" ng-repeat="hptpbanr in setting_data.placemnt_pkg |filter:{field_value:'home_top_bot_banner'} : true ">
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" ng-checked="hptpbanr.status=='1'" ng-true-value="'1'" ng-false-value="'0'" ng-model="setting_data.placemnt_pkg[setting_data.placemnt_pkg.indexOf(hptpbanr)].status">
                                               Home Page- Top/Bottom Banner
                                            </label>
                                          </div>
                                             
                                       <div  class="col-sm-12" ng-repeat="topbanr in topbanr_array=(setting_data.prom_all |filter:{field_name:'home_top_bot_banner'} : true) ">
                                           
                                         <div class="col-sm-5">
                                             <input class="form-control" type="text"  value="" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(topbanr)].nom_view" placeholder="views">
                                           </div>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text"  value="" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(topbanr)].view_price" placeholder="price">
                                           </div>
                                           <div class="col-sm-2 ad_minus" ng-if="$index+1 !=topbanr_array.length ">
                                               <a href="javascript:void(0)" ng-click="remove_topbanr(setting_data.prom_all.indexOf(topbanr))">
                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                          
                                           <div class="col-sm-2 ad_pls" ng-if="$index+1 == topbanr_array.length ">
                                             <a href="javascript:void(0)" ng-click="add_topbanr()">
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                       </div>  
                                         
                                         </div>
                                         
                                          <div class="col-sm-12" >
                                       <div class="form-check" ng-repeat="hprtbanr in setting_data.placemnt_pkg |filter:{field_value:'home_right_banner'} : true ">
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" ng-checked="hprtbanr.status=='1'" ng-true-value="'1'" ng-false-value="'0'" ng-model="setting_data.placemnt_pkg[setting_data.placemnt_pkg.indexOf(hprtbanr)].status ">
                                               Home Page- Right Box Banner
                                            </label>
                                          </div>
                                       <div  class="col-sm-12" ng-repeat="right_banr in righbanr_arr=(setting_data.prom_all |filter:{field_name:'home_right_banner'} : true )">

                                           <div class="col-sm-5">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(right_banr)].nom_view" placeholder="views">
                                           </div>
                                           <div class="col-sm-5">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(right_banr)].view_price" placeholder="price">
                                           </div>
                                             <div class="col-sm-2 ad_minus" ng-if="$index+1!=righbanr_arr.length">
                                                       <a href="javascript:void(0)" ng-click="remove_rightbanr1(setting_data.prom_all.indexOf(right_banr));">
                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                           <div class="col-sm-2 ad_pls" ng-if="$index+1==righbanr_arr.length">
                                               <a href="javascript:void(0)" ng-click="add_rightbanr1()">
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                       </div>  
                                         
                                         </div>
                                         
                                           <div class="col-sm-12" >
                                       <div class="form-check" ng-repeat="catlftbanr in setting_data.placemnt_pkg |filter:{field_value:'categ_left_bot_banner'} : true ">
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" ng-checked="catlftbanr.status=='1'" ng-true-value="'1'" ng-false-value="'0'" ng-model="ssetting_data.placemnt_pkg[setting_data.placemnt_pkg.indexOf(catlftbanr)].status">
                                                Category Page- Left/Bottom Banner
                                            </label>
                                          </div>
                                               <div  class="col-sm-12" ng-repeat="catbanr in catban_arr=(setting_data.prom_all |filter:{field_name:'categ_left_bot_banner'} : true) ">
                                         <div class="col-sm-5">
                                             <input class="form-control" type="text"  value="" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(catbanr)].nom_view" placeholder="views">
                                           </div>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text"  value="" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(catbanr)].view_price" placeholder="price">
                                           </div>
                                                   <div class="col-sm-2 ad_minus" ng-if="$index+1!=catban_arr.length">
                                                       <a href="javascript:void(0)" ng-click="remove_catban(setting_data.prom_all.indexOf(catbanr));">
                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                           <div class="col-sm-2 ad_pls" ng-if="$index+1==catban_arr.length">
                                               <a href="javascript:void(0)" ng-click="add_catban();" >
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                       </div>  
                                         
                                         </div>
                                         
                                         <div class="col-sm-12" >
                                       <div class="form-check" ng-repeat="prodlftbanr in setting_data.placemnt_pkg |filter:{field_value:'prod_left_bot_banner'} : true ">
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" ng-checked="prodlftbanr.status=='1'" ng-true-value="'1'" ng-false-value="'0'" ng-model="setting_data.placemnt_pkg[setting_data.placemnt_pkg.indexOf(prodlftbanr)].status ">
                                               Product Page- Left/Bottom Banner
                                            </label>
                                          </div>
                                       <div  class="col-sm-12" ng-repeat="prodbanr in prodban_arr=(setting_data.prom_all |filter:{field_name:'prod_left_bot_banner'} : true) ">
                                         <div class="col-sm-5">
                                             <input class="form-control" type="text"  value="" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(prodbanr)].nom_view" placeholder="views">
                                           </div>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text"  value="" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(prodbanr)].view_price" placeholder="price">
                                           </div>
                                           <div class="col-sm-2 ad_minus" ng-if="$index+1!=prodban_arr.length">
                                               <a href="javascript:void(0)" ng-click="remove_prodban(setting_data.prom_all.indexOf(prodbanr));">
                                              <i class="fa fa-minus" aria-hidden="true"></i>
                                             </a>
                                         </div>
                                           <div class="col-sm-2 ad_pls" ng-if="$index+1==prodban_arr.length">
                                               
                                             <a href="javascript:void(0)" ng-click="add_prodban();">
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
                                         <div class="col-sm-12" ng-repeat="schedule in setting_data.schedule_status"> 
                                             <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" ng-checked="schedule.status=='1'" ng-true-value="'1'" ng-false-value="'0'" ng-model="setting_data.schedule_status[$index].status">
                                                 <% schedule.field_value %>
                                            </label>
                                          </div>
                                     
                                         </div>   
                                  </div>              
                             </div> 
                            
                            <div class="form-group">
                                    <label class="control-label col-sm-4">Tooltip</label>
                                     <div class="col-sm-8 tltip">
                                        <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_create_campaign'}: true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                        </div>
                                         <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Compaign_type'}: true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                        </div>
                                          <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_ad_placement'}: true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                        </div>
                                          <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_views'}: true ">
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
                                    <label class="control-label col-sm-4" for="pwd">Seller's Selection to Promote</label>
                                     <div class="col-sm-8">
                                         <div class="col-sm-12" ng-repeat=" selr_select in setting_data.seler_select">
                                             <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" ng-checked="selr_select.status=='1'" ng-true-value="'1'" ng-false-value="'0'" ng-model="setting_data.seler_select[$index].status ">
                                                <% selr_select.field_value %>
                                            </label>
                                          </div>
                              
                                         </div>   
                                  </div>              
                             </div> 
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Ad Content Character Limit</label>
                                     <div class="col-sm-8">
                                         
                                         
                                         
                                         
                                         <div class="col-sm-12" ng-repeat="hmptop_setng in setting_data.prom_all |filter:{field_name:'home_topbot_banr_setting'} : true ">
                                              <label class="control-label col-sm-12">Home Page Top/Bottom Banner</label>
                                           <div class="col-sm-6" > 
                                               <input class="form-control" type="text"  placeholder="Image Dimention(pixel)" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(hmptop_setng)].dimention" >
                                           </div>
                                            <div class="col-sm-6" >                                                
                                                <input class="form-control" type="text" placeholder="Image Size(MB)" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(hmptop_setng)].banr_size">
                                           </div>
                                         </div>
                                         <div class="col-sm-12" ng-repeat="hmpright_setng in setting_data.prom_all |filter:{field_name:'home_right_banr_setting'} : true ">
                                              <label class="control-label col-sm-12">Home Page Right Box Banner</label>
                                           <div class="col-sm-6" > 
                                               <input class="form-control" type="text"  placeholder="Image Dimention(pixel)" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(hmpright_setng)].dimention">
                                           </div>
                                            <div class="col-sm-6" >                                                
                                                <input class="form-control" type="text" placeholder="Image Size(MB)" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(hmpright_setng)].banr_size">
                                           </div>
                                         </div>
                                         <div class="col-sm-12" ng-repeat="catlft_setng in setting_data.prom_all |filter:{field_name:'categ_lftbotm_banr_setting'} : true ">
                                              <label class="control-label col-sm-12">Category Page Left/Bottom Banner </label>
                                           <div class="col-sm-6" > 
                                               <input class="form-control" type="text"  placeholder="Image Dimention(pixel)" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(catlft_setng)].dimention">
                                           </div>
                                            <div class="col-sm-6" >                                                
                                                <input class="form-control" type="text" placeholder="Image Size(MB)" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(catlft_setng)].banr_size">
                                           </div>
                                         </div>
                                         <div class="col-sm-12" ng-repeat="prodlft_setng in setting_data.prom_all |filter:{field_name:'prod_leftbot_banr_setting'} : true ">
                                              <label class="control-label col-sm-12">Product Page Left/Bottom Banner</label>
                                           <div class="col-sm-6" > 
                                               <input class="form-control" type="text"  placeholder="Image Dimention(pixel)" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(prodlft_setng)].dimention">
                                           </div>
                                            <div class="col-sm-6" >                                                
                                                <input class="form-control" type="text" placeholder="Image Size(MB)" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(prodlft_setng)].banr_size">
                                           </div>
                                         </div>

                                  </div>              
                             </div> 
                            
                          
                            
                            <div class="form-group">
                                    <label class="control-label col-sm-4">Tooltip</label>
                                     <div class="col-sm-8 tltip">
                                               <div class="col-sm-12" ng-repeat="toltip in setting_data.tooltip |filter:{tool_fd:'Select_store_product_categ'}: true ">
                                               <input class="form-control" type="text"  value="" ng-model="setting_data.tooltip[setting_data.tooltip.indexOf(toltip)].tool_val" placeholder="Select or Create Compaign">
                                        </div>
                                  

                                  </div>              
                             </div> 
                       </div>
                        <div ng-show="isSet(3)">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="pwd">Payment Option</label>
                                     <div class="col-sm-8">
                                         <div class="col-sm-12" ng-repeat="paymnt in setting_data.payment_opt">
                                          <div class="form-check" >
                                            <label class="form-check-label">
                                                <input class="form-check-input"  type="checkbox" ng-checked="paymnt.status=='1'" ng-true-value="'1'" ng-false-value="'0'" ng-model="setting_data.payment_opt[$index].status ">
                                              <% paymnt.field_value %>
                                            </label>
                                          </div>
                                    
                            
                                         </div>   
                                  </div>              
                             </div> 
                             <div class="form-group">
                                    <label class="control-label col-sm-4">Messages</label>
                                     <div class="col-sm-8 tltip">
                                         <div class="col-sm-12" ng-repeat="insuficient in setting_data.prom_all |filter:{field_name:'insufficient_bal'}: true ">
                                             <label class="control-label " for="insufficient_balance" >Insufficient Balance Message</label>
                                             <textarea class="form-control"  id="insufficient_balance" rows="3" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(insuficient)].field_value"></textarea>
                                           </div>
                                         <div class="col-sm-12" ng-repeat="sucess in setting_data.prom_all |filter:{field_name:'success_msg'}: true">
                                               <label class="control-label " for="successful_message">Successful Message</label>
                                               <textarea class="form-control"  id="successful_message" rows="3" ng-model="setting_data.prom_all[setting_data.prom_all.indexOf(sucess)].field_value"></textarea>
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

