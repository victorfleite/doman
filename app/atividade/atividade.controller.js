(function () {

  'use strict';

  angular
    .module('app')
    .controller('AtividadeController', atividadeController);

    atividadeController.$inject = [
      '$rootScope', 
      '$scope', 
      'authService', 
      '$stateParams', 
      'selecionadosService',
      '$log',
      'grupoService',
      'CONSTANTES'
    ];

  function atividadeController(
    $rootScope, 
    $scope, 
    authService, 
    $stateParams,
    selecionadosService, 
    $log,
    grupoService,
    CONSTANTES
  ) {

    var vm = this;
    vm.path = CONSTANTES.PATH_IMAGENS;
    vm.auth = authService;
    vm.alunoService = selecionadosService;
    vm.atividades = [];
    $rootScope.loading = false;
    vm.aluno = $stateParams.aluno; 
    vm.grupo = $stateParams.grupo;
    
    
    $rootScope.loading = true;
    grupoService.getAtividades(vm.aluno, vm.grupo).then(function(resultado){
        vm.atividades = resultado.data.retorno;
        vm.grupo
        $rootScope.loading = false;        
    });



}

})();