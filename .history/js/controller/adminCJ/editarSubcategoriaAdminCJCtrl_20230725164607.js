app.controller("editarSubcategoriaAdminCJCtrl", function ($scope, $http, $routeParams, $location) {

    $scope.idsubcategory = $routeParams.idsubcategory;

    var getGroups = function(){
        var option = 'get groups';
		$http.get('http://localhost:8880/web/Custojoin/php/adminCJ/grupoAdminCJ.php?option='+option).success(function(data){
			$scope.groups = data;
		});
	}

	getGroups();

	// var getCategoryToEdit = function(){
    //     var option = 'get category to edit';
    //     var idsubcategory = $scope.idsubcategory;
	// 	$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php?option='+option+'&idsubcategory='+idsubcategory).success(function(data){
	// 		$scope.category = data;
	// 	});
	// }

	// getCategoryToEdit();

    // $scope.updateCategory = function(category) {
    //     category.option = 'update category';
    //     $http.post('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php', category).success(function(data){
    //         // console.log(data);    
    //         $location.path('/categoriaAdmin');
    //     });
    // }

});