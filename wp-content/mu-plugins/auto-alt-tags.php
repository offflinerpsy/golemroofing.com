<?php
/**
 * Auto-generate ALT tags for images without ALT
 * Golem Roofing SEO Optimization
 */

// Run only on admin_init to update existing images
add_action("admin_init", function() {
    // Only run once per day
    if (get_transient("golem_alt_tags_updated")) {
        return;
    }
    
    global $wpdb;
    
    // Find images without ALT text
    $images = $wpdb->get_results("
        SELECT p.ID, p.post_title, p.guid
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id AND pm.meta_key = '_wp_attachment_image_alt'
        WHERE p.post_type = 'attachment'
        AND p.post_mime_type LIKE 'image/%'
        AND (pm.meta_value IS NULL OR pm.meta_value = '')
        LIMIT 50
    ");
    
    foreach ($images as $image) {
        // Generate ALT from title
        $alt = $image->post_title;
        
        // Clean up the title
        $alt = str_replace(["-", "_", ".jpg", ".png", ".webp", ".gif", ".jpeg"], " ", $alt);
        $alt = preg_replace("/[0-9]+x[0-9]+/", "", $alt); // Remove dimensions
        $alt = preg_replace("/\s+/", " ", $alt); // Multiple spaces to one
        $alt = trim($alt);
        $alt = ucfirst(strtolower($alt));
        
        // Add Golem Roofing context for generic images
        if (stripos($alt, "roofing") === false && stripos($alt, "roof") === false && stripos($alt, "golem") === false) {
            $alt .= " - Golem Roofing";
        }
        
        if (!empty($alt)) {
            update_post_meta($image->ID, "_wp_attachment_image_alt", $alt);
        }
    }
    
    // Set transient to avoid running too often
    set_transient("golem_alt_tags_updated", true, DAY_IN_SECONDS);
});

// Auto-add ALT to newly uploaded images
add_action("add_attachment", function($post_id) {
    $post = get_post($post_id);
    
    if ($post->post_mime_type && strpos($post->post_mime_type, "image/") === 0) {
        $existing_alt = get_post_meta($post_id, "_wp_attachment_image_alt", true);
        
        if (empty($existing_alt)) {
            $alt = $post->post_title;
            $alt = str_replace(["-", "_"], " ", $alt);
            $alt = preg_replace("/\.[^.]+$/", "", $alt); // Remove extension
            $alt = trim($alt);
            $alt = ucfirst(strtolower($alt));
            
            if (!empty($alt)) {
                update_post_meta($post_id, "_wp_attachment_image_alt", $alt . " - Golem Roofing");
            }
        }
    }
});
