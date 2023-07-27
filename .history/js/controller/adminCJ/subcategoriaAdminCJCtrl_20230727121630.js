app.controller("subcategoriaAdminCJCtrl", function ($scope, $http, $location, $window) {

	var getCategories = function(){
        var option = 'get categories';
		$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php?option='+option).success(function(data){
            // console.log(data)
			$scope.categories = data;
		});
	}

	getCategories();

    $scope.saveSubcategory = function(subcategoria) {
        subcategoria.option = 'save subcategory';
        $http.post('http://localhost:8880/web/Custojoin2/php/adminCJ/subcategoriasAdminCJ.php', subcategoria).success(function(data){
            getSubcategories();
		});
    }

    var getSubcategories = function() {
        var option = 'get subcategories';
        $http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/subcategoriasAdminCJ.php?option='+option).success(function(response){
			$scope.subcategories = response;
		});
    }

    getSubcategories();
    
    console.log($scope.subcategories[{}]);
    // $scope.totalPorPagina = 10;
    // $scope.totalRegistro = $scope.subcategories.length;
    // $scope.pagina = [];
    // var p = $scope.totalRegistro > $scope.totalPorPagina ? Math.ceil($scope.totalRegistro / $scope.totalPorPagina) : 1;
    // for (var i = 0; i < p; i++) {
    //     $scope.pagina.push(c.splice(0, $scope.totalPorPagina));
    // }
    // $scope.lista = $scope.pagina[0];
  
    // $scope.loadListPagination = function (i) {
    //         $scope.lista = $scope.pagina[i];
    //     };

});