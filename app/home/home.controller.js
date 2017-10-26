(function () {

  'use strict';

  angular
    .module('app')
    .controller('HomeController', homeController);

  homeController.$inject = ['$rootScope', 'authService'];

  function homeController($rootScope, authService) {
    var vm = this;
    $rootScope.menuHeaderOpen = true;
    $rootScope.menuFooterOpen = true;
    vm.auth = authService;

    

  }

})();