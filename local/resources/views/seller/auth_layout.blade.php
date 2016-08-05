<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ configs_value('Site Name') }} | Seller Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::asset('seller/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('seller/css/AdminLTE.min.css')}}">
  
<style>input#textAngular-editableFix-010203040506070809 {
    display: none;
}</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" ng-app="sellers" ng-controller="HomeController">
<div class="login-box">
  <div class="login-logo">
   <a href="{{ configs_value('Website') }} ">{{ configs_value('Site Name') }} </a>
  </div>
    
    
        <div class="alert alert-danger" ng-if= "errors">
        <strong>Whoops! Something went wrong!</strong>

        <br><br>
 
          <ul ng-repeat="er in errors">
            <li><% er %></li>
          </ul>
        </div>
    
     @if(Session::has('flash_message'))
         <div class="alert alert-success" ng-hide="errors">
            <p >
		   {{ Session::get('flash_message') }}
            </p>
         </div>
    @endif  
  <!-- /.login-logo -->
   @yield('content')
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="{{URL::asset('seller/js/jQuery-2.2.0.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{URL::asset('seller/js/bootstrap.min.js')}}"></script>
<!-- Angular JS 3.3.6 -->
<script src="{{URL::asset('seller/js/angular.min.js')}}"></script>
<script src="{{URL::asset('seller/js/angular-route.min.js')}}"></script>

<script src="{{URL::asset('seller/dist/textAngular-rangy.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('seller/dist/textAngular-sanitize.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('seller/dist/textAngular.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('seller/js/angular_app.js')}}"></script>

</body>
</html>
