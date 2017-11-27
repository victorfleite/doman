(function () {

  'use strict';

  angular
    .module('app')
    .service('alunoService', alunoService);

    alunoService.$inject = ['$http', '$state', 'CONSTANTES'];

  function alunoService($http, $state, CONSTANTES) {

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

    return {
      getAlunos: getAlunos,
      getGrupos: getGrupos
    }
  }
})();
