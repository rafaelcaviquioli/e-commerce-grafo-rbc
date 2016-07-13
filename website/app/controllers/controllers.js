app.controller('HomeCtrl', function ($scope, $http, $location) {
    verificaSessao($scope, $http);

    //URL ATIVA
    $scope.activetab = $location.path();
})

.controller('IndexCtrl', function ($scope, $http, $location) {
    $scope.categoriaFiltroDescricao = "Categoria";

    loadCategorias($scope, $http);
    loadMarcas($scope, $http);
    loadTamanhos($scope, $http);
    loadGeneros($scope, $http);
    loadCores($scope, $http);

    $scope.filtros = [[], [], [], []];
    $scope.categoriaFiltroId = "";

    $scope.marcarFiltro = function(filtro, id){
        var index = $scope.filtros[filtro].indexOf(id);
        if(index !== -1){
            $scope.filtros[filtro].splice(index, 1);
        }else{
            $scope.filtros[filtro].push(id);
        }

        $scope.filtrar();
    }
    $scope.filtrarCategoria = function(categoria){
        $scope.categoriaFiltroId = categoria.id;
        $scope.categoriaFiltroDescricao = categoria.descricao;

        $scope.filtrar();
    }
    $scope.filtrar = function(){
        $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

        $http({
            method: "POST",
            url: app.configApp.api.url + "produto_search",
            data: {
                marcas:    $scope.filtros[0],
                generos:   $scope.filtros[1],
                cores:     $scope.filtros[2],
                tamanhos:  $scope.filtros[3],
                categoria: $scope.categoriaFiltroId
            },
            transformRequest: function(obj) {
                var str = [];
                for(var p in obj)
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                return str.join("&");
            }

        }).then(function mySucces(response) {
            $scope.produtos = response.data;
            console.log(response.data);

        }, function myError(response) {
            $scope.error = response.statusText;
        });
    }
    $scope.filtrar();
})

.controller('ProdutoCtrl', function ($scope, $location, $http, $routeParams) {

    $http({
        method: "GET",
        url: app.configApp.api.url + "produto/" + $routeParams.id

    }).then(function mySucces(response) {
        this.produto = response.data;

    }, function myError(response) {
        $scope.error = response.statusText;
    });

    $scope.activetab = $location.path();
})


.controller('BuscaCategoriaCtrl', function ($scope, $location, $http, $routeParams) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
    //console.log($scope.marcas);
    $http({
        method: "POST",
        url: app.configApp.api.url + "produto_search",
        data: {idCategoria: $routeParams.id},
        transformRequest: function(obj) {
            var str = [];
            for(var p in obj)
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            return str.join("&");
        }

    }).then(function mySucces(response) {
        $scope.produtos = response.data;

    }, function myError(response) {
        $scope.error = response.statusText;
    });

    $scope.activetab = $location.path();
})

.controller('LoginCtrl', function ($scope, $location, $http, $routeParams) {
    $scope.loginError ="";
    $scope.login = function(){

            $http({
            method: "GET",
            url: app.configApp.api.url + "sessao/login/" + $scope.form_login.email + "/" + $scope.form_login.senha,
            data: $scope.form_login

        }).then(function mySucces(response) {
            if(response.data.status){
                $scope.loginSuccess = response.data.message;

                $location.path("IndexCtrl");
            }else{
                $scope.loginError = response.data.message;
            }
        }, function myError(response) {
            $scope.loginError = response.statusText;
        });
    }

    $scope.activetab = $location.path();
});
function getIdsFromCheckbox(checkboxs){
    var ids = [];
    for(var i = 0; i < checkboxs.length; i++){
        ids[i] = checkboxs[i]['id'];
    }
    return ids;
}
//CVerifica status da sessao
function verificaSessao($scope, $http){
    $http({
        method: "GET",
        url: app.configApp.api.url + "sessao"

    }).then(function mySucces(response) {
        $scope.sessionStatus = response.data.status;

    }, function myError(response) {
        $scope.sessionStatus = false;
    });
}

//Carrega produtos da api e inseri no escopo
function loadProdutos($scope, $http){
    $http({
        method: "GET",
        url: app.configApp.api.url + "produto"

    }).then(function mySucces(response) {
        $scope.produtos = response.data;

    }, function myError(response) {
        $scope.error = response.statusText;
    });
}
//Carrega marcas da api e inseri no escopo
function loadCategorias($scope, $http){
    $http({
        method: "GET",
        url: app.configApp.api.url + "categoria"

    }).then(function mySucces(response) {
        $scope.categorias = response.data;

    }, function myError(response) {
        $scope.error = response.statusText;
    });
}
//Carrega marcas da api e inseri no escopo
function loadMarcas($scope, $http){
    $http({
        method: "GET",
        url: app.configApp.api.url + "marca"

    }).then(function mySucces(response) {
        $scope.marcas = response.data;

    }, function myError(response) {
        $scope.error = response.statusText;
    });
}
//Carrega tamanhos da api e inseri no escopo
function loadTamanhos($scope, $http){
    $http({
        method: "GET",
        url: app.configApp.api.url + "tamanho"

    }).then(function mySucces(response) {
        $scope.tamanhos = response.data;

    }, function myError(response) {
        $scope.error = response.statusText;
    });
}
function loadGeneros($scope, $http){
    $http({
        method: "GET",
        url: app.configApp.api.url + "genero"

    }).then(function mySucces(response) {
        $scope.generos = response.data;

    }, function myError(response) {
        $scope.error = response.statusText;
    });
}
function loadCores($scope, $http){
    $http({
        method: "GET",
        url: app.configApp.api.url + "cor"

    }).then(function mySucces(response) {
        $scope.cores = response.data;

    }, function myError(response) {
        $scope.error = response.statusText;
    });
}