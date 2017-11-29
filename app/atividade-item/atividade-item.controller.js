(function () {

    'use strict';

    angular.module('app')
        .controller('ModalInstanceCtrl', modalInstanceCtrl);

    function modalInstanceCtrl($scope, $uibModalInstance, items) {

        var slides = $scope.slides = [];
        $scope.items = items;


        $scope.addSlide = function (image, id) {
            var newWidth = 800 + slides.length + 1;
            slides.push({
                image: image,
                text: ['', '', '', ''][slides.length % 4],
                id: id
            });
        };

        for (var i = 0; i < items.length; i++) {
            $scope.addSlide(items[i].image, i);
        }


        $scope.myInterval = 0;
        $scope.noWrapSlides = false;
        $scope.active = 0;

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

        // http://stackoverflow.com/questions/962802#962890
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

        $scope.selected = {
            item: $scope.items[0]
        };

        $scope.ok = function () {
            $uibModalInstance.close($scope.selected.item);
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
        $scope.carouselNext = function () {
            $('#carousel-main').carousel('next');
        }
        $scope.carouselPrev = function () {
            $('#carousel-main').carousel('prev');
        }
        $scope.swipeFn = function (side) {
            if (side == 'swipe-left') {
                $scope.carouselPrev();
            } else if (side == 'swipe-right') {
                $scope.carouselNext();
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
        'alunoService',
        '$log',
        'ngYoutubeEmbedService',
        'CONSTANTES'
    ];

    function atividadeItemController(
        $scope,
        authService,
        $uibModal,
        $document,
        selecionadosService,
        alunoService,
        $log,
        ngYoutubeEmbedService,
        CONSTANTES
    ) {

        var vm = this;
        vm.path = CONSTANTES.PATH_IMAGENS;
        vm.atividade = selecionadosService.getAtividade();

        vm.getAutoPlay = function(){
            return 'autoplay';
        }
        $log.log(vm.atividade);

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

        // MODAL ATIVIDADES

        $scope.slides = [
            { image: 'assets/img/01.png' },
            { image: 'assets/img/02.png' },
            { image: 'assets/img/03.png' },
            { image: 'assets/img/04.png' },
            { image: 'assets/img/05.png' }
        ]

        $scope.open = function (size, parentSelector) {

            var parentElem = parentSelector ?
                angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
            var modalInstance = $uibModal.open({
                animation: false,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                controllerAs: '$scope',
                size: size,
                appendTo: parentElem,
                resolve: {
                    items: function () {
                        return $scope.slides;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                $scope.selected = selectedItem;
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

    }




})();