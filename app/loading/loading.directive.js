(function () {

    'use strict';

    angular
        .module('app')
        .directive('loading', loading);
    loading.$inject = [];
    function loading() {
        return {
            restrict: 'E',
            replace: true,
            template: '<div class="loading"><img src="assets/loading.svg" alt="loading"></div>',
            link: function (scope, element, attr) {
                scope.$watch('loading', function (val) {
                    if (val)
                        $(element).show();
                    else
                        $(element).hide();
                });
            }
        }
    }

})();