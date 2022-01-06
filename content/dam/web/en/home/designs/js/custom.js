//home js
$(document).ready(function () {
	/************if ($("#do_more").length) {
		var waypoint = new Waypoint({
			element: document.getElementById('do_more'),
			handler: function () {
				$('.menu-bg').toggleClass('reverseMenu');
				$('.btn--search').toggleClass('search-toggle-bg');
				$('.stick-left-nav-ul > li').toggleClass('darkText');
				$('#logo').attr('fill', function (index, attr) {
					return attr === '#007cc3' ? '#fff' : '#007cc3';
				});
				$('.burger > .icon-bar1').toggleClass('icon-bar11');
				$('.burger > .icon-bar2').toggleClass('icon-bar21');
				$('.burger > .icon-bar3').toggleClass('icon-bar31');
			}
		});
	}****************/
	
	var pathName = window.location.pathname.toLowerCase();
	var pageUrl = 'others';
	if (pathName === '/australia.html' || pathName === '/cn.html' ) {
		pageUrl = 'home';
	}

	if ($("#ai_powered_core").length !== 0 && pageUrl !== 'home') {
		var waypoint1 = new Waypoint({
			element: document.getElementById('ai_powered_core'),
			handler: function () {
				$("header .container > .navbar-header,.container > .header-menu").toggleClass('hidden-xs hidden-sm hidden-md hidden-lg');
				$("header .container").toggleClass('mt45');
			}
		});
	}

/* do more expand/collapse effect */
	$(document).on('click', '.expandHead', function () {
		var expandID = $(this).data('id');
		$(expandID).fadeIn();
		$(expandID).addClass('expandWrpr').removeClass('contractWrpr');
		$('.closeWrpr').addClass('closeWrprAnim');
	});
	$(document).on('click', '.closeWrpr', function () {
		$('.expandableDiv').removeClass('expandWrpr').addClass('contractWrpr');
		$('.expandableDiv').fadeOut();
		$('.closeWrpr').removeClass('closeWrprAnim');
	});

/* index careers - employeespeak slider */
var employeespeak_slider = $("#employeespeak_slider").find('.item').length;


    /* left navigation hover effects */
	$(document).on('mouseenter', '.sticky-left-nav li', function () {
		if (!$(this).hasClass('mb50')) {
			$(this).addClass('nav-active');
		}
	});
	$(document).on('mouseleave', '.sticky-left-nav li', function () {
		if (!$(this).hasClass('mb50')) {
			$(this).removeClass('nav-active');
		}
	});


// Tn JS
jQuery('.sticky-left-nav ul li a').click(function(){
    var scroll_id = jQuery(this).attr('href');
        jQuery('.sticky-left-nav ul li').removeClass('nav-active mb50');
        jQuery(this).closest('li').addClass('nav-active mb50');
    if( scroll_id == '#our_portfolio' || scroll_id == '#contact_us'){
        jQuery(this).closest('ul').addClass('dark-color-tn');
    }
    else{
        jQuery('.sticky-left-nav ul').removeClass('dark-color-tn');
    }
    jQuery('html, body').animate({
        scrollTop: jQuery(scroll_id).offset().top
    }, 500);
});
// Onscroll
$(window).scroll(function () {
    var windowPos = $(window).scrollTop();
    if (windowPos >= 0) {

    $('.freeflowhtml').each(function (i) {
            if ($(this).position().top <= windowPos + 100) {
            var cur_id = jQuery(this).find('.scroll-section').attr('id');    
            if(cur_id == 'our_portfolio' || cur_id == 'contact_us'){
                    jQuery('.sticky-left-nav li.nav-active').closest('ul').addClass('dark-color-tn');
                }
                else{
                    jQuery('.sticky-left-nav ul').removeClass('dark-color-tn');
                }
            $('.sticky-left-nav li.nav-active').removeClass('nav-active mb50');
            $('.sticky-left-nav li').eq(i - 1).addClass('nav-active mb50');
        }
    });

    } else {
        $('.stick-left-nav-ul li.nav-active-menu').removeClass('nav-active-menu');
    }
});



});


