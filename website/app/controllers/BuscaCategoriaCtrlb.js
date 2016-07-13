app.controller('BuscaCategoriaCtrl', function ($scope, $location, $http, $routeParams) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
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
});