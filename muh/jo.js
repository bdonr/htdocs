var app = angular.module('app1',['ngRoute']);
app.config(function ($routeProvider) {

    $routeProvider.when('#!/', {
        templateUrl: '/muh/index.html',
        controller: 'logincontroller'
    }).when('/index2', {
        templateUrl: '/muh/index2.html',
        controller: 'indexcontroller'
    }).otherwise({
        redirectTo: "/"
    });

    app.controller('logincontroller',function($scope,$location){
        $scope.login = true;
        $scope.submit = function () {
            f($scope.name.toLowerCase() == "DON".toLowerCase())
                $location.path('/index2');
            }
            else {
                $scope.kk = "nope";
            }
        }
    });

    app.controller('indexcontroller',function($scope,$location){

    });
});



