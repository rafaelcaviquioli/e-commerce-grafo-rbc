app.controller('LoginCtrl', function ($scope, $location, $http, $routeParams, $localStorage, $window) {
    $scope.loginError ="";

    $scope.login = function(){

        $http({
            method: "GET",
            url: app.configApp.api.url + "sessao/login/" + $scope.form_login.email + "/" + $scope.form_login.senha,
            data: $scope.form_login

        }).then(function mySucces(response) {
            if(response.data.status){
                $scope.loginSuccess = response.data.message;
                $localStorage.usuario = response.data.usuario;

                verificaSessao($scope, $http, $localStorage);
                $window.location.href = '/';
            }else{
                $scope.loginError = response.data.message;
            }
        }, function myError(response) {
            $scope.loginError = response.statusText;
        });
    }

    $scope.cadastro = function(){
        $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

        $http({
            method: "POST",
            url: app.configApp.api.url + "usuario",
            data: $scope.form_cadastro,
            transformRequest: function(obj) {
                var str = [];
                for(var p in obj)
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                return str.join("&");
            }

        }).then(function mySucces(response) {
            if(response.data.status){
                $scope.cadastroSuccess = response.data.message;
                $scope.form_cadastro.nome = "";
                $scope.form_cadastro.email = "";
                $scope.form_cadastro.senha = "";
                $scope.form_cadastro.confirmarSenha = "";

                $('#email').focus();
            }else{
                $scope.cadastroError = response.data.message;
            }
        }, function myError(response) {
            $scope.cadastroError = response.statusText;
        });
    }

    $scope.activetab = $location.path();
});