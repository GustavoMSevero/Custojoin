app.controller("SubcategoriaAdminCtrl", function ($scope, $http, $location, $window) {

	$scope.subcategorias = [];
	$scope.subcategoria = {categoria: "", subcategoria: ""};

	$scope.salvarSubcategoria = function(subcategoria){

		$http.post('http://localhost:8880/web/Custojoin/php/subcategoriaAdmin.php', subcategoria).success(function(data){
			$scope.subcategoria = {categoria: "", subcategoria: ""};
			$scope.subcategorias = [];
			pegaSubcategorias();

		});

	}

	var pegaSubcategorias = function(){
		$http.get('http://localhost:8880/web/Custojoin/php/subcategoriaAdmin.php').success(function(data){
			$scope.subcategorias = data;
		});
	}

	pegaSubcategorias();

});