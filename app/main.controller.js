(function () {

    'use strict';

    angular
        .module('app')
        .controller('MainController', mainController);
    mainController.$inject = [
        '$rootScope', 
        'authService', 
        'educadorService',
        'selecionadosService', 
        '$timeout'
    ];
    function mainController(
        $rootScope, 
        authService, 
        educadorService,
        selecionadosService, 
        $timeout
    ) {

        var vm = this;
        vm.auth = authService;
        vm.profile = {};

        var check = $timeout(checkAuth, 500);
        function checkAuth() {
          check = $timeout(checkAuth, 500);
          if(authService.isAuthenticated()){
            $rootScope.loading = true;
            $timeout.cancel(check);
            if (authService.getCachedProfile()) {
              vm.profile = authService.getCachedProfile();
              getEducador(vm.profile.email);          
            } else {
              authService.getProfile(function(err, profile) {
                vm.profile = profile;
                getEducador(vm.profile.email);
              });
            }
          }
        }
        function getEducador(email){      
          educadorService.getEducador(email).then(function(resultado){
              selecionadosService.setEducador(resultado.data.retorno);          
              $rootScope.loading = false;        
          });
        }

    }

})();