var app = angular.module("fluxo", ["ngRoute", "ui.utils.masks", "ngFileUpload", "LocalStorageModule"]);

app.config(function($routeProvider, $locationProvider, localStorageServiceProvider){

   localStorageServiceProvider.setPrefix('fluxo');
   localStorageServiceProvider.setStorageType('localStorage');

	$routeProvider

	.when('/', {
      templateUrl : 'views/login.html',
      controller  : 'LoginCtrl',
	})

   .when('/cadempresa', {
      templateUrl : 'views/cadempresa.html',
      controller  : 'CadEmpresaCtrl',
	})

   .when('/cadusuario', {
      templateUrl : 'views/cadusuario.html',
      controller  : 'CadUsuarioCtrl',
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