app.controller("gruposAdminCJCtrl", function ($scope, $http, $location, $window) {


	$scope.group = {id: "", grupo: ""};
	$scope.safeGroup = function(group){
        group.option = 'save';
		$http.post('http://localhost:8880/web/Custojoin/php/adminCJ/grupoAdminCJ.php', group).success(function(data){
            $scope.group = {id: "", grupo: ""};
            getGroups();

		});

	}

	var getGroups = function(){
        var option = 'get groups';
		$http.get('http://localhost:8880/web/Custojoin/php/adminCJ/grupoAdminCJ.php?option='+option).success(function(data){
			$scope.grupos = data;
		});
	}

	getGroups();

});