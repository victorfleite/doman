'use strict';

app.service('localService',['$http','$log','utilService',function($http, $log, utilService) {
	this.getLocalList = function() {
                return $http({
                    method: 'GET',
                    url: 'mapa/json/locais.json'
                });               
	};			

} ]);