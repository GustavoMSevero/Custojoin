app.controller("InicialCtrl", function ($scope, $http, $window, $rootScope) {

	$scope.id = $rootScope.idempresa = localStorage.getItem('id');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');
	$scope.usuario = $rootScope.usuario = localStorage.getItem('usuario');

	$scope.sair = function(){
		localStorage.clear();
		//localStorage.removeItem(usuarioEmp);
	}



});