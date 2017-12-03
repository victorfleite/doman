(function () {

    'use strict';

    angular.module('app')
        .controller('ModalInstanceCtrl', modalInstanceCtrl);

    function modalInstanceCtrl($scope, $uibModalInstance, log, atividade, items, ngAudio, hotkeys) {

        var slides = $scope.slides = [];
        $scope.items = items;
        $scope.atividade = atividade;
        $scope.audio_play = true;

        $scope.addSlide = function (image, id) {
            var newWidth = 800 + slides.length + 1;
            slides.push({
                image: image,
                text: ['', '', '', ''][slides.length % 4],
                id: id
            });
        };

        for (var i = 0; i < items.length; i++) {
            $scope.addSlide(items[i].imagem_caminho, i);
        }


        $scope.myInterval = 0;
        $scope.noWrapSlides = false;
        $scope.active = 0;
        $scope.indexCarousel = 0;

        var currIndex = 0;

        $scope.randomize = function () {
            var indexes = generateIndexesArray();
            assignNewIndexesToSlides(indexes);
        };

        // Randomize logic below

        function assignNewIndexesToSlides(indexes) {
            for (var i = 0, l = slides.length; i < l; i++) {
                slides[i].id = indexes.pop();
            }
        }

        function generateIndexesArray() {
            var indexes = [];
            for (var i = 0; i < currIndex; ++i) {
                indexes[i] = i;
            }
            return shuffle(indexes);
        }

        function shuffle(array) {
            var tmp, current, top = array.length;

            if (top) {
                while (--top) {
                    current = Math.floor(Math.random() * (top + 1));
                    tmp = array[current];
                    array[current] = array[top];
                    array[top] = tmp;
                }
            }

            return array;
        }
        $scope.$watch("active", function (newValue) {
            // Play no audio
            if (items[newValue] && items[newValue].sound_player && $scope.audio_play) {
                items[newValue].sound_player.play();
            }
        });

        //log.log(hotkeys);
        hotkeys.add({
            combo: 'right',
            description: 'Próximo',
            callback: function () {
                $scope.carouselNext();
            }
        });
        hotkeys.add({
            combo: 'left',
            description: 'Previo',
            callback: function () {
                $scope.carouselPrev();
            }
        });

        $scope.selected = {
            item: $scope.items[0]
        };

        $scope.ok = function () {
            $uibModalInstance.dismiss('cancel');
        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
        $scope.carouselNext = function () {
            //$('#carousel-main').carousel('next');
        }
        $scope.carouselPrev = function () {
            //$('#carousel-main').carousel('prev');
        }
        $scope.swipeFn = function (side) {
            if (side == 'swipe-left') {
                $scope.carouselNext();
            } else if (side == 'swipe-right') {
                $scope.carouselPrev();
            }
        }


        $scope.setFullScreen = function () {
            if (screenfull.enabled) {
                screenfull.request();
            }
        }

    }


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
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
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