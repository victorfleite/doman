(function () {

  'use strict';

  angular
    .module('app')
    .controller('HomeController', homeController);

  homeController.$inject = ['authService'];

  function homeController(authService) {

    var vm = this;
    vm.auth = authService;

    vm.profile;
    if (authService.getCachedProfile()) {
      vm.profile = authService.getCachedProfile();
    } else {
      authService.getProfile(function (err, profile) {
        vm.profile = profile;
        $scope.$apply();
      });
    }

  }

})();