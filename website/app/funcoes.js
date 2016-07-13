function getIdsFromCheckbox(checkboxs){
    var ids = [];
    for(var i = 0; i < checkboxs.length; i++){
        ids[i] = checkboxs[i]['id'];
    }
    return ids;
}
//CVerifica status da sessao
function verificaSessao($scope, $http, $localStorage){
    if($localStorage.usuario){
        $scope.sessionStatus = true;
    }
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
function findRbc($scope, $http, id){
    $http({
        method: "GET",
        url: app.configApp.api.url + "find-rbc/" + id

    }).then(function mySucces(response) {
        $scope.produtosRelacionados = response.data;

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
function registrarVisita(id, $scope, $http, $localStorage){
    $http({
        method: "GET",
        url: app.configApp.api.url + "produto/visita/" + id + "/" + $localStorage.usuario.token
    });
}