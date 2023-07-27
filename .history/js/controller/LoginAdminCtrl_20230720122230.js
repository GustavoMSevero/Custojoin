app.controller("loginAdminCtrl", function ($scope, $http, $location, $window) {


	$scope.loginAdminCJ = function (admin) {
		$http.post('http://localhost:8880/web/Custojoin/php/adminCJ/loginadmin.php', admin).success(function(data){
			if(data != ''){
				$location.path('/areaadmin');
			}else{
				$location.path('/adminCJ');
				$scope.erroLoginAdmin = "Email ou senha inválido";
			}
		});
		
	}
});