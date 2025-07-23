jQuery(document).ready(function($) {
    'use strict';

    // Smooth scrolling for anchor links
    $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
                return false;
            }
        }
    });

    // Fade in animation on scroll
    function fadeInOnScroll() {
        $('.fade-in').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('visible');
            }
        });
    }

    // Initialize fade in elements
    $('.card, .featured-content, .section-title').addClass('fade-in');
    
    // Check on scroll
    $(window).on('scroll resize', fadeInOnScroll);
    fadeInOnScroll(); // Check on load

    // Navbar background on scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('#header_area').addClass('scrolled');
        } else {
            $('#header_area').removeClass('scrolled');
        }
    });

    // Carousel auto-play control
    if ($('.carousel').length) {
        $('.carousel').carousel({
            interval: 5000,
            pause: 'hover'
        });
    }

    // Loading effect for images
    $('img').on('load', function() {
        $(this).removeClass('loading');
    }).each(function() {
        if (this.complete) {
            $(this).removeClass('loading');
        } else {
            $(this).addClass('loading');
        }
    });

    // Search form enhancement
    $('.widget form[role="search"]').addClass('d-flex');
    $('.widget input[type="search"]').addClass('form-control me-2');
    $('.widget input[type="submit"]').addClass('btn btn-outline-primary');

    // Mobile menu close on click
    $('.navbar-nav a').on('click', function() {
        if ($(window).width() < 992) {
            $('.navbar-collapse').collapse('hide');
        }
    });

    // Tooltip initialization
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Back to top button
    var backToTopBtn = $('<button class="btn btn-primary back-to-top"><i class="bi bi-arrow-up"></i></button>');
    $('body').append(backToTopBtn);

    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            backToTopBtn.fadeIn();
        } else {
            backToTopBtn.fadeOut();
        }
    });
      backToTopBtn.click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    
    // Form validation enhancement
    $('form').on('submit', function() {
        var form = $(this);
        var hasError = false;
        
        // Check required fields
        form.find('[required]').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('is-invalid');
                hasError = true;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        // Email validation
        form.find('input[type="email"]').each(function() {
            var email = $(this).val();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email && !emailRegex.test(email)) {
                $(this).addClass('is-invalid');
                hasError = true;
            }
        });
        
        if (hasError) {
            return false;
        }
    });
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        var imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(function(img) {
            imageObserver.observe(img);
        });
    }
    
    // Accordion enhancement
    $('.accordion-header').on('click', function() {
        var accordion = $(this).closest('.accordion-item');
        var content = accordion.find('.accordion-content');
        
        // Close other accordions
        $('.accordion-item').not(accordion).removeClass('active');
        $('.accordion-content').not(content).slideUp();
        
        // Toggle current accordion
        accordion.toggleClass('active');
        content.slideToggle();
    });
    
    // Cookie consent (if needed)
    if (!localStorage.getItem('cookieConsent')) {
        var cookieBanner = $('<div class="cookie-banner alert alert-info fixed-bottom m-3">' +
            '<p>This website uses cookies to ensure you get the best experience. ' +
            '<button class="btn btn-sm btn-primary ms-2 accept-cookies">Accept</button>' +
            '<button class="btn btn-sm btn-outline-secondary ms-1 decline-cookies">Decline</button></p>' +
            '</div>');
        
        $('body').append(cookieBanner);
        
        $('.accept-cookies').click(function() {
            localStorage.setItem('cookieConsent', 'accepted');
            cookieBanner.fadeOut();
        });
        
        $('.decline-cookies').click(function() {
            localStorage.setItem('cookieConsent', 'declined');
            cookieBanner.fadeOut();
        });
    }
});
