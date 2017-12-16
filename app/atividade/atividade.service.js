(function () {

  'use strict';

  angular
    .module('app')
    .service('atividadeService', atividadeService);

  atividadeService.$inject = ['$http', '$state', '$log', 'CONSTANTES'];

  function atividadeService($http, $state, $log, CONSTANTES) {

    var getAtividade = function (aluno, grupo, atividade) {
      var params = { "aluno_id": aluno, 'grupo_id': grupo, 'atividade_id':atividade };
      var url = CONSTANTES.API + '/service/get-atividade';
      return $http.post(url, params);
    }

    var setHistoricoAtividadeAluno = function (educador, aluno, grupo, atividade) {
      var params = { "educador_id": educador, "aluno_id": aluno, "grupo_id": grupo, "atividade_id": atividade };
      var url = CONSTANTES.API + '/service/set-historico-atividade-aluno';
      return $http.post(url, params);
    }

    var getHistoricoAtividadeAluno = function (educador, aluno, grupo, atividade) {
      var params = { "educador_id": educador, "aluno_id": aluno, "grupo_id": grupo, "atividade_id": atividade };
      var url = CONSTANTES.API + '/service/get-historico-atividade-aluno';
      return $http.post(url, params);
    }

    return {
      getAtividade: getAtividade,
      setHistoricoAtividadeAluno: setHistoricoAtividadeAluno,
      getHistoricoAtividadeAluno: getHistoricoAtividadeAluno
    }
  }
})();
