app.controller("categoriaAdminCJCtrl", function ($scope, $http, $location, $window) {


	var getGroups = function(){
        var option = 'get groups';
		$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/grupoAdminCJ.php?option='+option).success(function(data){
			$scope.groups = data;
		});
	}

	getGroups();

    $scope.safeCategory = function(category) {
        category.option = 'save category';
        $http.post('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriaAdminCJ.php', category).success(function(data){
            getCategories()
		});
    }

    var getCategories = function() {
        var option = 'get categories';
        $http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/categoriasAdminCJ.php?option='+option).success(function(data) {
            $scope.categories = data;
        })
    }

    getCategories();

});