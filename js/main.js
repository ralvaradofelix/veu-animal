const $ = window.$

var swup = new Swup({
  animateScroll: false,
  preload: false,
  // plugins: [new SwupGaPlugin()]
})

Delighters.config({    
  start: 0.95
})

var alertCookies = {
  init: function () {
    this.show()
  },
  show: function (duration) {
    $('.alert').slideDown(duration)
  },
  close: function (duration) {
    $('.alert').slideUp(duration)
  }
}
alertCookies.init()

var dialogComponent = {
  init: function () {
    window.setTimeout(function () {
      $('.dialog').addClass('is-open')
    }, 2000)
    $('.dialog__media a').click(function () {
      $('.dialog').removeClass('is-open')
    })
  },
  initFast: function () {
    $('.dialog').addClass('is-open')
  },
  close: function () {
    $('.dialog').removeClass('is-open')
    Cookies.set('hide-div', true, { expires: 1 })
  },
  initTrigger: function () {
    $('.dialog-tab__trigger').click(function (event) {
      event.preventDefault()
      dialogComponent.initFast()
    })
  }
}

// dialogComponent.initTrigger()


// if ( !Cookies.get('hide-div') ) {
//   dialogComponent.init()
// }

$(document).keyup(function (e) {
  if (e.keyCode === 27) {
    dialogComponent.close()
  }
})

$(document).ready(function () {

  $('.swipebox').swipebox()

  $('.button--menu').click(function () {
    $(this).find('.hamburger').toggleClass('active')
    //$body.toggleClass('menu-is-open')
    $('.menu-principal-inner').slideToggle()
    gtag('event','mobile - menu open',{
        'event_category': 'navigation', 
        'event_label': $(i).attr('href')
    });
  })

  var carousels = {
    init: function () {
      var $carousel = $("[class$='-carousel']")
      var $cardCarousel = $('.media-carousel--card')
      var $contentCarousel = $('.media-carousel--content')
      var $autoplayCarousel = $('.media-carousel--autoplay')
      var $testimonisCarousel = $('.media-carousel--testimonis')
      var $heroCarousel = $('.media-carousel--hero')

      function itemCount (event) {
        var items = event.item.count
        var item = event.item.index
        $(this).parents('.card, .content').find('.media-info__span').html(item + 1 + '/' + items)
      }

      $carousel.on('initialized.owl.carousel', itemCount)
      $carousel.on('changed.owl.carousel', itemCount)

      $cardCarousel.owlCarousel({
        items: 1,
        dots: false,
        lazyLoad: true,
        nav: true,
        navText: ''
      }).on('changed.owl.carousel', function(event) {
          gtag('event','card slide',{
              'event_category': 'navigation', 
              'event_label': $(event.currentTarget).parent().parent().attr('data-name')
          });
      })

      $contentCarousel.owlCarousel({
        items: 1,
        dots: false,
        lazyLoad: true,
        margin: 0,
        thumbs: true,
        thumbsPrerendered: true,
        nav: true,
        navText: ''
      }).on('changed.owl.carousel', function(event) {
          gtag('event','slide detall',{
              'event_category': 'navigation', 
              'event_label': $(event.currentTarget).attr('data-name')
          }); 
      })

      $autoplayCarousel.owlCarousel({
        items: 1,
        dots: false,
        loop: true,
        margin: 0,
        nav: true,
        navText: '',
        autoplay: true,
        autoplayTimeout: 2000
      }).on('changed.owl.carousel', function(event) {
          gtag('event','slide autoplay',{
              'event_category': 'navigation', 
              'event_label': $(event.currentTarget).attr('data-name')
          });
      })

      $testimonisCarousel.owlCarousel({
        items: 1,
        dots: false,
        loop: true,
        margin: 0,
        nav: true,
        navText: '',
        autoplay: true,
        autoplayTimeout: 2000
      })

      $heroCarousel.owlCarousel({
        items: 1,
        dots: false,
        loop: true,
        margin: 0,
        nav: false,
        navText: '',
        autoplay: true,
        autoplayTimeout: 5000,
        animateOut: 'fadeOut'
      })


    }
  }

  carousels.init()

  document.addEventListener('swup:contentReplaced', event => {

    window.dataLayer.push({
      event: 'VirtualPageview',
      virtualPageURL: window.location.pathname + window.location.search,
      virtualPageTitle: document.title
    });

    window.gtag('config', 'UA-118311392-1', {
      'page_title' : document.title,
      'page_path': window.location.pathname + window.location.search
    });

    carousels.init()
    $('.swipebox').swipebox()
    pageDetall.init()
    toHashes.init()
    Delighters.init()
    CalcularFinanciacion.init()
    AnalyticsTracking.init()
    if ($('.page_expositor').length == 1) {
      if ( !Cookies.get('hide-div') ) {
        dialogComponent.init()
        dialogComponent.initTrigger()
      }
    }
    if ($('.page_home').length == 0) {
      $('.button--goBack').fadeIn(100)
    } else {
      $('.button--goBack').fadeOut(100)
    }
  });


})

if ($('.page_expositor').length == 1) {
  if ( !Cookies.get('hide-div') ) {
    dialogComponent.init()
  }
}

var toHashes = {
  init: function () {
    // Select all links with hashes
    $('a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function (event) {
      // On-page links
      if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
        // Figure out element to scroll to
        var target = $(this.hash)
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']')
        // Does a scroll target exist?
        if (target.length) {
          gtag('event','detail menu',{
              'event_category': 'navigation', 
              'event_label': this.hash.slice(1)
          });

          // Only prevent default if animation is actually gonna happen
          event.preventDefault()
          $('html, body').animate({
            scrollTop: target.offset().top - 230
          }, 1000, function () {
            // Callback after animation
            // Must change focus!
            var $target = $(target)
            $target.focus()
            if ($target.is(':focus')) { // Checking if the target was focused
              return false
            } else {
              $target.attr('tabindex', '-1') // Adding tabindex for elements not focusable
              $target.focus() // Set focus again
            }
          })
        }
      }
    })
  }
}

toHashes.init()

// Google Maps
function initialize () {
  var map = L.map('map-canvas').setView([41.5689845, 2.2443539], 14);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  L.marker([41.5689845, 2.2443539]).addTo(map);

}

// google.maps.event.addDomListener(window, 'load', initialize)
$(window).on("load", initialize );


// Set Font Size Based On Word Count
// var $cardTitleModelo = $(".title-modelo")

// $cardTitleModelo.each(function() {
//    var $numWords = $(this).text().split(" ").length
//    if ( $numWords > 5 ) {
//      $(this).css("font-size", ".97em")
//    }
// })

var CalcularFinanciacion = {
  init: function () {
    $('.jsCalcularFinanciacion').click(function (event) {
      event.preventDefault()
    
      var $alertFinaciacion = $('.alert_financiacion')
      var val = $('.financiacion__form .form__import').val()
      val = val.replace('.', '').replace(',', '.')
      val = parseFloat(val)
    
      if (!isNaN(val)) {
        gtag('event','financiancion calc',{
            'event_category': 'contact', 
            'event_label': val
          });
    
        var $opt = $('.financiacion__form select option:selected')
        var coef = parseFloat($opt.attr('data-rel'))
        var num = $('.financiacion__form select').first().val()
    
        var result = (val * coef)
    
        $alertFinaciacion.find('span.calculat').text(result.toFixed(2).replace('.', ','))
    
        $alertFinaciacion.fadeIn()
      } else {
        $('.financiacion__form .form__import').addClass('error')
        $alertFinaciacion.fadeOut()
      }
    })
  }
}

CalcularFinanciacion.init()

$('.form__import').on('keydown', function () { $('.alert_financiacion').fadeOut() })
$('.financiacion__form select').on('change', function () { $('.alert_financiacion').fadeOut() })


var $menu = $('.menu'),
    $menuItem = $('.menu__item'),
    $menuItemA = $('.menu__item a'),
    $menuSubmenuTrigger = $('.menu__submenu-trigger'),
    $menuSubmenu = $('.menu__submenu')

$menuSubmenuTrigger.click(function (event) {
  event.preventDefault()
  gtag('event','menu toggle',{
        'event_category': 'navigation', 
        'event_label': $(this).parent().text().trim()
      });
  $(this).toggleClass('-active')
  $(this).parent().next($menuSubmenu).slideToggle()
})

$('.menu__item, .menu__item a, .main__branding a, .button--goBack').click(function () {
  if ($('.hamburger.active').length == 1 && !$(this).hasClass("menu__item--submenu")) {
    $('.button--menu').click()
  }
})

$('.main__branding a').click(function () {
  $('.menu--principal').find('.menu__item').removeClass('-current')
})

$menuItem.click(function () {
  if (!$(this).hasClass("menu__item--submenu")) {
    $(this).parents('.menu--principal').find('.menu__item').removeClass('-current')
    $(this).addClass('-current').addClass('-active')
  }
})

$menuItemA.click(function () {
    $(this).parents('.menu--principal').find('.menu__item').removeClass('-current')
    $(this).parents('.menu__item--submenu').addClass('-current').addClass('-active')
})

var pageDetall = {
  init: function () {
    if ( $('.page_detall').length) {
      $('*').click(function () {
        if ( $('.form__item').is(":focus") ) {
          gtag('event','focus form',{
            'event_category': 'contactar', 
            'event_label': 'focus in missatge'
          });
          $('.informacion__inputs-hided').slideDown();
        } else if ( $(window).width() > 500 )  {
          $('.informacion__inputs-hided').slideUp();
        }
      })
    
      $('.informacion__form-toggle').on('click touchstart', function (event) {
        event.preventDefault();
        gtag('event','mobile - open form',{
            'event_category': 'contactar', 
            'event_label': 'open contact form'
        });
        $('.inner-mobile').slideToggle()
        $('.informacion').toggleClass('-open')
      })

      $('.inner-mobile__close').on('click', function (event) {
        $('.inner-mobile').slideUp()
      })
    
      $('.informacion__telefono').on('click',function(){
        gtag('event','call',{
            'event_category': 'contactar', 
            'event_label': 'call phone'
        });
      });
    
    }
  }
}

pageDetall.init()


// analytics tracking

var AnalyticsTracking = {
  init: function () {
    $('.breadcrumb__item').each(function(k,i){
      $(i).on('click',function(){
          gtag('event','breadcrumb',{
            'event_category': 'navigation', 
            'event_label': $(i).attr('href')
        });
      });
    });
    
    
    $('.breadcrumb__item').each(function(k,i){
      $(i).on('click',function(){
        gtag('event','breadcrumb',{
            'event_category': 'navigation', 
            'event_label': $(i).attr('href')
        });
      });
    });
    
    $('.footer_contacte_link').each(function(k,i){
      $(i).on("click",function(){
        var rel = $(i).attr('data-rel');
        gtag('event', 'footer',{
            'event_category': 'contactar', 
            'event_label': rel
        });
      });
    });
    
    
    $('.links_marques .menu__link').each(function(k,i){
      $(i).on("click",function(){
        var rel = $(i).attr('data-rel');
        gtag('event', 'footer link',{
            'event_category': 'navigation', 
            'event_label': $(i).text().trim()
        });
      });
    });
  }
}

AnalyticsTracking.init()