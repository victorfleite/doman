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
    '$q',
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
    $q,
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

    $q.all([
      grupoService.getGrupo(vm.alunoId, vm.grupoId),
      grupoService.getAtividades(vm.alunoId, vm.grupoId)])
      .then(function (result) {
        $log.log(result);
        vm.grupo = result[0].data.retorno;
        vm.atividades = result[1].data.retorno;
        $rootScope.loading = false;
    });



  }

})();