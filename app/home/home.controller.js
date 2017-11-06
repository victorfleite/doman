(function () {

  'use strict';

  angular
    .module('app')
    .controller('HomeController', homeController);

  homeController.$inject = ['authService', '$location'];

  function homeController(authService, $location) {

    var vm = this;
    vm.auth = authService;

    vm.profile;
    $location.path("/atividade");

  }

})();