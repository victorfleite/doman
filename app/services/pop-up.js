'use strict';

app.service('popUpService', ['$log', 'ModalService', function ($log, modalService) {

        var modalUnica = {};

        this.isEmpty = function (object) {
            if (angular.equals({}, object))
                return true;
            else
                return false;

        }

        this.showSingletonModal = function (params, callback, callbackError) {

            if (this.isEmpty(modalUnica)) {

                modalService.showModal({
                    templateUrl: params.templateUrl,
                    controller: params.controller,
                    inputs: params.inputs,
                }).then(function (modal) {
                    modal.close.then(function (result) {
                        modalUnica = {};
                    });
                    callback(modal);
                }).catch(function (error) {
                    // error contains a detailed error message.
                    callbackError(error);
                });

                modalUnica = {'modalId': Math.floor((Math.random() * 100000) + 1)};
            }
        }

    }]);

