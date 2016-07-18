var app = angular.module('admins', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});
 
app.controller('HomeController', function($scope, $http) {
// alert('hello');
	$scope.errors=false;
	$scope.loading = true;
 
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
		
         
		$http.post('admins/log_user', {
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
	$scope.init = function() {
		$scope.loading = true;
		$http.get('admins/category').
		success(function(data, status, headers, config) {
			$scope.categorys = data;
	        $scope.loading = false;
 
	});
	}
 
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
 