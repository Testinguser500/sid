
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
              
              <div class="col-sm-12">
               <div class="bread">
                   <a href="javascript:void(0)" ng-class="{active:wizard==1}" ng-click="step_wizard(1)">Plan and Package</a>
                   <a href="javascript:void(0)" ng-class="{active:wizard==2}" ng-if='create_promo.id'   ng-click="step_wizard(2)">Choose Products</a>
                    <a href="javascript:void(0)" ng-class="{active:wizard==2}" ng-if='!create_promo.id'   >Choose Products</a>
                   <a href="javascript:void(0)" ng-class="{active:wizard==3}" ng-if='create_promo.add_discrip' ng-click="step_wizard(3);preview(create_promo);">Review and Payment</a>
                    <a href="javascript:void(0)" ng-class="{active:wizard==3}" ng-if='!create_promo.add_discrip'>Review and Payment</a>
            </div>

              </div>
            
          <!----------------------------Step One------------------------------->   
          
          <div class="box box-primary crt_prom step1"  ng-if="wizard==1">
            
            <!-- /.box-header -->
            <div class="form-group">
                <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Select or Create Campaign </label>
                <div class="col-md-8 col-sm-8">
                    <select class="form-control "  ng-change="selcrt_camp(create_promo.campain)" ng-model="create_promo.campain">
                       <option value="">Please select</option>
                       <option value="create_new">Create New</option>
                       <option value="update_campn">Update Campaign</option>                       
                    </select> 
                    
                    <select ng-show="updcampshow==true" class="form-control camp"  ng-change="" ng-model="create_promo.upd_camp">
                       <option value="">Please select</option>
                       <option ng-repeat="campd in campdata" value="<% campd.compaign_name %>"><% campd.compaign_name %></option>
                    </select>
                    
                    
                   <div class="camp" ng-show="campinputshow==true">
                       <input  class="form-control" type="text" ng-model="create_promo.newcamp" placeholder="Please enter campaign name"/>
                   </div>
                </div>
            </div>
            <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Ad Type </label>
                  <div class="col-md-8 col-sm-8">
                      <select class="form-control" ng-model="create_promo.ad_type" ng-change="change_Ad(create_promo.ad_type)">
                        <option value="">Select Ad Type</option>
                        <option value="text_ad">Ad Text</option>
                        <option value="banner_ad">Ad Banner</option>
                    </select>   
                  </div>     
            </div>
             <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Select views per product  </label>
                <div class="col-md-8 col-sm-8">  
                    <select class="form-control" ng-model="create_promo.select_view">
                        <option value=""> Select view</option>
                        <option ng-repeat="select_view in promot_rec.create_package" value="<% select_view.id %>"><% select_view.nview %> views - Rs <% select_view.price %></option>
                    </select>    
                </div>    
            </div>
              <div class="form-group">
                  
                  <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Schedule </label>
                <div class="col-md-8 col-sm-8" >  
                    <div class="form-check" ng-repeat="shedules in promot_rec.schedule_status">
                        <label class="form-check-label" >
                            <input class="form-check-input" name="shedul" ng-value="shedules.id"   ng-model="create_promo.schedule" type="radio" id="inlineCheckbox1" ng-click="customdate(create_promo.schedule);" > <% shedules.field_value %>
                       </label>
                    </div>
                    
                    <div class="form-group" ng-show="custdate==true">
                        <div class="col-sm-4">
                            <label  class="col-md-12 col-sm-12" ng-init="create_promo.start_date=CurrentDate">Starting Date </label>
                             <ng-datepicker  class="hasDatepicker" view-format="Do MMMM YYYY" ng-model="create_promo.start_date" first-week-day-sunday="true" placeholder="Pick a date">
                                           </ng-datepicker>
                        </div>
                        <div class="col-sm-4">
                            <label  class="col-md-12 col-sm-12" ng-init="create_promo.end_date=CurrentDate">End Date </label>
                            <ng-datepicker  class="hasDatepicker" view-format="Do MMMM YYYY" ng-model="create_promo.end_date" first-week-day-sunday="true"  placeholder="Pick a date">
                                           </ng-datepicker>
                        </div>    
                    </div>
                    
                </div>    
            </div>
            
            <div class="form-group butn">
                <button type="button" class="btn btn-default" ng-click="discard()">Discard</button>
                    <button type="button" class="btn btn-primary" ng-click="saveAdtext(create_promo)">Save Draft</button>
                    <button type="button" class="btn btn-success" ng-disabled="!create_promo.id" ng-click="step_wizard(2)">Next</button>
                    
            </div>    
            
          </div>  
          
          <!----------------------------Step Two------------------------------->
          
          <div class="box box-primary crt_prom step2" ng-if="wizard==2">
             <!-- /.box-header -->
             
            <div class="form-group">
                <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Select or Create Promotion </label>
                <div class="col-md-8 col-sm-8">
                    <select class="form-control "  ng-change="selcrt_prom(create_promo.promot)" ng-model="create_promo.promot">
                        <option value="">Please select</option>
                       <option value="create_new">Create New</option> 
                       <option value="update_promn">Update Promotion</option>
                    </select> 
                    
                    <select ng-show="updpromshow==true" class="form-control camp"  ng-change="" ng-model="create_promo.upd_promot">
                       <option value="">Please select</option>
                       <option ng-repeat="promotnd in promotndata" value="<% promotnd.promotion_name %>"><% promotnd.promotion_name %></option>
                    </select> 
                    
                   <div class="camp" ng-show="prom_input_show==true">
                       <input  class="form-control" type="text" ng-model="create_promo.newpromot" placeholder="Please enter campaign name"/>
                   </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="col-md-12 col-sm-12">Product to Promote </label>
                  <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Select your Product 
                      <a href="#" data-toggle="tooltip" data-placement="right" title="SID">?</a> 
                  </label>
                  <div class="col-md-8 col-sm-8">
                      
                      <select class="form-control" ng-model="create_promo.product">
                          <option  value=""> Select Product </option>
                          <option ng-repeat=" product in promot_rec.product_name" value="<% product.id %>"> <% product.pro_name %> </option>
                        
                    </select>   
                  </div>     
            </div>
            <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Destination category </label>
                <div class="col-md-8 col-sm-8">  
                      <label  class="col-md-12 col-sm-12">Text Ad also displays in home page by default </label> 
                </div>    
            </div>
             <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Select Category
                       <a href="#" data-toggle="tooltip" data-placement="right" title="SID">?</a> 
                  </label>
                <div class="col-md-8 col-sm-8"> 
                    <div class="col-sm-12">
                      
                            <select multiple class="form-control" ng-model="create_promo.category">
                                
                                <option ng-repeat=" category in  promot_rec.category_name" value="<% category.id %>"><% category.category_name %></option>
                            </select>                             
                        
                       
                    </div>
                </div>    
            </div>
              <div class="form-group">
                  <label  class="col-md-4 col-sm-4">Add Content 
                      <a href="#" data-toggle="tooltip" data-placement="right" title="SID">?</a>
                  </label>
                <div class="col-md-8 col-sm-8"> 
                    <div class="col-sm-12">                        
                        <label  class="col-md-12 col-sm-12">Add Content </label>
                        <input class="form-control" type="text" ng-model="create_promo.add_content"  ng-trim="false" maxlength="100" />
                        <label  class="col-md-12 col-sm-12"> <%100-create_promo.add_content.length %> character remaining </label>
                    </div>  
                    <div class="col-sm-12">                        
                        <label  class="col-md-12 col-sm-12">Description </label>
                        <input class="form-control" type="text" ng-model="create_promo.add_discrip"  ng-trim="false" maxlength="100"/> 
                        <label  class="col-md-12 col-sm-12"> <%100-create_promo.add_discrip.length%> character remaining </label>
                    </div> 
                </div>    
            </div>
            
              <div class="form-group butn">
                  <button type="button" class="btn btn-default" ng-click="step_wizard(1)">Back</button> 
                  <button type="button" class="btn btn-primary" ng-click="update_adtext(create_promo)" >Save Draft</button>                  
                  <button type="button" class="btn btn-success" ng-disabled="btnenble==false" ng-click="step_wizard(3);preview(create_promo)">Next</button>
                    
               </div>  
            
          </div>  
          
          <!-----------------------------Step Three---------------------------->
          
         <div class="box box-primary crt_prom step3" ng-if="wizard==3">
             <!-- /.box-header -->
            
             <h2>Review</h2>
            <div class="form-group">
                <label for="exampleInputEmail1" class="col-md-12 col-sm-12"> Product to Promote </label>
                <div class="col-md-12 col-sm-12">                
                   <div class="camp" >
                       <input  class="form-control" type="text" disabled value="<%previw_data.product['pro_name']%>"/>
                   </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="col-md-12 col-sm-12"> Destination Category </label>
                
                  <div class="col-md-12 col-sm-12">                      
                      <ul>
                          <li ng-repeat="cat in previw_data.category"><%cat.category_name%></li>
                      </ul>  
                  </div>     
            </div>
            <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-12 col-sm-12">Content </label>
                <div class="col-md-12 col-sm-12">  
                      <% previw_data.prviw_data.adcontent_title %>
                </div>    
            </div>
             <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-12 col-sm-12">Description               
                  </label>
                <div class="col-md-12 col-sm-12"> 
                    <% previw_data.prviw_data.adcontent_discrip %>
                </div>    
            </div>
             
            
              <div class="form-group butn">
                  <button type="button" class="btn btn-default" ng-click="step_wizard(2)">Back</button> 
                 
                    
               </div>  
            
          </div>  
          
          <!--------------End-------------->
          
       
 </section>  
<style>
    .crt_prom{display:table;padding-top: 20px;}
    .crt_prom .form-group{display: table;width:100%}
    .butn,.step3 h2{padding-left: 20px;}
    .camp{margin-top: 20px}
    .ad_minus { margin-bottom: 5px;}
    .ad_minus a{ background: #0f8c96; padding: 2px 6px;}
    .ad_minus a i{color:#fff;} 
    .ad_pls a{ background: #0f8c96; padding: 2px 6px;}
    .ad_pls a i{color:#fff;} 
    .bread{display: inline-block;         
          border-radius: 5px;}
    .bread a{text-decoration: none;
         outline: none;
         display: block;	
         float: left;
         font-size: 12px;	
         line-height: 36px;	
         color: #000;	
        
         padding: 0 10px 0 30px;	
         background: #d6dce2;	
        position: relative;
        }
    .bread a:first-child{}
    .bread a:first-child:before{}
    .bread a.active, .bread a:hover{background: #0f8c96; color:#fff;
    }
    .bread a.active:after, .bread a:hover:after{background: #0f8c96; 

    }

.bread a:after {
	content: '';
	position: absolute;
	top: 0; 
	right: -18px; 
	width: 36px; 
	height: 36px;
	transform: scale(0.707) rotate(45deg);
	-webkit-transform: scale(0.707) rotate(45deg);		
	-ms-transform: scale(0.707) rotate(45deg);		
	-o-transform: scale(0.707) rotate(45deg);		
	z-index: 1;
	background: #d6dce2;
	
	box-shadow: 
		2px -2px 0 2px #ecf0f5, 
		3px -3px 0 2px #ecf0f5;
	border-radius: 0 5px 0 50px;
}
.bread a:first-child::before {
	content: '';
	position: absolute;
	top: 0; 
	left: -18px; 
	width: 36px; 
	height: 36px;
	transform: scale(0.707) rotate(45deg);
	-webkit-transform: scale(0.707) rotate(45deg);		
	-ms-transform: scale(0.707) rotate(45deg);		
	-o-transform: scale(0.707) rotate(45deg);		
	z-index: 1;
	background: #ecf0f5;	
	box-shadow: 
		0 #ecf0f5, 
		0 #ecf0f5;
	border-radius: 0;
}


</style>
