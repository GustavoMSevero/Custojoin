app.controller("editar_conta_importadaCtrl", function ($scope, $http, $location, $rootScope, $routeParams) {

	var idempresa = $rootScope.idempresa;
	var empresa = $rootScope.empresa;
	var usuario = $rootScope.usuario;

	$scope.idempresa = idempresa;
	$scope.empresa = empresa;
	$scope.usuario = usuario;

    var idconta = $routeParams.idconta;

    var pegarContaImportada = function() {
        var opcao = 'pegar conta importada';
        $http.get("http://localhost:8888/web/Custojoin2/php/contas_importadas.php?opcao=" +opcao +"&idempresa="+ idempresa+"&idconta="+ idconta).success(function(response) {
            // console.log(response)
            $scope.contaImportada = response;
        })
    }
    pegarContaImportada();

    $scope.atualizarConta = function(contaImportada) {
        contaImportada.opcao = 'atualizar conta importada';
        contaImportada.idempresa = idempresa;
        $http.post("http://localhost:8888/web/Custojoin2/php/contas_importadas.php", contaImportada).success(function(response) {
            // console.log(response)
            $location.path('/contas_importadas');
        })
    }


});


