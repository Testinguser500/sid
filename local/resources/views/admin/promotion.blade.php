
 <section class="content">
       <div class="col-md-12">
<!--            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
           @endif -->
              <!-- general form elements -->
              
              <div class="col-sm-12">
               <div class="bread">
                    <a href="#" class="active">Plan and Package</a>
                    <a href="#">Choose Products</a>
                    <a href="#">Review and Payment</a>
            </div>

              </div>
          <div class="box box-primary crt_prom">
            
            <!-- /.box-header -->
            <div class="form-group">
                <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Select or Create Campaign </label>
                <div class="col-md-8 col-sm-8">
                    <select class="form-control "  ng-change="selcrt_camp(Ad_text.campain)" ng-model="Ad_text.campain">
                        <option value="">Please select</option>
                       <option value="create_new">Create New</option>
                    </select> 
                   <div class="camp" ng-show="campinputshow==true">
                       <input  class="form-control" type="text" ng-model="Ad_text.newcamp" placeholder="Please enter campaign name"/>
                   </div>
                </div>
            </div>
            <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Ad Type </label>
                  <div class="col-md-8 col-sm-8">
                    <select class="form-control">
                       <option>Default select</option>
                    </select>   
                  </div>     
            </div>
             <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Select views per product  </label>
                <div class="col-md-8 col-sm-8">  
                    <select class="form-control">
                       <option>Default select</option>
                    </select>    
                </div>    
            </div>
              <div class="form-group">
                  <label for="exampleInputEmail1" class="col-md-4 col-sm-4">Schedule </label>
                <div class="col-md-8 col-sm-8">  
                    <select class="form-control">
                       <option>Default select</option>
                    </select> 
                </div>    
            </div>
          </div>   
       </div>
 </section>  
<style>
    .crt_prom{display:table;padding-top: 20px;}
    .crt_prom .form-group{display: table;width:100%}
    .camp{margin-top: 20px}
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
