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

// directiva para subir imagenes al servidor
app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

// servicio para subir imagenes al servidor
app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl){
        var fd = new FormData();
        fd.append('file', file);
        $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            })
            .success(function(){
            })
            .error(function(){
            });
    }
}]);

app.controller('controllerApp', ['$scope', 'fileUpload', '$http', function($scope, fileUpload, $http){

    $scope.portafolio = [ ];

    $scope.obtener = function () {
        $http.get('lib/php/main.php')
            .success(function (data) {
                $scope.portafolio = data;
                console.log(data);
            })
            .error(function (data) {
                console.log('Erro:' + data);
            });
    }

    //envio de información por post
    $scope.enviar = function () {

        var file = $scope.myFile;
        console.log('file is ' );
        console.dir(file);
        var uploadUrl = "/fileUpload";
        fileUpload.uploadFileToUrl(file, uploadUrl);

        $http.post('lib/php/main.php', {titulo: $scope.titulo, enlace: $scope.enlace, descripcion: $scope.descripcion} )
            .success(function (data) {
                // $scope.portafolio = data;
                $scope.obtener();
                console.log(data)
            })
            .error(function (data) {
                console.log('Error:' + data);
            });
        $scope.titulo = '';
        $scope.enlace = '';
        $scope.descripcion = '';
    }
    
//    funcion encargada de llamar a los servicios para enviar la imagen adjunta



}]);

app.config([function () {
    //Bloque config para configurar el resto de cosas que no son las rutas.
}])

app.run([function () {

}]);