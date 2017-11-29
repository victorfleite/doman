(function () {

  'use strict';

  angular
    .module('app', [
      'auth0.auth0',
      'ui.router',
      'easypiechart',
      'ui.bootstrap',
      'ui.carousel',
      'ngTouch',
      'angularScreenfull',
      'ngStorage',
      'ngYoutubeEmbed'
    ])
    .constant('CONSTANTES', {
      PATH_IMAGENS: 'server/backend/web/',
      API: 'http://localhost/doman/server/service/api/www/index.php/v1',
   })
    .config(config);

  config.$inject = [
    '$stateProvider',
    '$locationProvider',
    '$urlRouterProvider',
    'angularAuth0Provider'
  ];

  function config(
    $stateProvider,
    $locationProvider,
    $urlRouterProvider,
    angularAuth0Provider
  ) {

    $stateProvider
      .state('home', {
        url: '/',
        controller: 'HomeController',
        templateUrl: 'app/home/home.html',
        controllerAs: 'vm'
      })
      .state('alunos', {
        url: '/alunos',
        controller: 'AlunoController',
        templateUrl: 'app/aluno/alunos.html',
        controllerAs: 'vm',
        onEnter: checkAuthentication
      })
      .state('profile', {
        url: '/profile',
        controller: 'ProfileController',
        templateUrl: 'app/profile/profile.html',
        controllerAs: 'vm',
        onEnter: checkAuthentication
      })
      .state('callback', {
        url: '/callback',
        controller: 'CallbackController',
        templateUrl: 'app/callback/callback.html',
        controllerAs: 'vm'
      })
      .state('grupos', {
        url: '/grupos/:educador/:aluno',
        controller: 'GrupoController',
        templateUrl: 'app/grupo/grupos.html',
        controllerAs: 'vm',
        onEnter: checkAuthentication
      })
      .state('atividades', {
        url: '/atividades/:aluno/:grupo',
        controller: 'AtividadeController',
        templateUrl: 'app/atividade/atividades.html',
        controllerAs: 'vm',
        onEnter: checkAuthentication
      })
      .state('atividade-item', {
        url: '/atividade/:aluno/:grupo/:atividade',
        controller: 'AtividadeItemController',
        templateUrl: 'app/atividade-item/atividade-item.html',
        controllerAs: 'vm',
        onEnter: checkAuthentication
      })
      .state('doman-sobre', {
        url: '/doman-sobre',
        controller: 'StaticPageController',
        templateUrl: 'app/static-page/doman-sobre.html',
        controllerAs: 'vm'
      })
      .state('doman-filosofia', {
        url: '/doman-filosofia',
        controller: 'StaticPageController',
        templateUrl: 'app/static-page/doman-filosofia.html',
        controllerAs: 'vm'
      });

    function checkAuthentication($transition$) {
      var $state = $transition$.router.stateService;
      var auth = $transition$.injector().get('authService');
      if (!auth.isAuthenticated()) {
        return $state.target('home');
      }
    }
    // Initialization for the angular-auth0 library
    angularAuth0Provider.init({
      clientID: AUTH0_CLIENT_ID,
      domain: AUTH0_DOMAIN,
      responseType: 'token id_token',
      audience: AUTH0_AUDIENCE,
      redirectUri: AUTH0_CALLBACK_URL,
      scope: 'openid email profile'
    });


    $urlRouterProvider.otherwise('/');

    //$locationProvider.hashPrefix('');

    // Comment out the line below to run the app
    // without HTML5 mode (will use hashes in routes)
    //$locationProvider.html5Mode(true);
  }

})();
