app.controller("LoginAdminCtrl", function ($scope, $http, $location, $window) {


	$scope.loginAdminCJ = function (admin) {
		$http.post('http://localhost:8888/web/Custojoin2/php/adminCJ/loginadmin.php', admin).success(function(data){
			if(data != ''){
				$location.path('/areaadmin');
			}else{
				$location.path('/adminCJ');
				$scope.erroLoginAdmin = "Email ou senha inválido";
			}
		});
		
	}
});