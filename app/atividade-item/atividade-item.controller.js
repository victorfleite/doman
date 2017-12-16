(function () {

    'use strict';

    angular
        .module('app')
        .controller('AtividadeItemController', atividadeItemController);

    atividadeItemController.$inject = [
        '$rootScope',
        '$scope',
        'authService',
        '$uibModal',
        '$document',
        'selecionadosService',
        '$log',
        '$q',
        'ngYoutubeEmbedService',
        'ngAudio',
        '$state',
        'hotkeys',
        'atividadeService',
        'CONSTANTES',
    ];

    function atividadeItemController(
        $rootScope,
        $scope,
        authService,
        $uibModal,
        $document,
        selecionadosService,
        $log,
        $q,
        ngYoutubeEmbedService,
        ngAudio,
        $state,
        hotkeys,
        atividadeService,
        CONSTANTES,
    ) {
        //$log.log(hotkeys);

        var vm = this;
        vm.path = CONSTANTES.PATH_IMAGENS;
        vm.educador = selecionadosService.getEducador();
        vm.aluno = selecionadosService.getAluno();
        vm.grupo = selecionadosService.getGrupo();
        vm.atividade = selecionadosService.getAtividade();
        vm.historico = [];


        vm.getAutoPlay = function () {
            return 'autoplay';
        }

        vm.getTemplate = function (tipo) {
            switch (tipo) {
                case 1:
                    return 'app/atividade-item/atividade-item-bit-inteligencia.html';
                    break;
                case 2:
                    return 'app/atividade-item/atividade-item-youtube.html';
                    break;
                case 3:
                    return 'app/atividade-item/atividade-item-mp3.html';
                    break;
                default:
                    throw new Error('O tipo de template não foi definido');
                    break;
            }

        }

        // Historico de Cartoes aplicados
        $rootScope.loading = true;
        $q.all([
            atividadeService.getHistoricoAtividadeAluno(vm.educador.id, vm.aluno.aluno_id, vm.grupo.grupo_id, vm.atividade.atividade_id)
        ])
            .then(function (result) {
                vm.historico = result[0].data.retorno;
                $rootScope.loading = false;
            });


        // GRAFICO PIZZA
        $scope.percent = 65;
        $scope.options = {
            /*percent: 65,*/
            lineWidth: 10,
            trackColor: '#e8eff0',
            barColor: '#27c24c',
            scaleColor: '#e8eff0',
            size: 188,
            lineCap: 'butt',
            animate: 1000
        };


        // RATING
        $scope.rate = 5;
        $scope.max = 5;
        $scope.isReadonly = false;

        $scope.hoveringOver = function (value) {
            $scope.overStar = value;
            //$scope.percentRating = 100 * (value / $scope.max);
        };

        // MODAL ATIVIDADE

        function filtrarAtividadesConvocadas(cartoes) {
            var out = [];
            if (!cartoes) return out;

            for (var i = 0; i < cartoes.length; i++) {
                var e = cartoes[i];
                if (e.status_convocacao == 1) { // Ativo
                    e.imagem_caminho = vm.path + e.imagem_caminho;
                    if (e.som_caminho) {
                        e.sound_player = ngAudio.load(vm.path + e.som_caminho);
                    }
                    out.push(e);
                }
            }
            return out;
        }


        $scope.slides = filtrarAtividadesConvocadas(vm.atividade.cartoes);
        $scope.open = function (size, parentSelector) {

            /*var parentElem = parentSelector ?
                angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
            */
            var modalInstance = $uibModal.open({
                animation: false,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                templateUrl: 'app/atividade-item/atividade-item-modal.html',
                controller: 'AtividadeItemModalController',
                //controllerAs: '$scope',
                size: size,
                //appendTo: parentElem,
                resolve: {
                    log: $log,
                    educador: vm.educador,
                    aluno: vm.aluno,
                    grupo: vm.grupo,
                    atividade: vm.atividade,
                    items: $scope.slides,
                    hotkeys: hotkeys,
                    atividadeService: atividadeService
                }
            });

            modalInstance.result.then(function (selectedItem) {
            }, function () {
                var params = { aluno: vm.aluno.aluno_id, grupo: vm.grupo.grupo_id, atividade: vm.atividade.atividade_id };
                $state.go('atividade-item', params);
            });
        };


        $scope.openCartoes = function (size, parentSelector) {

            /*var parentElem = parentSelector ?
                angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
            */

            var modalInstance = $uibModal.open({
                animation: false,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                templateUrl: 'app/atividade-item/atividade-item-cartoes-modal.html',
                controller: 'AtividadeItemCartoesModalController',
                //controllerAs: '$scope',
                size: size,
                //appendTo: parentElem,
                resolve: {
                    rootScope: $rootScope,
                    log: $log,
                    queue: function(){
                        return $q;
                    },
                    atividadeService: function(){
                        return atividadeService;
                    },
                    educador: vm.educador,
                    aluno: vm.aluno,
                    grupo: vm.grupo,
                    atividade: vm.atividade
                }
            });

            modalInstance.result.then(function (selectedItem) {
            }, function () {
                var params = { aluno: vm.aluno.aluno_id, grupo: vm.grupo.grupo_id, atividade: vm.atividade.atividade_id };
                $state.go('atividade-item', params);
            });

        };


    }




})();