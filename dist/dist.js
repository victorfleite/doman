!function(o,t,n){"use strict";var e=angular.module("domanApp",["ngRoute","angularModalService"]).constant("LOADER",{LOADED_CLASS:"pace-done",LOADING_CLASS:"pace-progress"}).constant("CONSTANTES",{VIEW_FOLDER:"app"}).config(["$logProvider","CONSTANTES","$routeProvider",function(o,t,n){}]).run(["$log","$rootScope","CONSTANTES",function(o,t,n){}]);e.controller("mainController",["$rootScope","$scope","$log","CONSTANTES",function(o,t,n,e){}]),e.directive("tooltip",["$log",function(o){return{restrict:"A",scope:{tooltip:"="},link:function(o,t,n){var e=o.tooltip||{};$(t).tooltipster({position:e.position,theme:e.theme||"tooltipster-default",touchDevices:!1,trigger:"hover",content:angular.element("<span><strong>"+e.title+"</strong></span>")})}}}])}(window,document);