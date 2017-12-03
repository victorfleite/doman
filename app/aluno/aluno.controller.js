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
    vm.educador = selecionadosService.getEducador();
    vm.alunos = [];
    vm.auth = authService;
    vm.profile;

    vm.setSelecionado = function(aluno){
      var params = {educador: aluno.educador_id, aluno: aluno.aluno_id};      
      selecionadosService.setAluno(aluno);
      $state.go('grupos', params);
    }

    vm.getAlunos = function(){     
      var educador = selecionadosService.getEducador();
      alunoService.getAlunos(educador.email).then(function(resultado){
          vm.alunos = resultado.data.retorno; 
          if(vm.alunos.length == 1){
              vm.setSelecionado(vm.alunos[0]);
          }         
          $rootScope.loading = false;        
      });
    };
    
    vm.getAlunos();
  }
  
})();