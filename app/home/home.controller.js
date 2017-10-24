(function () {

  'use strict';

  angular
    .module('app')
    .controller('HomeController', homeController);

  homeController.$inject = ['$rootScope', 'authService'];

  function homeController($rootScope, authService) {

    $rootScope.menuHeaderOpen = true;
    $rootScope.menuFooterOpen = true;

    var vm = this;
    vm.auth = authService;

  }

})();