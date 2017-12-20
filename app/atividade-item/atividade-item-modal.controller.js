(function () {

    'use strict';

    angular.module('app')
        .controller('AtividadeItemModalController', atividadeItemModalController);

    function atividadeItemModalController($scope, $uibModalInstance, log, educador, aluno, grupo, atividade, items, ngAudio, hotkeys, atividadeService) {

        var slides = $scope.slides = [];
        $scope.items = items;
        $scope.atividade = atividade;
        $scope.audio_play = true;
           
        atividadeService.setHistoricoAtividadeAluno(educador.id, aluno.aluno_id, grupo.grupo_id, atividade.atividade_id);

        $scope.addSlide = function (image, id) {
            slides.push({
                image: image,
                text: ['', '', '', ''][slides.length],
                id: id
            });
        };

        for (var i = 0; i < $scope.items.length; i++) {            
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
})();   