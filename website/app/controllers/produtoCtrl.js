app.controller('ProdutoCtrl', function ($scope, $location, $http, $routeParams) {

    $http({
        method: "GET",
        url: app.configApp.api.url + "produto/" + $routeParams.id

    }).then(function mySucces(response) {
        $scope.produto = response.data;

        findRbc($scope, $http, $scope.produto.id);

    }, function myError(response) {
        $scope.error = response.statusText;
    });

    $scope.adicionarCarrinho = function(id, qtd){
        alert('Id ' + id + ' qtd ' + qtd);
    }

    $scope.activetab = $location.path();
});