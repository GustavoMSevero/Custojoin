app.controller("contas_importadasCtrl", function ($scope, $http, $window, $rootScope) {

	var idempresa = $rootScope.idempresa;
	var empresa = $rootScope.empresa;
	var usuario = $rootScope.usuario;

	$scope.empresa = empresa;
	$scope.usuario = usuario;

    var pegarContasImportadas = function() {
        var opcao = 'pegar contas importadas';
        $http.get("http://localhost:8888/web/Custojoin2/php/contas_importadas.php?opcao=" +opcao +"&idempresa="+ idempresa).success(function(data) {
            // console.log(data)
            $scope.contas_importadas = data;
        })
    }
    pegarContasImportadas();


});


