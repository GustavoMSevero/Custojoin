app.controller("subcategoriaAdminCJCtrl", function ($scope, $http, $location, $window) {


	var getCategories = function(){
        var option = 'get categories';
		$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php?option='+option).success(function(data){
            console.log(data)
			$scope.groups = data;
		});
	}

	getCategories();

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