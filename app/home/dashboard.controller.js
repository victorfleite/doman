(function () {

  'use strict';

  angular
    .module('app')
    .controller('DashboardController', dashboardController);

  dashboardController.$inject = ['$rootScope', '$scope', 'authService', 'alunoService', '$location', '$timeout', '$log'];

  function dashboardController($rootScope, $scope, authService, alunoService, $location, $timeout, $log) {

    var vm = this;
    vm.alunos = [];
    vm.auth = authService;
    vm.profile;

    var check = $timeout(checkAuth, 500);
    function checkAuth() {
      $log.log('verifica se esta logado')
      check = $timeout(checkAuth, 500);
      if(authService.isAuthenticated()){
        $log.log('cancelei o check')
        $timeout.cancel(check);
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
    }
    function getAlunos(){
      alunoService.getAlunos(vm.profile.email).then(function(resultado){
          vm.alunos = resultado.data.retorno;
      });
    }

  }

})();