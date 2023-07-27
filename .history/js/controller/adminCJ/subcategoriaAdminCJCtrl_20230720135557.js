app.controller("subcategoriaAdminCJCtrl", function ($scope, $http, $location, $window) {


	var getCategories = function(){
        var option = 'get categories';
		$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php?option='+option).success(function(data){
            // console.log(data)
			$scope.categories = data;
		});
	}

	getCategories();

    $scope.saveSubcategoria = function(subcategoria) {
        subcategoria.option = 'save subcategory';
        console.log(subcategoria)
        $http.post('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriaAdminCJ.php', subcategoria).success(function(data){
            // console.log(data)
		});
    }

    // var getCategories = function() {
    //     var option = 'get categories';
    //     $http.get('http://localhost:8880/web/Custojoin/php/adminCJ/categoriaAdminCJ.php?option='+option).success(function(data){
	// 		$scope.categories = data;
	// 	});
    // }

    // getCategories();

});