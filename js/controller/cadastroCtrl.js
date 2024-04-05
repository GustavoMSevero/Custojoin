app.controller("cadastroCtrl", function ($scope, $http, $location) {

	$scope.cadastrar = function(empresa) {
		empresa.opcao = "cadastrar empresa";
		// console.log(empresa)
		$http.post('http://localhost:8888/web/Custojoin2/php/empresa.php', empresa).success(function(data) {
			// console.log(data)
			if (data.status == 1) {
				$location.path('/');
			}
		})
	}


});