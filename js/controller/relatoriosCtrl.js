app.controller("relatoriosCtrl", function ($scope, $http, $rootScope) {

	var idempresa = $rootScope.idempresa;
	var empresa = $rootScope.empresa;
	var usuario = $rootScope.usuario;

	$scope.empresa = empresa;
	$scope.usuario = usuario;

    // var pegarContasImportadas = function() {
    //     var opcao = 'pegar contas importadas';
    //     $http.get("http://localhost:8880/web/Custojoin2/php/contas_importadas.php?opcao=" +opcao +"&idempresa="+ idempresa).success(function(data) {
    //         // console.log(data)
    //         $scope.contas_importadas = data;
    //     })
    // }
    // pegarContasImportadas();
    
    $scope.consultar = function(data) {
        data.idempresa = idempresa;
        console.log(data)
        $http.post('http://localhost:8880/web/Custojoin2/php/relatorio_mensal.php', data).success(function(response) {
            console.log(response)
            // $scope.reltorioMensal = data;
        });
    }


});


