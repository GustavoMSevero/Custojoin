app.controller("LoginCtrl", function ($scope, $http, $window, $location, $rootScope, localStorageService) {

	$scope.logar = function(usuario){

		var opcao = 'logar';
		usuario.opcao = opcao;

		$http.post('http://localhost:8888/sistemas/webApps/fluxo_de_caixa/fluxojoin_2.0/php/usuario.php', usuario).success(function (data){
			//console.log(data);
			if(data == '' || data == [] || data == 'null' || data == 'undefined'){
				$scope.msgErro = "E-mail ou senha inválido";
				return;

			}else if(typeof(Storage) !== "undefined") {
				//console.log(data);
				localStorage.setItem('empresa', data.empresa);
				localStorage.setItem('idempresa', data.idempresa);
				localStorage.setItem('usuario', data.usuario);
				localStorage.setItem('idusuario', data.idusuario);

				$rootScope.usuario = $scope.usuario = data.usuario;
				$rootScope.idusuario = $scope.idusuario = data.idusuario;
				$rootScope.empresa = $scope.empresa = data.empresa;
				$rootScope.idempresa = $scope.idempresa = data.idempresa;
				
				$location.path('/inicial');
			} else {
			    console.log("Desculpe, mas o navegador nao possui suporte a Web Storage.");
			}
		});
	};
});