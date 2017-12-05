(function () {

    'use strict';

    angular
        .module('app')
        .controller('AtividadeItemController', atividadeItemController);

    atividadeItemController.$inject = [
        '$scope',
        'authService',
        '$uibModal',
        '$document',
        'selecionadosService',
        '$log',
        'ngYoutubeEmbedService',
        'ngAudio',
        '$state',
        'hotkeys',
        'CONSTANTES',
    ];

    function atividadeItemController(
        $scope,
        authService,
        $uibModal,
        $document,
        selecionadosService,
        $log,
        ngYoutubeEmbedService,
        ngAudio,
        $state,
        hotkeys,
        CONSTANTES,
    ) {
        //$log.log(hotkeys);

        var vm = this;
        vm.path = CONSTANTES.PATH_IMAGENS;
        vm.educador = selecionadosService.getEducador();
        vm.aluno = selecionadosService.getAluno();
        vm.grupo = selecionadosService.getGrupo();
        vm.atividade = selecionadosService.getAtividade();
        

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
                    atividade: function () {
                        return vm.atividade;
                    },
                    items: function () {
                        return $scope.slides;
                    },
                    hotkeys: function () {
                        return hotkeys;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
            }, function () {
                var params = { aluno: vm.aluno.aluno_id, grupo: vm.grupo.grupo_id, atividade: vm.atividade.atividade_id  };
                $state.go('atividade-item', params);
            });
        };

    }




})();