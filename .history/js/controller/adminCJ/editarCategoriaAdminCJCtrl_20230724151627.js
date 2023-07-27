app.controller("editarCategoriaAdminCJCtrl", function ($scope, $http, $routeParams, $location) {

    $scope.idcategory = $routeParams.idcategory;
    console.log('idcategory '+$scope.idcategory)

	var getCategoryToEdit = function(){
        var option = 'get category to edit';
        var idcategory = $scope.idcategory;
		$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php?option='+option+'&idcategory='+idcategory).success(function(data){
            console.log(data)
			$scope.category = data;
		});
	}

	getCategoryToEdit();

    // $scope.safeCategory = function(category) {
    //     category.option = 'save category';
    //     // console.log(category)
    //     $http.post('http://localhost:8880/web/Custojoin/php/adminCJ/categoriaAdminCJ.php', category).success(function(data){
    //         // console.log(data)
    //         getCategories()
	// 	});
    // }

    // var getCategories = function() {
    //     var option = 'get categories';
    //     $http.get('http://localhost:8880/web/Custojoin/php/adminCJ/categoriaAdminCJ.php?option='+option).success(function(data){
	// 		$scope.categories = data;
	// 	});
    // }

    // getCategories();

});