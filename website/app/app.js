var app = angular.module('app',['ngRoute', 'angular-loading-bar', 'ngAnimate']);
 
app.config(function($routeProvider, $locationProvider)
{

   // remove o # da url
   $locationProvider.html5Mode(true);
 
   $routeProvider
 
   .when('/', {
      templateUrl : 'app/views/home.html',
      controller     : 'HomeCtrl',
   })

   .when('/produto/:id', {
      templateUrl : 'app/views/produto.html',
      controller  : 'ProdutoCtrl',
   })

    .when('/login', {
      templateUrl : 'app/views/login.html',
      controller  : 'LoginCtrl',
   })
 
   .otherwise ({ redirectTo: '/' });

});
app.configApp = {
    api : {
        url : "http://localhost/e-commerce-grafo-rbc/web/app_dev.php/api/",
    }
}