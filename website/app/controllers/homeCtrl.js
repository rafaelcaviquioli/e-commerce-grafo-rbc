app.controller('HomeCtrl', function ($scope, $http, $location, $localStorage) {
    verificaSessao($scope, $http, $localStorage);
    //URL ATIVA
    $scope.activetab = $location.path();
});