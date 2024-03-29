app.controller("editarSubcategoriaAdminCJCtrl", function ($scope, $http, $routeParams, $location) {

    $scope.idsubcategory = $routeParams.idsubcategory;

    var getCategory = function(){
        var option = 'get categories';
		$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php?option='+option).success(function(data){
            $scope.categories = data;
		});
	}

	getCategory();

	var getSubcategoryToEdit = function(){
        var option = 'get subcategory to edit';
        var idsubcategory = $scope.idsubcategory;
		$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/subcategoriasAdminCJ.php?option='+option+'&idsubcategory='+idsubcategory).success(function(data){
			$scope.subcategory = data;
		});
	}

	getSubcategoryToEdit();

    $scope.updateSubcategory = function(subcategory) {
        subcategory.option = 'update subcategory';
        $http.post('http://localhost:8880/web/Custojoin2/php/adminCJ/subcategoriasAdminCJ.php', subcategory).success(function(data){
            $location.path('/subcategoriaAdmin');
        });
    }

});