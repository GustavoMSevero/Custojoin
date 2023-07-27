app.controller("categoriaAdminCJCtrl", function ($scope, $http, $location, $window) {


	var getGroups = function(){
        var option = 'get groups';
		$http.get('http://localhost:8880/web/Custojoin/php/adminCJ/grupoAdminCJ.php?option='+option).success(function(data){
            // console.log(data)
			$scope.groups = data;
		});
	}

	getGroups();

    $scope.safeCategory = function(category) {
        category.option = 'save category';
        // console.log(category)
        $http.post('http://localhost:8880/web/Custojoin/php/adminCJ/categoriaAdminCJ.php', category).success(function(data){
            // console.log(data)
		});
    }

    var getCategories = function() {
        var option = 'get categories';
        $http.get('http://localhost:8880/web/Custojoin/php/adminCJ/categoriaAdminCJ.php?option='+option).success(function(data){
			$scope.categories = data;
		});
    }

    getCategories()

});