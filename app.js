/**
 * Created by Familia on 23/08/2016.
 */
var app = angular.module('app', [
    'ngRoute'
]);

//Añade aquí las constantes

app.config(['$routeProvider', function ($routeProvider) {
    //En este bloque config solo se configuran las rutas

    $routeProvider.when('/', {
        templateUrl: 'main.html',
        controller: 'MainController'
    });

    $routeProvider.otherwise({
        redirectTo: '/'
    });
}])


app.config([function () {
    //Bloque config para configurar el resto de cosas que no son las rutas.
}])

app.run([function () {

}]);