(function () {

  'use strict';

  angular
    .module('app')
    .controller('AtividadeController', atividadeController);

  atividadeController.$inject = [
    '$rootScope',
    '$scope',
    'authService',
    '$state',
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
    $state,
    $stateParams,
    selecionadosService,
    $log,
    grupoService,
    CONSTANTES
  ) {

    var vm = this;
    vm.path = CONSTANTES.PATH_IMAGENS;
    vm.auth = authService;
    vm.educador = selecionadosService.getEducador();
    vm.aluno = selecionadosService.getAluno();
    vm.grupo = selecionadosService.getGrupo();
    vm.atividades = [];
    $rootScope.loading = false;
    vm.alunoId = $stateParams.aluno;
    vm.grupoId = $stateParams.grupo;

    vm.setSelecionado = function (atividade) {
      var params = { aluno: vm.alunoId, grupo: vm.grupoId, atividade: atividade.atividade_id };
      selecionadosService.setAtividade(atividade);
      $state.go('atividade-item', params);
    }

    $rootScope.loading = true;
    grupoService.getAtividades(vm.alunoId, vm.grupoId).then(function (resultado) {
      vm.atividades = resultado.data.retorno;
      $rootScope.loading = false;
    });




  }

})();