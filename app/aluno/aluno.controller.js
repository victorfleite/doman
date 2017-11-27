(function () {

  'use strict';

  angular
    .module('app')
    .controller('AlunoController', alunoController);

    alunoController.$inject = [
    '$rootScope', 
    '$scope', 
    'authService', 
    'alunoService', 
    'selecionadosService',
    '$location', 
    '$timeout', 
    '$log',
    '$state',
    'CONSTANTES'
  ];

  function alunoController(
    $rootScope, 
    $scope, 
    authService, 
    alunoService, 
    selecionadosService,
    $location, 
    $timeout, 
    $log,
    $state, 
    CONSTANTES
  ) {
    var vm = this;
    vm.path = CONSTANTES.PATH_IMAGENS;
    vm.alunos = [];
    vm.auth = authService;
    vm.profile;

    vm.setSelecionado = function(aluno){
      var params = {educador: aluno.educador_id, aluno: aluno.aluno_id};      
      selecionadosService.setAluno(aluno);
      $state.go('grupos', params);
    }

    $rootScope.loading = true;
    var check = $timeout(checkAuth, 500);
    function checkAuth() {
      check = $timeout(checkAuth, 500);
      if(authService.isAuthenticated()){
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
          $rootScope.loading = false;        
      });
    }
    

  }
  
})();