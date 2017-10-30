(function () {

    'use strict';

    angular
        .module('app')
        .controller('AtividadeItemController', atividadeItemController);

    atividadeItemController.$inject = ['$scope', 'authService'];

    function atividadeItemController($scope, authService) {

        // GRAFICO PIZZA
        $scope.percent = 65;
        $scope.options = {
            /*percent: 65,*/
            lineWidth: 10,
            trackColor: '#e8eff0',
            barColor: '#27c24c',
            scaleColor: '#e8eff0',
            size: 188,
            lineCap: 'butt',
            animate: 1000
        };


        // RATING
        $scope.rate = 5;
        $scope.max = 5;
        $scope.isReadonly = false;
      
        $scope.hoveringOver = function(value) {
          $scope.overStar = value;
          //$scope.percentRating = 100 * (value / $scope.max);
        };

    }

})();