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
    vm.aluno = selecionadosService.getAluno();
    vm.educador = selecionadosService.getEducador();
    vm.grupos = [];
    $rootScope.loading = false;
    vm.educadorId = $stateParams.educador; 
    vm.alunoId = $stateParams.aluno;

    vm.checkboxes = [];
    
    vm.setSelecionado = function(grupo){
      if(grupo.status == 1){
        var params = {aluno: vm.alunoId, grupo: grupo.grupo_id};      
        selecionadosService.setGrupo(grupo);
        $state.go('atividades', params);
      }      
    }
    
    $rootScope.loading = true;
    alunoService.getGrupos(vm.educadorId, vm.alunoId).then(function(resultado){
        vm.grupos = resultado.data.retorno;        
        for (var i = 0; i < vm.grupos.length; i++) {
          var grupo = vm.grupos[i];
          vm.checkboxes.push((grupo.status));          
        }
        $log.log(vm.checkboxes);
        $rootScope.loading = false;        
    });

    vm.verificaTipoEducador = function(){
      switch (vm.educador.tipo) {
        case 2: // PROFESSOR
          return true; 
          break;      
        case 3: // ORIENTADOR PEDAGOGICO
          return true;
          break;
      }
      return false;
    }
    $scope.$watchCollection('vm.checkboxes', function(statusListNew, statusListOld) {
      var out = [];
      for (var i = 0; i < vm.grupos.length; i++) {
        var grupo = vm.grupos[i];
        grupo.status = statusListNew[i];
        out.push(grupo);
      }
      $rootScope.loading = true;  
      alunoService.setGruposStatusAluno(vm.educadorId, vm.alunoId, out).then(function(resultado){
        $rootScope.loading = false; 
      });
    });


}

})();