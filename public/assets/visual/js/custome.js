// if($(window).innerWidth() >= 1024){
//     new WOW().init();
// }
// AOS.init({
//   duration: 1000
// });



$(document).ready(function() {

	var cursor = $(".cursor-hover");
	$(window).mousemove(function(e) {
		cursor.css({
			top: e.clientY - cursor.height() / 2,
			left: e.clientX - cursor.width() / 2
		});
	});
	$(".link-hover")
		.mouseenter(function() {
			cursor.css({
				transition: .2,
				width: 40,
				height: 40
			});
		})
		.mouseleave(function() {
			cursor.css({
				transition: .2,
				width: 0,
				height: 0 
			});
		});
});




$(document).ready(function() {

 	$('.left-bar a').click(function(e){
	  e.preventDefault();
	  var target = $($(this).attr('href'));
	  if(target.length){
	    var scrollTo = target.offset().top;
	    $('body, html').animate({scrollTop: scrollTo+'px'}, 800);
	  }
	  $('.left-bar a').removeClass("active");
	  $(this).addClass("active");
	});

 // 	$('.menu_button').click(function(e){
 // 		new WOW().init();
	// });


	// $('.nav-works>ol>li>a').click(function(e) {
	// 	$('.nav-works ul').slideToggle("slow");
	// })

	$('.clc-work, .clc-grid').click(function(e) {
		$('.right_part, .left-item, .main_page_top, .right-part-abs').toggleClass('active');
		$('body, .main_page.wrapper, .slide-top').addClass('active');
		// $('.item-swip').slick('unslick'); 
		$('.left-item').removeClass('scr-top');
		$('.content_page.hidden, .footer-default.hidden, .footer-top.hidden').show();
		new WOW().init();
		$('body').css({
			display: 'unset',
			"padding-top": "10px",
		});
		if ($('.left-item .item-swip').hasClass('slick-slider')) {
            $('.item-swip').slick('unslick');  
        }
	})

	$(".nav-works>ol>li>a").click(function () {
	    $(this).parents().children(".nav-works ul").toggle(300).toggleClass('active');
	    $(this).toggleClass("active");
	    $('.clc-nav').toggleClass("active");
	});

    $(".nav-works>ol>li").click(function () {
        $('.nav-works>ol>li').removeClass('active');
        $(this).toggleClass('active');
    });
	// if(".nav-works ol a") {
	// if($('.nav-works ol a').hasClass('active')) {
	// 	$(".nav-works a ul").show();
	// }

	$(".clc-nav").click(function () {
	    $('.nav-works ul').removeClass('active');
	    $(this).toggleClass('active');
	});

	$(".nav-works ol ul a").click(function () {
	    $('.nav-works ol ul a').removeClass('active');
	    $(this).toggleClass('active');
	});

 })


$(document).on('click', '#menu_button', function () {
	$('#menuDesktop_bg').addClass('active');
	$('#menuDesktop').slideDown();
	$('#menuDesktop .menu_button').addClass('active');
	$('.header').css('opacity', 1)
	$('.aos-init').addClass('aos-animate')
	$('.main_btn').addClass('aos-init aos-animate')
});

$(document).on('click', '.menu_button.active', function () {
	$('#menuDesktop_bg').removeClass('active');
	$('#menuDesktop').slideUp();
	$('#menuDesktop .menu_button').removeClass('active');
	$('.header').css('opacity', 0)
	$('.aos-init').removeClass('aos-animate')
	$('.main_btn').removeClass('aos-init aos-animate')
});


$(document).on('click', '.modal-toggle', function(e) {
  e.preventDefault();

  var slug = $(this).attr('data-link');
  var id = $(this).attr('data-id');

  if (typeof slug !== 'undefined') {
      var linkAPI = slug + '-f' + id + '.html';

      console.log(linkAPI);

      var _cb = function (res) {
          if(res.code){
              $('.js-modal-content').html(res.data);
              $('.modal').toggleClass('is-visible');
              $('body').toggleClass('is-visible');
          }
      };

      $.app.ajax(null, linkAPI, {}, _cb, 'GET', '.alert-submit');
  }
  else {
      $('.modal').toggleClass('is-visible');
      $('body').toggleClass('is-visible');
  }
});


if($(window).innerWidth() <= 1023){
    $('.scroll-work a').click(function(e){
	  e.preventDefault();
	  var target = $($(this).attr('href'));
	  if(target.length){
	    var scrollTo = target.offset().top - 10;
	    $('body, html').animate({scrollTop: scrollTo+'px'}, 800);
	  }
	});
}
