(function () {

  'use strict';

  angular
    .module('app')
    .controller('AtividadeController', atividadeController);

  atividadeController.$inject = ['$rootScope', '$scope', 'authService'];

  function atividadeController($rootScope, $scope, authService) {

    var vm = this;
    vm.auth = authService;

    $rootScope.loading = false;

  }

})();