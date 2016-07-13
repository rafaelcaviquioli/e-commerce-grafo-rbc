app.controller('IndexCtrl', function ($scope, $http, $location, $localStorage, $window) {
    $scope.sessionStatus;
    $scope.produtos;

    $scope.categoriaFiltroDescricao = "Categoria";
    verificaSessao($scope, $http, $localStorage);
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

        }, function myError(response) {
            $scope.error = response.statusText;
            $scope.produtos = "";
        });
    }
    $scope.filtrar();

    $scope.logout = function(){
        $localStorage.$reset();
        $window.location.href = '/';
    }
});