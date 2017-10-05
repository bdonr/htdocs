var app = angular.module('xyz', []);
app.controller('indexController', function ($scope) {
    $scope.text = "asdas";
    var x = $scope.groesse;
    alert(x);
    if(x){
        $scope.text = "fick fdich"
    }
    $scope.func = function () {
        return $scope.text;
    };
});