(function () {

  'use strict';

  angular
    .module('app')
    .controller('StaticPageController', staticPageController);

    staticPageController.$inject = ['$rootScope', 'authService'];

  function staticPageController($rootScope, authService) {
    var vm = this;
    $rootScope.menuHeaderOpen = true;
    $rootScope.menuFooterOpen = true;
    vm.auth = authService;

    

  }

})();