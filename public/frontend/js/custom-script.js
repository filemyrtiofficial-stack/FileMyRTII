(function ($) {
    "use strict";

        if ($('.testimonial_slider').length) {
          $('.testimonial_slider').slick({
               dots: false,
               arrows: true,
               infinite: true,
               speed: 3000,
               slidesToShow: 1,
               slidesToScroll: 1,
               autoplay: true,
               autoplaySpeed: 5000,
               pauseOnHover: true,
               pauseOnFocus: true,
               prevArrow: '<button type="button" class="slick-prev"><svg width="18" height="36" viewBox="0 0 18 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2.76459 19.0665L11.2501 27.552L13.3711 25.431L5.94609 18.006L13.3711 10.581L11.2501 8.45996L2.76459 16.9455C2.48339 17.2268 2.32541 17.6082 2.32541 18.006C2.32541 18.4037 2.48339 18.7852 2.76459 19.0665Z" fill="black"/></svg></button>',
               nextArrow: '<button type="button" class="slick-next"><svg width="18" height="36" viewBox="0 0 18 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.2354 19.0665L6.74991 27.552L4.62891 25.431L12.0539 18.006L4.62891 10.581L6.74991 8.45996L15.2354 16.9455C15.5166 17.2268 15.6746 17.6082 15.6746 18.006C15.6746 18.4037 15.5166 18.7852 15.2354 19.0665Z" fill="black"/></svg></button>',
               responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
               ]
          });
        }

        // RTI tab slider only in mobile

        const $window = $(window);
        const $slick_slider = $('.rti_tab_slider');
        // $('.rti_tab_slider li').wrap('<div></div>');
        const settings = {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        mobileFirst: true,
        prevArrow: '<button type="button" class="slick-prev"><svg width="18" height="36" viewBox="0 0 18 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2.76459 19.0665L11.2501 27.552L13.3711 25.431L5.94609 18.006L13.3711 10.581L11.2501 8.45996L2.76459 16.9455C2.48339 17.2268 2.32541 17.6082 2.32541 18.006C2.32541 18.4037 2.48339 18.7852 2.76459 19.0665Z" fill="black"/></svg></button>',
        nextArrow: '<button type="button" class="slick-next"><svg width="18" height="36" viewBox="0 0 18 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.2354 19.0665L6.74991 27.552L4.62891 25.431L12.0539 18.006L4.62891 10.581L6.74991 8.45996L15.2354 16.9455C15.5166 17.2268 15.6746 17.6082 15.6746 18.006C15.6746 18.4037 15.5166 18.7852 15.2354 19.0665Z" fill="black"/></svg></button>',
        responsive: [
                {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3
                    }
                },
                {
                breakpoint: 992,
                settings: "unslick",
                },
        ],
        };
        $slick_slider.slick(settings);
        $window.on('resize', function() {
        if ($window.width() > 992) {
            $slick_slider.slick('unslick');
            return
        }
        if ( ! $slick_slider.hasClass('slick-initialized'))
            return $slick_slider.slick(settings);
        });  



          

          
          // Toggle the desktop offcanvas menu
          $('.nav_btn').on("click",function() {
            if ($('.mobile_menu').length) {
            $('.nav_btn .toggler').toggleClass('active');
            $('.mobile_menu').toggleClass('active');
            }
          });

          // Toggle the mobile menu
          $('.nav_btn_m').on("click",function() {
            if ($('.mobile_menu').length) {
            $('.nav_btn_m .toggler').toggleClass('active');
            $('.menu').toggleClass('active');
            $('.has-dropdown a').parent().siblings().removeClass('show');
            }
        });

        $('.menu .has-dropdown > a').after('<span class="arrow-btn"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>');
       
        // Handle mega menu visibility
        $('.menu .has-dropdown > .arrow-btn').on("click",function (e) {
            e.preventDefault();
            if ($(this).siblings('.mega_menu_wrapper').length) {
            $(this).toggleClass('active');
            $(this).siblings('.mega_menu_wrapper').toggleClass('show');
            $(this).parent().siblings().find('.mega_menu_wrapper').removeClass('show');
            }
        });
    
        // Handle second-level dropdowns
        $('.mega_menu .has-dropdown > .arrow-btn').on("click",function (e) {
            e.preventDefault();
            if ($(this).siblings('ul').length) {
            $(this).toggleClass('active');
            $(this).siblings('ul').toggleClass('show');
            $(this).parent().siblings().find('ul').removeClass('show');
            }
        });
    
        // Handle third-level dropdowns
        $('.mega_menu ul .has-dropdown > .arrow-btn').on("click",function (e) {
            e.preventDefault();
            if ($(this).siblings('ul').length) {
            $(this).toggleClass('active');
            $(this).siblings('ul').toggleClass('show');
            $(this).parent().siblings().find('ul').removeClass('show');
            }
        });
    
        // Close all dropdowns when clicking outside the menu
        $(document).on("click",function (e) {
            if (!$(e.target).closest('.menu').length) {
                $('.has-dropdown > .arrow-btn').removeClass('active');
                $('.mega_menu_wrapper').removeClass('show');
                $('.mega_menu ul').removeClass('show');
            }
        });

        // file my rti tabs
        if ($('.rti_tab_item').length) {
            $('.rti_tab_item').on("click",function(){  
                $(".rti_tab").removeClass('tab-active');
                $(".rti_tab[data-id='"+$(this).attr('data-id')+"']").addClass("tab-active");
                $(".rti_tab_item").removeClass('active');
                $(this).parent().find(".rti_tab_item").addClass('active');
            });
        }

        // image add in background
        if ($('.bg_img').length) {
            $('.bg_img').each(function(){
                const el = $(this),
                src = el.attr('src'),
                parent = el.parent();
                parent.css({
                    'background-image': `url(${src})`,
                    'background-size': 'cover',
                    'background-position': '50% 50%',
                    'background-repeat': 'no-repeat',
                });
                el.hide();
            });
        }


        // about us page js

        if ($('.vision_section .accordion_item').length) {
            console.log("accordion function run");
            $('.accordion_item .accordion_title').on("click",function(){
                $(this).siblings(".accordion_content").slideToggle(300);
                $(this).parent().siblings().find(".accordion_content").slideUp(300);
                $(this).parent().siblings().find(".accordion_title").removeClass("active");
                $(this).toggleClass("active");
            });
            
            
        }
        $('.your-slider').slick({
    dots: true,
    infinite: true,
    speed: 300,        // Fast slide transition
    autoplaySpeed: 3000, // Time between auto slides (3 seconds)
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true
});

})(jQuery);