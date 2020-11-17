document.getElementById("mobileButton").onclick = function () {
  if (navbarSupportedContent.classList.contains("active")) {
    document
      .getElementById("navbarSupportedContent")
      .classList.remove("active");
  } else {
    document.getElementById("navbarSupportedContent").classList.add("active");
  }
};


( function($) { 

	$('ul li').hover(
		function(){$(this).addClass("wpacc-hover");},
		function(){$(this).delay('250').removeClass("wpacc-hover");}
	);
	
	$('ul li a').on('focus blur',
		function(){$(this).parents("li").toggleClass("wpacc-hover");}
	);
}(jQuery));