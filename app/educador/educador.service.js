(function () {

  'use strict';

  angular
    .module('app')
    .service('educadorService', educadorService);

  educadorService.$inject = ['$http', '$state', 'CONSTANTES'];

  function educadorService($http, $state, CONSTANTES) {

    var getEducador = function (email) {
      var params = { "email": email };
      var url = CONSTANTES.API + '/service/get-educador';
      return $http.post(url, params);

    }

    return {
      getEducador: getEducador,
    }
  }
})();
