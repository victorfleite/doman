(function () {

    'use strict';

    angular.module('app')
        .controller('AtividadeItemCartoesModalController', atividadeItemCartoesModalController);

    function atividadeItemCartoesModalController($scope, $uibModalInstance, rootScope, log, queue, atividadeService, educador, aluno, grupo, atividade) {

        $scope.cartoes = [];
        $scope.educador = educador;
        $scope.aluno = aluno;
        $scope.grupo = grupo;
        $scope.atividade = atividade;
        
        rootScope.loading = true;
        queue.all([
             atividadeService.getAtividade(aluno.aluno_id, grupo.grupo_id, atividade.atividade_id),
        ]).then(function (result) {
              var atividade = result[0].data.retorno;
              log.log(atividade);
              $scope.cartoes = atividade.cartoes;         
              rootScope.loading = false;
        });

        $scope.getLabelConvocacao = function(status){
            if(status){
                return 'Convocado';
            }
            return 'Nao convocado';
        }

        $scope.getLabelConhecido = function(status){
            if(status){
                return 'Conhecido';
            }
            return 'Nao conhecido';
        }
                
        $scope.ok = function () {
            $uibModalInstance.dismiss('cancel');
        };

    }
})();   