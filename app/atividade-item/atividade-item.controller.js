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
        '$filter',
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
        $filter,
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
            atividadeService.getAtividade(vm.aluno.aluno_id, vm.grupo.grupo_id, vm.atividade.atividade_id),
            atividadeService.getHistoricoAtividadeAluno(vm.educador.id, vm.aluno.aluno_id, vm.grupo.grupo_id, vm.atividade.atividade_id)
        ])
            .then(function (result) {

                var atividade = result[0].data.retorno;
                selecionadosService.setAtividade(atividade);
                vm.historico = result[1].data.retorno;
                $rootScope.loading = false;
            });




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
                    e.som_caminho = vm.path + e.som_caminho;
                    out.push(e);
                }
            }
            return out;
        }

        $scope.getPercentage = function () {
            var count = 0;
            var total = $scope.slides.length;
            
            for (var i = 0; i < $scope.slides.length; i++) {
                var e = $scope.slides[i];
                if (e.conhecido == 1) { // Conhecido
                    count++;
                    continue;
                }
            }
            return Math.round((count * 100) / total);
        }


        $scope.slides = filtrarAtividadesConvocadas(vm.atividade.cartoes);


        // GRAFICO PIZZA
        $scope.percent = $scope.getPercentage();
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
                    log: function () {
                        return $log;
                    },
                    filter: function(){
                        return $filter;
                    },
                    educador: function () {
                        return vm.educador;
                    },
                    aluno: function () {
                        return vm.aluno;
                    },
                    grupo: function () {
                        return vm.grupo;
                    },
                    atividade: function () {
                        return vm.atividade;
                    },
                    items: function () {
                        return $scope.slides;
                    },
                    ngAudio: function(){
                        return ngAudio;
                    },
                    hotkeys: function () {
                        return hotkeys;
                    },
                    atividadeService: function () {
                        return atividadeService;
                    },
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
                    queue: function () {
                        return $q;
                    },
                    atividadeService: function () {
                        return atividadeService;
                    },
                    educador: vm.educador,
                    aluno: vm.aluno,
                    grupo: vm.grupo,
                    atividade: vm.atividade
                }
            });

            modalInstance.result.then(function (selectedItem) {
                $state.go($state.current, {}, { reload: true });
            }, function () {
                $state.go($state.current, {}, { reload: true });
            });

           
        };

        vm.setLog = function (tipo) {
            switch (tipo) {
                case 1:
                    break;
                default:
                    atividadeService.setHistoricoAtividadeAluno(vm.educador.id, vm.aluno.aluno_id, vm.grupo.grupo_id, vm.atividade.atividade_id);
                    break;
            }
        }

        // CALL FUNCTIONS
        vm.setLog(vm.atividade.atividade_tipo);



    }




})();