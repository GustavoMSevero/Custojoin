app.controller("importacaoCtrl", function ($scope, $rootScope, $route) {

	var formData = new FormData();

	$scope.id = $rootScope.idempresa = localStorage.getItem('id');
	$scope.empresa = $rootScope.empresa = localStorage.getItem('empresa');

	$scope.uploadExcel = function(){
		$scope.input.click();
	}

	$scope.input = document.createElement("INPUT");
	$scope.input.setAttribute("type", "file");
	$scope.input.addEventListener('change', function(){
		formData.append('file_xls', $scope.input.files[0]);

			$.ajax({
				url: 'http://localhost:8880/web/Custojoin2/php/importaArquivo.php?idempresa='+$scope.id,
				data: formData,
				type: 'POST',
				contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
				processData: false
			}) // NEEDED, DON'T OMIT THIS
			// ... Other options like success and etc
			.then(function successCallback(response) {
				console.log(response);
				alert(response)
				$route.reload();
		}, function errorCallback(response) {
			console.log("Error "+response);
		});
	});


});