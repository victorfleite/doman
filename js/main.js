// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
 
$("#alertas header").idTabs(function(id,list,set){ 
	$("a",set).removeClass("selected") 
	.filter("[href='"+id+"']",set).addClass("selected"); 
	for(i in list) 
		$(list[i]).hide(); 
		$(id).fadeIn(); 
	return false; 
}); 


// ------------------------------------------------------------------
// modal
// ------------------------------------------------------------------ 

/*
(function() {

	var dlgtrigger = document.querySelector( '[data-dialog]' ),
		somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) ),
		dlg = new DialogFx( somedialog );

	dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

})();
*/





// ------------------------------------------------------------------
// mobile
// ------------------------------------------------------------------ 

$(document).ready(function() {

	$( '#hamburguerMenu' ).click( function(){
		if( $(this).hasClass('open') ){
			$('#menuMobile').removeClass( "open" );
			$(this).removeClass('open');
		}else{
			$('#menuMobile').addClass( "open" );
			$(this).addClass('open');
		}
		return false
	});

	$( '#menuMobile nav a' ).click( function(){
		$('#menuMobile').removeClass( "open" );
		return false
	});

});

// ------------------------------------------------------------------
// Toggle grid sorting
// ------------------------------------------------------------------ 

/*
$(function () {
	$('.headerAffected th').on('click', function (e) {
		$(this).addClass('active').siblings().removeClass('active');
		alert('ola');
	});
});

*/

// ------------------------------------------------------------------
// Toggle with classie! 
// ------------------------------------------------------------------ 

/*
var previsaoExpand = document.getElementById( 'previsaoExpand' ),
		previsao = document.getElementById( 'previsao' ),
		body = document.body;

previsaoExpand.onclick = function() {
	classie.toggle( this, 'active' );
	classie.toggle( previsao, 'open' );
	disableOther( 'previsaoExpand' );
};

function disableOther( button ) {
	if( button !== 'previsaoExpand' ) {
		classie.toggle( previsaoExpand, 'disabled' );
	}
}
*/