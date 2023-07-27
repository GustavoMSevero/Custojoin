app.controller("editarSubcategoriaAdminCJCtrl", function ($scope, $http, $routeParams, $location) {

    $scope.idsubcategory = $routeParams.idsubcategory;

    var getGroups = function(){
        var option = 'get groups';
		$http.get('http://localhost:8880/web/Custojoin/php/adminCJ/grupoAdminCJ.php?option='+option).success(function(data){
			$scope.groups = data;
		});
	}

	getGroups();

	var getSubcategoryToEdit = function(){
        var option = 'get subcategory to edit';
        var idsubcategory = $scope.idsubcategory;
		$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/subcategoriasAdminCJ.php?option='+option+'&idsubcategory='+idsubcategory).success(function(data){
            console.log(data)
			$scope.subcategory = data;
		});
	}

	getSubcategoryToEdit();

    $scope.updateSubcategory = function(subcategory) {
        subcategory.option = 'update subcategory';
        $http.post('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php', subcategory).success(function(data){
            console.log(data);    
            // $location.path('/categoriaAdmin');
        });
    }

});