<?php
/**
 * Plugin Name: Golem Instagram Gallery (Swiper) v2.1
 * Description: Modern Instagram-style gallery with Swiper.js - arrows inside, touch support, autoplay. Single-image galleries handled cleanly.
 * Version: 2.1.0
 * Author: Golem Roofing
 * 
 * Based on official Swiper.js v11 documentation
 * https://swiperjs.com/swiper-api
 */

defined('ABSPATH') || exit;

/**
 * Enqueue Swiper.js assets
 */
add_action('wp_enqueue_scripts', 'golem_swiper_v2_assets', 20);
function golem_swiper_v2_assets() {
    // Load on posts and pages with galleries
    if (!is_singular()) return;
    
    // Swiper v11 CSS Bundle (includes all modules)
    wp_enqueue_style(
        'swiper-bundle',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        [],
        '11.1.14'
    );
    
    // Swiper v11 JS Bundle 
    wp_enqueue_script(
        'swiper-bundle',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        [],
        '11.1.14',
        true
    );
    
    // Our custom init script
    wp_add_inline_script('swiper-bundle', golem_swiper_v2_init());
}

/**
 * Swiper initialization script
 * Based on official Swiper.js API documentation
 */
function golem_swiper_v2_init() {
    return <<<'JAVASCRIPT'
(function() {
    'use strict';
    
    function initGolemSwipers() {
        // Support both class names
        const galleries = document.querySelectorAll('.golem-instagram-gallery, .golem-swiper');
        
        galleries.forEach(function(el) {
            // Skip if already initialized
            if (el.swiper) return;
            
            // Count actual slides
            const slideCount = el.querySelectorAll('.swiper-slide').length;
            const isSingle = slideCount <= 1;
            
            // Get autoplay delay from data attribute or default
            const autoplayDelay = parseInt(el.dataset.autoplay) || 4000;
            
            // Hide arrows and pagination for single-image galleries
            if (isSingle) {
                var prevBtn = el.querySelector('.swiper-button-prev');
                var nextBtn = el.querySelector('.swiper-button-next');
                var pagination = el.querySelector('.swiper-pagination');
                if (prevBtn) prevBtn.style.display = 'none';
                if (nextBtn) nextBtn.style.display = 'none';
                if (pagination) pagination.style.display = 'none';
                el.classList.add('golem-single-image');
            }
            
            // Build Swiper options — disable loop/autoplay for single images
            var options = {
                // Core
                slidesPerView: 1,
                spaceBetween: 0,
                speed: 500,
                grabCursor: !isSingle,
                
                // Loop mode only for multi-image (requires 2+ slides)
                loop: !isSingle,
                
                // Keyboard navigation
                keyboard: {
                    enabled: !isSingle,
                    onlyInViewport: true
                },
                
                // Touch/mouse drag
                touchEventsTarget: 'container',
                touchRatio: isSingle ? 0 : 1,
                touchAngle: 45,
                simulateTouch: !isSingle,
                
                // Accessibility
                a11y: {
                    enabled: true,
                    prevSlideMessage: 'Previous slide',
                    nextSlideMessage: 'Next slide',
                    firstSlideMessage: 'This is the first slide',
                    lastSlideMessage: 'This is the last slide'
                },
                
                // Smooth slide effect
                effect: 'slide',
                
                // Events
                on: {
                    init: function() {
                        this.el.classList.add('swiper-initialized');
                    }
                }
            };
            
            // Only add navigation/pagination/autoplay for multi-image galleries
            if (!isSingle) {
                options.autoplay = {
                    delay: autoplayDelay,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true
                };
                options.navigation = {
                    nextEl: el.querySelector('.swiper-button-next'),
                    prevEl: el.querySelector('.swiper-button-prev')
                };
                options.pagination = {
                    el: el.querySelector('.swiper-pagination'),
                    clickable: true,
                    dynamicBullets: true,
                    dynamicMainBullets: 3
                };
            }
            
            new Swiper(el, options);
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGolemSwipers);
    } else {
        initGolemSwipers();
    }
    
    // Also initialize after Elementor frontend loads (for preview)
    document.addEventListener('elementor/frontend/init', function() {
        setTimeout(initGolemSwipers, 500);
    });
})();
JAVASCRIPT;
}

/**
 * Gallery CSS styles based on official Swiper CSS variables
 * https://swiperjs.com/swiper-api#css-styles
 */
add_action('wp_head', 'golem_swiper_v2_styles', 20);
function golem_swiper_v2_styles() {
    if (!is_singular()) return;
    ?>
<style id="golem-swiper-v2-styles">
/* ==========================================================================
   GOLEM INSTAGRAM GALLERY - SWIPER V2
   Modern Instagram-style carousel with proper arrow positioning
   ========================================================================== */

/* Swiper CSS Custom Properties (Official API)
   https://swiperjs.com/swiper-api#css-custom-properties */
:root {
    /* Navigation */
    --swiper-navigation-size: 24px;
    --swiper-navigation-top-offset: 50%;
    --swiper-navigation-sides-offset: 12px;
    --swiper-navigation-color: #ffffff;
    
    /* Pagination */
    --swiper-pagination-color: #ffffff;
    --swiper-pagination-bullet-size: 8px;
    --swiper-pagination-bullet-inactive-color: #ffffff;
    --swiper-pagination-bullet-inactive-opacity: 0.5;
    --swiper-pagination-bullet-opacity: 1;
    --swiper-pagination-bottom: 16px;
    --swiper-pagination-bullet-horizontal-gap: 6px;
    
    /* Theme */
    --swiper-theme-color: #ffffff;
}

/* Gallery Container */
.golem-instagram-gallery,
.golem-swiper {
    position: relative !important;
    width: 100% !important;
    max-width: 600px !important;
    margin: 0 auto 32px !important;
    border-radius: 12px !important;
    overflow: hidden !important;
    background: #1a1a1a !important;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15) !important;
}

/* Wrapper */
.golem-instagram-gallery .swiper-wrapper,
.golem-swiper .swiper-wrapper {
    align-items: center;
}

/* Slides */
.golem-instagram-gallery .swiper-slide,
.golem-swiper .swiper-slide {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: #1a1a1a !important;
    overflow: hidden !important;
}

/* Images - Instagram 4:5 aspect ratio */
.golem-instagram-gallery .swiper-slide img,
.golem-swiper .swiper-slide img {
    width: 100% !important;
    height: auto !important;
    max-height: 750px !important;
    object-fit: cover !important;
    aspect-ratio: 4 / 5 !important;
    display: block !important;
}

/* ==========================================================================
   NAVIGATION ARROWS - Instagram Style
   Positioned INSIDE the gallery with proper offset
   ========================================================================== */
.golem-instagram-gallery .swiper-button-prev,
.golem-instagram-gallery .swiper-button-next,
.golem-swiper .swiper-button-prev,
.golem-swiper .swiper-button-next {
    /* Position inside container */
    position: absolute !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    z-index: 10 !important;
    
    /* Size and appearance */
    width: 40px !important;
    height: 40px !important;
    margin-top: 0 !important;
    
    /* Instagram-style circular buttons */
    background: rgba(0, 0, 0, 0.5) !important;
    border-radius: 50% !important;
    backdrop-filter: blur(4px) !important;
    -webkit-backdrop-filter: blur(4px) !important;
    
    /* Smooth transitions */
    transition: all 0.25s ease !important;
    
    /* Hide default arrow color */
    color: #fff !important;
}

/* Position arrows inside with offset */
.golem-instagram-gallery .swiper-button-prev,
.golem-swiper .swiper-button-prev {
    left: 12px !important;
    right: auto !important;
}

.golem-instagram-gallery .swiper-button-next,
.golem-swiper .swiper-button-next {
    right: 12px !important;
    left: auto !important;
}

/* Custom arrow icons - smaller and centered */
.golem-instagram-gallery .swiper-button-prev::after,
.golem-instagram-gallery .swiper-button-next::after,
.golem-swiper .swiper-button-prev::after,
.golem-swiper .swiper-button-next::after {
    font-size: 16px !important;
    font-weight: 600 !important;
    color: #fff !important;
}

/* Hover state */
.golem-instagram-gallery .swiper-button-prev:hover,
.golem-instagram-gallery .swiper-button-next:hover,
.golem-swiper .swiper-button-prev:hover,
.golem-swiper .swiper-button-next:hover {
    background: rgba(0, 0, 0, 0.75) !important;
    transform: translateY(-50%) scale(1.05) !important;
}

/* Hide arrows when disabled */
.golem-instagram-gallery .swiper-button-disabled,
.golem-swiper .swiper-button-disabled {
    opacity: 0 !important;
    pointer-events: none !important;
}

/* ==========================================================================
   PAGINATION DOTS - Instagram Style
   ========================================================================== */
.golem-instagram-gallery .swiper-pagination,
.golem-swiper .swiper-pagination {
    position: absolute !important;
    bottom: 16px !important;
    left: 0 !important;
    right: 0 !important;
    width: 100% !important;
    text-align: center !important;
    z-index: 10 !important;
}

.golem-instagram-gallery .swiper-pagination-bullet,
.golem-swiper .swiper-pagination-bullet {
    width: 8px !important;
    height: 8px !important;
    background: rgba(255, 255, 255, 0.5) !important;
    opacity: 1 !important;
    margin: 0 4px !important;
    border-radius: 50% !important;
    transition: all 0.3s ease !important;
}

.golem-instagram-gallery .swiper-pagination-bullet-active,
.golem-swiper .swiper-pagination-bullet-active {
    background: #ffffff !important;
    transform: scale(1.2) !important;
}

/* Dynamic bullets - center larger */
.golem-instagram-gallery .swiper-pagination-bullet-active-main,
.golem-swiper .swiper-pagination-bullet-active-main {
    background: #ffffff !important;
}

/* ==========================================================================
   RESPONSIVE - Mobile optimizations
   ========================================================================== */
@media (max-width: 768px) {
    .golem-instagram-gallery,
    .golem-swiper {
        max-width: 100% !important;
        margin: 0 0 24px !important;
        border-radius: 0 !important;
    }
    
    /* Larger touch targets on mobile */
    .golem-instagram-gallery .swiper-button-prev,
    .golem-instagram-gallery .swiper-button-next,
    .golem-swiper .swiper-button-prev,
    .golem-swiper .swiper-button-next {
        width: 36px !important;
        height: 36px !important;
        background: rgba(0, 0, 0, 0.4) !important;
    }
    
    .golem-instagram-gallery .swiper-button-prev::after,
    .golem-instagram-gallery .swiper-button-next::after,
    .golem-swiper .swiper-button-prev::after,
    .golem-swiper .swiper-button-next::after {
        font-size: 14px !important;
    }
}

/* Hide arrows on very small screens - swipe is primary */
@media (max-width: 480px) {
    .golem-instagram-gallery .swiper-button-prev,
    .golem-instagram-gallery .swiper-button-next,
    .golem-swiper .swiper-button-prev,
    .golem-swiper .swiper-button-next {
        display: none !important;
    }
    
    /* Larger dots for touch */
    .golem-instagram-gallery .swiper-pagination-bullet,
    .golem-swiper .swiper-pagination-bullet {
        width: 10px !important;
        height: 10px !important;
    }
}

/* ==========================================================================
   SINGLE IMAGE GALLERIES
   ========================================================================== */
.golem-instagram-gallery.golem-single-image {
    cursor: default !important;
}

.golem-instagram-gallery.golem-single-image .swiper-button-prev,
.golem-instagram-gallery.golem-single-image .swiper-button-next,
.golem-instagram-gallery.golem-single-image .swiper-pagination {
    display: none !important;
}

/* ==========================================================================
   INITIALIZATION STATE
   ========================================================================== */
.golem-instagram-gallery:not(.swiper-initialized),
.golem-swiper:not(.swiper-initialized) {
    opacity: 0.5;
}

.golem-instagram-gallery.swiper-initialized,
.golem-swiper.swiper-initialized {
    opacity: 1;
    transition: opacity 0.3s ease;
}

/* ==========================================================================
   PRINT STYLES
   ========================================================================== */
@media print {
    .golem-instagram-gallery .swiper-button-prev,
    .golem-instagram-gallery .swiper-button-next,
    .golem-instagram-gallery .swiper-pagination,
    .golem-swiper .swiper-button-prev,
    .golem-swiper .swiper-button-next,
    .golem-swiper .swiper-pagination {
        display: none !important;
    }
}
</style>
    <?php
}

/**
 * Shortcode: [golem_gallery images="url1,url2,url3"]
 */
add_shortcode('golem_gallery', 'golem_gallery_v2_shortcode');
function golem_gallery_v2_shortcode($atts) {
    $atts = shortcode_atts([
        'images' => '',
        'autoplay' => '4000'
    ], $atts);
    
    if (empty($atts['images'])) return '';
    
    $images = array_map('trim', explode(',', $atts['images']));
    $images = array_filter($images); // Remove empty entries
    $autoplay = absint($atts['autoplay']);
    $is_single = count($images) <= 1;
    
    ob_start();
    ?>
    <div class="golem-instagram-gallery swiper<?php echo $is_single ? ' golem-single-image' : ''; ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-slides="<?php echo count($images); ?>">
        <div class="swiper-wrapper">
            <?php foreach ($images as $img): ?>
            <div class="swiper-slide">
                <img src="<?php echo esc_url($img); ?>" alt="Golem Roofing project" loading="lazy">
            </div>
            <?php endforeach; ?>
        </div>
        <?php if (!$is_single): ?>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Enable WebP uploads
 */
add_filter('upload_mimes', function($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
});
