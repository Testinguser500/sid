var app = angular.module('admins', ['ngRoute','textAngular'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
      
});
 app.filter('capitalize', function() {
    return function(input) {
      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});
app.config(['$routeProvider', function($routeProvider) {
   $routeProvider.   
   when('/category', {
      templateUrl: 'category',controller: 'CategoryController'
   }). 
   when('/newsletter', {
      templateUrl: 'newsletter', controller: 'NewsletterController'
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
   when('/user/add', {
      templateUrl: 'user/add', controller: 'UserController'

   }). 
	when('/brand', {
      templateUrl: 'brand', controller: 'BrandsController'
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
     $scope.files=false;
     $scope.loading = true;
     $scope.categories=false;
     $scope.page='index';
    
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
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
                        $scope.all_cat = data['all_cat'];
		        $scope.loading = false;
 
		});;
	};
        $scope.uploadedFile = function(element) {
           $scope.$apply(function($scope) {
            
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ $scope.files=data;});

    });
   }

        $scope.update = function(category) { console.log($scope.category.file);
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
                        meta_keyword: category.meta_keyword,
                   
		}).success(function(data, status, headers, config) {
                 $scope.files=false;
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
                        meta_keyword: category.meta_keyword,

		} ).success(function(data, status, headers, config) {
                   $scope.files=false;
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
// Faq Management
 app.controller('FaqController', function($scope, $http) {
    
     $scope.errors=false;
     $scope.files=false;
     $scope.loading = true;
     $scope.faqs=false;
     $scope.page='index';
     $scope.faq=false;
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('faq/all').
		success(function(data, status, headers, config) {
			$scope.faqs = data;
		        $scope.loading = false;
 
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
 
		});;
	};
        

        $scope.update = function(faq) { 
            $scope.errors=false;
            $scope.success_flash=false;
         
           $http.post('faq/update', {
			question: faq.quest,
			answer: faq.ans,
                        status: faq.status,
                        faq_id:faq.id,
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

      $scope.store = function(faq) { 
           $scope.errors=false;
           $scope.success_flash=false;   

           $http.post('faq/store', {
			question: faq.quest,
			answer: faq.ans,
                        status: faq.status,
			
                     
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
      $scope.deletefaq = function(index) {
		$scope.loading = true;

		var faq = $scope.faqs[index];
              
                $http.post('faq/delete',{            
                    del_id:faq.id
                }).success(function(data, status, headers, config) {
                                        $scope.faqs.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };

         $scope.init();
});
// Newsletter Management
app.controller('NewsletterController', function($scope, $http) {
   
     $scope.errors=false;
     $scope.files=false;
     $scope.loading = true;
     $scope.newsletters=false;
     $scope.page='index';
    
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('newsletter/all').
		success(function(data, status, headers, config) {
			$scope.newsletters = data;
		        $scope.loading = false;
 
		});
	}
       

        $scope.update = function(newsletter) { 
            $scope.errors=false;
            $scope.success_flash=false;
         
           $http.post('newsletter/update', {			
                        edit_id: newsletter.id,
                        subscribe: newsletter.subscribe                    
                  
		}).success(function(data, status, headers, config) {
                   $scope.files=false;
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

      
      $scope.delete = function(index) {
		$scope.loading = true;

		var newsletter = $scope.newsletters[index];
              
                $http.post('newsletter/delete',{            
                    del_id:newsletter.id
                }).success(function(data, status, headers, config) {
                                        $scope.newsletters.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };

         $scope.init();
});
//Configuration 
app.controller('ConfigController', function($scope, $http) {
   
     $scope.errors=false;
     $scope.files=false;
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
//user management
app.controller('UserController', function($scope, $http) {

    $scope.errors=false;
	$scope.files=false;
     $scope.loading = true;
     $scope.users=false;
	 $scope.user=false;
	 $scope.user_data = false;
     $scope.page='index';
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.loading = true;
		$http.get('user/all').
		success(function(data, status, headers, config) {
			$scope.users = data;
		        $scope.loading = false;
 
		});
	}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('user/all').
		success(function(data, status, headers, config) {
			$scope.all_user = data;
		        $scope.loading = false;
 
		});
	}
        $scope.edituser = function(category) {
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('user/edit/' + category.id, {			
		}).success(function(data, status, headers, config) {
			$scope.user = data['user'];
                        $scope.all_user = data['all_user'];
		        $scope.loading = false;
 
		});;
	};
	
	$scope.uploadedFile = function(element) {
           $scope.$apply(function($scope) {
            
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
			fd.append("folder",'user');
			fd.append("width",'150');
			fd.append("height",'150');
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ $scope.files=data;});

    });
   }
        $scope.update = function(user_data) { console.log($scope.user);
            $scope.errors=false;
            $scope.success_flash=false;
           $http.post('user/update', {
			name: user_data.name,
			email: user_data.email,
			gender:user_data.gender,
			address:user_data.address,
                        id: user_data.id,
                        status: user_data.status,
                        image: $scope.files
                   
		}).success(function(data, status, headers, config) {
                    
            if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				$scope.user.image = $scope.files;
				//console.log($scope.user.image);
				$scope.files=false;
			$scope.errors=false;
			$scope.success_flash= data[1];
			
			}
			$scope.loading = false;
 
         });
      };
	  
	  $scope.store = function(userData) { 
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('user/store', {
			name: userData.name,
			email: userData.email,
			gender:userData.gender,
			address:userData.address,
                        id: userData.id,
                        status: userData.status,
                        image: $scope.files

		}).success(function(data, status, headers, config) {console.log($scope.files);
                    $scope.files=false;
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
                                $scope.success_flash=data[1];
				$scope.users.push(userData);
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };
      $scope.deleteUser = function(index) {
		$scope.loading = true;

		var user = $scope.users[index];
              
                $http.post('user/delete',{            
                    del_id:user.id
                }).success(function(data, status, headers, config) {
                                        $scope.users.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };
				
         $scope.init(); 



});
//Static Content
app.controller('StaticContentController', function($scope, $http) {

    $scope.errors=false;
	$scope.files=false;
     $scope.loading = true;
     $scope.contents=false;
	 $scope.content=false;
	 $scope.user=false;
     $scope.page='index';
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.loading = true;
		$http.get('static-content/all').
		success(function(data, status, headers, config) {
			$scope.contents = data;
		        $scope.loading = false;
 
		});
	}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('static-content/all').
		success(function(data, status, headers, config) {
			$scope.all_user = data;
		        $scope.loading = false;
 
		});
	}
        $scope.editcontent = function(category) {
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('static-content/edit/' + category.id, {			
		}).success(function(data, status, headers, config) {
			$scope.content = data['content'];
                        $scope.all_content = data['all_content'];
		        $scope.loading = false;
 
		});;
	};
	
	$scope.uploadedFile = function(element) {
           $scope.$apply(function($scope) {
            
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
			fd.append("folder",'static');
			fd.append("width",'150');
			fd.append("height",'150');
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ $scope.files=data;});

    });
   }
        $scope.update = function(contents) { console.log(contents);
            $scope.errors=false;
            $scope.success_flash=false;
           $http.post('static-content/update', {
			title: contents.title,
			short_description: contents.short_description,
			description:contents.description,
			image: $scope.files,id: contents.id
                   
		}).success(function(data, status, headers, config) {
			
                    //console.log(contents);
            if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
			$scope.content.image = $scope.files;
			//console.log($scope.content.image);
			$scope.files=false;			
			$scope.errors=false;
			$scope.success_flash= data[1];
			
			}
			$scope.loading = false;
 
         });
      };
	  
	  $scope.store = function(userData) { 
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('static-content/store', {
			name: userData.name,
			email: userData.email,
			gender:userData.gender,
			address:userData.address,
                        id: userData.id,
                        status: userData.status,
                        image: $scope.files

		}).success(function(data, status, headers, config) {
                    $scope.files=false;
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
                                $scope.success_flash=data[1];
				$scope.users.push(userData);
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };
      $scope.deleteUser = function(index) {
		$scope.loading = true;

		var user = $scope.users[index];
              
                $http.post('user/delete',{            
                    del_id:user.id
                }).success(function(data, status, headers, config) {
                                        $scope.users.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };
				
         $scope.init(); 



});

//Brands
app.controller('BrandsController', function($scope, $http) {

    $scope.errors=false;
	$scope.files = false;
     $scope.loading = true;
     $scope.brands=false;
	 $scope.brand=false;
	 $scope.user=false;
     $scope.page='index';
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.loading = true;
		$http.get('brand/all').
		success(function(data, status, headers, config) {
			$scope.brands = data;
			
		        $scope.loading = false;
 
		});
	}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('brand/all').
		success(function(data, status, headers, config) {
			$scope.all_brand = data;
		        $scope.loading = false;
 
		});
	}
        $scope.editbrand = function(brand_data) {
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('brand/edit/' + brand_data.id, {			
		}).success(function(data, status, headers, config) {
			$scope.brands = data['brands'];
                        $scope.all_brand = data['all_brand'];
		        $scope.loading = false;
 
		});;
	};
	$scope.uploadedFile = function(element) {
           $scope.$apply(function($scope) {
            
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
			fd.append("folder",'brand');
			fd.append("width",'150');
			fd.append("height",'150');
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ $scope.files=data;});

    });
	}
        $scope.update = function(brands) { console.log(brands);
            $scope.errors=false;
            $scope.success_flash=false;
           $http.post('brand/update', {
			brand_name: brands.brand_name,
			description: brands.description,
			status:brands.status,
			image: $scope.files,id: brands.id
                   
		}).success(function(data, status, headers, config) {
                    console.log(data);
            if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				$scope.brands.image = $scope.files;
			$scope.errors=false;
			$scope.files = false;
			$scope.success_flash= data[1];
			
			}
			$scope.loading = false;
 
         });
      };
	  
	  $scope.store = function(userData) { 
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('brand/store', {
			brand_name: userData.brand_name,
			description: userData.description,
			id: userData.id,
			status: userData.status,
			image: $scope.files

		}).success(function(data, status, headers, config) {
                    $scope.files=false;
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
				
                                $scope.success_flash=data[1];
				$scope.brands.push(userData);
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };
      $scope.deleteUser = function(index) {
		$scope.loading = true;

		var brand = $scope.brands[index];
              
                $http.post('brand/delete',{            
                    del_id:brand.id
                }).success(function(data, status, headers, config) {
                                        $scope.users.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };
				
         $scope.init(); 



});