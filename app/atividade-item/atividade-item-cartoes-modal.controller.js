(function () {

    'use strict';

    angular.module('app')
        .controller('AtividadeItemCartoesModalController', atividadeItemCartoesModalController);

    function atividadeItemCartoesModalController($scope, $uibModalInstance, log, educador, aluno, grupo, atividade, items) {

        var slides = $scope.slides = [];
        $scope.items = items;
        log.log('modal');

        $scope.ok = function () {
            $uibModalInstance.dismiss('cancel');
        };

    }
})();   