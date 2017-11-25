(function () {

  'use strict';

  angular
    .module('app')
    .controller('CallbackController', callbackController);

	callbackController.$inject = ['$location'];

  function callbackController($location) {

    //$location.redirect('/dashboard');

  }

})();