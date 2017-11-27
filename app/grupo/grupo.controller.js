(function () {

  'use strict';

  angular
    .module('app')
    .controller('GrupoController', grupoController);

    grupoController.$inject = [
      '$rootScope', 
      '$scope', 
      'authService',
      'selecionadosService',
      '$state',
      '$stateParams', 
      '$log',
      'alunoService',
      'CONSTANTES'
    ];

  function grupoController(
    $rootScope, 
    $scope, 
    authService, 
    selecionadosService,
    $state,
    $stateParams, 
    $log,
    alunoService,
    CONSTANTES
  ) {

    var vm = this;
    vm.path = CONSTANTES.PATH_IMAGENS;
    vm.auth = authService;
    vm.alunoService = selecionadosService;
    vm.grupos = [];
    $rootScope.loading = false;
    vm.educador = $stateParams.educador; 
    vm.aluno = $stateParams.aluno;
    
    vm.setSelecionado = function(grupo){
      var params = {aluno: vm.aluno, grupo: grupo.grupo_id};      
      selecionadosService.setGrupo(grupo);
      $state.go('atividades', params);
    }
    
    $rootScope.loading = true;
    alunoService.getGrupos(vm.educador, vm.aluno).then(function(resultado){
        vm.grupos = resultado.data.retorno; 
        $rootScope.loading = false;        
    });



}

})();