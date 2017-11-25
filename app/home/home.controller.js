(function () {

  'use strict';

  angular
    .module('app')
    .controller('HomeController', homeController);

  homeController.$inject = ['$rootScope', 'authService', 'alunoService', '$location'];

  function homeController($rootScope, authService, alunoService, $location) {

    var vm = this;
    vm.alunos = [];
    vm.auth = authService;
    vm.profile;

    if(vm.auth.isAuthenticated()){
      if (authService.getCachedProfile()) {
        vm.profile = authService.getCachedProfile();
          getAlunos();
      } else {
        authService.getProfile(function(err, profile) {
          vm.profile = profile; 
            getAlunos();
        });
      }
    }
    function getAlunos(){
        //$rootScope.loading = true;
        console.log(vm.profile);
    }

    

  }

})();