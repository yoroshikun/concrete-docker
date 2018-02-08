(function($) {
var window_width = $( window ).width();

$( window ).resize(function() {
 window_width = $( window ).width();
});

var scroll = $(window).scrollTop();
console.log(scroll);
if (scroll > 0){
var padding = 45 - scroll;
if (padding <= 0){padding = 0};
$(".header-large").css('padding-top', padding);
var margin = 120 - scroll;
if (margin <= 75){ margin = 75};
$(".main").css('margin-top', margin);
}else{
$(".header-large").css('padding-top', 45);
$(".main").css('margin-top','120px');
}

$( window ).scroll(function() {
if (window_width >= 992){
  var scroll = $(window).scrollTop();
  console.log(scroll);
  if (scroll > 0){
  var padding = 45 - scroll;
  if (padding <= 0){padding = 0};
  $(".header-large").css('padding-top', padding);
  var margin = 120 - scroll;
  if (margin <= 75){ margin = 75};
  $(".main").css('margin-top', margin);
  }else{
  $(".header-large").css('padding-top', 45);
  $(".main").css('margin-top','120px');

}

var scroll = $(window).scrollTop();
console.log(scroll);
if (scroll > 0){
var padding = 45 - scroll;
if (padding <= 0){padding = 0};
$(".header-large").css('padding-top', padding);
var margin = 120 - scroll;
if (margin <= 75){ margin = 75};
$(".main").css('margin-top', margin);
}else{
$(".header-large").css('padding-top', 45);
$(".main").css('margin-top','120px');
}
}else{
  $(".header-large").css('padding-top', 0);
  $(".main").css('margin-top',0);
}});

})(jQuery);
