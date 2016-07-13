app.controller('CarrinhoCtrl', function ($scope, $http, $location, $localStorage) {

    $scope.adicionarCarrinho = function(produto, qtd){
        if($localStorage.carrinho == undefined){
            $localStorage.carrinho = [];
        }

        $localStorage.carrinho.push({produto: produto, qtd: qtd});

        $scope.atualizarCarrinho();
    }

    $scope.atualizarCarrinho = function(){
        $scope.carrinhoQtd = 0;
        $scope.carrinhoTotal = 0;

        var total = 0;
        angular.forEach($localStorage.carrinho, function(value, key) {
            $scope.carrinhoQtd += value.qtd;
            total = (parseFloat($scope.carrinhoTotal) + parseFloat(value.produto.valor));
        });
        $scope.carrinhoTotal = "R$ " + total.toFixed(2);
    }
    $scope.atualizarCarrinho();
});