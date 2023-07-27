app.controller("subcategoriaAdminCJCtrl", function ($scope, $http, $location, $window) {

    $scope.filteredSubcate = []
    ,$scope.currentPage = 1
    ,$scope.numPerPage = 10
    ,$scope.maxSize = 5;

    $scope.makeSubcate = function() {
        $scope.todos = [];
            for (i=1;i<=1000;i++) {
                $scope.subcate.push({ text:'subcate '+i, done:false});
            }
        };
    $scope.makeSubcate();

    $scope.$watch('currentPage + numPerPage', function() {
        var begin = (($scope.currentPage - 1) * $scope.numPerPage)
        , end = begin + $scope.numPerPage;
        
        $scope.filteredSubcate = $scope.subcate.slice(begin, end);
    });

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

});