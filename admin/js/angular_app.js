var app = angular.module('admins', ['ngRoute','textAngular','angularUtils.directives.dirPagination','jkuri.datepicker'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
      
});
 app.filter('capitalize', function() {
    return function(input) {
      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});
 app.directive('textarea', function() {
    return {
        restrict: 'E',
        link: function( scope , element , attributes ) {
            var threshold    = 35,
                minHeight    = element[0].offsetHeight,
                paddingLeft  = element.css('paddingLeft'),
                paddingRight = element.css('paddingRight');

            var $shadow = angular.element('<div></div>').css({
                position:   'absolute',
                top:        -10000,
                left:       -10000,
                width:      element[0].offsetWidth - parseInt(paddingLeft || 0) - parseInt(paddingRight || 0),
                fontSize:   element.css('fontSize'),
                fontFamily: element.css('fontFamily'),
                lineHeight: element.css('lineHeight'),
                resize:     'none'
            });

            angular.element( document.body ).append( $shadow );

            var update = function() {
                var times = function(string, number) {
                    for (var i = 0, r = ''; i < number; i++) {
                        r += string;
                    }
                    return r;
                }

                var val = element.val().replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/&/g, '&amp;')
                    .replace(/\n$/, '<br/>&nbsp;')
                    .replace(/\n/g, '<br/>')
                    .replace(/\s{2,}/g, function( space ) {
                        return times('&nbsp;', space.length - 1) + ' ';
                    });

                $shadow.html( val );

                element.css( 'height' , Math.max( $shadow[0].offsetHeight + threshold , minHeight ) );
            }

            scope.$on('$destroy', function() {
                $shadow.remove();
            });

            element.bind( 'keyup keydown keypress change' , update );
            update();
        }
    }
});
app.directive("passwordStrength", function(){
    return {        
        restrict: 'A',
        link: function(scope, element, attrs){                    
            scope.$watch(attrs.passwordStrength, function(value) {
                //console.log(value);
				
                if(angular.isDefined(value)&& value!=''){
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
   when('/plan', {
      templateUrl: 'plan', controller: 'PlanController'
   }).
   when('/permission', {
      templateUrl: 'permission', controller: 'PermissionController'
   }).
   when('/coupon', {
      templateUrl: 'coupon', controller: 'CouponController'
   }).
   when('/special-offer', {
      templateUrl: 'special-offer', controller: 'SpecialOfferController'
   }).
   when('/bulk-discount', {
      templateUrl: 'bulk-discount', controller: 'BulkDiscountController'
   }).
   otherwise({
      redirectTo: 'dashboard', controller: 'DashboardController'
   });
	
}]);
app.controller('parentCtrl',function($scope, $http){
    $scope.ptitle="";
   
    $scope.change_title=function(title){
        $scope.ptitle=title;  
     
     
    };
});

app.controller('HomeController', function($scope, $http) {
    
//alert($location.path());
	$scope.errors=false;
	$scope.loading = true;
        $scope.includes_function=false;
        $scope.$parent.ptitle='Dashboard';
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
			password: $scope.password
                   
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
    $scope.$parent.ptitle='Category Management';
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
	//$scope.screen_opt=[{"category_name":true},{"status":true}];
	$scope.setScreenOpt=function(opt,screen,kk){
		console.log(opt);
		//console.log(screen);
		//console.log(opt[1].category_name);
		//oldmovies='';
		angular.forEach(opt, function(value,key){ //For loop
			//console.log(value);
			//console.log(key);
          if(value.category_name==false)
	  {
		opt.splice(key,1);
	  }
		});
		console.log(opt);
	}
     $scope.init = function() {	
                $scope.page='index';
                $scope.files='';
                $scope.category={};
                $scope.errors=false;               
		$scope.loading = true;
		//$scope.condition = true;
		$http.get('category/all').
		success(function(data, status, headers, config) {
			$scope.categories = data['category'];
			$scope.all_category = data['all_category'];
			//console.log($scope.all_category);
		        $scope.loading = false;
 
		});
	}
	$scope.changeStatus=function(userData)
	   {
		
		   $scope.loading = true;
	   $http.post('category/changeStatus',{
		   id:userData.id,
		   status:userData.status
		   
	   }).success(function(data, status, headers, config) {
		   	                    
			$scope.loading = false
			$scope.success_flash=data[1];
			$scope.init();
			});
	   }
	   
	   $scope.edit_modal=function(edit_field,edit_values){
            $scope.errors=false;
            $scope.success_flash=false;
            $scope.errors_pop=false;          
            $scope.success_flash_pop=false;
            $scope.edit_field=edit_field ;
            $scope.edit_values=edit_values;
            console.log($scope.edit_values);
		}
        $scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $http.get('category/all').
		success(function(data, status, headers, config) {
			$scope.all_cat = data['category'];
			$scope.all_category = data['all_category'];
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
	
	$scope.Quickupdate = function(category) { 
            $scope.errors_pop=false;
            $scope.success_flash_pop=false;
         
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
			type:true
                   
		}).success(function(data, status, headers, config) {
                 $scope.files='';
                if(data[0]=='error'){
				$scope.errors_pop=data[1];
			}else{
				
				$scope.errors_pop=false;
			        $scope.success_flash_pop=data[1];
                                $scope.init();
			}
			$scope.loading = false;
 
         });
      };

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
     $scope.$parent.ptitle='Enquiry';
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
     $scope.$parent.ptitle='FAQ';
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
     $scope.$parent.ptitle='Template';
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
                        message: template.message                    
                       
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
     $scope.$parent.ptitle='Newsletter';
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
     $scope.$parent.ptitle='Configuration';
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
        $scope.$parent.ptitle='User Management';
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
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
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
	$scope.checkLink = function(userData)
	{
		$scope.linkloading = true;
		$scope.loading = true;
                $scope.error=false;
		$scope.succ_flash= false;
                $scope.success_flash=false;
                
		$http.post('user/checkLink', {
				store_link:userData.store_link,
				store_id:userData.store_id
		}).success(function(data, status, headers, config) {//console.log(data['user']);
		
		if(data[0]=='error'){
				$scope.error=data[1];
				$scope.loading = true;
				$scope.succ_flash= false;
			$scope.linkloading = false;
			}else{
				
			console.log(data);
			$scope.errors=false;
			$scope.loading = false;
			$scope.succ_flash= true;
			$scope.linkloading = false;
			console.log($scope.success_flash);			
			
			}
			
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
			
 console.log($scope.user_ddata);
 $scope.user_ddata.password='';
 $scope.getState($scope.user_ddata.country,'user');
 $scope.getCity($scope.user_ddata.state,'user');
 $scope.getState($scope.user_ddata.store_country,'store');
 $scope.getCity($scope.user_ddata.store_state,'store');
 $scope.getState($scope.user_ddata.ship_country,'shipp');
 $scope.getCity($scope.user_ddata.ship_state,'shipp');
 $scope.category = data['category'];
 $scope.inputs = $scope.user_ddata.affiliate;
 $scope.loading = false;
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
            }).success( function(data, status, headers, config){
		if(data[0]=='error'){
			$scope.errors=data[1];
		}
		else
		{
		$scope.files = data;
		$scope.image = $scope.files;
		$scope.loading = false;
		}
		});

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
		   
		   $scope.user_ddata.promotion_banner = false;
		   $scope.user.promotional_banner = false;
		   
	   }
        $scope.update = function(user_data) { //console.log(user_data);
            $scope.errors=false;
			$scope.loading=true;
            $scope.success_flash=false;
		//$scope.getProfileImage(user_data);
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
			password: user_data.password,
			confirm_password:user_data.repassword,
			nationality: user_data.nationality,
			country: user_data.country,
			state:user_data.state,
			city:user_data.city,
			address:user_data.address,
			id: user_data.userid,
			status: user_data.status,
			profile_image: $scope.files,
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
    
    $scope.$parent.ptitle='Static Content Management';
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
    
     $scope.$parent.ptitle='Brand Management';
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
    
    $scope.$parent.ptitle='Banner Management';
    $scope.errors=false;
	$scope.files='';
     $scope.loading = true;
     $scope.banners=false;
	 $scope.banner=false;
	 $scope.user=false;
	 $scope.itemSelected = false;
     $scope.page='index';
     $scope.success_flash=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
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
    $scope.$parent.ptitle='Seller Management';
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

    $scope.$parent.ptitle='Country';
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
     $scope.show_save=1;
     $scope.$parent.ptitle='Attribute Management';
     $scope.all_cats={};
     $scope.errors=false;
     $scope.errors_pop=false;
     $scope.cat_select=false;
     $scope.cat_select_error=false;
     $scope.files='';
     $scope.loading = true;
     $scope.options={};
     $scope.page='index';
     $scope.selectedAll=false;
     $scope.selected_attr=[];
     $scope.option={};  
     $scope.edit_field=''; 
     $scope.edit_values={};
     $scope.shw_sv_attr=1;
     $scope.shw_sv_value=1;
     $scope.opt_grp=[{ opt_id : null }];
     $scope.values={};
     $scope.success_flash=false;
     $scope.success_flash_pop=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
     $scope.init = function() {	
               $scope.page='index';
               $scope.errors=false; 
               $scope.errors_pop=false;              
               $scope.success_flash_pop=false;
               $scope.edit_values={};
               $scope.cat_select_error='';
               $scope.cat_select=false;
               $scope.shw_sv_attr=1;
               $scope.shw_sv_value=1;
               $scope.show_save=1;
	       $scope.loading = true;
	       $http.get('option/all').
	       success(function(data, status, headers, config) {
			$scope.options = data['attr_gr'];
                        $scope.all_cats = data['category'];
                        $scope.only_cat_id = data['only_cat_id'];
		        $scope.loading = false;
 
		});
	}
        $scope.del_attr_gr=function(var_sel){
              $scope.errors=false;
              $http.post('option/delete', {
			del_ids: var_sel,
		}).
	       success(function(data, status, headers, config) {                         
			  $scope.success_flash=data[1];		        
                          $scope.init();                              
		});
        }
        $scope.checkAll = function () {	
            if (!$scope.selectedAll) {
                $scope.selectedAll = true;
            } else {
                $scope.selectedAll = false;
            }	
            angular.forEach($scope.options, function (item) {  

                            if($scope.selectedAll)
                            {
                            $scope.selected_attr[item.id]=true;
                            }else
                            {
                             $scope.selected_attr[item.id]=false;
                            }

            });
	
      };
        $scope.edit_modal=function(edit_field,edit_values){
            $scope.errors=false;
            $scope.success_flash=false;
            $scope.errors_pop=false;          
            $scope.success_flash_pop=false;
            $scope.edit_field=edit_field ;
            $scope.arr_cats=[];    
            $scope.cat_select=false;console.log( $scope.cat_select);
            $scope.edit_values=edit_values;   
            $scope.edit_values.cats_id=[];
            var arrs_ca=$scope.edit_values.categorys_id.split(',');
            for(var i=0;i < arrs_ca.length; i++)
            {
                $scope.arr_cats.push(parseInt(arrs_ca[i]));
                $scope.edit_values.cats_id[parseInt(arrs_ca[i])]=true;
            }           
           
        }
        $scope.sel_al=function(sel_un){
             angular.forEach($scope.only_cat_id, function (item,key) { 
                 if(sel_un=="select")
                 {
                     $scope.edit_values.cats_id[item.id]=true;
                 }else{
                     
                     $scope.edit_values.cats_id[item.id]=false;
                 }
             });
        }
        $scope.chec_array=function(){ 
           return $scope.edit_values.categorys_id.split(',');

            $scope.edit_values=edit_values;
            

        }
        $scope.add = function() {
                $scope.loading = true; 
                $scope.page='add';
                $scope.errors=false; 
                $scope.errors_pop=false;
                $scope.success_flash=false;
                $scope.success_flash_pop=false;
                $scope.shw_sv_attr=1;
                $scope.shw_sv_value=1;
                $scope.show_save=1;
                $scope.option=false;
                $http.get('option/add').
		success(function(data, status, headers, config) {
			$scope.all_cats=data;  //categories
		        $scope.loading = false;
 
		});
	} ;
        //add
        $scope.duplicate_check_atr_name = function(ot_ky,ky)
        {                
             if($scope.opt_grp[ot_ky].attribute[ky].atr_name!=''){
             $scope.shw_sv_attr=1;
              var value= $scope.opt_grp[ot_ky].attribute[ky].atr_name.toLowerCase();
              $scope.opt_grp[ot_ky].attribute[ky].error='';
                 angular.forEach($scope.opt_grp[ot_ky].attribute, function (item,key) {                     
                    if((ky != key) && (item.atr_name)){
                        if( item.atr_name.toLowerCase() == value)
                        {                           
                           $scope.opt_grp[ot_ky].attribute[ky].error="Duplicate Value is not allowed.";
                           $scope.show_save=0;
                           $scope.shw_sv_attr=0;
                        }
                        else{
                           $scope.shw_sv_attr=1;
                        }
                    }
                    if((item.error) && (item.error != ''))
                    {
                        $scope.shw_sv_attr=0;
                    }
                    
                 });
             
                 if(($scope.shw_sv_value==1) && ($scope.shw_sv_attr==1)){
                     $scope.show_save=1;
                 }
               }               
        }
        //edit
        $scope.duplicate_check_atr_name_edit = function(ky)
        {                
             if(($scope.edit_values.attribute[ky].option_name) && ($scope.edit_values.attribute[ky].option_name!='')){
             $scope.shw_sv_attr=1;  
             $scope.success_flash_pop=false;
             $scope.errors_pop=false;
              var value= $scope.edit_values.attribute[ky].option_name.toLowerCase();
               $scope.edit_values.attribute[ky].error='';
                 angular.forEach($scope.edit_values.attribute, function (item,key) {                     
                    if((ky != key) && (item.option_name)){
                        if( item.option_name.toLowerCase() == value)
                        {                           
                           $scope.edit_values.attribute[ky].error="Duplicate Value is not allowed.";
                           $scope.show_save=0;
                           $scope.shw_sv_attr=0;
                        }
                        else{
                           $scope.shw_sv_attr=1;
                        }
                    }
                    if((item.error) && (item.error != ''))
                    {
                        $scope.shw_sv_attr=0;
                    }
                    
                 });
             
                 if(($scope.shw_sv_value==1) && ($scope.shw_sv_attr==1)){
                     $scope.show_save=1;
                 }
               }               
        }
        //add
         $scope.duplicate_check_atr_value = function(ot_ky,ky,ke)
        {   
             if($scope.opt_grp[ot_ky].attribute[ky].atr_val[ke].val_name != ''){
             $scope.shw_sv_value=1;            
              var value= $scope.opt_grp[ot_ky].attribute[ky].atr_val[ke].val_name.toLowerCase();
              $scope.opt_grp[ot_ky].attribute[ky].atr_val[ke].error='';
                 angular.forEach($scope.opt_grp[ot_ky].attribute[ky].atr_val, function (item,key) {  
                    if((ke != key) && (item.val_name)){
                        if( item.val_name.toLowerCase() == value)
                        {                           
                          $scope.opt_grp[ot_ky].attribute[ky].atr_val[ke].error="Duplicate Value is not allowed.";
                          $scope.show_save=0;
                          $scope.shw_sv_value=0;
                        }
                         else{
                           $scope.shw_sv_value=1;
                        }
                    }
                      if((item.error) && (item.error != ''))
                    {
                        $scope.shw_sv_value=0;
                    }
                 });
             
                 if(($scope.shw_sv_value==1) && ($scope.shw_sv_attr==1)){
                     $scope.show_save=1;
                 }
               }
                 
        }
        //edit
         $scope.duplicate_check_atr_value_edit = function(ky,ke)
        {   
             if(($scope.edit_values.attribute[ky].options[ke].option_name) && ($scope.edit_values.attribute[ky].options[ke].option_name != '')){
              $scope.shw_sv_value=1;
             $scope.success_flash_pop=false;
             $scope.errors_pop=false;
              var value= $scope.edit_values.attribute[ky].options[ke].option_name.toLowerCase();
              $scope.edit_values.attribute[ky].options[ke].error='';
                 angular.forEach($scope.edit_values.attribute[ky].options, function (item,key) {  
                    if((ke != key) && (item.option_name)){
                        if( item.option_name.toLowerCase() == value)
                        {                           
                          $scope.edit_values.attribute[ky].options[ke].error="Duplicate Value is not allowed.";
                          $scope.show_save=0;
                          $scope.shw_sv_value=0;
                        }
                         else{
                           $scope.shw_sv_value=1;
                        }
                    }
                      if((item.error) && (item.error != ''))
                    {
                        $scope.shw_sv_value=0;
                    }
                 });
             
                 if(($scope.shw_sv_value==1) && ($scope.shw_sv_attr==1)){
                     $scope.show_save=1;
                 }
               }
                 
        }
         $scope.remove_show_save = function(){
                    $scope.show_save=0;
         }
        $scope.save_attr = function(all_values){
            
              $http.post('option/attribues', {
			values: all_values,
		}).success(function(data, status, headers, config) {
                 
                if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				
				$scope.errors=false;				
			        $scope.success_flash=data[1];
                                all_values={};
                                $scope.init();
			}
			$scope.loading = false;
 
         });
                
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
        

        $scope.update = function(update_values, fd) {  
           $scope.loading = true;
           $scope.errors=false;
           $scope.errors_pop=false;
           $scope.success_flash=false;  
           $scope.success_flash_pop=false;
           var check_cats;
           check_cats=0;
           if((update_values.cats_id) && (update_values.cats_id.length>0)){
              
                update_values.categorys_id='';
                angular.forEach(update_values.cats_id, function (item,key) { 
               if(item)
               {
                   if(check_cats != 0){
                      
                      update_values.categorys_id += ","; 
                   }
                   check_cats=1;
                   update_values.categorys_id += key;
               }
               });
           }
           if(fd=='status' || check_cats==1){
                $scope.cat_select_error=false;
                $http.post('option/update', {
                             update_values: update_values,       
                     }).success(function(data, status, headers, config) {

                             if(data[0]=='error'){
                                     $scope.errors_pop=data[1];
                             }else{
                                     $scope.success_flash_pop=data[1];
                             }
                             $scope.loading = false;

              });
          }else{
               $scope.cat_select_error="Please select atleast one category";
          }
      };

      $scope.store = function(option) { 
           $scope.errors=false;
           $scope.success_flash=false;
           var check_cats=0;
           angular.forEach(option.category_id, function (item,key) { 
               if(item)
               {
                   check_cats=1;
               }
           });
           if(check_cats==1){
           $scope.cat_select_error=false;
           $http.post('option/store', {
			option_name: option.option_name,
                        status: option.status,
                        category:option.category_id
		} ).success(function(data, status, headers, config) {
                  
                    if(data[0]=='error'){
				$scope.errors=data[1];
			}else{
				$scope.errors=false; 
                                $scope.option={};
                                option.option_name='';				
                                $scope.opt_grp.push({
                                    opt_id : data[1].id,
                                    opt_name:data[1].option_name
                                });
				$scope.push_attr($scope.opt_grp.length-1);
			}
			$scope.loading = false;
 
         });
        }else{
            $scope.cat_select_error="Please select atleast one category";
        }
      };
      //add 
      $scope.push_attr = function(index)
      {
          if(!$scope.opt_grp[index].attribute){
          $scope.opt_grp[index].attribute=[{
                  atr_name:null,
                  atr_type:"select", 
                  atr_val:[{val_name:null}],
          }];
         }else{
            $scope.opt_grp[index].attribute.push({
                                    atr_name:null,
                                    atr_type:"select", 
                                    atr_val:[{val_name:null}],
              });
         }
      }
      //edit
      $scope.push_attr_edit = function()
      {
         
            $scope.edit_values.attribute.push({
                                    option_name:null,
                                    type:"select", 
                                    options:[{option_name:null}],
              });
       
      }
      //add
       $scope.pop_attr = function(ot_ky,ky)
      {
          $scope.opt_grp[ot_ky].attribute.splice(ky,1);
          
      }
      //edit
      $scope.pop_attr_edit = function(ky)
      {
         
            $scope.edit_values.attribute.splice(ky,1);
       
      }
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
	//add
	$scope.addInput = function (ot_ky,ky) {	   

             $scope.opt_grp[ot_ky].attribute[ky].atr_val.push({                                   
                                  val_name:null
              });
	}
       //add
	$scope.removeInput = function (ot_ky,ky,index) {
	  
          $scope.opt_grp[ot_ky].attribute[ky].atr_val.splice(index, 1);
	}
        //edit
	$scope.addInput_edit = function (ky) {	   

              $scope.edit_values.attribute[ky].options.push({                                   
                                  option_name:null
              });
	}
       //edit
	$scope.removeInput_edit = function (ky,index) {
	  
          $scope.edit_values.attribute[ky].options.splice(index, 1);
	}
         $scope.init();
});
 
 /*****Products*****/
  app.controller('ProductController', function($scope, $http, filterFilter) {
      
     $scope.$parent.ptitle='Product Management'; 
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.products=false;
     $scope.page='index';
     $scope.product={};  
     $scope.pr_imgs = [];
     $scope.pro_opt_values_id = [];
     $scope.optval = [];
     $scope.optval_radio = [];
     $scope.tags = [];
     $scope.variations = [];    
     $scope.product.pro_category_id={};
     $scope.up_sell=[];
     //$scope.product.pro_opt_values_id=[];
     $scope.success_flash=false;
     $scope.tab = 1;
     $scope.options=[];
     $scope.showMeimg=true;     
      $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
    $scope.setTab = function(newTab){
      $scope.tab = newTab;
    };
   $scope.main_option=[];
    $scope.isSet = function(tabNum){
      return $scope.tab === tabNum;
    };
    
    $scope.showMe = true;
    $scope.showMe1 = true;
    $scope.showMe3 = true;
    $scope.showMe4 = false;
    $scope.showMe5 = false;
    $scope.myFunc = function() {
        $scope.showMe = !$scope.showMe;
    }
    $scope.myFunc1 = function() {
        $scope.showMe1 = !$scope.showMe1;
    }
    $scope.myFunc3 = function() {
        $scope.showMe3 = !$scope.showMe3;
    }
    $scope.myFunc4 = function() {
        $scope.showMe4 = !$scope.showMe4;
    }
    $scope.myFunc5 = function() {
        $scope.showMe5 = !$scope.showMe5;
    }
    $scope.myFuncimg = function() {
        $scope.showMeimg = !$scope.showMeimg;
    }
  
    $scope.changeState=function(param){
       
    }

   $scope.group_pros = [
       {"status": 'All', "items": ""},
       {"status": 'Active', "items": ""},
       {"status": 'Inactive', "items": ""},
       {"status": 'Pending', "items": ""}
  ];
$scope.product_id = {};
$scope.checkAll = function () {
		
		
        if (!$scope.selectedAll) {
            $scope.selectedAll = true;
        } else {
            $scope.selectedAll = false;
        }
		
        angular.forEach($scope.products, function (item) {
			//alert(item);			
           
			if($scope.selectedAll)
			{
			$scope.product_id[item.id]=true;
				
			}
			else
			{

				$scope.product_id[item.id]=false;
			}
        });
		
		 

    };
       //bulk delete
   $scope.bulkAction = function(userData){
	   console.log(userData);
	   $scope.page='index';
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.loading = true;
		if(userData=='delete')
		{
		$http.post('product/deleteAll',{
			action:userData,
			id:$scope.product_id
		}).
		success(function(data, status, headers, config) {
			$scope.success_flash= data[1];
			console.log($scope.success_flash);
		        $scope.loading = false;
				$scope.init();
		});
		}
   }
   
   $scope.edit_modal=function(edit_field,edit_values){
            $scope.errors=false;
            $scope.success_flash=false;
            $scope.errors_pop=false;          
            $scope.success_flash_pop=false;
            $scope.edit_field=edit_field ;
            $scope.edit_values=edit_values;
            console.log($scope.edit_values);
		}
	$scope.editDes=function(product)
	{
	$scope.errors_pop=false;
           $scope.success_flash_pop=false;
           console.log(product);
           $http.post('product/updateDes', {
			
			description: product.pro_des,
			short_description: product.pro_short_des,
			feature_description: product.pro_feature_des,
			sku:product.sku,
			price:product.price,
			expiry_date:product.date_to,
			meta_title:product.meta_title,
			meta_description:product.meta_description,
			meta_keywords:product.meta_keywords,
			id:product.id
		} ).success(function(data, status, headers, config) {
                  
                    if(data[0]=='error'){
				$scope.errors_pop=data[1];
			}else{
				$scope.errors_pop=false;
				$scope.success_flash_pop=data[1];				
				$scope.init();
			}
			$scope.loading = false;
 
         });	
	}
  $scope.select_group_pros='All';

        $scope.init = function() {
                $scope.main_option=[];
                $scope.optval = [];
                $scope.optval_radio = [];
                $scope.options=[];
                $scope.tags = [];
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('product/all').
		success(function(data, status, headers, config) {
			$scope.products = data['products'];
                        $scope.group_all_pros = data['products'];
		        $scope.loading = false;                
                        angular.forEach($scope.group_pros, function (item,key) {                            
                                 if( $scope.group_pros[key].status=="All"){
                                     var st='';
                                      $scope.group_pros[key].items = $scope.group_all_pros;
                                 }else{
                                      var st=$scope.group_pros[key].status;
                                       $scope.group_pros[key].items = filterFilter($scope.group_all_pros, {status:st},true);
                                 }
                               
                                  if(key==$scope.select_group_pros)
                                  {
                                        $scope.products =  $scope.group_pros[key].items; 
                                 }
                           
                        });
                       
		});
	}
        $scope.set_group_pros = function(val){
            $scope.select_group_pros=val;
            angular.forEach($scope.group_pros, function (item,key) {                            
                                 if( $scope.group_pros[key].status=="All"){
                                     var st='';
                                      $scope.group_pros[key].items = filterFilter($scope.group_all_pros, {status:st});
                                 }else{
                                      var st=$scope.group_pros[key].status;
                                       $scope.group_pros[key].items = filterFilter($scope.group_all_pros, {status:st},true);
                                 }
                               
                                  if($scope.group_pros[key].status==$scope.select_group_pros)
                                  {
                                        $scope.products =  $scope.group_pros[key].items; 
                                 }
                           
                        });
        }
	$scope.GetSelectedOptions = function(optionid) { 
	
	$http.post('product/getoptionvalue',{
			parent_id: optionid
		}).
		success(function(data, status, headers, config) {
			$scope.optionvalues = data['optionvalues'];
		        $scope.loading = false;
		});
	}
        $scope.getProduct = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getProduct',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.err=true;
				$scope.msg = data[1];
				$scope.upsell_pro = '';
				
			}
			else
			{
                                $scope.loading = false
                                $scope.upsell_pro = data;
                                $scope.err=false;
				$scope.msg = '';
			     
			}
			});
	}
        
        $scope.upselItem = function(pro){
           
           $scope.up_sell.push(pro);
            
            
        }
	$scope.addData = function (optionid) { 
           if(optionid!=''){
	    $http.post('product/getoptionvalue',{
			parent_id: optionid
		}).
		success(function(data, status, headers, config) { 
                   if(data['optionname']['type']=="select"){
			$scope.optval.push({
		         optid:optionid,
	                 all :data['optionvalues'],
			 parent_name: data['optionname']
		        });
		        
                    }else if(data['optionname']['type']=='radio'){
                        $scope.optval_radio.push({
		         optid:optionid,
	                 all :data['optionvalues'],
			 parent_name: data['optionname']
		        });
                    }
                    $scope.loading = false;
		});
	   }
	}
       
	$scope.attribute_gr_add=function(pro_category_id)
        {
             
            $http.post('product/get_attr_gr',{
			pro_category_id: pro_category_id
		}).
		success(function(data, status, headers, config) {
                
                       $scope.idarr=data['arr_id_attr'];
                      
			$scope.options=data['attrr'];
                        
                    
		});
                
        }
	$scope.addTags=function(ptag){ //console.log(ptag);
        if(ptag != ''){
		$scope.tags.push({
		tag : ptag
		});
	}		
	}
	$scope.removeTags=function(index)
	{
	   $scope.tags.splice(index,1);
	}
	
	$scope.addVariation=function(vari_status,opt_val_idss,current_val){
		$http.post('product/getvariation',{
			vari_status: vari_status,
			option_ids: opt_val_idss,
			current_val: current_val
		}).success(function(data, status, headers, config) {
				$scope.variations.push({
					variations : data['variations']
					});
				$scope.loading = false;
			});
				
	}
	 
	$scope.removeVariation=function(index,vari_sku,vari_price,vari_sale_price,vari_stock)
	{
        
	   $scope.variations.splice(index,1);
           delete vari_sku[index];
           delete vari_price[index];
           delete vari_sale_price[index];
           delete vari_stock[index];

	}
	
	$scope.getMainCat=function(vari_status,opt_idss){ 
                var mai_opt=  $scope.main_option;
            
		$http.post('product/getMainCat',{
			vari_status: vari_status,
			option_ids: opt_idss
		}).success(function(data, status, headers, config) { //console.log(data); 
				$scope.main_option = data['main_option'];
                               
                                if((mai_opt.length == 2) && ($scope.main_option.length != 2))
                                {
                                    alert("Please select only 2 variation for bulk variation.");
                                }
                                
			});
		
	}
	
    $scope.check_exist=function(optid){
	var exist_val=0;
	angular.forEach($scope.optval, function (item,key) {
			if(item.optid==optid)  {
				exist_val=1;
			}
			
        });
        angular.forEach($scope.optval_radio, function (item,key) {
                      
			if(item.optid==optid)  {
				exist_val=1;
			}
			
        });
	if(exist_val==1){
		return false;
	}else{
		return true;
	}
	
    }
    $scope.removeData=function(index)
	{
	   $scope.optval.splice(index,1);console.log($scope.product);
	  // $scope.product.pro_opt_values_id.splice(pr_op,1);
	}
    $scope.removeRadio=function(index){
        $scope.optval_radio.splice(index,1);
    }	
	
	$scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
		//angular.element('.hasDatepicker').find('input').addClass('form-control');
                $scope.success_flash=false;
                $scope.product=false;
		$http.get('product/all').
		success(function(data, status, headers, config) {
			$scope.sellers = data['sellers'];
			$scope.categories = data['categories'];
			$scope.brands = data['brands'];
			$scope.datatyps = data['datatyps'];

			//$scope.options = data['options'];
			$scope.product={};
			$scope.optval = [];
			$scope.pr_imgs = [];
			$scope.product.pro_tags = '';
			$scope.all_category = data['all_category'];


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
	$scope.removeimgs=function(img_nam,index)  //console.log(img_nam);
	{  $scope.errors=false;
           $scope.success_flash=false; 
	$http.post('product/image_delete',{
		image: img_nam
		}).success( function(data, status, headers, config){
	          $scope.pr_imgs.splice(index,1);
	});   
	   
	}
     
	   
	 
	 $scope.store = function(product,images,tags) {
		
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
			pro_datatype_id: product.pro_datatype_id,
			//pro_opt_name_id: product.pro_opt_name_id,
			pro_opt_values_id: product.pro_opt_values_id,
			variation_status: product.variation_status,
			sku: product.sku,
			date_from: product.date_from,
			date_to: product.date_to,
			video: product.video,
			weight: product.weight,
			length: product.length,
			width: product.width,
			height: product.height,
			warranty: product.warranty,
			return_policy: product.return_policy,
			meta_title: product.meta_title,
			meta_description: product.meta_description,
			meta_keywords: product.meta_keywords,
                        stock_status: product.stock_status,
			status: product.status,
                        review: product.review,
                        bulk_view: product.bulk_view,
                        col_bulk: product.col_bulk,
                        row_bulk: product.row_bulk,
                        feature: product.feature,
			images: images,
			tags : tags,
			vari_name: product.vari_name,
			vari_sku: product.vari_sku,
			vari_price: product.vari_price,
			vari_sale_price: product.vari_sale_price,
			vari_stock: product.vari_stock
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
		}).success(function(data, status, headers, config) { //console.log(data);
			$scope.product = data['product']; 
			$scope.sellers = data['sellers'];
			$scope.categories = data['categories'];
			$scope.brands = data['brands'];
			$scope.datatyps = data['datatyps'];
			$scope.options = data['options'];
			$scope.all_category = data['all_category'];
			$scope.pr_imgs = data['product_img'];
			$scope.tags = data['product_tag'];
			$scope.product.pro_tags = '';
			$scope.optval = data['all'];
			//$scope.all = data['all'];console.log($scope.optval); console.log($scope.all);
		        $scope.loading = false;
		});
	};

        $scope.update = function(product,images,tags) { 
            $scope.errors=false;
            $scope.success_flash=false; console.log(product); console.log(images);
           $http.post('product/update', { 
			id: product.id,
			pro_name: product.pro_name,
			pro_des: product.pro_des,
			pro_short_des: product.pro_short_des,
			pro_feature_des: product.pro_feature_des,
			seller_id: product.seller_id,
			//pro_category_id: product.pro_category_id,
			brand_id: product.brand_id,
			product_tags: product.product_tags,
			price: product.price,
			sale_price: product.sale_price,
			no_stock: product.no_stock,
			pro_datatype_id: product.pro_datatype_id,
			pro_opt_values_id: product.pro_opt_values_id,
			sku: product.sku,
			date_from: product.date_from,
			date_to: product.date_to,
			video: product.video,
			weight: product.weight,
			length: product.length,
			width: product.width,
			height: product.height,
			warranty: product.warranty,
			return_policy: product.return_policy,
			meta_title: product.meta_title,
			meta_description: product.meta_description,
			meta_keywords: product.meta_keywords,
                        status: product.status,
			images: images,
			tags: tags
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
  
//Subscription Plan
  app.controller('PlanController', function($scope, $http) {
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.page='index';
     $scope.plans=false;
     $scope.plan='';
     $scope.plan.plan_image='';
     $scope.success_flash=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
     $scope.init = function() {
	$scope.image = '';
		$scope.plan.plan_image = '';
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('plan/all').
		success(function(data, status, headers, config) {
			$scope.plans = data;
			console.log($scope.plans);
		        $scope.loading = false;
		});
	};
	
	$scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.product=false;
		$http.get('plan/all').
		success(function(data, status, headers, config) {
			$scope.loading = false;
 
		});
	};
	$scope.uploadedFile = function(element) {
		$scope.loading = true;
           $scope.$apply(function($scope) {
            
           var fd = new FormData();
            //Take the first selected file
            fd.append("image",element.files[0]);
            fd.append("folder",'plan');
	    fd.append("width",'310');
	    fd.append("height",'210');
            $http.post('imageupload', fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).success( function(data, status, headers, config){ 
                        if(data[0]=='error'){
				$scope.errors=data[1];
				$scope.loading = true;
			}
			else
			{
                                $scope.errors=false;
                                $scope.files=data;
				console.log($scope.files);
				$scope.image = $scope.files;
				$scope.plan.plan_image = $scope.files;
				console.log($scope.plan.plan_image);
                                $scope.loading = false;
			}
        });

    });
   }
	$scope.store = function(product) { 
           $scope.errors=false;
           $scope.success_flash=false;   
           console.log(product);
           $http.post('plan/store', {
			plan_name:product.plan_name,
			plan_duration:product.plan_duration,
			plan_price:product.plan_price,
			description:product.description,
			image:$scope.files,
			status:product.status
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
      
      $scope.editplan = function(plan) {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('plan/edit/' + plan.id, {			
		}).success(function(data, status, headers, config) {
			$scope.plan = data['plan'];
			$scope.loading = false;
		});
	};
	
	$scope.update=function(plan)
	{
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.page='edit';
		$http.post('plan/update',{
			plan_id:plan.id,
			plan_name:plan.plan_name,
			plan_duration:plan.plan_duration,
			plan_price:plan.plan_price,
			description:plan.description,
			image:$scope.files,
			plan_status:plan.plan_status
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
	$scope.delfiles = function()
	{
		$scope.plan.plan_image='';
	}
     $scope.init();
  });
//Role Permission
  app.controller('PermissionController', function($scope, $http) {
      
     $scope.$parent.ptitle='Permission Management'; 
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.page='index';
     $scope.setting={};
     $scope.plan='';
     $scope.plan.plan_image='';
     $scope.success_flash=false;
     $scope.tab = 1;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
	$scope.setTab = function(newTab){
	$scope.tab = newTab;
	};

	$scope.isSet = function(tabNum){
	  return $scope.tab === tabNum;
	};
     $scope.init = function() {
	$scope.image = '';
		$scope.plan.plan_image = '';
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('permission/all').
		success(function(data, status, headers, config) {
			$scope.roles = data['roles'];
			$scope.setting = data['setting'];
			//console.log($scope.plans);
		        $scope.loading = false;
		});
	};
	
	
	$scope.store = function(product) { 
           $scope.errors=false;
           $scope.success_flash=false;   
           console.log(product);
           $http.post('permission/store', {
			site_login_setting:product.site_login_setting,
			admin_login_setting:product.admin_login_setting,
			create_setting:product.create_setting,
			edit_own_setting:product.edit_own_setting,
			//edit_state_setting:product.edit_state_setting,
			edit_setting:product.edit_setting,
			delete_setting:product.delete_setting
			
			
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
      
      $scope.editplan = function(plan) {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('plan/edit/' + plan.id, {			
		}).success(function(data, status, headers, config) {
			$scope.plan = data['plan'];
			$scope.loading = false;
		});
	};
	
	$scope.update=function(plan)
	{
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.page='edit';
		$http.post('plan/update',{
			plan_id:plan.id,
			plan_name:plan.plan_name,
			plan_duration:plan.plan_duration,
			plan_price:plan.plan_price,
			description:plan.description,
			image:$scope.files,
			plan_status:plan.plan_status
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
	$scope.delfiles = function()
	{
		$scope.plan.plan_image='';
	}
     $scope.init();
  });
  //Coupon
  app.controller('CouponController', function($scope, $http) {
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.page='index';
     $scope.coupon='';
	$scope.success_flash=false;
     $scope.tab = 1;
     $scope.coupon_datas=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
	$scope.setTab = function(newTab){
	$scope.tab = newTab;
	};

	$scope.isSet = function(tabNum){
	  return $scope.tab === tabNum;
	};
     $scope.init = function() {
	$scope.image = '';
		
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('coupon/all').
		success(function(data, status, headers, config) {
			$scope.coupons = data['coupon'];
			$scope.category = data['category'];
			
			//console.log($scope.plans);
		        $scope.loading = false;
		});
	};
	
	$scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.coupons=false;
		$scope.selectedUsers=[];
		$scope.exselectedCats=[];
		$scope.selectedCats=[];
		$scope.exselectedItems=[];
		$scope.selectedItems=[];
		$http.get('coupon/all').
		success(function(data, status, headers, config) {
			$scope.loading = false;
 
		});
	};
	
	$scope.store = function(coupon) { 
           $scope.errors=false;
           $scope.success_flash=false;   
           console.log(coupon);
           $http.post('coupon/store', {
		coupon_name:coupon.coupon_name,
		description:coupon.description,
		discount_type:coupon.discount_type,
		discount_value:coupon.discount_value,
		free_shipp:coupon.free_shipp,
		usage_limit_coupon:coupon.usage_limit_coupon,
		usage_limit_user:coupon.usage_limit_user,
		expire_date:coupon.expire_date,
		exclude_sale:coupon.exclude_sale,
		min_spend:coupon.min_amount,
		max_spend:coupon.max_amount,
		individual:coupon.individual,
		products:$scope.selectedItems,
		exclude_products:$scope.exselectedItems,
		category:$scope.selectedCats,
		exclude_category:$scope.exselectedCats,
		user_email:$scope.selectedUsers,
		coupon_status:coupon.status
			
			
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
      
      $scope.editcoupon = function(couponData) {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('coupon/edit/' + couponData.id, {			
		}).success(function(data, status, headers, config) {
			$scope.coupon_datas = data['coupon'];
			$scope.selectedItems=$scope.coupon_datas.product_data;
			$scope.exselectedItems=$scope.coupon_datas.exproduct_data;
			$scope.selectedCats=$scope.coupon_datas.category_data;
			$scope.exselectedCats=$scope.coupon_datas.excategory_data;
			$scope.selectedUsers=$scope.coupon_datas.user_email;
			console.log($scope.coupon_datas);
			$scope.loading = false;
		});
	};
	
	$scope.update=function(couponData)
	{
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.page='edit';
		$http.post('coupon/update',{
			coupon_id:couponData.id,
		coupon_name:couponData.coupon_name,
		description:couponData.description,
		discount_type:couponData.discount_type,
		discount_value:couponData.discount_value,
		free_shipp:couponData.free_shipp,
		usage_limit_coupon:couponData.usage_limit_coupon,
		usage_limit_user:couponData.usage_limit_user,
		expire_date:couponData.expire_date,
		exclude_sale:couponData.exclude_sale,
		min_spend:couponData.min_spend,
		max_spend:couponData.max_spend,
		individual:couponData.individual,
		products:$scope.selectedItems,
		exclude_products:$scope.exselectedItems,
		category:$scope.selectedCats,
		exclude_category:$scope.exselectedCats,
		user_email:$scope.selectedUsers,
		coupon_status:couponData.coupon_status
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
	$scope.deletecoupon = function(index)
	{
		$scope.loading = true;

		var coupon = $scope.coupons[index];
              
                $http.post('coupon/delete',{            
                    del_id:coupon.id
                }).success(function(data, status, headers, config) {
                                        $scope.coupons.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
	}
	
	$scope.changeStatus=function(userData)
	   {
		
		   $scope.loading = true;
	   $http.post('coupon/changeStatus',{
		   id:userData.id,
		   status:userData.coupon_status
		   
	   }).success(function(data, status, headers, config) {
		   	
		                             
			$scope.loading = false
			$scope.success_flash=data[1];
			$scope.init();
			});
	   }
	   
	$scope.getProduct = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getProduct',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.err=true;
				$scope.msg = data[1];
				$scope.products = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.products = data;
			$scope.err=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedItems=[];
	$scope.selectedItem = function(item)
	{
		oldmovies='';
		angular.forEach($scope.selectedItems, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedItems.push(item);
		$scope.products='';
		$scope.coupons.product='';
		console.log($scope.selectedItems);
	  }
	}
	
	$scope.removeItem=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedItems.splice(index, 1);
		
	}
	//explode product
	
	$scope.getexProduct = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getProduct',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.exerr=true;
				$scope.msg = data[1];
				$scope.exproducts = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.exproducts = data;
			console.log($scope.exproducts);
			$scope.exerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.exselectedItems=[];
	$scope.exselectedItem = function(item)
	{
		oldmovies='';
		angular.forEach($scope.exselectedItems, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.exselectedItems.push(item);
		$scope.exproducts='';
		$scope.coupons.exproduct='';
		console.log($scope.exselectedItems);
	  }
	}
	
	$scope.exremoveItem=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.exselectedItems.splice(index, 1);
		
	}
	//category
	$scope.getCategory = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getCategory',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.cerr=true;
				$scope.msg = data[1];
				$scope.categories = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.categories = data;
			$scope.cerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedCats=[];
	$scope.selectedCat = function(item)
	{
		oldmovies='';
		angular.forEach($scope.selectedCats, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedCats.push(item);
		$scope.categories='';
		$scope.coupons.category='';
		console.log($scope.selectedCats);
	  }
	}
	$scope.removeCat=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedCats.splice(index, 1);
		
	}
	//exclude category
	$scope.getexCategory = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getCategory',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.excerr=true;
				$scope.msg = data[1];
				$scope.excategories = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.excategories = data;
			$scope.excerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.exselectedCats=[];
	$scope.exselectedCat = function(item)
	{
		oldmovies='';
		angular.forEach($scope.exselectedCats, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.exselectedCats.push(item);
		$scope.excategories='';
		$scope.coupons.excategory='';
		console.log($scope.exselectedCats);
	  }
	}
	$scope.exremoveCat=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.exselectedCats.splice(index, 1);
		
	}
	
	$scope.getUser = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getUser',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.uerr=true;
				$scope.msg = data[1];
				$scope.users = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.users = data;
			$scope.uerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedUsers=[];
	$scope.selectedUser = function(item)
	{
		oldmovies='';
		angular.forEach($scope.selectedUsers, function(eachmovie){ //For loop
          if(item.email == eachmovie.email){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedUsers.push(item);
		$scope.users='';
		$scope.coupons.user='';
		console.log($scope.selectedUsers);
	  }
	}
	
	$scope.removeUser=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedUsers.splice(index, 1);
		
	}
     $scope.init();
  });
  
  //Special Offer
  app.controller('SpecialOfferController', function($scope, $http) {
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.page='index';
     $scope.offer='';
	$scope.success_flash=false;
     $scope.tab = 1;
     $scope.coupon_datas=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
	$scope.setTab = function(newTab){
	$scope.tab = newTab;
	};

	$scope.isSet = function(tabNum){
	  return $scope.tab === tabNum;
	};
     $scope.init = function() {
	$scope.image = '';
		
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('special-offer/all').
		success(function(data, status, headers, config) {
			$scope.offers = data['offers'];
			console.log($scope.offers);
		        $scope.loading = false;
		});
	};
	
	$scope.add = function() {	
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.offer=false;
		$scope.selectedRoles=[];
		$scope.selectedUsers=[];
		$scope.exselectedCats=[];
		$scope.selectedCats=[];
		$scope.exselectedItems=[];
		$scope.selectedItems=[];
		$scope.spselectedCats=[];
		$scope.spselectedItems=[];
		$http.get('coupon/all').
		success(function(data, status, headers, config) {
			$scope.loading = false;
 
		});
	};
	
	$scope.store = function(offer) { 
           $scope.errors=false;
           $scope.success_flash=false;   
           console.log(offer);
	   $scope.method='special';
           $http.post('special-offer/store', {
		
		adjustment_type:offer.adjustment_type,
		adjustment_value:offer.adjustment_value,
		amount_adjust:offer.amount_adjust,
		amount_purchase:offer.amount_purchase,
		apply_to:offer.apply_to,
		category_list:$scope.selectedCats,
		product_list:$scope.selectedItems,
		role_list:$scope.selectedRoles,
		customer_list:$scope.selectedUsers,
		specific_category:$scope.spselectedCats,
		specific_product:$scope.spselectedItems,
		condition_match:offer.condition_match,
		customers:offer.customers,
		end_date:offer.end_date,
		from_date:offer.from_date,
		products_adujst:offer.products_adujst,
		quantity_based_on:offer.quantity_based_on,
		rule_name:offer.role_name,
		method:$scope.method
	
	
			
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
      
      $scope.editoffer = function(offerData) {
              
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('special-offer/edit/' + offerData.id, {			
		}).success(function(data, status, headers, config) {
		$scope.offer_datas = data['offer'];
		$scope.selectedItems = $scope.offer_datas.product_data;
		$scope.spselectedItems = $scope.offer_datas.spproduct_data;
		$scope.selectedCats = $scope.offer_datas.category_data;
		$scope.spselectedCats = $scope.offer_datas.spcategory_data;
		$scope.selectedRoles = $scope.offer_datas.role_data;
		
		$scope.selectedUsers = $scope.offer_datas.user_data;
		console.log($scope.offer_datas);
		$scope.loading = false;
		});
	};
	
	$scope.update=function(offerData)
	{
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.page='edit';
		$http.post('special-offer/update',{
			id:offerData.id,
		adjustment_type:offerData.adjustment_type,
		adjustment_value:offerData.adjustment_value,
		amount_adjust:offerData.amount_adjust,
		amount_purchase:offerData.amount_purchase,
		apply_to:offerData.apply_to,
		category_list:$scope.selectedCats,
		product_list:$scope.selectedItems,
		role_list:$scope.selectedRoles,
		customer_list:$scope.selectedUsers,
		specific_category:$scope.spselectedCats,
		specific_product:$scope.spselectedItems,
		condition_match:offerData.condition_match,
		customers:offerData.customers,
		end_date:offerData.end_date,
		from_date:offerData.start_date,
		products_adujst:offerData.products_adujst,
		quantity_based_on:offerData.quantity_based_on,
		rule_name:offerData.offer_name,
		method:offerData.method
		
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
	$scope.deleteoffer = function(index)
	{
		$scope.loading = true;

		var offer = $scope.offers[index];
              
                $http.post('special-offer/delete',{            
                    del_id:offer.id
                }).success(function(data, status, headers, config) {
                                        $scope.offers.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
	}
	
	$scope.changeStatus=function(userData)
	   {
		
		   $scope.loading = true;
	   $http.post('special-offer/changeStatus',{
		   id:userData.id,
		   status:userData.offer_status
		   
	   }).success(function(data, status, headers, config) {
		   	
		                             
			$scope.loading = false
			$scope.success_flash=data[1];
			$scope.init();
			});
	   }
	   
	$scope.getProduct = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getProduct',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
			$scope.err=true;
			$scope.msg = data[1];
			$scope.products = '';
			console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.products = data;
			$scope.err=false;
			$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedItems=[];
	$scope.selectedItem = function(item)
	{
		oldmovies='';
		angular.forEach($scope.selectedItems, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedItems.push(item);
		$scope.products='';
		$scope.offer.product='';
		console.log($scope.selectedItems);
	  }
	}
	
	$scope.removeItem=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedItems.splice(index, 1);
		
	}
	//explode product
	
	$scope.getexProduct = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getProduct',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.exerr=true;
				$scope.msg = data[1];
				$scope.exproducts = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.exproducts = data;
			console.log($scope.exproducts);
			$scope.exerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.exselectedItems=[];
	$scope.exselectedItem = function(item)
	{
		oldmovies='';
		angular.forEach($scope.exselectedItems, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.exselectedItems.push(item);
		$scope.exproducts='';
		$scope.offer.exproduct='';
		console.log($scope.exselectedItems);
	  }
	}
	
	$scope.exremoveItem=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.exselectedItems.splice(index, 1);
		
	}
	//category
	$scope.getCategory = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getCategory',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.cerr=true;
				$scope.msg = data[1];
				$scope.categories = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.categories = data;
			$scope.cerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedCats=[];
	$scope.selectedCat = function(item)
	{
		oldmovies='';
		angular.forEach($scope.selectedCats, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedCats.push(item);
		$scope.categories='';
		$scope.offer.category='';
		console.log($scope.selectedCats);
	  }
	}
	$scope.removeCat=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedCats.splice(index, 1);
		
	}
	//exclude category
	$scope.getexCategory = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getCategory',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.excerr=true;
				$scope.msg = data[1];
				$scope.excategories = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.excategories = data;
			$scope.excerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.exselectedCats=[];
	$scope.exselectedCat = function(item)
	{
		oldmovies='';
		angular.forEach($scope.exselectedCats, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.exselectedCats.push(item);
		$scope.excategories='';
		$scope.offer.excategory='';
		console.log($scope.exselectedCats);
	  }
	}
	$scope.exremoveCat=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.exselectedCats.splice(index, 1);
		
	}
	
	$scope.getUser = function(pData)
	{
		$scope.loading = true;
	   $http.post('special-offer/getUser',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.uerr=true;
				$scope.msg = data[1];
				$scope.users = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.users = data;
			console.log($scope.users);
			$scope.uerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedUsers=[];
	$scope.selectedUser = function(item)
	{
		oldmovies='';
		angular.forEach($scope.selectedUsers, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedUsers.push(item);
		$scope.users='';
		$scope.offer.user='';
		console.log($scope.selectedUsers);
	  }
	}
	
	$scope.removeUser=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedUsers.splice(index, 1);
		
	}
	//get Role
	$scope.getRole = function(pData)
	{
		$scope.loading = true;
	   $http.post('special-offer/getRole',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.rerr=true;
				$scope.msg = data[1];
				$scope.role = '';
				console.log($scope.msg);
			}
			else
			{
				//$scope.ab=false;
			//console.log($scope.ab);
			$scope.loading = false
			$scope.role = data;
			console.log($scope.role);
			$scope.rerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedRoles=[];
	$scope.selectedRole = function(item)
	{ 
		oldmovies='';
		angular.forEach($scope.selectedRoles, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedRoles.push(item);
		$scope.role='';
		$scope.offer.role='';
		//$scope.ab=true;
		//console.log($scope.ab);
	  }
	}
	
	$scope.removeRole=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedRoles.splice(index, 1);
		
	}
	
	//Specific product
	
	$scope.getSpecificProduct = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getProduct',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.sperr=true;
				$scope.msg = data[1];
				$scope.spproducts = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.spproducts = data;
			///console.log($scope.spproducts);
			$scope.sperr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.spselectedItems=[];
	$scope.spselectedItem = function(item)
	{
		oldmovies='';
		angular.forEach($scope.spselectedItems, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.spselectedItems.push(item);
		$scope.spproducts='';
		$scope.offer.spproduct='';
		console.log($scope.spselectedItems);
	  }
	}
	
	$scope.spremoveItem=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.spselectedItems.splice(index, 1);
		
	}
	//specific category
	$scope.getspecificCategory = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getCategory',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.spcerr=true;
				$scope.msg = data[1];
				$scope.spcategories = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.spcategories = data;
			$scope.spcerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.spselectedCats=[];
	$scope.spselectedCat = function(item)
	{
		oldmovies='';
		angular.forEach($scope.spselectedCats, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.spselectedCats.push(item);
		$scope.spcategories='';
		$scope.offer.spcategory='';
		console.log($scope.spselectedCats);
	  }
	}
	$scope.spremoveCat=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.spselectedCats.splice(index, 1);
		
	}
     $scope.init();
  });
  //Bullk Discount
  app.controller('BulkDiscountController', function($scope, $http) {
     $scope.errors=false;
     $scope.files='';
     $scope.loading = true;
     $scope.page='index';
     $scope.offer='';
	$scope.success_flash=false;
     $scope.tab = 1;
     $scope.coupon_datas=false;
     $scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
	$scope.setTab = function(newTab){
	$scope.tab = newTab;
	};

	$scope.isSet = function(tabNum){
	  return $scope.tab === tabNum;
	};
     $scope.init = function() {
	$scope.image = '';
		
                $scope.page='index';
                $scope.errors=false;               
		$scope.loading = true;
		$http.get('bulk-discount/all').
		success(function(data, status, headers, config) {
			$scope.offers = data['offers'];
			console.log($scope.offers);
		        $scope.loading = false;
		});
	};
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
	$scope.add = function() {
		$scope.inputs = [{
        value: null
    }];
                $scope.page='add';		
		$scope.errors=false;
                $scope.success_flash=false;
                $scope.offer=false;
		$scope.selectedRoles=[];
		$scope.selectedUsers=[];
		$scope.exselectedCats=[];
		$scope.selectedCats=[];
		$scope.exselectedItems=[];
		$scope.selectedItems=[];
		$scope.spselectedCats=[];
		$scope.spselectedItems=[];
		$http.get('bulk-discount/all').
		success(function(data, status, headers, config) {
			$scope.loading = false;
 
		});
	};
	
	$scope.store = function(offer) { 
           $scope.errors=false;
           $scope.success_flash=false;   
           console.log(offer);
	   $scope.method='quantity';
           $http.post('bulk-discount/store', {
		
		quantity:$scope.inputs,
		apply_to:offer.apply_to,
		category_list:$scope.selectedCats,
		product_list:$scope.selectedItems,
		role_list:$scope.selectedRoles,
		customer_list:$scope.selectedUsers,
		condition_match:offer.condition_match,
		customers:offer.customers,
		end_date:offer.end_date,
		from_date:offer.from_date,
		quantity_based_on:offer.quantity_based_on,
		role_name:offer.role_name,
		method:$scope.method
	
	
			
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
      
      $scope.editoffer = function(offerData) {
              $scope.inputs = [{
        value: null
    }];
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
                $scope.page='edit';
		$http.get('bulk-discount/edit/' + offerData.id, {			
		}).success(function(data, status, headers, config) {
		$scope.offer_datas = data['offer'];
		$scope.selectedItems = $scope.offer_datas.product_data;
		$scope.spselectedItems = $scope.offer_datas.spproduct_data;
		$scope.selectedCats = $scope.offer_datas.category_data;
		$scope.spselectedCats = $scope.offer_datas.spcategory_data;
		$scope.selectedRoles = $scope.offer_datas.role_data;
		$scope.selectedUsers = $scope.offer_datas.user_data;
		
		if($scope.offer_datas.quantity)
		$scope.inputs = $scope.offer_datas.quantity;
		
		$scope.loading = false;
		});
	};
	
	$scope.update=function(offerData)
	{
		$scope.loading = true;
                $scope.errors=false;
                $scope.success_flash=false;
		$scope.page='edit';
		$http.post('bulk-discount/update',{
			id:offerData.id,
		quantity:$scope.inputs,
		apply_to:offerData.apply_to,
		category_list:$scope.selectedCats,
		product_list:$scope.selectedItems,
		role_list:$scope.selectedRoles,
		customer_list:$scope.selectedUsers,
		
		condition_match:offerData.condition_match,
		customers:offerData.customers,
		end_date:offerData.end_date,
		from_date:offerData.start_date,
		
		quantity_based_on:offerData.quantity_based_on,
		role_name:offerData.role_name,
		method:offerData.method
		
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
	$scope.deleteoffer = function(index)
	{
		$scope.loading = true;

		var offer = $scope.offers[index];
              
                $http.post('bulk-discount/delete',{            
                    del_id:offer.id
                }).success(function(data, status, headers, config) {
                                        $scope.offers.splice(index, 1);
                                        $scope.loading = false
                                        $scope.success_flash=data[1];
                                        $scope.init();
                                });
	}
	
	$scope.changeStatus=function(userData)
	   {
		
		   $scope.loading = true;
	   $http.post('bulk-discount/changeStatus',{
		   id:userData.id,
		   status:userData.offer_status
		   
	   }).success(function(data, status, headers, config) {
		   	
		                             
			$scope.loading = false
			$scope.success_flash=data[1];
			$scope.init();
			});
	   }
	   
	$scope.getProduct = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getProduct',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
			$scope.err=true;
			$scope.msg = data[1];
			$scope.products = '';
			console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.products = data;
			$scope.err=false;
			$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedItems=[];
	$scope.selectedItem = function(item)
	{
		oldmovies='';
		angular.forEach($scope.selectedItems, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedItems.push(item);
		$scope.products='';
		$scope.offer.product='';
		console.log($scope.selectedItems);
	  }
	}
	
	$scope.removeItem=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedItems.splice(index, 1);
		
	}
	//explode product
	
	$scope.getexProduct = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getProduct',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.exerr=true;
				$scope.msg = data[1];
				$scope.exproducts = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.exproducts = data;
			console.log($scope.exproducts);
			$scope.exerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.exselectedItems=[];
	$scope.exselectedItem = function(item)
	{
		oldmovies='';
		angular.forEach($scope.exselectedItems, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.exselectedItems.push(item);
		$scope.exproducts='';
		$scope.offer.exproduct='';
		console.log($scope.exselectedItems);
	  }
	}
	
	$scope.exremoveItem=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.exselectedItems.splice(index, 1);
		
	}
	//category
	$scope.getCategory = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getCategory',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.cerr=true;
				$scope.msg = data[1];
				$scope.categories = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.categories = data;
			$scope.cerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedCats=[];
	$scope.selectedCat = function(item)
	{
		oldmovies='';
		angular.forEach($scope.selectedCats, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedCats.push(item);
		$scope.categories='';
		$scope.offer.category='';
		console.log($scope.selectedCats);
	  }
	}
	$scope.removeCat=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedCats.splice(index, 1);
		
	}
	//exclude category
	$scope.getexCategory = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getCategory',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.excerr=true;
				$scope.msg = data[1];
				$scope.excategories = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.excategories = data;
			$scope.excerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.exselectedCats=[];
	$scope.exselectedCat = function(item)
	{
		oldmovies='';
		angular.forEach($scope.exselectedCats, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.exselectedCats.push(item);
		$scope.excategories='';
		$scope.offer.excategory='';
		console.log($scope.exselectedCats);
	  }
	}
	$scope.exremoveCat=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.exselectedCats.splice(index, 1);
		
	}
	
	$scope.getUser = function(pData)
	{
		$scope.loading = true;
	   $http.post('special-offer/getUser',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.uerr=true;
				$scope.msg = data[1];
				$scope.users = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.users = data;
			console.log($scope.users);
			$scope.uerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedUsers=[];
	$scope.selectedUser = function(item)
	{
		oldmovies='';
		angular.forEach($scope.selectedUsers, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedUsers.push(item);
		$scope.users='';
		$scope.offer.user='';
		console.log($scope.selectedUsers);
	  }
	}
	
	$scope.removeUser=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedUsers.splice(index, 1);
		
	}
	//get Role
	$scope.getRole = function(pData)
	{
		$scope.loading = true;
	   $http.post('special-offer/getRole',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.rerr=true;
				$scope.msg = data[1];
				$scope.role = '';
				console.log($scope.msg);
			}
			else
			{
				//$scope.ab=false;
			//console.log($scope.ab);
			$scope.loading = false
			$scope.role = data;
			console.log($scope.role);
			$scope.rerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.selectedRoles=[];
	$scope.selectedRole = function(item)
	{ 
		oldmovies='';
		angular.forEach($scope.selectedRoles, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.selectedRoles.push(item);
		$scope.role='';
		$scope.offer.role='';
		//$scope.ab=true;
		//console.log($scope.ab);
	  }
	}
	
	$scope.removeRole=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.selectedRoles.splice(index, 1);
		
	}
	
	//Specific product
	
	$scope.getSpecificProduct = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getProduct',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.sperr=true;
				$scope.msg = data[1];
				$scope.spproducts = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.spproducts = data;
			///console.log($scope.spproducts);
			$scope.sperr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.spselectedItems=[];
	$scope.spselectedItem = function(item)
	{
		oldmovies='';
		angular.forEach($scope.spselectedItems, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.spselectedItems.push(item);
		$scope.spproducts='';
		$scope.offer.spproduct='';
		console.log($scope.spselectedItems);
	  }
	}
	
	$scope.spremoveItem=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.spselectedItems.splice(index, 1);
		
	}
	//specific category
	$scope.getspecificCategory = function(pData)
	{
		$scope.loading = true;
	   $http.post('coupon/getCategory',{
		   keyWord:pData
		   
		   
	   }).success(function(data, status, headers, config) {
		   	
		        if(data[0]=='error')
			{
				$scope.spcerr=true;
				$scope.msg = data[1];
				$scope.spcategories = '';
				console.log($scope.msg);
			}
			else
			{
			$scope.loading = false
			$scope.spcategories = data;
			$scope.spcerr=false;
				$scope.msg = '';
			//$scope.init();
			}
			});
	}
	$scope.spselectedCats=[];
	$scope.spselectedCat = function(item)
	{
		oldmovies='';
		angular.forEach($scope.spselectedCats, function(eachmovie){ //For loop
          if(item.id == eachmovie.id){ // this line will check whether the data is existing or not
          oldmovies = true;
          }
		});
	  if(!oldmovies)
	  {
		item.selected=true;
		$scope.spselectedCats.push(item);
		$scope.spcategories='';
		$scope.offer.spcategory='';
		console.log($scope.spselectedCats);
	  }
	}
	$scope.spremoveCat=function(index)
	{
		//var product = $scope.selectedItems[index];
		$scope.spselectedCats.splice(index, 1);
		
	}
     $scope.init();
  });