var app = angular.module('admins', ['ngRoute','textAngular','angularUtils.directives.dirPagination'], function($interpolateProvider) {
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
   when('/newsletter', {
      templateUrl: 'newsletter', controller: 'NewsletterController'
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
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
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
 app.controller('EnquiryController', function($scope, $http) {
    
     $scope.errors=false;
     $scope.files=false;
     $scope.loading = true;
     $scope.enquirys=false;
     $scope.enquiry=false;
     $scope.page='index';
     $scope.faq=false;
     $scope.success_flash=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('enquiry/all').
		success(function(data, status, headers, config) {
			$scope.enquirys = data;
		        $scope.loading = false;
 
		});
	}
        $scope.replys = function(enquiry) {	
                $scope.page='reply';		
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.enquiry=enquiry;
                $http.get('enquiry/edit/' + enquiry.id, {			
		}).success(function(data, status, headers, config) {
			$scope.reply = data['reply'];                      
		        $scope.loading = false;
 
		});;
	}
       
        

        $scope.send = function(enquiry) { 
            $scope.errors=false;
            $scope.success_flash=false;
         
           $http.post('enquiry/update', {
			reply: enquiry.reply,
                        name: enquiry.name,
			subject:enquiry.subject,
                        email:enquiry.email,
                        reply_to:enquiry.id
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
    
      $scope.deleteenquiry = function(index) {
		$scope.loading = true;

		var enquiry = $scope.enquirys[index];
              
                $http.post('enquiry/delete',{            
                    del_id:enquiry.id
                }).success(function(data, status, headers, config) {
                                        $scope.enquirys.splice(index, 1);
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
       $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
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
 
		});
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
// Template Management
app.controller('TemplateController', function($scope, $http) {
     $scope.errors=false;
     $scope.loading = true;
     $scope.templates=false;
     $scope.template=false;
     $scope.temp=false;
     $scope.page='index';     
     $scope.success_flash=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('template/all').
		success(function(data, status, headers, config) {
			$scope.templates = data;
		        $scope.loading = false;
 
		});
	}
       $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.template=false;
	}
       $scope.edittemplate = function(template) {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('template/edit/' + template.id, {			
		}).success(function(data, status, headers, config) {
			$scope.template = data['data'];                      
		        $scope.loading = false;
 
		});;
	};
        
       $scope.store = function(template) { 
           $scope.errors_modal=false;
           $scope.success_flash_modal=false;   
         
           $http.post('template/store', {			
                        subject: template.subject,
                        message: template.message,                    
                       
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
      $scope.send_email=function(user_send,temp_id){          
           $http.post('template/sent', {			
                      user:user_send,                  
                      template_id:temp_id,   
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
      }
        $scope.sendtemplate = function(template){
            $scope.errors=false;
            $scope.success_flash=false;   
            $scope.page='send';
            $scope.temp=template;
        }
        $scope.update = function(template) { 
           $scope.errors=false;
           $scope.success_flash=false;         
           $http.post('template/update', {			
                      subject: template.subject,
                      message: template.content,  
                      template_id: template.id
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

      
      $scope.deletetemplate = function(index) {
		$scope.loading = true;
		var templates = $scope.templates[index];              
                $http.post('template/delete',{            
                    del_id:templates.id
                }).success(function(data, status, headers, config) {
                                        $scope.templates.splice(index, 1);
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
	$scope.promotion='';
	$scope.logo='';
	$scope.profileImage='';
     $scope.loading = true;
     $scope.users=false;
	 $scope.user={};
	 $scope.userq={};
	 $scope.user_data = false;
	 $scope.user_ddata = false;
	 $scope.banner=false;
     $scope.page='index';
     $scope.success_flash=false;
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;
                //$scope.success_flash=false;
		$scope.loading = true;
		$http.get('user/all').
		success(function(data, status, headers, config) {
			$scope.users = data['users'];
			$scope.country = data['country'];
			$scope.usersRecord = data['total'];
			$scope.roles = data['roles'];
			//console.log($scope.usersRecord);
		        $scope.loading = false;
 
		});
	}
	$scope.users_id = {};
        //id: null
    
	$scope.checkAll = function () {
		
		
        if (!$scope.selectedAll) {
            $scope.selectedAll = true;
        } else {
            $scope.selectedAll = false;
        }
		
        angular.forEach($scope.users, function (item) {
			//alert(item);			
           
			if($scope.selectedAll)
			{
			$scope.users_id[item.id]=true;
				
			}
			else
			{

				$scope.users_id[item.id]=false;
			}
        });
		
		 

    };
	
	/* $scope.optionToggled = function (ids) {
		
                console.log( $scope.users_id[ids] ); 
//                if($scope.users_id[ids]==true)
//                {
//                var use_id=$scope.getObjectKeyIndex($scope.users_id, ids);
//                $scope.users_id.splice(use_id, 1);
//               }
// Returns int(1) (or null if the key doesn't exist)


//     var idx = $scope.users_id.indexOf(employeeName);
// alert(idx);
//     // is currently selected
//     if (idx > -1) {
//       $scope.selection.splice(idx, 1);
//	   $scope.users_id.push({
//	   id:employeeName});
//     }
// 
//     // is newly selected
//     else {
//       $scope.selection.push(employeeName);
//	   $scope.users_id.splice(employeeName+1, 1);
//     }
//	 console.log($scope.selection);
//	 console.log($scope.users_id);
   };
   $scope.getObjectKeyIndex =function(obj, keyToFind) {
    var i = 0, key;

    for (key in obj) {
        if (key == keyToFind) {
            return i;
        }

        i++;
    }

    return null;
} */
   $scope.roleChange = function(roless){
		$scope.errors=false;
		$scope.success_flash=false;
		$scope.loading = true;
		console.log($scope.users_id);
	   $http.post('user/changeRole',{
			id:$scope.users_id,
			role:roless
		}).
		success(function(data, status, headers, config) {
			
			$scope.success_flash= data[1];
			//console.log($scope.usersRecord);
		        $scope.loading = false;
				$scope.init();
		});
   }
   //bulk delete
   $scope.bulkDelete = function(userData){
	   console.log(userData);
	   $scope.page='index';
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.loading = true;
		$http.post('user/deleteAll',{
			action:userData,
			id:$scope.users_id,
		}).
		success(function(data, status, headers, config) {
			$scope.success_flash= data[1];
			console.log($scope.success_flash);
		        $scope.loading = false;
				$scope.init();
		});
   }
	$scope.userlist = function(userData){
		$scope.page='index';
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.loading = true;
		$http.post('user/all',{
			role:userData.role_id
		}).
		success(function(data, status, headers, config) {
			$scope.users = data['users'];
			$scope.country = data['country'];
			$scope.usersRecord = data['total'];
			//console.log($scope.usersRecord);
		        $scope.loading = false;
		});
		
	}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('user/all').
		success(function(data, status, headers, config) {
			$scope.all_user = data['users'];
			$scope.country = data['country'];
			$scope.category = data['category'];
			//console.log($scope.all_user);
		        $scope.loading = false;
 
		});
	}
	$scope.inputs = [{
        value: null
    }];

    $scope.addInput = function () {
       
        $scope.inputs.push({
            value: ''
        });
    }

    $scope.removeInput = function (index) {
        $scope.inputs.splice(index, 1);
    }
	$scope.useradd = function() {	
	$scope.user={};
                $scope.page='useradd';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('user/all').
		success(function(data, status, headers, config) {
			$scope.all_user = data['category'];
			$scope.country = data['country'];
			$scope.roles = data['roles'];
			//console.log($scope.all_user);
		        $scope.loading = false;
 
		});
	}
	$scope.checkUser = function(userData){
	$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                
		$http.post('user/checkUser', {
				username:userData.username,
				email:userData.email,
				password:userData.password,
				confirm_password:userData.repassword,
				role:userData.role,
				ownpassword:userData.ownpassword
		}).success(function(data, status, headers, config) {//console.log(data['user']);
		
		if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
			//console.log($scope.user.image);
			$scope.errors=false;
			$scope.success_flash= data[1];
			$scope.user.username = userData.username;
			$scope.user.email = userData.email;
			$scope.user.role = userData.role;
			$scope.user.password = userData.password;
			$scope.user.notify = userData.notify;
			$scope.loading = false;
			//console.log($scope.user.username);			
			$scope.add();
			}
			
		});
	};
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
 console.log($scope.user_ddata);
 $scope.getState($scope.user_ddata.country,'user');
 $scope.getCity($scope.user_ddata.state,'user');
 $scope.getState($scope.user_ddata.store_country,'store');
 $scope.getCity($scope.user_ddata.store_state,'store');
 $scope.getState($scope.user_ddata.ship_country,'shipp');
 $scope.getCity($scope.user_ddata.ship_state,'shipp');
 $scope.category = data['category'];
 $scope.inputs = $scope.user_ddata.affiliate;
		});
	};
	
	$scope.getState = function(pid,type){
		//console.log(pid);
		$http.post('country/getState',{
			store_country:pid
		}).
		success(function(data, status, headers, config) {//console.log(data);
		var vari = type + 'state';
		console.log(type);
		if(type=='user')
		$scope.user_state = data;
		else if(type=='store')
		{
			$scope.store_state = data;
		}
		else if(type=='shipp')
		{
			$scope.shipps_state=data;
			//console.log(type);
		}
 //console.log($scope.vari);
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
		else if(type=='shipp')
		{
			$scope.shipps_city=data;
		}		
 
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
			$scope.user.logo=$scope.logo;
			$scope.user_ddata.logo=$scope.logo;
			$scope.loading = false;
			}
			});

    });
   }
   
   $scope.uploadedPromotionBannerFile = function(element) {
           $scope.$apply(function($scope) {
            $scope.loading = true;
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
			fd.append("folder",'promotion');
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
			$scope.promotion=data;
			$scope.user_ddata.promotional_banner=$scope.promotion;
			$scope.user.promotional_banner=$scope.promotion;
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
			$scope.user.banner=$scope.bannerfiles;
			$scope.user_ddata.banner=$scope.bannerfiles;
			//console.log($scope.user.banner);
			$scope.loading = false;
			}
			});

    });
   }
   $scope.getProfileImage=function(user_data)
   {
	   
	   $scope.errors=false;
            $scope.success_flash=false;
           $http.post('user/getProfileImage',

		   { email:user_data.email,
		   name:user_data.username
		   
		   }).success( function(data, status, headers, config)
		   {
			   //$scope.user.profile = data;
			   var dt=data.split("<img src='");
			   var dt1=dt[1].split("'");
			   console.log(dt1[0]);
			   $scope.profileImage = dt1[0]
			   $scope.user.profile = $scope.profileImage;
			   
			   
		   });
   }
   
   $scope.genratePassword = function(){
	   var length=6;
	   var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
    var pass = "";
	var charsa = /^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
		
					
    }
	$scope.formSubmit=true;
	console.log($scope.formSubmit);
	return pass;
	//console.log(pass);
					
   }
	   $scope.delBanner=function(bannerData)
	   {//console.log(bannerData);
		   $scope.user.banner=false;
		   $scope.user_ddata.banner=false;
		   
	   }
	   $scope.removelogo=function()
	   {
		   $scope.user.logo=false;
		   $scope.user_ddata.logo=false;
		   
	   }
	   $scope.removepromotional_banner=function()
	   {
		   
		   $scope.user_ddata.promotional_banner = false;
		   $scope.user.promotional_banner = false;
		   
	   }
        $scope.update = function(user_data) { //console.log($scope.bannerfiles);
            $scope.errors=false;
			$scope.loading=true;
            $scope.success_flash=false;
			getProfileImage(user_data);
           $http.post('user/update', {
			role:user_data.role,
			fname: user_data.fname,
			lname: user_data.lname,
			//display_name:user_data.display_name,
			username: user_data.username,
			//nickname: user_data.nickname,
			email: user_data.email,
			gender:user_data.gender,
			mobile: user_data.mobile,
			home_number: user_data.home_number,
			website: user_data.website,
			bio: user_data.bio,
			password: user_data.pass,
			//confirm_password:user_data.repassword,
			nationality: user_data.nationality,
			country: user_data.country,
			state:user_data.state,
			city:user_data.city,
			address:user_data.address,
			id: user_data.userid,
			status: user_data.status,
			profile_image: $scope.profileImage,
			store_name: user_data.store_name,
			store_link: user_data.store_link,
			store_address: user_data.store_address,
			ship_fname: user_data.ship_fname,
			ship_lname: user_data.ship_lname,
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
			shipp_id:user_data.shipp_id,
			affiliatefees:$scope.inputs,
			logo:$scope.logo,
			selling:user_data.selling,
			publishing:user_data.publishing,
			commission:user_data.commission,
			featured:user_data.featured,
			verified:user_data.verified,
			promotinoal_link:user_data.promotinoal_link,
			promotion:$scope.promotion,
			
                   
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
//store user  
	  $scope.store = function(userData) {console.log($scope.files) ;
           $scope.errors=false;
           $scope.success_flash=false;
		   
		  
		  console.log($scope.albumNameArray);
           $http.post('user/store', {
			role:userData.role,
			fname: userData.fname,
			lname: userData.lname,
			username: userData.username,
			//nickname: userData.nickname,
			//display_name: userData.display_name,
			email: userData.email,
			gender:userData.gender,
			mobile: userData.mobile,
			home_number: userData.home_number,
			website: userData.website,
			bio: userData.bio,
			profile_image: $scope.profileImage,
			password: $scope.user.password,
			//confirm_password:userData.repassword,
			nationality: userData.nationality,
			country: userData.country,
			address:userData.address,
			state:userData.state,
			city:userData.city,
			id: userData.id,
			notify:$scope.user.notify,
			status: userData.status,
			
			
			ship_fname: userData.ship_fname,
			ship_lname: userData.ship_lname,
			ship_mobile: userData.ship_mobile,
			ship_address: userData.ship_address,
			ship_country: userData.ship_country,
			ship_state: userData.ship_state,
			ship_city: userData.ship_city,
			banner:$scope.bannerfiles,
			store_name: userData.store_name,
			store_link: userData.store_link,
			logo:$scope.logo,
			store_address: userData.store_address,
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
			affiliatefees:$scope.inputs,
			selling:userData.selling,
			publishing:userData.publishing,
			commission:userData.commission,
			featured:userData.featured,
			verified:userData.verified,
			promotinoal_link:userData.promotinoal_link,
			promotion:$scope.promotion,
			
			
		}).success(function(data, status, headers, config) {//console.log($scope.files);
                    
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				$scope.files='';
				$scope.inputs=false;
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
				
		$scope.changeStatus=function(userData)
	   {
		   $scope.loading = true;
	   $http.post('user/changeStatus',{
		   id:userData.id,
		   status:userData.status
		   
	   }).success(function(data, status, headers, config) {
		   	
		                             
			$scope.loading = false
			$scope.success_flash=data[1];
			$scope.init();
			});
	   }
				
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
        $scope.update = function(contents) { //console.log(contents);
            $scope.errors=false;
            $scope.success_flash=false;
           $http.post('static-content/update', {
			title: contents.title,
			short_description: contents.short_description,
			description:contents.description,
			image: $scope.files,
			id: contents.id,
			meta_title:contents.meta_title,
			meta_description:contents.meta_description,
			meta_keyword:contents.meta_keyword,
                   
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
     $scope.brands={};
     $scope.brand={};
     $scope.page='index';
     $scope.success_flash=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;
                $scope.files = '';               
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
               
	}
        $scope.delbrandfiles=function(file) {
                $scope.files='';
        }
        $scope.editbrand = function(brand_data) {
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('brand/edit/' + brand_data.id, {			
		}).success(function(data, status, headers, config) {
			$scope.brand = data['brands'];
                        var im=$scope.brand.image;
                        var im1= im.split("brand/"); 
                        $scope.files=im1[1]; 
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
	    fd.append("width",'200');
	    fd.append("height",'80');
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){  if(data[0]=='error'){
				$scope.errors=data[1];
			}
			else
			{
                                $scope.errors=false;
                                $scope.files=data;                    
                                $scope.loading = false;
			}});

    });
	}
        $scope.update = function(brands) {
            $scope.errors=false;
            $scope.success_flash=false;
           $http.post('brand/update', {
			brand_name: brands.brand_name,
			description: brands.description,
			status:brands.status,
			image: $scope.files,id: brands.id,
                        meta_title: brands.meta_title,
                        meta_description: brands.meta_description,
                        meta_keyword: brands.meta_keyword
                   
		}).success(function(data, status, headers, config) {
                   
                        if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
							
                                $scope.errors=false;
                                $scope.files='';
                                $scope.success_flash= data[1];
                                $scope.init();
			
			}
			$scope.loading = false;
 
         });
      };
	  
	  $scope.store = function(brand) {
           $scope.errors=false;
           $scope.success_flash=false;
           $http.post('brand/store', {
			brand_name: brand.brand_name,
			description: brand.description,
			id: brand.id,
			status: brand.status,
			image: $scope.files,
                        meta_title: brand.meta_title,
                        meta_description: brand.meta_description,
                        meta_keyword: brand.meta_keyword


		}).success(function(data, status, headers, config) {
                    $scope.files='';
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
				$scope.user=false;
                                $scope.success_flash=data[1];
				$scope.brands.push(brand);
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
			country_id: userData.id
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

// Product Option Management
 app.controller('OptionController', function($scope, $http) {
     $scope.values = [{
        option_name: null
     }];
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.options=false;
     $scope.page='index';
     $scope.option={};
     $scope.values={};
     $scope.success_flash=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
     $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('option/all').
		success(function(data, status, headers, config) {
			$scope.options = data;
		        $scope.loading = false;
 
		});
	}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.option=false;
	}
        $scope.editoption = function(option) {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('option/edit/' + option.id, {			
		}).success(function(data, status, headers, config) {
			$scope.option = data['option'];
			$scope.values = data['values'];
			if($scope.values.length=='0')
			{
				$scope.addInput(); 
			}
		        $scope.loading = false;
 
		});;
	};
        

        $scope.update = function(option,values) { 
            $scope.errors=false;
            $scope.success_flash=false;
         
           $http.post('option/update', {
			option_name: option.option_name,			
                        status: option.status,
                        id:option.id,
			option_value:values
		}).success(function(data, status, headers, config) {
                 
                if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;
				$scope.option={};
                                $scope.values={};
			        $scope.success_flash=data[1];
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };

      $scope.store = function(option) { 
           $scope.errors=false;
           $scope.success_flash=false;   

           $http.post('option/store', {
			option_name: option.option_name,
                        status: option.status 
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
      $scope.deleteoption = function(index) {
		$scope.loading = true;

		var option = $scope.options[index];
              
                $http.post('option/delete',{            
                    del_id:option.id
                }).success(function(data, status, headers, config) {
                                        $scope.options.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
        };	
	
	$scope.addInput = function () {
	   
	    $scope.values.push({
		option_name: null
	    });
	}
    
	$scope.removeInput = function (index) {
	    $scope.values.splice(index, 1);
	}

         $scope.init();
});
 
 /*****Products*****/
  app.controller('ProductController', function($scope, $http) {
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.products=false;
     $scope.page='index';
     $scope.product={};
     $scope.pr_imgs = [];
     $scope.product.pro_category_id={};
     $scope.success_flash=false;
     $scope.tab = 1;
    $scope.showMeimg=true;

    $scope.setTab = function(newTab){
      $scope.tab = newTab;
    };

    $scope.isSet = function(tabNum){
      return $scope.tab === tabNum;
    };
    
    $scope.showMe = true;
    $scope.showMe1 = true;
    $scope.showMe3 = true;
    $scope.myFunc = function() {
        $scope.showMe = !$scope.showMe;
    }
    $scope.myFunc1 = function() {
        $scope.showMe1 = !$scope.showMe1;
    }
    $scope.myFunc3 = function() {
        $scope.showMe3 = !$scope.showMe3;
    }
    $scope.myFuncimg = function() {
        $scope.showMeimg = !$scope.showMeimg;
    }
    $scope.changeState=function(param){
       
    }

        $scope.init = function() {	
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('product/all').
		success(function(data, status, headers, config) {
			$scope.products = data['products'];
		        $scope.loading = false;
		});
	}
	$scope.GetSelectedOptions = function(optionid) { console.log($scope.optionvalues);
	$http.post('product/getoptionvalue',{
			parent_id: optionid
		}).
		success(function(data, status, headers, config) {
			$scope.optionvalues = data['optionvalues'];
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
			$scope.datatyps = data['datatyps'];
			$scope.options = data['options'];			
			$scope.all_category = data['all_category'];
			console.log($scope.all_category);
			console.log($scope.categories);


		        $scope.loading = false;
 
		});
	}
	// image upload
        $scope.uploadedFile = function(element) {
            $scope.$apply(function($scope) {
            $scope.loading = true;
            var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
	    fd.append("folder",'product');
	    fd.append("width",'500');
	    fd.append("height",'500');
            $http.post('imagemutipleupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){   
                  if(data[0]=='error'){
				$scope.errors=data[1];
		  }else{
                                $scope.errors=false;
                                $scope.pr_imgs.push({
                                img: data,def:0
                                });                  
                                $scope.loading = false;
		  }
               
   
                $scope.loading = false;
            });

    });
   }
   $scope.setdefault=function(index){
       angular.forEach($scope.pr_imgs, function (item,key) {
			$scope.pr_imgs[key]['def']=0;        
			
        });
        $scope.pr_imgs[index]['def']=1;
   }
   $scope.unsetdefault=function(index){
      
        $scope.pr_imgs[index]['def']=0;
   }
   $scope.removeimgs=function(index)
   {
      $scope.pr_imgs.splice(index,1);
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
			sale_price: product.sale_price,
			pro_opt_name_id: product.pro_opt_name_id,
			pro_opt_values_id: product.pro_opt_values_id,
			sku: product.sku,
			date_from: product.date_from,
			date_to: product.date_to,
			video: product.video,
			weight: product.weight,
			length: product.length,
			width: product.width,
			height: product.height,
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