'use strict';

app.directive('tooltip', ['$log', function ($log) {
	return {
		restrict:'A',
		scope:{
			tooltip: '=' 
		},	    		 
		link: function(scope, element, attrs){
			var options = scope.tooltip||{};
			$(element).tooltipster({
				position: options.position,
				//animation: 'fade',
				theme: options.theme || 'tooltipster-default',
				touchDevices: false, 
				trigger: 'hover',
				content: angular.element('<span><strong>'+options.title+'</strong></span>') 
			});						
		}
	} 
}]);

	