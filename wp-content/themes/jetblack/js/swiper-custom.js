var swiperHeroSlider = new Swiper ( '#slider-section', {
	// Optional parameters
	loop: 1,
	effect: 'slide',
	speed: 300,
	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
		type: 'bullets',
		clickable: 'true',
	},

	// Navigation arrows
	navigation: {
		nextEl: '#slider-section .swiper-button-next',
		prevEl: '#slider-section .swiper-button-prev',
	},
});

var swiperTestimonial = new Swiper( '.testimonial-content-wrapper.swiper-carousel-enabled', {
	slidesPerView: 1,
	loop: 1,
	effect: 'slide',
	speed: 300,
	freeMode: true,
	spaceBetween: 30,
	pagination: {
		el: '#testimonial-section .swiper-pagination',
		clickable: true,
	},

	// Navigation arrows
	navigation: {
		nextEl: '#testimonial-section .swiper-button-next',
		prevEl: '#testimonial-section .swiper-button-prev',
	},
	// Breakpoints
	breakpoints: {
		640 : {
			slidesPerView: 2,
			spaceBetween: 30,
		}
	}
});
