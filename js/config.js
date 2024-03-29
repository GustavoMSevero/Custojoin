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
    })

    .when("/grupos", {
        templateUrl: "views/adminCJ/gruposAdmin.html",
    })

    .when("/categoriaAdmin", {
        templateUrl: "views/adminCJ/categoriaAdmin.html",
    })

    .when("/subcategoriaAdmin", {
        templateUrl: "views/adminCJ/subcategoriaAdmin.html",
    })

    .when("/contaAdmin", {
        templateUrl: "views/adminCJ/contaAdmin.html",
    })

    .when("/editarCategoria/:idcategory", {
        templateUrl: "views/adminCJ/editarCategoria.html",
    })

    .when("/editarSubcategoria/:idsubcategory", {
        templateUrl: "views/adminCJ/editarSubcategoria.html",
    })

    .when("/cadastra_empresa", {
        templateUrl: "views/cadastra_empresa.html",
    })

    .when("/importacao", {
        templateUrl: "views/importacao.html",
    })

    .when("/contas", {
        templateUrl: "views/contas.html",
    })

    .when("/plano_contas", {
        templateUrl: "views/plano_contas.html",
    })

    .when("/contas_importadas", {
        templateUrl: "views/contas_importadas.html",
    })

    .when("/relatorios", {
        templateUrl: "views/relatorios.html",
    })

    
});