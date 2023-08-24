app.controller("ImportacaoCtrl", function ($scope, $http, $window, $rootScope) {

	$scope.id = $rootScope.idempresa = localStorage.getItem('id');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');

	$scope.sair = function(){
		localStorage.clear();
		//localStorage.removeItem(usuarioEmp);
	}



});