
$(document).ready(function(){
	// header mobile
	$('.header__nav').clone().removeClass('header__nav').addClass('header__nav--mobile').appendTo('.header__drop-header');

	$('.header__toggle').click(function(){
		$(this).toggleClass('header__toggle--active');
		$('body').toggleClass('body--hidden-mobile');
		$('.header__drop').toggleClass('header__drop--show');
	});

	$('.header__logo, .header__nav--mobile a').on('click', function (event){
		$('.header__toggle').removeClass('header__toggle--active');
		$('body').removeClass('body--hidden-mobile');
		$('.header__drop').removeClass('header__drop--show');
	});

	// target link
	$('.header__nav--mobile .nav__link').on('click', function (event){
		event.preventDefault();
		var id1 = $(this).attr('href'),
			top_1_1 = $(id1).offset().top,
			top_2_1 = top_1_1 - 68;
		$('body, html').animate({scrollTop: top_2_1}, 650);
	});

	// target link
	$('.js-to-scroll, .js-top-top, .header__nav .nav__link').on('click', function (event){
		event.preventDefault();
		var id2 = $(this).attr('href'),
			top_1_2 = $(id2).offset().top,
			top_2_2 = top_1_2 - 87;
		$('body, html').animate({scrollTop: top_2_2}, 650);
	});

	// nav toggle class
	$('.nav__link').hover(function(){
		$('.nav__link').not(this).addClass('nav__link--active');
	}, function () {
		$('.nav__link').removeClass('nav__link--active');
	});

	// technologies tabs
	$('.technologies__item-text').click(function(){
		$(this).parents('.technologies__item').toggleClass('technologies__item--active');
	});

	// modal
	$('a[href="#modal-login"]').click(function(event) {
		event.preventDefault();
		$(this).modal({
			fadeDuration: 400
		});
	});

	// slider SLICK portfolio
	$('.js-portfolio-slider').slick({
		adaptiveHeight: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		arrows: true,
		fade: true,
		speed: 800,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					autoplay: true,
					autoplaySpeed: 3500,
					arrows: false
				}
			},
			{
				breakpoint: 768,
				settings: {
					autoplay: true,
					autoplaySpeed: 3500,
					arrows: false,
					speed: 400
				}
			}
		]
	});
});