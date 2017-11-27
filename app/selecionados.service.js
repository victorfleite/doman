(function () {
    
      'use strict';
    
      angular
        .module('app')
        .service('selecionadosService', selecionadosService);        
        
        selecionadosService.$inject = [
            '$log'
        ];
      
      function selecionadosService($log) {
        
        var aluno = {};
        var grupo = {};
        var atividade = {};     

        this.setAluno = function(aluno){
            this.aluno = aluno; 
        }
        this.setGrupo = function(grupo){
            this.grupo = grupo; 
        }
        this.setAtividade = function(atividade){
            atividade = atividade; 
        }    
        this.getAluno = function(){
          return this.aluno;
        }
        this.getGrupo = function(){
            return this.grupo;
        }
        this.getAtividade = function(){
            return this.atividade;
        }

      };

})();     
    
    