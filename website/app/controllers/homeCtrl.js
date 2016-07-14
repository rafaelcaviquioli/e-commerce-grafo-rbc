app.controller('HomeCtrl', function ($scope, $http, $location, $localStorage) {
    verificaSessao($scope, $http, $localStorage);

    getProdutosRecomendados($scope, $http, $localStorage);
});
function getProdutosRecomendados($scope, $http, $localStorage) {
    if ($scope.sessionStatus != true) {
        return false;
    }
    $http({
        method: "GET",
        url: app.configApp.api.url + "find-produto-grafo/" + $localStorage.usuario.token

    }).then(function mySucces(response) {
        $scope.produtosRecomendados = response.data;

    }, function myError(response) {
        $scope.error = response.statusText;
    });
}