/******************
 * Vinova Themes  Framework for Prestashop 1.7.x 
 * @package    Nova - PrestaShop 1.7 Theme For Fashion Templates
 * @version    1.0
 * @author    http://vinovathemes.com/
 * @copyright  Copyright (C) October 2013 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 * *****************/
(function($) {
    $.cookie = function(key, value, options) {
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);
            if (value === null || value === undefined) {
                options.expires = -1
            }
            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setDate(t.getDate() + days)
            }
            value = String(value);
            return (document.cookie = [encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join(''))
        }
        options = value || {};
        var decode = options.raw ? function(s) {
            return s
        } : decodeURIComponent;
        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || '')
        }
        return null
    }

})(jQuery);

$(".boxInstagram").each(function (i) {
    if($('body').hasClass('lang-rtl'))
        rtl = true;
    else
        rtl = false;
    var Inslimit = $(this).data("limit"),
        InsaccessToken = $(this).data("accesstoken"),
        InsuserId = $(this).data("userid"),
        autoplay = $(this).data("autoplay"),
        autoplaytimeout = $(this).data("autoplaytimeout"),
        loop = $(this).data("loop"),
        dots = $(this).data("dots"),
        nav = $(this).data("nav"),
        margin = $(this).data("margin"),
        items = $(this).data("items"),
        items_mobile = $(this).data("items_mobile");
    var feed = new Instafeed({
        get: 'user',
        userId: InsuserId,
        accessToken: InsaccessToken,
        limit: Inslimit,
        sortBy: 'least-recent',
        resolution: 'standard_resolution',
        template: '<a href="{{link}}"><img src="{{image}}" alt="image-instagram"/></a>',
        before: function() {},
        after: function() {
            $('.boxInstagram').owlCarousel({
                navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
                loop: loop,
                margin: margin,
                autoplay: autoplay,
                dots: dots,
                nav:nav,
                items: items,
                responsive: {
                    0 : {
                        items: items_mobile
                    },
                    768 : {
                        items: items
                    },
                    992 : {
                        items: items
                    },
                    1200 : {
                        items: items
                    }
                }
            });
            $('.boxInstagram').addClass('owl-carousel');
        },
        success: function() {},
        error: function() {}
    });
    feed.run();

});

//Owl-carousel 2
$(".owl-carousel").each(function (index) {
	if($('body').hasClass('lang-rtl'))
	    rtl = true;
	else
	    rtl = false;
	var autoplay = $(this).data('autoplay');
	var autoplayTimeout = $(this).data('autoplayTimeout');
	var items = $(this).data('items');
    var margin = $(this).data('margin');
    var nav = $(this).data('nav');
    var dots = $(this).data('dots');
    var loop = $(this).data('loop');
    var items_tablet = $(this).data('items_tablet') ? $(this).data('items_tablet') : 3;
    var items_mobile = $(this).data('items_mobile') ? $(this).data('items_mobile') : 1;
    var center = $(this).data('center') ? $(this).data('center') : false;
    var start = $(this).data('start') ? $(this).data('start') : 0;
	$(this).owlCarousel({
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
        lazyLoad         : true,
        lazyContent      : true,
        loop             : loop,
		autoplay         : autoplay,
		autoplayTimeout  : autoplayTimeout,
		items            : items,
        margin           : margin,
		rtl              : rtl,
        dots             : dots,
        nav              : nav,
        responsive       : {
            0 : {
                items: items_mobile,
                center: center,
            },
            475 : {
                items: items_mobile,
                margin: margin,
            },
            768 : {
                items: items_tablet,
                margin: margin,
            },
            
            1024 :{
                items: items_tablet,
                margin: margin,

            },
            1200 : {
                items: items,
                center: center,
                startPosition: start,
            },
        }
	});
});

//Owl with Slick
$(".slick-images").each(function (index) {
    if($('body').hasClass('lang-rtl'))
        rtl = true;
    else
        rtl = false;
    var autoplay = $(this).data('autoplay');
    var autoplayTimeout = $(this).data('autoplayTimeout');
    var items = $(this).data('items');
    var margin = $(this).data('margin');
    var nav = $(this).data('nav');
    var dots = $(this).data('dots');
    var loop = $(this).data('loop');
    var position = $(this).find('.selected').data('position-image');
    $(this).slick({
        rtl: rtl,
        initialSlide: position,
        slidesToShow: items,
        slidesToScroll: items,
        arrows: nav,
        vertical: true,
        verticalSwiping: true,
    });
});

//When hover Cat in desktop
$('#_desktop_cart').hover(function() {
    $('.cart_block').addClass('hover-active');
}, function() {
    $('.cart_block').removeClass('hover-active');
});

//
var current_width = current_widthnov = $(window).width(),
    min_width = 768,
    responsive_mobile = current_width < min_width,
    min_widthnov = 991,
    responsive_mobilenov = current_width < min_widthnov;

function swapChildrenNova(obj1, obj2) {
    var temp = obj2.children().detach();
    obj2.append(obj1.children());
    obj1.append(temp);
}
function NovatoggleMobileStylesCart() {
    if (responsive_mobile) {
        $("#_mobile_cart").each(function(idx, el) {
            var target = $('#_mobile_cart_bottom');
            if (target) {
                target.append($('#_mobile_cart').html());
                $('.header-cart a').removeClass('d-flex');
            }
        });
    } else {
        $("#_mobile_cart_bottom").each(function(idx, el) {
            var target = $('#_mobile_cart');
            if (target) {
                $("#_mobile_cart_bottom").children().detach();
                $('.header-cart a').addClass('d-flex');
            }
        });
    }
}
function ResponsiveNov() {
    if (responsive_mobilenov) {
        $("*[id^='_desktopnov_']").each(function(idx, el) {
            var target = $('#' + el.id.replace('_desktopnov_', '_mobilenov_'));
            if (target.length) {
                swapChildrenNova($(el), target);
            }
        });
    } else {
        $("*[id^='_mobilenov_']").each(function(idx, el) {
            var target = $('#' + el.id.replace('_mobilenov_', '_desktopnov_'));
            if (target.length) {
                swapChildrenNova($(el), target);
            }
        });
    }
}

$(window).on('resize', function() {
    var _cw = current_width;
    var _mw = min_width;
    var _w = $(window).width();
    var _toggle = (_cw >= _mw && _w < _mw) || (_cw < _mw && _w >= _mw);
    responsive_mobile = _cw >= _mw;
    current_width = _w;
    if (_toggle) {
        NovatoggleMobileStylesCart();
    }
    var _cwnov = current_widthnov;
    var _mwnov = min_widthnov;
    var _wnov = $(window).width();
    var _togglenov = (_cwnov >= _mwnov && _wnov < _mwnov) || (_cwnov < _mwnov && _wnov >= _mwnov);
    responsive_mobilenov = _cwnov >= _mwnov;
    current_widthnov = _wnov;
    if (_togglenov) {
        ResponsiveNov();
    }
});
$(document).ready(function() {
    if (responsive_mobilenov) {
        ResponsiveNov();
    }
});


//Toggle menu left
function resetCanvas(){
    $('body').removeClass('open_nov_mobile_menu');
    $('.nov-canvas-menu').removeClass('canvas-active');
    $('.nov-menu .toggle-nav').removeClass('act');
    $('.canvas-overlay').removeClass('act');
    return false;
};
var l = $('.nov-canvas-menu'),
    c = $('.nov-menu .toggle-nav'),
    u = $('.canvas-overlay');


c.click(function() {
    l.hasClass('canvas-active') ? ( l.removeClass('canvas-active'), u.removeClass('act'), c.removeClass('act') ) : ( l.addClass('canvas-active'), u.addClass('act'), c.addClass('act') )
});
u.on("click", function() {
    resetCanvas();return false;
});

//Megamenu
if($("body").attr("id")=="index") 
	this_hompage = 1;
else
	this_hompage = 0;
	
var showpanel = false; 
var hidepanel = false;

var this_url = window.location;
this_url = String(this_url);
this_url = this_url.replace("https://","").replace("http://","").replace("www.","").replace( /#\w*/, "" );

var this_link = "{/literal}{$current_link}{literal}";
this_link = this_link.replace("https://","").replace("http://","").replace("www.","").replace( /#\w*/, "" );


//Canvas Mainmenu
$('#_mobile_mainmenu').click(function() {
    $('body').hasClass('open_nov_mobile_menu') ? ( $('body').removeClass('open_nov_mobile_menu') ) : ( $('body').addClass('open_nov_mobile_menu') );
});
$('.canvas-overlay').on("click", function() {
    resetCanvas();return false;
});

$(".nov-megamenu > ul > li > a").each(function() {
    url_menu = $(this).attr("href").replace("https://","").replace("http://","").replace("www.","").replace( /#\w*/, "" );
	if( (this_url == url_menu) || (this_url.replace(this_link,"") == url_menu) || this_hompage){
		$(this).parent().addClass("active");
        return false;
	}
});

function NovTogglePage() {
    $('.nov-toggle-page').on('click', function(e){
        var target = $(this).data('target');
        $('body').hasClass('show-boxpage') ? ( $('body').removeClass('show-boxpage') ) : ( $('body').addClass('show-boxpage') );
        $(target).hasClass('active') ? ( $(target).removeClass('active') ) : ( $(target).addClass('active') );
        e.stopPropagation();
        e.preventDefault();
    });
    $('.box-header .close-box').on('click', function(e) {
        $('body').removeClass('show-boxpage');
        $(this).parents('.mobile-boxpage').removeClass('active');
        $('#mobile-pageaccount').find('.box-content').removeClass('active');
        e.stopPropagation();
    });
    $('.links-currency, .links-language').on('click', function(e) {
        var target_link = $(this).data('target'),
            title_box = $(this).data('titlebox');

        $('#mobile-pageaccount').find('.box-content').removeClass('active');
        $('.title-box','#mobile-pageaccount').html(title_box);
        $('.back-box','#mobile-pageaccount').addClass('active');
        $(target_link).hasClass('active') ? ( $(target_link).removeClass('active') ) : ( $(target_link).addClass('active') );
        e.stopPropagation();
    });
    $('.back-box','#mobile-pageaccount').on('click', function(e) {
        var titlebox_parent = $('#mobile-pageaccount').data('titlebox-parent');
        $('#mobile-pageaccount').find('.box-content').removeClass('active');
        $('.title-box','#mobile-pageaccount').html(titlebox_parent);
        $(this).removeClass('active');
    })

}

function NovHeightBoxContent() {
    var height = $( window ).outerHeight(),
        boxheight = $('.box-header').outerHeight(),
        menubottom = $('#stickymenu_bottom_mobile').outerHeight();
    $('.box-content','.mobile-boxpage').each(function(){
        $(this).outerHeight(height - boxheight - menubottom);
    });
}

//Vertical menu
function NovVerticalToggle() {
    if($('body').hasClass('page-index') == false){
        $('.verticalmenu .toggle-nav').on('click', function(e) {
            $('.verticalmenu-content').hasClass('active') ? ( $('.verticalmenu-content').removeClass('active'), $(this).removeClass('act') ) : ( $('.verticalmenu-content').addClass('active'), $(this).addClass('act') );
            e.stopPropagation();
        });
        $(document).on('click', function(vl) {
            if ($(vl.target).is('.verticalmenu-content')==false) {
                $('.verticalmenu-content').removeClass('active');
                $('.verticalmenu .toggle-nav').removeClass('act');
            }
        });
    } else {
        if ($('#header').hasClass('header-3') == true || $('#header').hasClass('header-1') == true || $('#header').hasClass('header-2') || $('#header').hasClass('header-4') || $('#header').hasClass('header-6')) {

            $('.verticalmenu .toggle-nav').on('click', function(e) {
                $('.verticalmenu-content').hasClass('active') ? ( $('.verticalmenu-content').removeClass('active'), $(this).removeClass('act') ) : ( $('.verticalmenu-content').addClass('active'), $(this).addClass('act') );
                e.stopPropagation();
            });
            $(document).on('click', function(vl) {
                if ($(vl.target).is('.verticalmenu-content') == false && $('body').hasClass('page-index') == false) {
                    $('.verticalmenu-content').removeClass('active');
                    $('.verticalmenu .toggle-nav').removeClass('act');
                }
            });
        }

    }
}

//Vertical menu on mobile
function NovVerticalToggleMobile() {
    $('.header-4 .verticalmenu .toggle-nav').on('click', function(e) {
        if ($('.verticalmenu-content').hasClass('show')) {
            $('.verticalmenu-content').removeClass('show');
            $(this).removeClass('act');
        } else {
            if ($('.verticalmenu-content').hasClass('active')) {
                $('.verticalmenu-content').removeClass('active');
                $(this).removeClass('act');
            } else {
                $('.verticalmenu-content').addClass('active');
                $(this).addClass('act');
            }
        }
        $('.verticalmenu-content').hasClass('active') ? ( $('.verticalmenu-content').removeClass('active').removeClass('show'), $(this).removeClass('act') ) : ( $('.verticalmenu-content').addClass('active').removeClass('show'), $(this).addClass('act') );
        e.stopPropagation();
    });
    $(document).on('click', function(vl) {
        if ($(vl.target).is('.verticalmenu-content')==false) {
            $('.verticalmenu-content').removeClass('active');
            $('.verticalmenu .toggle-nav').removeClass('act');
        }
    });
}

function SetPositionTopSubmenu() {
    if($(window).width() > 992) {
        var i = 0;
        $('.menu > .item','#verticalmenu').each(function(){
            i = i + 1;
            if($(this).hasClass('group')) {
                var position = -(42*(i-1));
                $(this).find('.dropdown-menu').css('top',position);
            }
        });
    }
}

function NovHeightVertical() {
    if($(window).width() > 980) {
        var h = $('#nivoSlider').innerHeight();
        $('#_desktop_verticalmenu','.displayhomenovone').innerHeight(h);
    }
}

//_mobile_infos
function NovMobileToggle() {
    if($(document).width() < 1600){
        $('#_mobile_infos .nav-info').on('click', function(e) {
            $('#_mobile_infos').hasClass('active') ? ( $('#_mobile_infos').removeClass('active'), $(this).removeClass('act') ) : ( $('#_mobile_infos').addClass('active'), $(this).addClass('act') );
            e.stopPropagation();
        });
        $(document).on('click', function(vl) {
            if ($(vl.target).is('#_mobile_infos')==false) {
                $('#_mobile_infos').removeClass('active');
            }
        });
    }
}

function NovSearchToggle() {
    $('#search_widget .toggle-search').on("click", function(e) {
        if($('#search_widget').hasClass('active-search')){
            $(this).parent("#search_widget").removeClass("active-search");
        } else {
            $(this).parent("#search_widget").addClass("active-search");
        }
        e.stopPropagation();
    });
    $(document).on('click', function(event) {
        if ( $(event.target).is('#_desktop_search input') == false ) {
            $('#search_widget').removeClass("active-search");
        }
    });
    $('#_mobile_search .nav-search').on("click", function(f) {
        $(this).parent("#_mobile_search").addClass("active-search");
        f.stopPropagation();
    });
    $(document).on('click', function(event) {
        if ( $(event.target).is('#searchbox input') == false ) {
            $('#_mobile_search').removeClass("active-search");
        }
    });
}


function NovToggleSearch() {
    $('.header-3 .toggle-search').on('click', function(e) {
        $('#_desktop_search_content').hasClass('active') ? ( $('#_desktop_search_content').removeClass('active'), $(this).removeClass('act') ) : ( $('#_desktop_search_content').addClass('active'), $(this).addClass('act') );
        e.stopPropagation();
    });
    $(document).on('click', function(vl) {
        if ($(vl.target).is('#_desktop_search_content')==false && $(vl.target).is('#search_query_top')==false) {
            $('#_desktop_search_content').removeClass('active');
            $('.header-3 .toggle-search').removeClass('act');
        }
    });
}


function NovMyaccountToggle() {
    $('#block_myaccount_infos .toggle-group-account, #_mobile_user_info .toggle-group-account').on("click", function(e) {
        $(this).toggleClass("act");
        $(this).parent("#block_myaccount_infos").toggleClass("active");
        $(this).parent("#_mobile_user_info").toggleClass("active");

        e.stopPropagation();
    });
    $(document).on('click', function(f) {
        if ($(f.target).is('.account-list')==false) {
            $('#block_myaccount_infos.links').removeClass("active");
            $('#block_myaccount_infos .toggle-group-account, #_mobile_user_info .toggle-group-account').removeClass('act');
        }
        if ($(f.target).is('#_mobile_user_info .toggle-group-account') == false) {
            $('#_mobile_user_info').removeClass("active");
            $('#block_myaccount_infos .toggle-group-account, #_mobile_user_info .toggle-group-account').removeClass('act');
        }
    });
}

if ($(document).width() < 768) {
    megamenu_rep();
}
$(window).resize(function() {
    if($(window).width() < 768) {
       megamenu_rep();
    }
});

function megamenu_rep() {
    $("#megamenu .menu li").each(function() {
        if($(this).hasClass("has-sub") || $(this).hasClass("group")) {
            if ($(this).children("a").length > 0 || $(this).children(".menu-title").length > 0) {
                if($(this).children(".nov-menu-toggle").length == 0) {
                    $(this).children(".dropdown-menu").css("display","none");
                }
            }
            else {
                $(this).children(".dropdown-menu").css("display","block");
            }
        }
    });
}

//Sticky Menu
function Sticky_Menu() {
    if($('div').hasClass('sticky-menu')) {
        var time;
        //var height = $('#nov-megamenu').height();
        //var a = 90;
        $(window).scroll(function(){
            if ( time ) clearTimeout(time);
            time = setTimeout(function(){
                if ($(window).scrollTop() >= 150) {
                    $('.sticky-menu').addClass('sticky-menu-active');
                } else {
                    $('.sticky-menu').removeClass('sticky-menu-active');
                }
                /*var current_position = $(window).scrollTop();
                if (current_position > a) {
                    a = current_position;
                    $('#nov-megamenu').removeClass('nov-megamenu--fixed');
                } else {
                    $('#nov-megamenu').addClass('nov-megamenu--fixed');
                    a = current_position;
                }
                if (current_position <= 90) {
                    $('#nov-megamenu').removeClass('nov-megamenu--fixed');
                }*/
            }, 50);
        });
    }
}

function ScrollFacet() {
    $('.facet').each(function (i) {
        if( $(this).find('li').length > 5 ) {
            $(this).addClass('facet-hasscroll');
        }
    })
}

//FlipBack Menu
function FlipBackMenu() {
    var width_window = $(window).width();
    $('#megamenu .level1 > li').each(function(){
        var total_width_sub = $('#megamenu .level1 > li > .dropdown-menu').outerWidth();
        var position = $(this).offset().left;
        var check = width_window - position;
        if (total_width_sub > check) {
            $(this).addClass('flipback');
        }
    });
}

function Stick_Element() {
    //Code here
}
//MoreverticalMenu
function _moreverticalMenu(){
    if( $('.verticalmenu-content').hasClass('has-showmore') && $(window).width() > 768) {
        var textshowmore = $('.verticalmenu-content').data('textshowmore'),
            textless = $('.verticalmenu-content').data('textless'),
            count_showmore = $('.nov-verticalmenu').data('count_showmore'),
            desktop_item = $('.verticalmenu-content').data('desktop_item');

        $('ul.menu').each(function(){
          var LiN = $(this).find('>li').length;
          if( LiN > count_showmore){    
            if($(window).width() > 1199){
                var hide_count =  count_showmore-1; 
            }else{
                 var hide_count =  desktop_item - 1;
            }
            $('>li', this).eq(hide_count).nextAll().hide().addClass('toggleable');
            $(this).append('<li class="more item">'+ textshowmore +'</li>');
            
          }else{

          }
          
        });


        $('ul.menu').on('click','.more', function(){
          
          if( $(this).hasClass('less') ){    
            $(this).text(textshowmore).removeClass('less');    
          }else{
            $(this).text(textless).addClass('less'); 
          }
          
          $(this).siblings('li.toggleable').slideToggle();
            
        }); 
    }
}

//Go to top
function goToTop() {
    var timer;
    $(window).scroll(function() {
        if ( timer ) clearTimeout(timer)
        timer = setTimeout(function(){
            if ($(window).scrollTop() >= 200) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        }, 300);
        
    });
    $("#back-top").click(function(){
        $("body,html").animate({scrollTop:0 },"normal");
        return!1
    });
}

//Popup newsletter
function PopupNewletter() {
    var date = new Date();
    var minutes = 60;
    date.setTime(date.getTime() + (minutes * 60 * 1000));

    if ($.cookie('popupNewLetterStatus') != 'closed' && $('body').outerWidth() > 768) {
        $("#popup-subscribe").modal({
            show: !0
        });
    }
    $.cookie("popupNewLetterStatus", "closed", {
        'expires': date,
        'path': '/'
    })
   /* $('input.no-view').change(function() {
        if ($('input.no-view').prop("checked") == 1) {
            $.cookie("popupNewLetterStatus", "closed", {
                'expires': date,
                'path': '/'
            })
        } else {
            $.cookie("popupNewLetterStatus", "", {
                'expires': date,
                'path': '/'
            })
        }
    })*/
}
if ($("#popup-subscribe").length) {
    $(window).load(function(){
        var timer = window.setTimeout(PopupNewletter,8000);
    });
}

//Google map lock
$(".map-locker").click(function() {
    $(this).css('display','none');
});
$("#nov-map-contact").on( "mouseleave", function() {
    $(".map-locker").css('display','block');
});

//Change Display Type category
function setDefaultGrid() {
    if ($.cookie('nov_grid_list') == 'grid') {
        $('.change-type .grid-type').trigger('click');
    }
    if ($.cookie('nov_grid_list') == 'list') {
        $('.change-type .list-type').trigger('click');
    }
}

$(document).on('click', '.change-type .grid-type', function(e) {
    e.preventDefault();
    $('#categories-product .products').removeClass('list').addClass('grid');
    $('.change-type').find('.grid-type').addClass('active');
    $('.change-type').find('.list-type').removeClass('active');
    $('#categories-product .products .product-miniature').each(function(index, element) {
        html_group_action = '<div class="product-buttons">';
            html_group_action += $(element).find('.product-buttons').html() + '</div>';
        $('.thumbnail-container', element).append(html_group_action);
        $('.product-description .product-buttons', element).remove();
    });
    $.cookie('nov_grid_list', 'grid', {
        expires: 1,
        path: '/'
    })
});

$(document).on('click', '.change-type .list-type', function(e) {
    e.preventDefault();
    $('#categories-product .products').removeClass('grid').addClass('list');
    $('.change-type').find('.grid-type').removeClass('active');
    $('.change-type').find('.list-type').addClass('active');
    $('#categories-product .products .product-miniature').each(function(index, element) {
        html_group_action = '<div class="product-buttons">';
            html_group_action += $(element).find('.product-buttons').html() + '</div>';
        $('.product-description', element).append(html_group_action);
        $('.thumbnail-container .product-buttons', element).remove();
    });
    $.cookie('nov_grid_list', 'list', {
        expires: 1,
        path: '/'
    })
});

$(document).ready( function() {
    var d = $(this),
        mobile = false;
    //enable tooltip everywhere
    $('[data-toggle="tooltip"]').tooltip();

    // SliderShow
    if ($("#nov-slider").length) {
        $("#nov-slider").each(function (index) {
            var effect = $('#nov-slider').data('effect');
            var slices = $('#nov-slider').data('slices');
            var animSpeed = $('#nov-slider').data('animspeed');
            var pauseTime = $('#nov-slider').data('pausetime');
            var startSlide = $('#nov-slider').data('startslide');
            var directionNav = $('#nov-slider').data('directionnav');
            var controlNav = $('#nov-slider').data('controlnav');
            var controlNavThumbs = $('#nov-slider').data('controlnavthumbs');
            var pauseOnHover = $('#nov-slider').data('pauseonhover');
            var manualAdvance = $('#nov-slider').data('manualadvance');
            var randomStart = $('#nov-slider').data('randomstart');
            $(window).load(function() {
                $('#nivoSlider').nivoSlider({
                    effect: effect, // Specify sets like: 'fold,fade,sliceDown'
                    slices: slices, // For slice animations
                    boxCols: 12, // For box animations
                    boxRows: 6, // For box animations
                    animSpeed: animSpeed, // Slide transition speed
                    pauseTime:  pauseTime, // How long each slide will show
                    startSlide:  startSlide, // Set starting Slide (0 index)
                    directionNav: directionNav, // Next & Prev navigation
                    controlNav: controlNav, // 1,2,3... navigation
                    controlNavThumbs: controlNavThumbs, // Use thumbnails for Control Nav
                    pauseOnHover: pauseOnHover, // Stop animation while hovering
                    manualAdvance: manualAdvance, // Force manual transitions
                    prevText: 'Prev', // Prev directionNav text
                    nextText: 'Next', // Next directionNav text
                    randomStart: randomStart, // Start on a random slide
                    beforeChange: function(){
                          
                    }, // Triggers before a slide transition
                    afterChange: function(){
                        
                    }, // Triggers after a slide transition
                    slideshowEnd: function(){
                        
                    }, // Triggers after all slides have been shown
                    lastSlide: function(){
                         
                    }, // Triggers when last slide is shown
                    afterLoad: function(){
                        $(".nov_preload").hide();
                    } // Triggers when slider has loaded
                });
            });
        });
    }

	$(".category-sub-menu li .collapse").first().collapse("show");	
	
	$("#nov-verticalmenu li").first().children('.dropdown-menu').slideDown(300);
	$("#nov-verticalmenu li").first().children('.block_content').slideDown(300);
	$("#nov-verticalmenu li").first().addClass('menu-active');	
	
    $(".show-sub").click( function() {
        var $this = $(this);
        if ($this.parent().hasClass('menu-active')) {
            $this.parent().removeClass('menu-active');
            $this.next().slideUp(300);
        } else {
            $this.parent().parent().find('li').removeClass('menu-active');
            $this.parent().parent().find('li .dropdown-menu, li .block_content').slideUp(300);
            $this.parent().toggleClass('menu-active');
            $this.next().slideToggle(300);
        }
        return false;
    });

    $('.opener').click( function(){
        if($(this).parent('li').hasClass('menu-active')){
            $(this).parent('li').children('.dropdown-menu').slideUp(300);
            $(this).parent('li').removeClass('menu-active');
        }
        else {
            $(this).parent('li').children('.dropdown-menu').slideDown(300);
            $(this).parent('li').addClass('menu-active');
        }
    });

    $('.countdownfree').each(function(e){
        var time_count = $(this).data('date');
        $(this).countdown(time_count, function(event) {
          var $this = $(this).html(event.strftime(''
            + '<div class="item-time"><span class="name-time">Days</span><span class="data-time"><span>%d</span></span></div>'
            + '<div class="item-time"><span class="name-time">Hours</span><span class="data-time"><span>%H</span></span></div>'
            + '<div class="item-time"><span class="name-time">Mins</span><span class="data-time"><span>%M</span></span></div>'
            + '<div class="item-time"><span class="name-time">Secs</span><span class="data-time"><span>%S</span></span></div>'
            ));
        });
    });
    
    $(window).on('load resize', function() {
        //NovVerticalToggle();
        NovHeightVertical();
        SetPositionTopSubmenu();
        NovMobileToggle();
        NovTogglePage();
        NovHeightBoxContent();
        NovMyaccountToggle();
        NovSearchToggle();
        NovToggleSearch();
        FlipBackMenu();
        NovHeightBoxContent();
        if (d.width() <= 980 && mobile == false) {
            mobile = true;
        } else if (d.width() > 980) {
             Sticky_Menu();
             mobile = false;
             NovHeightVertical();
        }
        if(d.width() > 991) {
            $('.filter-left','.filtertype-two').stick_in_parent();
        }
    });

    //display view type
    _moreverticalMenu();

    setDefaultGrid();
    SetPositionTopSubmenu();
    NovatoggleMobileStylesCart();
    NovVerticalToggle();
    NovVerticalToggleMobile();
    //ScrollFacet();
    goToTop();
    

});


