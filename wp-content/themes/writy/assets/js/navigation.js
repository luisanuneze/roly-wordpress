( function($) {

    /*Mobile Menu*/
    let NavMenu = $(".navbar-nav");
  let MenuItem = $(".menu-item");
  let MenuButton =
    // if ($(".menu-item").hasClass(".menu-item-has-children")) {
    //   let prefenditem = `<button class='submenu-control'>v</button>`;
    //   $(".menu-item").prefend(prefenditem);
    // }
    $("body").on(".submenu-controller", "click", function () {
      
    });

  MenuItem.on("click", function (e) {
    e = window.event || e;
    e.stopPropagation();
    if ($(this).hasClass("menu-item-has-children")) {
      $(this).children(".sub-menu").stop().slideToggle();
      $(this).siblings(".menu-item").children(".sub-menu").slideUp();
    }
  });
  $(".navbar-toggler").on("click", function () {
    $(".sub-menu").slideUp();
      
    //$(this).siblings(".navbar-collapse").find(".sub-menu").slideUp();
    $('body').toggleClass('showing-menu');
    if($('body').hasClass('showing-menu')){
      $(
        "<button class='submenu-controller dashicons dashicons-arrow-down-alt2'></button>"
      ).insertBefore($(".sub-menu"));
    }else{
      $(document).find('.submenu-controller ').remove();
    }
  });

  document.addEventListener(
    "keydown",
    function (event) {
      if (event.keyCode === 27 && $("body").hasClass("showing-menu")) {
        event.preventDefault();
        $("body").removeClass("showing-menu");
        $(".navbar-collapse").removeClass("active");
      }
    }.bind(this)
  );

  function keepFocusInModal() {
    var _doc = document;

    _doc.addEventListener("keydown", function (event) {
      var toggleTarget,
        menuToggleEl,
        acElParent,
        modal,
        selectors,
        elements,
        menuType,
        bottomMenu,
        activeEl,
        lastEl,
        firstEl,
        tabKey,
        shiftKey,
        menuToggleEl = $(".navbar-toggler");
        let toggleselector = _doc.querySelector(".navbar-toggler");
      clickedEl = menuToggleEl.data("clicked", true);

      if (clickedEl && _doc.body.classList.contains("showing-menu")) {
        selectors = "input, a, button";
        modal = _doc.querySelector(".navbar-nav");

        elements = modal.querySelectorAll(selectors);
        elements = Array.prototype.slice.call(elements);

        lastEl = elements[elements.length - 1];
        firstEl = elements[0];

        activeEl = _doc.activeElement;
        tabKey = event.keyCode === 9;
        shiftKey = event.shiftKey;
        

        if (!shiftKey && tabKey && lastEl === activeEl) {
          event.preventDefault();
          firstEl.focus();
          menuToggleEl.focus();
        }

        if (shiftKey && tabKey && firstEl === activeEl) {
          event.preventDefault();
          lastEl.focus();
          menuToggleEl.focus();
        }
        if(shiftKey && tabKey && toggleselector === activeEl){
          event.preventDefault();
             lastEl.focus();
        }
      }
    });
  }
  keepFocusInModal();


    
} )( jQuery );