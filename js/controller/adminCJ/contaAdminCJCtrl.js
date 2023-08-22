app.controller("contaAdminCJCtrl", function ($scope, $http, $location, $window) {

	var getSubcategories = function(){
        var option = 'get subcategories';
		$http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/subcategoriasAdminCJ.php?option='+option).success(function(data){
            $scope.subcategories = data;
		});
	}

	getSubcategories();

    $scope.saveConta = function(conta) {
        conta.option = 'save conta';
        $http.post('http://localhost:8880/web/Custojoin2/php/adminCJ/contaAdminCJ.php', conta).success(function(data) {
            // console.log(data);
            getContas();
        })
    }

    var getContas = function() {
        var option = 'get contas';
        $http.get('http://localhost:8880/web/Custojoin2/php/adminCJ/contaAdminCJ.php?option='+option).success(function(response){
			$scope.contas = response;
		});
    }

    getContas();

});