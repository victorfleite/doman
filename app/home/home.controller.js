(function () {

  'use strict';

  angular
    .module('app')
    .controller('HomeController', homeController);

  homeController.$inject = ['authService', '$location', 'loadingService'];

  function homeController(authService, $location, loadingService) {

    var vm = this;
    vm.auth = authService;

    vm.profile;
  
    loadingService.disableLoading();
    $location.path("/atividade");

  }

})();