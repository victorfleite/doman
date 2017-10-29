(function () {

    'use strict';

    angular
        .module('app')
        .controller('MainController', mainController);
    mainController.$inject = ['$scope', 'authService'];
    function mainController($scope, authService) {

        var vm = this;
        vm.auth = authService;

    }

})();