app.config(function($routeProvider, $locationProvider){

    $routeProvider

    .when("/", {
        templateUrl: "views/login.html",
        controller: "LoginCtrl",
    })

    .when("/inicial", {
        templateUrl: "views/inicial.html",
        controller: "LoginCtrl",
    })

    .when("/loginadmin", {
        templateUrl: "views/loginadmin.html",
        controller: "LoginAdminCtrl",
    })

    .when("/areaadmin", {
        templateUrl: "views/areaadmin.html",
        //controller: "LoginAdminCtrl",
    })

    .when("/grupos", {
        templateUrl: "views/adminCJ/gruposAdmin.html",
        //controller: "SubcategoriaAdminCtrl",
    })

    .when("/categoriaAdmin", {
        templateUrl: "views/adminCJ/categoriaAdmin.html",
        //controller: "SubcategoriaAdminCtrl",
    })

    .when("/subcategoriaAdmin", {
        templateUrl: "views/adminCJ/subcategoriaAdmin.html",
    })

    .when("/editarCategoria/:idcategory", {
        templateUrl: "views/editarCategoria.html",
    })

    
});