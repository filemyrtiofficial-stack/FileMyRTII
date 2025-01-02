(function ($) {
    "use strict";

        if ($('.testimonial_slider').length) {
          $('.testimonial_slider').slick({
               dots: false,
               arrows: true,
               infinite: true,
               speed: 300,
               slidesToShow: 1,
               slidesToScroll: 1,
               autoplay: true,
               autoplaySpeed: 2000,
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
            const $megaMenuWrapper = $(this).siblings('.mega_menu_wrapper');
            if ($megaMenuWrapper.length) {
            $(this).toggleClass('active');
            $megaMenuWrapper.slideToggle(300, function() {
                if ($megaMenuWrapper.is(':visible')) {
                    $megaMenuWrapper.addClass('show');
                } else {
                    $megaMenuWrapper.removeClass('show');
                }
            });
            $(this).parent().siblings().find('.mega_menu_wrapper').slideUp(300).removeClass('show');
        $(this).parent().siblings().find('.arrow-btn').removeClass('active');
            }
        });
    
        // Handle second-level dropdowns
        $('.mega_menu .has-dropdown > .arrow-btn').on("click",function (e) {
            e.preventDefault();
            const $submenu = $(this).siblings('ul'); 
            if ($submenu.length) {
            $(this).toggleClass('active');
            $submenu.slideToggle(300, function() {
                if ($submenu.is(':visible')) {
                    $submenu.addClass('show');
                } else {
                    $submenu.removeClass('show');
                }
            });

            $(this).parent().siblings().find('ul').slideUp(300).removeClass('show');
            $(this).parent().siblings().find('.arrow-btn').removeClass('active');
            }
        });
    
        // Handle third-level dropdowns
        $('.mega_menu ul .has-dropdown > .arrow-btn').on("click",function (e) {
            e.preventDefault();
            const $submenu = $(this).siblings('ul');
            if ($(this).siblings('ul').length) {
            $(this).toggleClass('active');
            $submenu.slideToggle(300, function() {
                if ($submenu.is(':visible')) {
                    $submenu.addClass('show');
                } else {
                    $submenu.removeClass('show');
                }
            });
            $(this).parent().siblings().find('ul').slideUp(300).removeClass('show');
            $(this).parent().siblings().find('.arrow-btn').removeClass('active');
            }
        });

    
        // Close all dropdowns when clicking outside the menu
        $(document).on("click",function (e) {
            if (!$(e.target).closest('.menu').length) {
                // $('.has-dropdown > .arrow-btn').removeClass('active');
                // $('.mega_menu_wrapper').slideUp(300).removeClass('show');
                // $('.mega_menu ul').slideUp(300).removeClass('show');
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
            $('.accordion_item .accordion_title').on("click",function(){
                $(this).siblings(".accordion_content").slideToggle(300);
                $(this).parent().siblings().find(".accordion_content").slideUp(300);
                $(this).parent().siblings().find(".accordion_title").removeClass("active");
                $(this).toggleClass("active");
            });
        }

        // contact us page js

        if ($('.contact_faq_tab .faq_item').length) {
            $('.faq_item .faq_title').on("click",function(){
                $(this).siblings(".faq_content").slideToggle(300);
                $(this).parent().siblings().find(".faq_content").slideUp(300);
                $(this).parent().siblings().find(".faq_title").removeClass("active");
                $(this).toggleClass("active");
            });
        }

        // contact tabs
        if ($('.contact_faq_tab_content .contact_faq_tab').length) {
            const $listItem = $('.contact_faq_list li');
            $('.contact_faq_tab').first().addClass('active');
            $listItem.first().addClass('active');
            $('.contact_faq_list li a').click(function(e) {
                e.preventDefault();
                $('.contact_faq_tab').removeClass('active');
                $listItem.removeClass('active');
                const targetTab = $(this).attr('href');
                $(targetTab).addClass('active');
                $(this).parent().addClass('active');
                const $activeListItem = $('.contact_faq_list li.active');
                const $prevItem = $activeListItem.prev();
                console.log($activeListItem);
                if ($prevItem.length) {
                    $listItem.css('border-bottom','1px solid rgba(212, 212, 212, 0.5)');
                    $activeListItem.css('border', 'none')
                    $prevItem.css('border', 'none');
                }
            });
        }

        // $('.form_yes').hide();
        // $('.form_no').hide();
    
        // // Show/hide form based on selected radio button
        // $('input[name="rti_option"]').change(function() {
        //     if ($(this).is('#rti_no')) {
        //         $('.form_yes').show(); // Show the form for applying RTI
        //         $('.form_no').hide(); // Hide the message for already applied RTI
        //     } else {
        //         $('.form_yes').hide(); // Hide the form for applying RTI
        //         $('.form_no').show(); // Show the message for already applied RTI
        //     }
        // });

        function toggleForm() {
            if ($('#rti_yes').is(':checked')) {
                $('.form_yes').show();
                $('.form_no').hide();
            } else {
                $('.form_yes').hide();
                $('.form_no').show();
            }
        }
    
        $('.form_yes').hide();
        $('.form_no').hide();
    

        toggleForm();
    

        $('input[name="rti_option"]').change(function() {
            toggleForm();
        });
        
        // service detail page form tab js
        if ($('.form_tab_item').length) {
            $('.form_tab_item').on("click",function(){  
                $(".form_tab").removeClass('tab-active');
                $(".form_tab[data-id='"+$(this).attr('data-id')+"']").addClass("tab-active");
                $(".form_tab_item").removeClass('active');
                $(this).parent().find(".form_tab_item").addClass('active');
            });
        }


        // service listing page js
        
        // service listing page testimonial client slider

        if ($('.testimonial_client_slider').length) {
            $('.testimonial_client_slider').slick({
                 dots: false,
                 arrows: true,
                 infinite: true,
                 speed: 300,
                 slidesToShow: 2,
                 slidesToScroll: 1,
                 autoplay: true,
                 autoplaySpeed: 2000,
                 pauseOnHover: true,
                 pauseOnFocus: true,
                 prevArrow: $(".prev_btn"),
                 nextArrow: $(".next_btn"),
                 responsive: [
                      {
                          breakpoint: 768,
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
  

})(jQuery);