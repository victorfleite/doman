(function () {

  'use strict';

  angular
    .module('app')
    .run(run);

  run.$inject = ['authService', 'Carousel'];

  function run(authService, Carousel) {
    // Handle the authentication
    // result in the hash
    authService.handleAuthentication();
    // Schedule the token to be renewed
    authService.scheduleRenewal();

    Carousel.setOptions({
      arrows: true,
      autoplay: false,
      autoplaySpeed: 3000,
      cssEase: 'ease',
      dots: false,

      easing: 'linear',
      fade: false,
      infinite: true,
      initialSlide: 0,

      slidesToShow: 1,
      slidesToScroll: 1,
      speed: 500,
    });
    
  }

})();