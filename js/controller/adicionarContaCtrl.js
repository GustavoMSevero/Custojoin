app.controller("AdicionarContaCtrl", function ($scope, $http, $window, $rootScope) {

	var idempresa = $rootScope.idempresa;
	var empresa = $rootScope.empresa;
	var usuario = $rootScope.usuario;
	var idusuario = $rootScope.idusuario;


	$scope.empresa = empresa;
	$scope.usuario = usuario;

	$scope.contaEntrada = {};

	$scope.salvarContaEntrada = function(contaEntrada){
		contaEntrada.idempresa = idempresa;
		$http.post("http://localhost:8888/web/Custojoin2/php/admin/contaEntradaAdmin.php", contaEntrada).success(function(data){
			$scope.contaEntrada = {};
			pegaContasEntrada();
		});
	}

	$scope.contaSaida = {};

	$scope.salvarContaSaida = function(contaSaida){
		contaSaida.idempresa = idempresa;
		$http.post("http://localhost:8888/web/Custojoin2/php/admin/contaSaidaAdmin.php", contaSaida).success(function(data){
			$scope.contaSaida = {};
			pegaContasSaida();
		});
	}

	// Pega contas de entrada salvas
	var pegaContasEntrada = function(){
		var data = {
			'idempresa':idempresa
		};

		$http.post("http://localhost:8888/web/Custojoin2/php/admin/pegaContasEntradaAdmin.php", data).success(function(data){
			$scope.contasEntrada = data;
		});
	}

	pegaContasEntrada();

	var pegaContasSaida = function(){

		$scope.contasSaida = [];

		var data = {
		 'idempresa':idempresa
		};

		$http.post("http://localhost:8888/web/Custojoin2/php/admin/pegaContasSaidaAdmin.php", data).success(function(data){
			$scope.contasSaida = data;
		})

	}

	pegaContasSaida();

});


