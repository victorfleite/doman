(function () {

  'use strict';

  angular
    .module('app')
    .controller('AtividadeController', atividadeController);

  atividadeController.$inject = ['$scope', 'authService'];

  function atividadeController($scope, authService) {

    var vm = this;
    vm.auth = authService;

    //====================================
    // Slick 3
    //====================================
    $scope.number3 = [{ label: 1 }, { label: 2 }, { label: 3 }, { label: 4 }, { label: 5 }, { label: 6 }, { label: 7 }, { label: 8 }];
    $scope.slickConfig3Loaded = true;
    $scope.slickConfig3 = {
      method: {},
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    };

  }

})();