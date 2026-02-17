<?php
/**
 * Plugin Name: Golem Blog Fixes
 * Description: Fixes author display, blog listing images, and thumbnail display
 * Version: 5.0
 */

if (!defined('ABSPATH')) exit;

// ===== 1. HIDE AUTHOR + FIX BLOG THUMBNAILS =====
add_action('wp_head', function() {
    ?>
    <style id="golem-blog-fixes">
    /* Hide author everywhere */
    .entry-author,
    .post-author,
    .aux-author-widget,
    .author-section,
    .aux-author-section,
    .entry-meta .author,
    .aux-post-info .author,
    .post-info .author,
    .byline,
    .aux-byline,
    [class*="author-name"],
    [class*="author_name"],
    .aux-widget-recent-posts .entry-author,
    .widget-post-author,
    .single-post .entry-author,
    .single-post .author-section,
    .single-post .aux-author-section,
    .blog .entry-author,
    .archive .entry-author,
    a[rel="author"] {
        display: none !important;
    }

    /* Ensure blog listing images are visible */
    .aux-media-frame img,
    .entry-media img {
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* ===== BLOG THUMBNAILS — show full image, no zoom/crop ===== */

    /* Container: portrait ratio, contain the image fully */
    .post.column-entry .entry-media .aux-media-frame,
    .blog .entry-media .aux-media-frame,
    .archive .entry-media .aux-media-frame,
    .page .aux-widget-recent-posts .entry-media .aux-media-frame {
        aspect-ratio: 4 / 5 !important;
        overflow: hidden !important;
        height: auto !important;
        padding-bottom: 0 !important;
        background: transparent !important;
    }

    /* Override Phlox inline padding-bottom */
    .post.column-entry .entry-media .aux-media-frame[style],
    .blog .entry-media .aux-media-frame[style],
    .archive .entry-media .aux-media-frame[style] {
        padding-bottom: 0 !important;
        height: auto !important;
    }

    /* Images: fill container, center on faces */
    .post.column-entry .entry-media .aux-media-frame img,
    .blog .entry-media .aux-media-frame img,
    .archive .entry-media .aux-media-frame img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center 20% !important;
        display: block !important;
    }

    /* Remove clip-path masks that distort */
    .post.column-entry .aux-image-mask,
    .blog .aux-image-mask,
    .archive .aux-image-mask {
        clip-path: none !important;
        -webkit-clip-path: none !important;
    }

    /* Subtle hover zoom */
    .post.column-entry .entry-media .aux-media-frame img {
        transition: transform 0.3s ease !important;
    }
    .post.column-entry:hover .entry-media .aux-media-frame img {
        transform: scale(1.03) !important;
    }
    </style>
    <?php
}, 1);

// ===== 2. FIX BLOG LISTING IMAGES (inject missing thumbnails) =====
add_action('template_redirect', function() {
    if (!is_page() && !is_home() && !is_archive()) return;

    ob_start(function($html) {
        $pattern = '/(<div class="aux-media-frame[^"]*">\s*<a href=")(https?:\/\/golemroofing\.com\/[^"]+)(">\s*<\/a>)/';
        $html = preg_replace_callback($pattern, function($matches) {
            $before = $matches[1];
            $url = $matches[2];

            $slug = trim(parse_url($url, PHP_URL_PATH), '/');
            $posts = get_posts([
                'name'        => $slug,
                'post_type'   => 'post',
                'post_status' => 'publish',
                'numberposts' => 1,
            ]);

            if (empty($posts)) return $matches[0];
            $post = $posts[0];
            $thumb_id = get_post_thumbnail_id($post->ID);
            if (!$thumb_id) return $matches[0];

            $img_data = wp_get_attachment_image_src($thumb_id, 'full');
            if (!$img_data) {
                $img_data = wp_get_attachment_image_src($thumb_id, 'large');
            }
            if (!$img_data) return $matches[0];

            $img_url = $img_data[0];
            $width = $img_data[1];
            $height = $img_data[2];
            $alt = esc_attr(get_post_meta($thumb_id, '_wp_attachment_image_alt', true) ?: $post->post_title);

            $srcset = wp_get_attachment_image_srcset($thumb_id, 'full');
            $sizes = wp_get_attachment_image_sizes($thumb_id, 'full');

            $img_tag = sprintf(
                '<img src="%s" alt="%s" width="%d" height="%d" class="aux-attachment aux-featured-image"%s%s loading="lazy" />',
                esc_url($img_url),
                $alt,
                $width,
                $height,
                $srcset ? ' srcset="' . esc_attr($srcset) . '"' : '',
                $sizes ? ' sizes="' . esc_attr($sizes) . '"' : ''
            );

            return $before . $url . '">' . $img_tag . '</a>';
        }, $html);

        // Also replace any cropped instagram image URLs with originals
        // Pattern: filename-WIDTHxHEIGHT.webp → filename.webp
        $html = preg_replace(
            '/(\/wp-content\/uploads\/instagram\/[^"\']+)-\d+x\d+\.(webp|jpg|jpeg|png)/i',
            '$1.$2',
            $html
        );

        // Same for 2026/02 uploads folder
        $html = preg_replace(
            '/(\/wp-content\/uploads\/2026\/02\/[^"\']+)-\d+x\d+\.(webp|jpg|jpeg|png)/i',
            '$1.$2',
            $html
        );

        // Remove srcset and sizes from blog listing images to force original src
        // This prevents browser from picking cropped versions from srcset
        $html = preg_replace(
            '/(<div class="aux-media-frame[^>]*>.*?<img[^>]*?) srcset="[^"]*"/is',
            '$1',
            $html
        );
        $html = preg_replace(
            '/(<div class="aux-media-frame[^>]*>.*?<img[^>]*?) sizes="[^"]*"/is',
            '$1',
            $html
        );

        return $html;
    });
});

// ===== 3. REMOVE AUTHOR FROM POST INFO =====
add_filter('auxin_post_info_args', function($args) {
    if (isset($args['author'])) $args['author'] = false;
    if (isset($args['display_author'])) $args['display_author'] = false;
    return $args;
}, 999);

// ===== 4. DISABLE LAZY LOADING FOR BLOG THUMBNAILS =====
add_filter('auxin_is_preloadable', '__return_false', 999);

add_filter('auxin_get_responsive_thumbnail_args', function($args) {
    $args['preloadable'] = false;
    $args['preload_preview'] = false;
    return $args;
}, 999);

// ===== 5. USE LARGE IMAGES FOR THUMBNAILS =====
add_filter('auxin_post_thumbnail_size', function($size) {
    return 'full';
}, 999);
