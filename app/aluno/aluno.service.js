(function () {

  'use strict';

  angular
    .module('app')
    .service('alunoService', alunoService);

    alunoService.$inject = ['$http', '$state', '$log', 'CONSTANTES'];

  function alunoService($http, $state, $log, CONSTANTES) {

    var getAlunos = function(email){
      var params = {"email" : email};
      var url = CONSTANTES.API + '/service/get-alunos';
      return $http.post(url, params);

    }

    var getGrupos = function(educador, aluno){
      var params = {"educador_id" : educador, "aluno_id": aluno};
      var url = CONSTANTES.API + '/service/get-grupos';
      return $http.post(url, params);
    }

    var setGruposStatusAluno = function(educadorId, alunoId, grupos){
      var params = {"educador_id" : educadorId, "aluno_id" : alunoId, "grupos": grupos};
      var url = CONSTANTES.API + '/service/set-status-grupos-aluno';
      return $http.post(url, params);
    }

    return {
      getAlunos: getAlunos,
      getGrupos: getGrupos,
      setGruposStatusAluno: setGruposStatusAluno
    }
  }
})();
