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
        <div class="box" ng-if="page=='index'">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i> Select Category</h3>
              
            </div>
            <div class="box-body">
                
                <ul class="cat-li" ng-bind-html="deliberatelyTrustDangerousSnippet()" id="bind-html-with-trust">
                </ul>
                
            </div>
            <div class="box-body">
                <div class="box box-primary" ng-repeat="pro in products">
            <div class="box-header with-border pt-lst">
                <div class="img"><img src="{{URL::asset('uploads/product')}}/<%pro.image%>"></div>
              <div class="box-title"><%pro.pro_name%></div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
          </div>
                <div ng-if="products==''" class="">
                    <div>Can't find the item you're looking for?</div>
                    <div class=""><button class="btn btn-primary" ng-click="addproduct(product.category)" >Specify you own</button></div>
                </div>
            </div>
        </div>
        <div class="box" ng-if="page=='add'">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-list"></i>Product Details</h3>
              
            </div>
            <div class="box-body">
            <div class="col-md-6">
                <div class="form-group">
		      <label for="exampleInputEmail1">Product Title</label>
		      <input type="text" class="form-control" id="" name="pro_name" placeholder="Product Name" ng-model="product.pro_name">
		      <div class="help-block"></div>
		    </div>
                <div class="form-group">
                    <h3>Product Specification</h3>
                </div>
                <div class="form-group pc-tt">
                    <label>Product Category 
                    </label><ul class="ul-cat-sel">
                    <li class="cat-tree-sel" ng-repeat="category in all_category | filter:test" ng-include="'categoryTree'"></li>
                    </ul><a ng-click="init()">Change Category</a>
                    
                    <script type="text/ng-template" id="categoryTree">
                    <% category.category_name %>
                    <ul ng-if="category.all_category">
                    <li class="cat-tree-sel" ng-repeat="category in category.all_category | filter:test" ng-include="'categoryTree'">           
                    
                    </li>
                    </ul>
                    </script>
                     
                </div>
                
                <div>
                    <div class="form-group" ng-repeat="opt in options">
                        <label><%opt.option_name%></label>
                        
                        <input type="text" class="form-control" ng-model="option_data.options[opt.option_name]" ng-click="getOption(opt.id)">
                            <ul class="pro-ul" ng-show="rerr"><li><%msg%></li></ul>
                            
			<ul class="pro-ul" ng-if="optValues[opt.id]">
			      <li ng-repeat="r in optValues[opt.id]" ng-click="selectedoptValue(r,opt.id);"><%r.option_name%></li>
			</ul>
                        <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 100%;">
			<span class="selection">
			      <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
			      <ul class="select2-selection__rendered">
				    <li class="select2-selection__choice" ng-repeat="r in selectedoptValues[opt.id]"><%r.option_name%> <span ng-click="removeItem($index,opt.id)" style="cursor:pointer">x</span></li>
			      </ul>
			      </span>
			</span>
		  </span>
                        <!--<select class="form-control" ng-if="opt.type=='select'" ng-model="product.options">
                            <option ng-repeat="val in opt.options_value" ng-value="val.id"><%val.option_name%></option>
                        </select>-->
                            
                    </div>
            </div>
                <div class="form-group">
                    <h3>Product Description</h3>
                    
                </div>
                <div class="form-group">
			 <label for="exampleInputEmail1">Description</label>
			     <div text-angular ng-model="product.pro_description" name="pro_des" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>
			     <div class="help-block"></div>
			</div>
                <div class="form-group">
			 <label for="exampleInputEmail1">Feature Description</label>
			     <div text-angular ng-model="product.pro_des_feature" name="pro_des_feature" ta-text-editor-class="border-around" ta-html-editor-class="border-around"></div>
			     <div class="help-block"></div>
			</div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h3>Product Images</h3>
                </div>
                <div class="form-group">
                    <div class="img-guid">
                    <h3>Image Guidelines:</h3>
                    <ul>
                        <li>Put your product in front of a plain backdrop</li>
                        <li>Be sure that the entire product is visible in the picture</li>
                        <li>Product image size should be square and 800x800 pixels</li>
                    </ul>
                    </div>
                </div>
               
                <div class="form-group sel-up-img" >
                    
                    <div ng-if="inputs">
                        <div ng-repeat="input in inputs" class="img-sell">
                        <img ng-mouseleave="display_cross_$index=0" ng-mouseover="display_cross_$index=1" ng-show="input.value" src="{{URL::asset('uploads/product')}}/thumb_<% input.value %>" style="height:80px;width:80px">
                        
                        <a href="javascript:void(0);" ng-click="removeimgs(input.value,$index);display_cross_$index=0" title="Delete" class="bnr-del" ng-mouseleave="display_cross_$index=0" ng-mouseover="display_cross_$index=1" ng-show="display_cross_$index==1"><img src="{{URL::asset('admin/img/del.png')}}"></a>
                        </div>
                    </div>
                    <div id="droply-filedrag-mas" ng-show="inputs.length <8" class="droply-filedrag " style="color: white; border: 5px dashed #efefef; background-image: url(&quot;img/icon-droply.png&quot;); background-size: 51% 61%; background-position: 120px 24%; background-repeat: no-repeat; display: block;"><br>
                    
                    <span ng-hide="input.value" class="btn btn-primary btn-file sell-file">
					Upload a Product Image <input type="file" ng-model="input.image" onchange="angular.element(this).scope().uploadedFile(this)">
				</span>
                    
                    <!--<button class="btn btn-success button button-small button-balanced" ng-if="$index == inputs.length - 1" ng-click="addInput()">
            <i class="icon ion-plus"></i>
        </button>
            <button class="btn btn-danger button button-small button-assertive" ng-if="$index != inputs.length - 1" ng-click="removeInput($index)">
            <i class="icon ion-minus"></i>
        </button>-->
                    </div>
                    
                
                </div>
            </div>
           
            <div ng-repeat="val in selectedoptValues"><%val%></div>
            <table id="example1" class="table table-bordered table-striped">
		    <thead>
		    <tr>
                        <td></td>
                        <th>Variables</th>
                        <th>Price</th>
                        <th>Discounted Price</th>
                        <th>Quantity</th>
                        <th>SKU</th>
                        <th>Weight(kg)</th>
                        <th>Dimensions(cm)</th>
                        <th>Purchase Note</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fa fa-trash"></i></td>
                            <td><div ng-repeat="opt in selectedoptValues"><%opt%></div></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                    </tbody>
            </div>
        </div>
</section>
