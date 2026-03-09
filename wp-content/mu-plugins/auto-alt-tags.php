<?php
/**
 * Auto-generate contextual ALT tags for images.
 * v2.0 — Uses parent post title as context instead of filename.
 * Golem Roofing SEO Optimization
 */

/**
 * Generate a contextual alt tag for an attachment.
 */
function golem_generate_alt($post_id) {
    $post = get_post($post_id);
    if (!$post) return '';

    $alt = '';

    // 1. Try parent post title
    if ($post->post_parent > 0) {
        $parent = get_post($post->post_parent);
        if ($parent && !empty($parent->post_title)) {
            $alt = wp_strip_all_tags($parent->post_title);
        }
    }

    // 2. Check if filename is readable (not a hash)
    if (empty($alt)) {
        $file = get_post_meta($post_id, '_wp_attached_file', true);
        $name = pathinfo(basename($file ?: ''), PATHINFO_FILENAME);
        $is_hash = preg_match('/^[0-9a-f]{16,}$/i', $name)
            || preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-/', $name);

        if (!$is_hash && strlen($name) > 3) {
            $clean = str_replace(['-', '_'], ' ', $name);
            $clean = preg_replace('/\d+x\d+/', '', $clean);
            $clean = preg_replace('/\b(scaled|e\d+)\b/i', '', $clean);
            $clean = preg_replace('/\s+/', ' ', trim($clean));
            if (strlen($clean) > 3) {
                $alt = ucfirst(strtolower($clean));
            }
        }
    }

    // 3. Fallback
    if (empty($alt)) {
        $alt = 'Golem Roofing — professional roofing services in Los Angeles';
    }

    // Add branding if missing
    if (stripos($alt, 'roof') === false && stripos($alt, 'golem') === false) {
        $alt .= ' — Golem Roofing';
    }

    return trim($alt);
}

// Auto-add ALT to newly uploaded images
add_action('add_attachment', function($post_id) {
    $post = get_post($post_id);
    if (!$post || strpos($post->post_mime_type, 'image/') !== 0) return;

    $existing = get_post_meta($post_id, '_wp_attachment_image_alt', true);
    if (!empty($existing)) return;

    $alt = golem_generate_alt($post_id);
    if (!empty($alt)) {
        update_post_meta($post_id, '_wp_attachment_image_alt', $alt);
    }
});
