app.controller("LoginCtrl", function ($scope, $http, $location, $rootScope) {

	$scope.logar = function(usuario){

		var opcao = 'logar';
		usuario.opcao = opcao;
		$http.post('http://localhost:8880/web/Custojoin2/php/empresa.php', usuario).success(function (data){
			if (data.status == 0) {
				alert(data.message);

			} else { 
				if(typeof(Storage) !== "undefined") {
				localStorage.setItem('empresa', data.empresa);
				localStorage.setItem('id', data.id)
				localStorage.setItem('usuario', data.usuario)

				$rootScope.empresa = data.empresa;
				$rootScope.id = data.id;
				$rootScope.usuario = data.usuario;

				$location.path('/inicial');
			}}
		});
	};
});