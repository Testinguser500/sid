var app = angular.module('sellers', ['ngRoute','textAngular'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
      
});
 app.filter('capitalize', function() {
    return function(input) {
      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});
app.directive("passwordStrength", function(){
    return {        
        restrict: 'A',
        link: function(scope, element, attrs){                    
            scope.$watch(attrs.passwordStrength, function(value) {
                console.log(value);
				
                if(angular.isDefined(value)){
					var numbers = /^[0-9]+$/; 
					var chars = /^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
					
					
					 if(chars.test(value))
					{
						scope.formSubmit=true;
						scope.strength = 'strong';
						scope.strengthClass= 'progress-sm';
						scope.barClass='progress-bar progress-bar-success';
					}
                    else if (value.length > 6) {
                        scope.strength = 'medium';
						scope.strengthClass= 'progress-xs';
						scope.barClass='progress-bar progress-bar-warning';
						scope.formSubmit=false;
                    } 
					//else if (value.length > 3) {
                    //    scope.strength = 'medium';
					//	scope.strengthClass= 'progress-xs';
					//	scope.barClass='progress-bar-warning';
                    //} 
					else {
                        scope.strength = 'weak';
						scope.strengthClass= 'progress-xxs';
						scope.barClass='progress-bar progress-bar-danger';
						//scope.formSubmit=false;
                    }
                }
            });
        }
    };
});
app.config(['$routeProvider', function($routeProvider) {
   $routeProvider.   
   when('/category', {
      templateUrl: 'category',controller: 'CategoryController'
   }). 
   when('/setting', {
      templateUrl: 'setting', controller: 'SettingController'
   }).
   when('/template', {
      templateUrl: 'template', controller: 'TemplateController'
   }).
   when('/enquiry', {
      templateUrl: 'enquiry', controller: 'EnquiryController'
   }).
   when('/config', {
      templateUrl: 'config', controller: 'ConfigController'
   }).  

   when('/faq', {
      templateUrl: 'faq', controller: 'FaqController'
   }). 

   when('/dashboard', {
      templateUrl: 'dashboard', controller: 'DashboardController'
   }).
   when('/user', {
      templateUrl: 'user', controller: 'UserController'
   }).
   when('/static-content', {
      templateUrl: 'static-content', controller: 'StaticContentController'
   }).
   when('/seller', {
      templateUrl: 'seller', controller: 'SellerController'

   }).   
	when('/brand', {
      templateUrl: 'brand', controller: 'BrandsController'
   }).
	when('/banner', {
      templateUrl: 'banner', controller: 'BannerController'
   }).
   when('/country', {
      templateUrl: 'country', controller: 'CountryController'
   }).
   when('/option', {
      templateUrl: 'option', controller: 'OptionController'
   }).
   when('/product', {
      templateUrl: 'product', controller: 'ProductController'
   }).
   when('/product-list', {
      templateUrl: 'product-list', controller: 'ProductListController'
   }).
   when('/profile', {
      templateUrl: 'profile', controller: 'ProfileController'
   }).
   
   otherwise({
      redirectTo: 'dashboard', controller: 'DashboardController'
   });
	
}]);
app.controller('HomeController', function($scope, $http) {
    
//alert($location.path());
	$scope.errors=false;
	$scope.loading = true;
        $scope.includes_function=false;
	$scope.init = function() {
            
		
//		$scope.loading = true;
//		$http.get('/log_user').
//		success(function(data, status, headers, config) {
//			$scope.todos = data;
//				$scope.loading = false;
// 
//		});
	}
 
       $scope.sign_in = function() {
		
         
		$http.post('log_user', {
			email: $scope.email,
			password: $scope.password,
                   
		}).success(function(data, status, headers, config) {
            if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
				location.href=data[1];
			}
			$scope.loading = false;
 
		})
	};
	
	//$scope.category = function() {
		//$scope.loading = true;alert('hello');
		//$scope.includes_function='/admins/category';
	/* 	$http.get('/admins/category').
		success(function(data, status, headers, config) {
			$scope.categorys = data;
	        $scope.loading = false;
 
	}); */
	//}
 
//	$scope.addTodo = function() {
//				$scope.loading = true;
// 
//		$http.post('/api/todos', {
//			title: $scope.todo.title,
//			done: $scope.todo.done
//		}).success(function(data, status, headers, config) {
//			$scope.todos.push(data);
//			$scope.todo = '';
//				$scope.loading = false;
// 
//		});
//	};
// 
//	$scope.updateTodo = function(todo) {
//		$scope.loading = true;
// 
//		$http.put('/api/todos/' + todo.id, {
//			title: todo.title,
//			done: todo.done
//		}).success(function(data, status, headers, config) {
//			todo = data;
//				$scope.loading = false;
// 
//		});;
//	};
// 
//	$scope.deleteTodo = function(index) {
//		$scope.loading = true;
// 
//		var todo = $scope.todos[index];
// 
//		$http.delete('/api/todos/' + todo.id)
//			.success(function() {
//				$scope.todos.splice(index, 1);
//					$scope.loading = false;
// 
//			});;
//	};
 
 
	$scope.init();
 
});
 app.controller('DashboardController', function($scope, $http) {
});
// Category Management
 app.controller('CategoryController', function($scope, $http) {
    
     $scope.errors=false;

     $scope.files='';

     $scope.loading = true;
     $scope.categories=false;
     $scope.page='index';
     $scope.category={};
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.files='';
                $scope.category={};
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('category/all').
		success(function(data, status, headers, config) {
			$scope.categories = data;
		        $scope.loading = false;
 
		});
	}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('category/all').
		success(function(data, status, headers, config) {
			$scope.all_cat = data;
		        $scope.loading = false;
 
		});
	}
        $scope.editcategory = function(category) {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('category/edit/' + category.id, {			
		}).success(function(data, status, headers, config) {
			$scope.category = data['category'];
                        var im=$scope.category.image;
                        var im1= im.split("category/"); 
                        $scope.files=im1[1]; 
                        $scope.all_cat = data['all_cat'];
		        $scope.loading = false;
 
		});;
	};
        $scope.uploadedFile = function(element) {
           $scope.$apply(function($scope) {
            
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
            fd.append("folder",'category');
	    fd.append("width",'310');
	    fd.append("height",'210');
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ 
                        if(data[0]=='error'){
				$scope.errors=data[1];
			}
			else
			{
                                $scope.errors=false;
                                $scope.files=data;                    
                                $scope.loading = false;
			}
        });

    });
   }
        $scope.delcatefiles=function(file) {
                $scope.files='';
        }

        $scope.update = function(category) { 
            $scope.errors=false;
            $scope.success_flash=false;
         
           $http.post('category/update', {
			category_name: category.category_name,
			description: category.description,
                        id: category.id,
                        status: category.status,
                        parent_id: category.parent_id,
                        image: $scope.files,
                        meta_title: category.meta_title,
                        meta_description: category.meta_description,
                        meta_keyword: category.meta_keyword
                   
		}).success(function(data, status, headers, config) {
                 $scope.files='';
                if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
			        $scope.success_flash=data[1];
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };

      $scope.store = function(category) { 
           $scope.errors=false;
           $scope.success_flash=false;   

           $http.post('category/store', {
			category_name: category.category_name,
			description: category.description,
                        image: $scope.files,
                        id: category.id,
                        status: category.status,
                        parent_id: category.parent_id,                       
                        meta_title: category.meta_title,
                        meta_description: category.meta_description,
                        meta_keyword: category.meta_keyword

		} ).success(function(data, status, headers, config) {
                    
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				$scope.files='';
				$scope.errors=false;
                                $scope.success_flash=data[1];				
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };
      $scope.deleteCategory = function(index) {
		$scope.loading = true;

		var category = $scope.categories[index];
              
                $http.post('category/delete',{            
                    del_id:category.id
                }).success(function(data, status, headers, config) {
                                        $scope.categories.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };

         $scope.init();
});
// Enquiry Management
 
// Setting
 app.controller('SettingController', function($scope, $http) {
    
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.faqs=false;
     $scope.page='index';
     $scope.faq=false;
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('setting/all').
		success(function(data, status, headers, config) {
			$scope.store_data = data['store_data'];
			$scope.country = data['country'];
			console.log($scope.store_data);
		        $scope.loading = false;
		$scope.getState($scope.store_data.store_country,'store');
		$scope.getCity($scope.store_data.store_state,'store');
 
		});
	}
	$scope.getState = function(pid,type){
		//console.log(pid);
		$http.post('country/getState',{
			store_country:pid
		}).
		success(function(data, status, headers, config) {console.log(data);
		var vari = type + 'state';
		//console.log(vari)
		if(type=='user')
		$scope.user_state = data;
		else if(type=='store')
		{
			$scope.store_state = data;
		}
		});
		
	}
	$scope.getCity = function(pid,type){
		//console.log(pid);
		$http.post('country/getCity',{
			store_country:pid
		}).
		success(function(data, status, headers, config) {//console.log(data);
		if(type=='user')
		$scope.user_city = data;
		else if(type=='store')
		{
			$scope.store_city = data;
		}	
 
		});
		
	}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.faq=false;
	}
        $scope.editfaq = function(faq) {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('faq/edit/' + faq.id, {			
		}).success(function(data, status, headers, config) {
			$scope.faq = data['data'];                      
		        $scope.loading = false;
 
		});
	};
        
	$scope.removelogo = function()
	{
		$scope.store_data.logo=false;
	}
	$scope.delBanner = function()
	{
		$scope.store_data.banner=false;
	}
	$scope.delPic = function()
	{
		$scope.store_data.profile_picture=false;
	}
        $scope.update = function(storeData) { 
            $scope.errors=false;
            $scope.success_flash=false;
         console.log(storeData);
           $http.post('setting/update', {
		store_id:storeData.id,
		profile_pic:storeData.profile_picture,
		store_name: storeData.store_name,
		store_link: storeData.store_link,
		store_address: storeData.store_address,
		banner:$scope.bannerfiles,
		store_country:storeData.store_country,
		store_state:storeData.store_state,
		store_city:storeData.store_city,
		
		store_phone:storeData.phone,
		logo:$scope.logo,

		}).success(function(data, status, headers, config) {
                 
                if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
			        $scope.success_flash=data[1];
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };

      $scope.uploadlogo = function(element) {
           $scope.$apply(function($scope) {
            $scope.loading = true;
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
			fd.append("folder",'store_logo');
			fd.append("width",'150');
			fd.append("height",'150');
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ 
			if(data[0]=='error'){
				$scope.errors=data[1];
			}
			else
			{
			$scope.logo=data;
			$scope.store_data.logo=$scope.logo;
			$scope.loading = false;
			}
			});

    });
   }
   
   $scope.uploadedBannerFile = function(element) {
           $scope.$apply(function($scope) {
            $scope.loading = true;
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
			fd.append("folder",'store_banner');
			fd.append("width",'1300');
			fd.append("height",'400');
            $http.post('Allimageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ 
			if(data[0]=='error'){
				$scope.errors=data[1];
			}
			else
			{
			$scope.bannerfiles=data;
			$scope.store_data.banner=$scope.bannerfiles;
			//console.log($scope.user.banner);
			$scope.loading = false;
			}
			});

    });
   }
   $scope.uploadProfilePic = function(element) {
           $scope.$apply(function($scope) {
            $scope.loading = true;
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
			fd.append("folder",'seller');
			fd.append("width",'150');
			fd.append("height",'150');
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ 
			if(data[0]=='error'){
				$scope.errors=data[1];
			}
			else
			{
			$scope.profilePic=data;
			$scope.store_data.profile_picture=$scope.profilePic;
			console.log($scope.profilePic);
			$scope.loading = false;
			}
			});

    });
   }
      

         $scope.init();
});

//Configuration 
app.controller('ConfigController', function($scope, $http) {
   
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.configs=false;
     $scope.page='index';    
     $scope.success_flash=false;
     
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('config/all').
		success(function(data, status, headers, config) {
			$scope.configs = data;
		        $scope.loading = false;
 
		});
	}
       
        $scope.edit= function() {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('config/edit').success(function(data, status, headers, config) {
			$scope.configs = data;                      
		        $scope.loading = false;
 
		});;
	};
        $scope.update = function(config) { 
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('config/update', {			
                       all_data:   config 
		}).success(function(data, status, headers, config) {
                      
                       if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
			        $scope.success_flash=data[1];
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };

     

         $scope.init();
});

 /*****Products*****/
  app.controller('ProductListController', function($scope, $http,$compile) {
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.products=false;
     $scope.page='index';
     $scope.product={};
     $scope.images={};
     var pro_id=[];
     $scope.success_flash=false;
     $scope.tab = 1;

    $scope.setTab = function(newTab){
      $scope.tab = newTab;
    };

    $scope.isSet = function(tabNum){
      return $scope.tab === tabNum;
    };
    
    $scope.showMe = false;
    $scope.myFunc = function() {
        $scope.showMe = !$scope.showMe;
    }
        $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;
		var ab='';
		$scope.loading = true;
		$http.get('getCategory').
		success(function(data, status, headers, config) {
			$scope.category = data['category'];
			var result = $scope.category;
			var $el =$('<li>'+
                    '<div class="cat-search"><input class="form-control" tpye="text" ng-model="cat.search" ng-keyup="getArray(category,cat.search)"></div><select id="cat" name="sometext" size="10" ng-model="product.category" data-ng-click="getSubCategory(product.category,1);" ></select>'+
                    
                    '</li>').appendTo('#bind-html-with-trust');
			$compile($el)($scope);
		   angular.forEach($scope.category, function (item) {
			 ab += '<option value="'+item.id+'">'+item.category_name+'</option>';
			
		   });
		   //ab= '<option ng-repeat="ctt in category" value="ctt.id"><%ctt.category_name%></option>';
		   $(ab).appendTo('#cat');
			 //$($el).appendTo('#bind-html-with-trust');
		    
		    $compile(ab)($scope);
             
		        $scope.loading = false;
		});
	}
	
	$scope.getSubCategory = function(CatData,step) {
		
		pro_id.push(CatData);
		var ab='';
		$scope.errors=false;               
		$scope.loading = true;
		$http.post('getSubCategory',{pid:CatData}).
		success(function(data, status, headers, config) {
			$scope.subcategory = data['category'];
			console.log(step);
			var nextStep = step+1;
			
			if($scope.subcategory)
			
			{var lastStep = nextStep;
				if ( angular.element('#cat-li_'+step).length ) {
			//console.log('#cat_'+step+' exists');
			angular.element('#cat-li_'+step).remove();
			}
			if(step<nextStep)
			{
				for(i=step;i<=nextStep;i++)
				{
					//console.log('cat_'+i);
				angular.element('#cat-li_'+i).remove();
				}
				console.log(step+'<'+nextStep);
				console.log(lastStep);
			}
				var $el =$('<li id="cat-li_'+step+'">'+
                    '<div class="cat-search"><input class="form-control" tpye="text" ng-model="search" ng-keypress="getArray(subcategory,search)"></div><select id="cat_'+step+'" class="all-select" name="sometext" size="10" ng-model="product.category" data-ng-click="getSubCategory(product.category,'+nextStep+');" ></select>'+
                    
                    '</li>').appendTo('#bind-html-with-trust');
			$compile($el)($scope);
		   angular.forEach($scope.subcategory, function (item) {
			 ab += '<option value="'+item.id+'">'+item.category_name+'</option>';
			
		   });
		   
		   $(ab).appendTo('#cat_'+step);
			 //$($el).appendTo('#bind-html-with-trust');
		    
		    $compile(ab)($scope);
			}
			else
			{
				for(i=step;i<=nextStep;i++)
				{
					console.log('cat_'+i);
					angular.element('#cat-li_'+i).remove();
				}
				
			$scope.errors=false;
			$scope.success_flash=false;
			//$scope.product=false;
			$http.post('product_list',{
				pro_id:CatData
				}).
			success(function(data, status, headers, config) {
				if(data)
				{
				$scope.products = data;
				}
				
				 console.log($scope.products);
				$scope.loading = false;
	 
			});	
			}
			//console.log(nextStep);
             
		        $scope.loading = false;
		});
		console.log(pro_id);
	}
	
	$scope.getArray = function(arrayData,vv)
	{
		var result = [];
		console.log(arrayData);
		console.log(vv);
		angular.forEach(arrayData, function (value, key) {
        //console.log(value.category_name);
	var patt = new RegExp(vv);
    //var res = patt.test(str);
	if(patt.test(value.category_name))
	{
		result.push(value);
               console.log(result);
	}

        });
        $scope.searchcategory= result;
	//console.log($scope.category);
	}
	$scope.addproduct = function(proData) {	
                $scope.page='add';
		console.log(proData);
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.product=false;
		$http.post('product/all',{cat_id:proData,product_id:pro_id}).
		success(function(data, status, headers, config) {
			$scope.sellers = data['sellers'];
			$scope.all_category = data['categories'];
			$scope.brands = data['brands'];
			$scope.options = data['options'];
			//$scope.all_category = data['all_category'];
			console.log($scope.options);
		        $scope.loading = false;
 
		});
	}
	$scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.product=false;
		$http.get('product/all').
		success(function(data, status, headers, config) {
			$scope.sellers = data['sellers'];
			$scope.categories = data['categories'];
			$scope.brands = data['brands'];
			$scope.all_category = data['all_category'];
			console.log($scope.all_category);
		        $scope.loading = false;
 
		});
	}
	
	$scope.getOption = function(optData){
		//var vv = 'optValues_'+optData;
		$scope.optValues=[];
		$http.post('product/getOptionValue',
			   {opt_id:optData
			   }).success(function(data,status,headers,config){
			$scope.optValues[optData] = data['optionvalues'];
			//console.log(vv);
			console.log($scope.optValues[optData]);
		})
	}
	$scope.selectedoptValues=[];
	$scope.array=[];
	$scope.selectedoptValue = function(item,optid)
	{
		
	if(!$scope.selectedoptValues[optid] ){
		$scope.selectedoptValues[optid]=[];
	}
		oldmovies='';
		angular.forEach($scope.selectedoptValues[optid], function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedoptValues[optid].push(item);
		//$scope.selectedoptValues[optid] = $scope.array;
		$scope.optValues[optid]='';
		//$scope.offer.spcategory='';
		console.log($scope.selectedoptValues[optid]);
	  }
	}
	$scope.removeItem=function(index,array)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedoptValues[array].splice(index, 1);
		console.log($scope.selectedoptValues[array]);
	}
	   // GET THE FILE INFORMATION.
//	 $scope.uploadedMultipleFile = function(element) { //alert(element);
//		
//		$scope.files = [];
//		 $scope.$apply(function () {
//
//                // STORE THE FILE OBJECT IN AN ARRAY.
//                for (var i = 0; i < element.files.length; i++) {
//                    $scope.files.push(element.files[i]); console.log(element.files[i]);
//                }
//		
//		 //FILL FormData WITH FILE DETAILS.
//		var data = new FormData();
//
//		for (var i in $scope.files) {
//		    data.append("uploadedFile", $scope.files[i]);
//		}
//
//            });
//           $scope.$apply(function($scope) {
//            $scope.loading = true;
//           var fd = new FormData();
//            //Take the first selected file
//            //fd.append("image",element.files[0]);
//	    angular.forEach(element, function (value, key) {
//                    fd.append(key, value);
//                });
//			fd.append("folder",'product');
//			fd.append("width",'150');
//			fd.append("height",'150');
//            $http.post('imagemutipleupload', fd, {
//                withCredentials: true,
//                headers: {'Content-Type': undefined },
//                transformRequest: angular.identity
//            }).success( function(data, status, headers, config){ $scope.files=data;$scope.loading = false;});
//
//    });
	//}
	 
	 $scope.store = function(product,images) { 
           $scope.errors=false;
           $scope.success_flash=false;   
           console.log(product);
           $http.post('product/store', {
			pro_name: product.pro_name,
			pro_des: product.pro_des,
			pro_short_des: product.pro_short_des,
			pro_feature_des: product.pro_feature_des,
			seller_id: product.seller_id,
			pro_category_id: product.pro_category_id,
			brand_id: product.brand_id,
			product_tags: product.product_tags,
			price: product.price,
			no_stock: product.no_stock,
			meta_title: product.meta_title,
			meta_description: product.meta_description,
			meta_keywords: product.meta_keywords,
                        status: product.status,
			images: images
		} ).success(function(data, status, headers, config) {
                  
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				$scope.errors=false;
				$scope.success_flash=data[1];				
				$scope.init();
			}
			$scope.loading = false;
 
         });
      };
	
	
	$scope.deleteproduct = function(index) { 
		$scope.loading = true;

		var product = $scope.products[index];

                $http.post('product/delete',{            
                    del_id:product.id
                }).success(function(data, status, headers, config) {
                                        $scope.products.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
        };
	
	 $scope.editproduct = function(product) {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('product/edit/' + product.id, {			
		}).success(function(data, status, headers, config) {
			$scope.product = data['product'];
			$scope.sellers = data['sellers'];
			$scope.categories = data['categories'];
			$scope.brands = data['brands'];
		        $scope.loading = false;
		});
	};

        $scope.update = function(product) { 
            $scope.errors=false;
            $scope.success_flash=false; //console.log(product);
           $http.post('product/update', { 
			id: product.id,
			pro_name: product.pro_name,
			pro_des: product.pro_des,
			pro_short_des: product.pro_short_des,
			pro_feature_des: product.pro_feature_des,
			seller_id: product.seller_id,
			pro_category_id: product.pro_category_id,
			brand_id: product.brand_id,
			product_tags: product.product_tags,
			price: product.price,
			no_stock: product.no_stock,
			meta_title: product.meta_title,
			meta_description: product.meta_description,
			meta_keywords: product.meta_keywords,
                        status: product.status 
		}).success(function(data, status, headers, config) {
                 
                if(data[0]=='error'){
				$scope.errors=data[1];
				$scope.success_flash=false;
			}else{
				
				$scope.errors=false;
				$scope.product={};
			        $scope.success_flash=data[1];
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };
	$scope.init();
});
   app.controller('ProfileController', function($scope, $http) {
	
	$scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.page='index';
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('profile/all').
		success(function(data, status, headers, config) {
			$scope.seller = data['seller'];
		        $scope.loading = false;
 
		});
	}
	$scope.update = function(sellerData) {
	$scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.post('profile/update',{
			id:sellerData.id,
			first_name:sellerData.fname,
			last_name:sellerData.lname,
			email:sellerData.email,
			current_password:sellerData.current_password,
			new_password:sellerData.new_password,
			confirm_new_password:sellerData.confirm_new_password
			}).
		success(function(data, status, headers, config) {
			//$scope.seller = data['seller'];
		        $scope.loading = false;
			if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
				$scope.product={};
			        $scope.success_flash=data[1];
                                $scope.init();
			}
			$scope.loading = false;
		});
	
	}
	$scope.init();
});