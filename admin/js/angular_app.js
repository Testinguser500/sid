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
                        meta_keyword: category.meta_keyword,

		} ).success(function(data, status, headers, config) {
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
     $scope.errors_modal=false;
     $scope.success_flash_modal=false;
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.newsletters=false;
     $scope.page='index';
     $scope.newsl = {};  
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
       $scope.store = function(newsletter) { 
           $scope.errors_modal=false;
           $scope.success_flash_modal=false;   
         
           $http.post('newsletter/store', {			
                        name: newsletter.name,
                        email: newsletter.email,                    
                        mobile_no: newsletter.mob_no,   
                        occupation: newsletter.occupation, 
                        city: newsletter.city, 
                        gender: newsletter.gender, 
		}).success(function(data, status, headers, config) {             
                       if(data[0]=='error'){
				$scope.errors_modal=data[1];
			}else{
				
				$scope.errors_modal=false;
			        $scope.success_flash_modal=data[1];
                                $scope.newsl ={};
                                $scope.newsl.gender='male';
                                $scope.init();
                               
			}
			$scope.loading = false;
 
         });
      };
   
        $scope.update = function(newsletter) { 
            $scope.errors_modal=false;
            $scope.success_flash_modal=false;         
           $http.post('newsletter/update', {			
                        name: newsletter.name,
                        email: newsletter.email,                    
                        mobile_no: newsletter.mob_no,   
                        occupation: newsletter.occupation, 
                        city: newsletter.city, 
                        gender: newsletter.gender,
                        edit_id:newsletter.id
                  
		}).success(function(data, status, headers, config) {
					$scope.files='';

                       if(data[0]=='error'){
				$scope.errors_modal=data[1];
			}else{
				
				$scope.errors_modal=false;
			        $scope.success_flash_modal=data[1];                             
                                
			}
			$scope.loading = false;
 
         });
      };

      $scope.update_sub = function(newsletter) { 
            $scope.errors=false;
            $scope.success_flash=false;         
           $http.post('newsletter/update_subscribe', {			
                        subscribe: newsletter.subscribe,                        
                        edit_id:newsletter.id
                  
		}).success(function(data, status, headers, config) {
                  
                       if(data[0]=='error'){
				$scope.errors_modal=data[1];
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
//user management
app.controller('UserController', function($scope, $http) {

    $scope.errors=false;
	$scope.files='';
	$scope.bannerfiles='';
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
			$scope.users = data['category'];
			$scope.country = data['country'];
		        $scope.loading = false;
 
		});
	}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('user/all').
		success(function(data, status, headers, config) {
			$scope.all_user = data['category'];
			$scope.country = data['country'];
			console.log($scope.all_user);
		        $scope.loading = false;
 
		});
	}
        $scope.edituser = function(category) {
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('user/edit/' + category.id, {			
		}).success(function(data, status, headers, config) {//console.log(data['user']);
			$scope.user_ddata = data['user'];
			$scope.all_user = data['all_user'];
			$scope.roles = data['roles'];
			$scope.loading = false;
 //console.log($scope.user_data);
 $scope.getState($scope.user_ddata.store_country);
 $scope.getCity($scope.user_ddata.store_state);
		});;
	};
	
	$scope.getState = function(pid){
		//console.log(pid);
		$http.post('country/getState',{
			store_country:pid
		}).
		success(function(data, status, headers, config) {//console.log(data);
		$scope.store_state = data;	
 
		});
		
	}
	$scope.getCity = function(pid){
		//console.log(pid);
		$http.post('country/getCity',{
			store_country:pid
		}).
		success(function(data, status, headers, config) {//console.log(data);
		$scope.store_city = data;	
 
		});
		
	}
	$scope.uploadedFile = function(element) {
           $scope.$apply(function($scope) {
            $scope.loading = true;
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
            }).success( function(data, status, headers, config){ $scope.files=data;$scope.loading = false;});

    });
   }
   $scope.uploadedBannerFile = function(element) {
           $scope.$apply(function($scope) {
            $scope.loading = true;
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
			fd.append("folder",'store_banner');
			fd.append("width",'550');
			fd.append("height",'250');
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ $scope.bannerfiles=data;$scope.loading = false;});

    });
   }
        $scope.update = function(user_data) { console.log($scope.bannerfiles);
            $scope.errors=false;
            $scope.success_flash=false;
           $http.post('user/update', {
			role:user_data.role,
			name: user_data.name,
			username: user_data.username,
			nickname: user_data.nickname,
			email: user_data.email,
			gender:user_data.gender,
			mobile: user_data.mobile,
			website: user_data.website,
			bio: user_data.bio,
			password: user_data.pass,
			confirm_password:user_data.repassword,
			nationality: user_data.nationality,
			country: user_data.country,
			address:user_data.address,
			id: user_data.userid,
			status: user_data.status,
			profile_image: $scope.files,
			store_name: user_data.store_name,
			store_link: user_data.store_link,
			store_address: user_data.store_address,
			ship_name: user_data.ship_name,
			ship_mobile: user_data.ship_mobile,
			ship_address: user_data.ship_address,
			ship_country: user_data.ship_country,
			ship_state: user_data.ship_state,
			ship_city: user_data.ship_city,
			banner:$scope.bannerfiles,
			store_country:user_data.store_country,
			store_state:user_data.store_state,
			store_city:user_data.store_city,
			
			store_phone:user_data.phone,
			facebook_link:user_data.facebook_link,
			google_plus_link:user_data.google_plus_link,
			twitter_link:user_data.twitter_link,
			linkedin_link:user_data.linkedin_link,
			youtube_link:user_data.youtube_link,
			instagram_link:user_data.instagram_link,
			flickr_link:user_data.flickr_link,
			store_id:user_data.store_id,
			shipp_id:user_data.shipp_id
                   
		}).success(function(data, status, headers, config) {
                    
            if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				if($scope.files)
				$scope.user.image = $scope.files;
				//console.log($scope.user.image);
				$scope.files='';
			$scope.errors=false;
			$scope.success_flash= data[1];
			
			}
			$scope.loading = false;
 
         });
      };
	  
	  $scope.store = function(userData) {console.log($scope.files) ;
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('user/store', {
			role:userData.role,
			name: userData.name,
			username: userData.username,
			nickname: userData.nickname,
			email: userData.email,
			gender:userData.gender,
			mobile: userData.mobile,
			website: userData.website,
			bio: userData.bio,
			password: userData.password,
			confirm_password:userData.repassword,
			nationality: userData.nationality,
			country: userData.country,
			address:userData.address,
			id: userData.id,
			status: userData.status,
			profile_image: $scope.files,
			store_name: userData.store_name,
			store_link: userData.store_link,
			store_address: userData.store_address,
			ship_name: userData.ship_name,
			ship_mobile: userData.ship_mobile,
			ship_address: userData.ship_address,
			ship_country: userData.ship_country,
			ship_state: userData.ship_state,
			ship_city: userData.ship_city,
			banner:$scope.bannerfiles,
			store_country:userData.store_country,
			store_state:userData.store_state,
			store_city:userData.store_city,
			
			store_phone:userData.store_phone,
			facebook_link:userData.facebook_link,
			google_plus_link:userData.google_plus_link,
			twitter_link:userData.twitter_link,
			linkedin_link:userData.linkedin_link,
			youtube_link:userData.youtube_link,
			instagram_link:userData.instagram_link,
			flickr_link:userData.flickr_link,
			
			
		}).success(function(data, status, headers, config) {console.log($scope.files);
                    $scope.files='';
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
	$scope.files='';
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
            $scope.loading = true;
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
            }).success( function(data, status, headers, config){ $scope.files=data;$scope.loading = false;});

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
				if($scope.files)
			$scope.content.image = $scope.files;
			//console.log($scope.content.image);
			$scope.files='';			
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
                    $scope.files='';
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
	$scope.files = '';
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
$scope.user=false;			
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
            $scope.loading = true;
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
            }).success( function(data, status, headers, config){ $scope.files=data;$scope.loading = false;});

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
				if($scope.files)
				$scope.brands.image = $scope.files;
			$scope.errors=false;
			$scope.files='';
			$scope.success_flash= data[1];
			
			}
			$scope.loading = false;
 
         });
      };
	  
	  $scope.store = function(userData) {console.log($scope.files); 
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('brand/store', {
			brand_name: userData.brand_name,
			description: userData.description,
			id: userData.id,
			status: userData.status,
			image: $scope.files

		}).success(function(data, status, headers, config) {
                    $scope.files='';
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
				$scope.user=false;
                                $scope.success_flash=data[1];
				$scope.brands.push(userData);
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };
      $scope.deleteBrand = function(index) {
		$scope.loading = true;

		var brand = $scope.brands[index];
              
                $http.post('brand/delete',{            
                    del_id:brand.id
                }).success(function(data, status, headers, config) {
                                        $scope.brands.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };
				
         $scope.init(); 



});

//Banners
app.controller('BannerController', function($scope, $http) {

    $scope.errors=false;
	$scope.files='';
     $scope.loading = true;
     $scope.banners=false;
	 $scope.banner=false;
	 $scope.user=false;
	 $scope.itemSelected = false;
     $scope.page='index';
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.loading = true;
		$http.get('banner/all').
		success(function(data, status, headers, config) {
			$scope.banners = data['banner'];
			
		        $scope.loading = false;
 
		});
	}
        $scope.add = function() {
$scope.banner=false;			
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('banner/all').
		success(function(data, status, headers, config) {
			$scope.all_banner = data['banner'];
			$scope.bannerType = data['banner_type'];
		        $scope.loading = false;
 
		});
	}
        $scope.editbanner = function(banner_data) {
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('banner/edit/' + banner_data.id, {			
		}).success(function(data, status, headers, config) {
			$scope.banner = data['banners'];
			$scope.banner_Type = data['banners']['position_id'];
			console.log($scope.banner_Type);
                        $scope.bannerType = data['banner_type'];
		        $scope.loading = false;
 
		});;
	};
	

    $scope.onCategoryChange = function (aa) {

        $scope.banner_Type = aa;

    };
	
	$scope.uploadedFile = function(element) {
           $scope.$apply(function($scope) {
            $scope.loading=true;
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
			fd.append("folder",'banner');
			fd.append("banner_type",$scope.banner_Type);
			fd.append("width",'150');
			fd.append("height",'150');
            $http.post('bannerImageUpload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ $scope.files=data;$scope.loading=false;});

    });
	}
        $scope.update = function(userData) { console.log(userData);
            $scope.errors=false;
            $scope.success_flash=false;
           $http.post('banner/update', {
			title: userData.title,
			banner_type: userData.position_id,
			url:userData.url,
			id:userData.id,
			status: userData.status,
			image: $scope.files
                   
		}).success(function(data, status, headers, config) {
                    console.log(data);
            if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				if($scope.files)
				$scope.banner.image = $scope.files;
			$scope.errors=false;
			$scope.files='';
			$scope.success_flash= data[1];
			
			}
			$scope.loading = false;
 
         });
      };
	  
	  $scope.store = function(userData) { 
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('banner/store', {
			title: userData.title,
			banner_type: userData.position_id,
			url:userData.url,
			
			status: userData.status,
			image: $scope.files

		}).success(function(data, status, headers, config) {
                    $scope.files='';
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
				$scope.banner=false;
				$scope.success_flash=data[1];

				$scope.init();
			}
			$scope.loading = false;
 
         });
      };
      $scope.deleteBanner = function(index) {
		$scope.loading = true;

		var banner = $scope.banners[index];
              
                $http.post('banner/delete',{            
                    del_id:banner.id
                }).success(function(data, status, headers, config) {
                                        $scope.banners.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };
				
         $scope.init(); 



});
//Seller management
app.controller('SellerController', function($scope, $http) {

    $scope.errors=false;
	$scope.files='';
     $scope.loading = true;
     $scope.sellers=false;
	 $scope.seller=false;
	 $scope.user_data = false;
     $scope.page='index';
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.loading = true;
		$http.get('seller/all').
		success(function(data, status, headers, config) {
			$scope.users = data;
		        $scope.loading = false;
 
		});
	}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('seller/all').
		success(function(data, status, headers, config) {
			$scope.all_seller = data;
		        $scope.loading = false;
 
		});
	}
        $scope.editseller = function(category) {
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('seller/edit/' + category.id, {			
		}).success(function(data, status, headers, config) {
			$scope.seller = data['user'];
			
                        $scope.all_seller = data['all_user'];
		        $scope.loading = false;
 
		});;
	};
	
	$scope.uploadedFile = function(element) {
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
            }).success( function(data, status, headers, config){ $scope.files=data;$scope.loading = false;});

    });
   }
        $scope.update = function(userData) { console.log($scope.user);
            $scope.errors=false;
            $scope.success_flash=false;
           $http.post('seller/update', {
			name: userData.name,
			email: userData.email,
			gender:userData.gender,
			address:userData.address,
			id: userData.id,
			status: userData.status,
			image: $scope.files,
			mobile:userData.mobile,
			company_name:userData.company_name,
			company_pan_no:userData.company_pan_no,
			company_address:userData.company_address,
			company_tin_no:userData.company_tin_no,
			store_link:userData.store_link,
                   
		}).success(function(data, status, headers, config) {
                    
            if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				if($scope.files)
				$scope.seller.image = $scope.files;
				//console.log($scope.user.image);
				$scope.files='';
			$scope.errors=false;
			$scope.success_flash= data[1];
			
			}
			$scope.loading = false;
 
         });
      };
	  
	  $scope.store = function(userData) { 
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('seller/store', {
			name: userData.name,
			email: userData.email,
			gender:userData.gender,
			address:userData.address,
			id: userData.id,
			status: userData.status,
			image: $scope.files,
			mobile:userData.mobile,
			company_name:userData.company_name,
			company_pan_no:userData.company_pan_no,
			company_address:userData.company_address,
			company_tin_no:userData.company_tin_no,
			store_link:userData.store_link,

		}).success(function(data, status, headers, config) {console.log($scope.files);
                    $scope.files='';
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
                                $scope.success_flash=data[1];
				$scope.sellers.push(userData);
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };
      $scope.deleteSeller = function(index) {
		$scope.loading = true;

		var seller = $scope.sellers[index];
              
                $http.post('seller/delete',{            
                    del_id:seller.id
                }).success(function(data, status, headers, config) {
                                        $scope.sellers.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };
				
         $scope.init(); 



});
//Country
app.controller('CountryController', function($scope, $http) {

    $scope.errors=false;
	$scope.files='';
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
		$http.get('country/all').
		success(function(data, status, headers, config) {
			$scope.contents = data;
		        $scope.loading = false;
 
		});
	}
	
	
        $scope.add = function() {
		$scope.country = false;				
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('country/all').
		success(function(data, status, headers, config) {console.log(data);
			$scope.all_country = data;
			
		        $scope.loading = false;
 
		});
	}
        $scope.editcontent = function(category) {
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('country/edit/' + category.id, {			
		}).success(function(data, status, headers, config) {
			$scope.country = data['content'];
                        $scope.all_country = data['all_content'];
		        $scope.loading = false;
 
		});;
	};
	
	
        $scope.update = function(contents) { console.log(contents);
            $scope.errors=false;
            $scope.success_flash=false;
           $http.post('country/update', {
			name: contents.name,
			country_id: contents.pid,
			id: contents.id,
                   
		}).success(function(data, status, headers, config) {
			
                    //console.log(contents);
            if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
			//console.log($scope.content.image);
			$scope.files='';			
			$scope.errors=false;
			$scope.success_flash= data[1];
			
			}
			$scope.loading = false;
 
         });
      };
	  
	  $scope.store = function(userData) { console.log(userData);
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('country/store', {
			name: userData.name,
			country_id: userData.id,
			

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
      $scope.deleteCity = function(index) {
		$scope.loading = true;

		//var user = $scope.contents[index];
              
                $http.post('country/delete',{            
                    del_id:index
                }).success(function(data, status, headers, config) {
                                        //$scope.contents.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };
				
			$scope.deleteCountry = function(index) {
		$scope.loading = true;

		var user = $scope.contents[index];
              
                $http.post('country/delete',{            
                    del_id:user.id
                }).success(function(data, status, headers, config) {
                                        $scope.contents.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
                };
				
         $scope.init(); 



});