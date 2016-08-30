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
            </div>
            <div class="col-md-6">
            </div>
            </div>
        </div>
</section>
