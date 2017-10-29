(function () {

    'use strict';

    angular
        .module('app')
        .controller('AtividadeItemController', atividadeItemController);

    atividadeItemController.$inject = ['$scope', 'authService'];

    function atividadeItemController($scope, authService) {

        var vm = this;
        vm.auth = authService;


    }

})();