(function () {

    'use strict';

    angular
        .module('app')
        .controller('MainController', mainController);
    mainController.$inject = ['$rootScope', 'authService'];
    function mainController($rootScope, authService) {

        var vm = this;
        vm.auth = authService;

    }

})();