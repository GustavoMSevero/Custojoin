app.controller("relatoriosCtrl", function ($scope, $http, $rootScope) {

	var idempresa = $rootScope.idempresa;
	var empresa = $rootScope.empresa;
	var usuario = $rootScope.usuario;

	$scope.empresa = empresa;
	$scope.usuario = usuario;
    
    $scope.salvar = function(data) {
        data.idempresa = idempresa;
        // console.log(data)
        $http.post('http://localhost:8880/web/Custojoin2/php/relatorio_mensal.php', data).success(function(response) {
            console.log(response)
        });
    }


});


