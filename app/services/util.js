'use strict';

app.service('utilService', [
    '$rootScope', 'CONSTANTES', '$http', '$log', '$q', '$location',
    function ($rootScope, CONSTANTES, $http, $log, $q, $location) {

        var self = this;

        self.getUrlServidor = function () {
            return CONSTANTES.URL_SERVIDOR.replace('{{HOST}}', $location.host());
        }


        self.retiraAcentos = function (palavra) {
            var com_acento = 'Ã¡Ã Ã£Ã¢Ã¤Ã©Ã¨ÃªÃ«Ã­Ã¬Ã®Ã¯Ã³Ã²ÃµÃ´Ã¶ÃºÃ¹Ã»Ã¼Ã§ÃÃ€ÃƒÃ‚Ã„Ã‰ÃˆÃŠÃ‹ÃÃŒÃŽÃÃ“Ã’Ã•Ã–Ã”ÃšÃ™Ã›ÃœÃ‡';
            var sem_acento = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC';
            var nova = '';
            if (!angular.isUndefined(palavra) && palavra != '') {
                for (var i = 0; i < palavra.length; i++) {
                    try {
                        if (com_acento.search(palavra.substr(i, 1)) >= 0) {
                            nova += sem_acento.substr(com_acento.search(palavra.substr(i, 1)), 1);
                        } else {
                            nova += palavra.substr(i, 1);
                        }
                    } catch (e) {
                        //$log.log(palavra.substr(i, 1));
                    }
                }
            }
            return nova;
        }

       

    }]);