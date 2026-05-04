<?php
/**
 * Plugin Name: Golem Blog SEO & Cross-Links
 * Description: Article Schema.org + cross-links (cities & services) + FAQ Schema + auto internal linking
 * Version: 3.1
 */

if (!defined('ABSPATH')) exit;

// ===== 0. LCP IMAGE PRELOAD =====
add_action('wp_head', 'golem_lcp_preload', 1);
function golem_lcp_preload() {
    // Blog posts: preload featured image
    if (is_single() && get_post_type() === 'post') {
        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if ($thumb_url) {
            echo '<link rel="preload" as="image" href="' . esc_url($thumb_url) . '" fetchpriority="high">' . "\n";
        }
        return;
    }

    // Homepage: preload hero background
    if (is_front_page()) {
        $hero_url = 'https://golemroofing.com/wp-content/uploads/2025/08/7bf0ac983262c3171f71cc5a0495567e.webp';
        echo '<link rel="preload" as="image" href="' . esc_url($hero_url) . '" fetchpriority="high">' . "\n";
    }
}

// ===== 1. ARTICLE SCHEMA.ORG FOR EVERY BLOG POST =====
add_action('wp_head', 'golem_blog_article_schema');
function golem_blog_article_schema() {
    if (!is_single() || get_post_type() !== 'post') return;

    global $post;
    $title = get_the_title($post);
    $url = get_permalink($post);
    $date_published = get_the_date('c', $post);
    $date_modified = get_the_modified_date('c', $post);
    $excerpt = wp_strip_all_tags(get_the_excerpt($post));
    $thumb_url = get_the_post_thumbnail_url($post, 'full');

    // Determine author based on content type
    $content_lower = strtolower($post->post_content);
    if (strpos($content_lower, 'andrei') !== false || strpos($content_lower, 'markavets') !== false) {
        $author_name = 'Andrei Markavets';
        $author_title = 'Co-Founder & Project Manager, Golem Roofing';
    } elseif (strpos($content_lower, 'dzmitry') !== false || strpos($content_lower, 'dvoryn') !== false) {
        $author_name = 'Dzmitry Dvoryn';
        $author_title = 'Co-Founder & Operations Lead, Golem Roofing';
    } else {
        $author_name = 'Golem Roofing Team';
        $author_title = 'Licensed Roofing Professionals, LA & Orange County';
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $title,
        'url' => $url,
        'datePublished' => $date_published,
        'dateModified' => $date_modified,
        'description' => $excerpt ?: substr(wp_strip_all_tags($post->post_content), 0, 160),
        'author' => [
            '@type' => 'Person',
            'name' => $author_name,
            'jobTitle' => $author_title,
            'worksFor' => [
                '@type' => 'Organization',
                'name' => 'Golem Roofing',
                'url' => 'https://golemroofing.com',
            ],
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Golem Roofing',
            'url' => 'https://golemroofing.com',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => 'https://golemroofing.com/wp-content/uploads/2025/08/7bf0ac983262c3171f71cc5a0495567e.webp',
            ],
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $url,
        ],
    ];

    if ($thumb_url) {
        $thumb_id = get_post_thumbnail_id($post);
        $img_meta = wp_get_attachment_metadata($thumb_id);
        $schema['image'] = [
            '@type' => 'ImageObject',
            'url' => $thumb_url,
            'width' => $img_meta['width'] ?? 1200,
            'height' => $img_meta['height'] ?? 630,
        ];
        $img_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        if ($img_alt) {
            $schema['image']['name'] = $img_alt;
        }
    }

    // Extract FAQ from post content (golem-material-card h4 with question marks)
    $faq_items = [];
    if (preg_match_all('/<div class="golem-material-card">\s*<h4[^>]*>([^<]*\?[^<]*)<\/h4>\s*<p>([^<]+)<\/p>/s', $post->post_content, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $m) {
            $faq_items[] = [
                '@type' => 'Question',
                'name' => trim(strip_tags($m[1])),
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => trim(strip_tags($m[2])),
                ],
            ];
        }
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";

    // Output FAQPage schema if FAQ items found
    if (!empty($faq_items)) {
        $faq_schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faq_items,
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }

    // BreadcrumbList
    $breadcrumb = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://golemroofing.com/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => 'https://golemroofing.com/blog/'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $title],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}


// ===== 2. AUTO CROSS-LINK FOOTER ON ALL BLOG POSTS =====
add_filter('the_content', 'golem_blog_crosslinks', 20);
function golem_blog_crosslinks($content) {
    if (!is_single() || get_post_type() !== 'post') return $content;

    $cities = [
        ['slug' => 'roofing-seal-beach-ca', 'name' => 'Seal Beach'],
        ['slug' => 'roofing-long-beach-ca', 'name' => 'Long Beach'],
        ['slug' => 'roofing-los-alamitos-rossmoor-ca', 'name' => 'Los Alamitos & Rossmoor'],
        ['slug' => 'roofing-manhattan-beach-ca', 'name' => 'Manhattan Beach'],
        ['slug' => 'roofing-hermosa-beach-ca', 'name' => 'Hermosa Beach'],
        ['slug' => 'roofing-redondo-beach-ca', 'name' => 'Redondo Beach'],
        ['slug' => 'roofing-palos-verdes-ca', 'name' => 'Palos Verdes Estates'],
        ['slug' => 'roofing-rancho-palos-verdes-ca', 'name' => 'Rancho Palos Verdes'],
    ];

    $services = [
        ['slug' => 'roof-installation', 'name' => 'Roof Installation'],
        ['slug' => 'roof-replacement', 'name' => 'Roof Replacement'],
        ['slug' => 'roof-repair', 'name' => 'Roof Repair'],
        ['slug' => 'roof-inspection', 'name' => 'Roof Inspection'],
        ['slug' => 'roof-maintenance', 'name' => 'Roof Maintenance'],
        ['slug' => 'roof-leak-repair', 'name' => 'Roof Leak Repair'],
        ['slug' => 'tile-roof-installation', 'name' => 'Tile Roof Installation'],
        ['slug' => 'concrete-tile-roofing', 'name' => 'Concrete Tile Roofing'],
        ['slug' => 'metal-roofing', 'name' => 'Metal Roofing'],
        ['slug' => 'tpo-roofing', 'name' => 'TPO Roofing'],
        ['slug' => 'silicone-roof-coating', 'name' => 'Silicone Roof Coating'],
        ['slug' => 'shingle-roofing', 'name' => 'Shingle Roofing'],
        ['slug' => 'skylight-installation', 'name' => 'Skylight Installation'],
    ];

    $city_links = '';
    foreach ($cities as $city) {
        $city_links .= '<li><a href="/' . esc_attr($city['slug']) . '/">' . esc_html($city['name']) . '</a></li>' . "\n";
    }

    $service_links = '';
    foreach ($services as $svc) {
        $service_links .= '<li><a href="/' . esc_attr($svc['slug']) . '/">' . esc_html($svc['name']) . '</a></li>' . "\n";
    }

    $crosslink_block = '
<!-- wp:html -->
<div class="golem-tips" style="margin-top: 2rem;">
    <h5>Golem Roofing Service Areas</h5>
    <ul style="column-count: 2; column-gap: 1.5rem;">
' . $city_links . '    </ul>
    <h5 style="margin-top: 1.25rem;">Our Roofing Services</h5>
    <ul style="column-count: 3; column-gap: 1.5rem;">
' . $service_links . '    </ul>
    <p style="margin-top: 0.75rem; font-size: 0.85rem; color: rgba(30,29,35,0.6);">Licensed roofing contractor serving Los Angeles County and Orange County. GAF Certified. 50-year warranty. <strong>(562) 991-8165</strong></p>
</div>
<!-- /wp:html -->';

    // Insert before the CTA block (golem-cta)
    $cta_pos = strrpos($content, '<div class="golem-cta">');
    if ($cta_pos !== false) {
        $content = substr($content, 0, $cta_pos) . $crosslink_block . "\n" . substr($content, $cta_pos);
    } else {
        // Append at end if no CTA found
        $content .= $crosslink_block;
    }

    return $content;
}

// ===== 3. AUTO INTERNAL LINKS — SERVICE KEYWORDS IN POST BODY =====
add_filter('the_content', 'golem_blog_autolinks', 18);
function golem_blog_autolinks($content) {
    if (!is_single() || get_post_type() !== 'post') return $content;

    // Keyword => URL, ordered longest-first to avoid partial matches
    $service_links = [
        'silicone roof coating'  => '/silicone-roof-coating/',
        'tile roof installation' => '/tile-roof-installation/',
        'concrete tile roofing'  => '/concrete-tile-roofing/',
        'skylight installation'  => '/skylight-installation/',
        'roof leak repair'       => '/roof-leak-repair/',
        'roof installation'      => '/roof-installation/',
        'roof replacement'       => '/roof-replacement/',
        'roof inspection'        => '/roof-inspection/',
        'roof maintenance'       => '/roof-maintenance/',
        'shingle roofing'        => '/shingle-roofing/',
        'metal roofing'          => '/metal-roofing/',
        'tpo roofing'            => '/tpo-roofing/',
        'roof repair'            => '/roof-repair/',
        'concrete tile'          => '/concrete-tile-roofing/',
        'silicone coating'       => '/silicone-roof-coating/',
        'metal roof'             => '/metal-roofing/',
        'tpo roof'               => '/tpo-roofing/',
        'leak repair'            => '/roof-leak-repair/',
        'asphalt shingle'        => '/shingle-roofing/',
        'shingle roof'           => '/shingle-roofing/',
    ];

    $linked_urls = [];
    $max_links   = 4;

    foreach ($service_links as $keyword => $url) {
        if (count($linked_urls) >= $max_links) break;
        if (in_array($url, $linked_urls, true)) continue;
        // Skip if this URL is already linked in content
        if (stripos($content, 'href="' . $url) !== false) {
            $linked_urls[] = $url;
            continue;
        }

        $result = golem_autolink_first($content, $keyword, $url);
        if ($result !== null) {
            $content = $result;
            $linked_urls[] = $url;
        }
    }

    return $content;
}

/**
 * Link first text-node occurrence of $keyword to $url.
 * Skips content inside <a>, <h1>-<h6>, <script>, <style>, <button> tags.
 * Returns modified content string, or null if no match found.
 */
function golem_autolink_first(string $content, string $keyword, string $url): ?string {
    $parts = preg_split('/(<[^>]+>)/s', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
    $skip_depth = 0;
    $replaced   = false;
    $pattern    = '/\b(' . preg_quote($keyword, '/') . ')\b/i';

    for ($i = 0, $len = count($parts); $i < $len; $i++) {
        $part = $parts[$i];
        if ($part === '') continue;

        // HTML tag
        if ($part[0] === '<') {
            if (preg_match('/^<(a|h[1-6]|script|style|button)\b/i', $part)) {
                $skip_depth++;
            } elseif (preg_match('/^<\/(a|h[1-6]|script|style|button)>/i', $part)) {
                $skip_depth = max(0, $skip_depth - 1);
            }
            continue;
        }

        // Text node — try to replace first occurrence
        if (!$replaced && $skip_depth === 0 && preg_match($pattern, $part)) {
            $parts[$i] = preg_replace(
                $pattern,
                '<a href="' . esc_url($url) . '">$1</a>',
                $part,
                1
            );
            $replaced = true;
            break;
        }
    }

    return $replaced ? implode('', $parts) : null;
}
