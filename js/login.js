$('.header-mobile-burger').click(function() {
  $('.header-mobile-nav').slideToggle();
  $(this).toggleClass('active');
});

$('.checkAll').click(function() {
  if($(this).prop('checked')){
    $('.join-member-wrap input[type="checkbox"]:not(".checkAll")').prop('checked', true);
  }else{
    $('.join-member-wrap input[type="checkbox"]:not(".checkAll")').prop('checked', false);
  }
});