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

    .when("/entradas", {
        templateUrl: "views/entradas.html",
        //controller: "LoginCtrl",
    })

    .when("/saidas", {
        templateUrl: "views/saidas.html",
        //controller: "LoginCtrl",
    })

    .when("/configuracoes", {
        templateUrl: "views/configuracoes.html",
        controller: "ConfigCtrl",
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
        //controller: "SubcategoriaAdminCtrl",
    })

    .when("/adicionarConta", {
        templateUrl: "views/adicionarConta.html",
        controller: "AdicionarContaCtrl",
    })

    .when("/adicionarConta", {
        templateUrl: "views/adicionarConta.html",
        controller: "CarregaSubcategoriasCtrl",
    })


    .when("/editarPerfil", {
        templateUrl: "views/editarPerfil.html",
        //controller: "EditarPerfilCtrl",
    })

    .when("/editarConta/:idconta", {
        templateUrl: "views/editarConta.html",
        //controller: "EditarContaCtrl",
    })

    .when("/editarContaEntrada/:idcontaEntrada", {
        templateUrl: "views/editarContaEntrada.html",
        controller: "EditarContaEntradaCtrl",
    })

    .when("/editarContaSaida/:idcontaSaida", {
        templateUrl: "views/editarContaSaida.html",
        controller: "EditarContaSaidaCtrl",
    })

    .when("/saldos", {
        templateUrl: "views/saldos.html",
        //controller: "EditarContaSaidaCtrl",
    })

    .when("/investimentos", {
        templateUrl: "views/investimentos.html",
        controller: "InvestimentosCtrl"
    })

    .when("/importacao", {
        templateUrl: "views/importacao.html",
        ///controller: "ImportacaoCtrl",
    })

    .when("/cadastrarBanco", {
        templateUrl: "views/cadastrarBanco.html",
        controller: "CadastrarBancoCtrl"
    })

    .when("/editarBanco/:idbanco", {
        templateUrl: "views/editarBanco.html",
        controller: "EditarBancoCtrl"
    })

    .when("/cadastrarBensImoveis", {
        templateUrl: "views/cadastrarBensImoveis.html"
    })

    .when("/cadastrarInvest", {
        templateUrl: "views/cadastrarInvest.html"
    })

    .when("/cadastrarPagDiversos", {
        templateUrl: "views/cadastrarPagDiversos.html"
    })

    .when("/cadastrarOperFinanceiras", {
        templateUrl: "views/cadastrarOperFinanceiras.html"
    })

    .when("/cadastrarOperAutoliquidez", {
        templateUrl: "views/cadastrarOperAutoliquidez.html"
    })

    .when("/editarBensImoveis/:idbensimoveis", {
        templateUrl: "views/editarBensImoveis.html"
    })

    .when("/editarInvestimento/:idinvestimento", {
        templateUrl: "views/editarInvestimento.html"
    })

    .when("/editarPagDiversos/:idpagamentosDiversos", {
        templateUrl: "views/editarPagDiversos.html"
    })

    .when("/editarOperFinanceiras/:idoperacoesFinanceiras", {
        templateUrl: "views/editarOperFinanceiras.html"
    })

    .when("/editarOperAutoliquidez/:idoperacoesAutoliquidez", {
        templateUrl: "views/editarOperAutoliquidez.html"
    })

    .when("/bensImoveis", {
        templateUrl: "views/bensImoveis.html"
    })

    .when("/invest", {
        templateUrl: "views/invest.html"
    })

    .when("/pagamentosDiversos", {
        templateUrl: "views/pagamentosDiversos.html"
    })

    .when("/operacoesFinanceiras", {
        templateUrl: "views/operacoesFinanceiras.html"
    })

    .when("/operacoesAutoliquidez", {
        templateUrl: "views/operacoesAutoliquidez.html"
    })

    .when("/relatorios", {
        templateUrl: "views/relatorios.html"
    })

    .when("/pordata", {
        templateUrl: "views/pordata.html"
    })

    .when("/porperiodo", {
        templateUrl: "views/porperiodo.html"
    })


    
});