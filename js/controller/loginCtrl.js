app.controller("LoginCtrl", function ($scope, $http, $location, $rootScope) {

	$scope.logar = function(usuario){

		var opcao = 'logar';
		usuario.opcao = opcao;

		$http.post('http://localhost:8880/web/Custojoin2/php/empresa.php', usuario).success(function (data){
			if (data.status == "") {

				alert("E-mail ou senha inválido");

			} else if(typeof(Storage) !== "undefined") {
					localStorage.setItem('empresa', data.empresa);
					localStorage.setItem('id', data.id)

					$rootScope.empresa = data.empresa;
					$rootScope.id = data.id;

					$location.path('/inicial');
			}
		});
	};
});