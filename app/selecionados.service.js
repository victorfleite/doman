(function () {

    'use strict';

    angular
        .module('app')
        .service('selecionadosService', selecionadosService);

    selecionadosService.$inject = [
        '$log',
        '$localStorage'
    ];

    function selecionadosService(
        $log,
        $localStorage
    ) {
        this.setAluno = function (aluno) {
            $localStorage.aluno = JSON.stringify(aluno);
        }
        this.setGrupo = function (grupo) {
            $localStorage.grupo = JSON.stringify(grupo);
        }
        this.setAtividade = function (atividade) {
            $localStorage.atividade = JSON.stringify(atividade);
        }
        this.getAluno = function () {
            return JSON.parse($localStorage.aluno);
        }
        this.getGrupo = function () {
            return JSON.parse($localStorage.grupo);
        }
        this.getAtividade = function () {
            return JSON.parse($localStorage.atividade);
        }

    };

})();

