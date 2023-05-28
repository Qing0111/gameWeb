$('.header-mobile-burger').click(function() {
  $('.header-mobile-nav').fadeToggle();
  $(this).toggleClass('active');
});

$('.header-mobile-nav-list > span').click(function(e) {
  // e.preventDefault();

  $(this).toggleClass('active').find('.header-mobile-nav-list-drop-down').slideToggle();
});



$('.banner-wrap').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  autoplay:true,
  autoplaySpeed: 2000,
});