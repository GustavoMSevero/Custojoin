var app = angular.module("custo", ["ngRoute", "ui.utils.masks", "ngFileUpload", "LocalStorageModule"]);

app.config(function($routeProvider, $locationProvider, localStorageServiceProvider){

   localStorageServiceProvider.setPrefix('custo');
   localStorageServiceProvider.setStorageType('localStorage');

	$routeProvider

	.when('/', {
      templateUrl : 'views/login.html',
      controller  : 'LoginCtrl',
	})

   .when('/inicial', {
      templateUrl : 'views/inicial.html',
      controller  : 'InicialCtrl'
   })

});

app.run(function($rootScope, $filter) {

   $rootScope.idempresa = null;
   $rootScope.idusuario = null;
   $rootScope.usuario = null;
   $rootScope.empresa = null;

})