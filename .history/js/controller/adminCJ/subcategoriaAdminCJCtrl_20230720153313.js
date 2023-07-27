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
        $http.post('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php', subcategoria).success(function(response){

		});
    }

    var getSubcategories = function() {
        var option = 'get categories';
        $http.get('http://localhost:8880/web/Custojoin/php/adminCJ/categoriaAdminCJ.php?option='+option).success(function(data){
            console.log(data);
			// $scope.categories = data;
		});
    }

    getSubcategories();

});