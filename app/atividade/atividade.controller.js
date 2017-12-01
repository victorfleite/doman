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
    vm.service = selecionadosService;
    vm.atividades = [];
    $rootScope.loading = false;
    vm.aluno = $stateParams.aluno;
    vm.grupo = $stateParams.grupo;

    vm.setSelecionado = function (atividade) {
      var params = { aluno: vm.aluno, grupo: vm.grupo, atividade: atividade.atividade_id };
      selecionadosService.setAtividade(atividade);
      $state.go('atividade-item', params);
    }

    $rootScope.loading = true;
    grupoService.getAtividades(vm.aluno, vm.grupo).then(function (resultado) {
      vm.atividades = resultado.data.retorno;
      $rootScope.loading = false;
    });




  }

})();