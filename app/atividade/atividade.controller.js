(function () {

  'use strict';

  angular
    .module('app')
    .controller('AtividadeController', atividadeController);

  atividadeController.$inject = ['$scope', 'authService'];

  function atividadeController($scope, authService) {

    var vm = this;
    vm.auth = authService;

   
  }

})();