(function () {

  'use strict';

  angular
    .module('app')
    .service('grupoService', grupoService);

    grupoService.$inject = ['$http', '$state', '$log', 'CONSTANTES'];

  function grupoService($http, $state, $log, CONSTANTES) {

    var getAtividades = function(aluno, grupo){
      var params = {"aluno_id" : aluno, 'grupo_id': grupo};
      var url = CONSTANTES.API + '/service/get-atividades';
      return $http.post(url, params);
    }

    return {
      getAtividades: getAtividades
    }
  }
})();
