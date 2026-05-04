<?php
/**
 * Plugin Name: Golem GEO Engine
 * Description: GEO optimization — llms.txt, AI-friendly robots.txt, enhanced Schema.org, BreadcrumbList, city landing pages, service pages, About Us page, footer branding
 * Version: 1.3.1
 * Author: Golem Roofing Dev Team
 */

if (!defined('ABSPATH')) exit;

// ═══════════════════════════════════════════════════════════════
// SERVICE AREAS CONFIGURATION
// ═══════════════════════════════════════════════════════════════

function golem_geo_get_service_areas(): array {
    return [
        'seal-beach' => [
            'city'          => 'Seal Beach',
            'state'         => 'CA',
            'zips'          => ['90740'],
            'lat'           => 33.7414,
            'lng'           => -118.1048,
            'slug'          => 'roofing-seal-beach-ca',
            'neighborhoods' => ['Old Ranch', 'College Park East', 'College Park West', 'The Hill'],
            'landmarks'     => ['Seal Beach Pier', 'Pacific Coast Highway', 'Seal Beach National Wildlife Refuge'],
        ],
        'long-beach' => [
            'city'          => 'Long Beach',
            'state'         => 'CA',
            'zips'          => ['90803', '90808', '90807'],
            'lat'           => 33.7701,
            'lng'           => -118.1937,
            'slug'          => 'roofing-long-beach-ca',
            'neighborhoods' => ['Belmont Shore', 'Belmont Heights', 'Naples', 'Alamitos Heights', 'Cal Heights', 'Bixby Knolls', 'Los Cerritos', 'Wrigley'],
            'landmarks'     => ['Long Beach Airport', 'CSULB', 'Belmont Pier', 'Shoreline Village'],
        ],
        'los-alamitos' => [
            'city'          => 'Los Alamitos',
            'state'         => 'CA',
            'zips'          => ['90720'],
            'lat'           => 33.8031,
            'lng'           => -118.0726,
            'slug'          => 'roofing-los-alamitos-rossmoor-ca',
            'neighborhoods' => ['Rossmoor', 'Rossmoor Center'],
            'landmarks'     => ['Rush Park', 'Shops at Rossmoor', 'Coyote Creek Trail'],
        ],
        'manhattan-beach' => [
            'city'          => 'Manhattan Beach',
            'state'         => 'CA',
            'zips'          => ['90266'],
            'lat'           => 33.8847,
            'lng'           => -118.4109,
            'slug'          => 'roofing-manhattan-beach-ca',
            'neighborhoods' => ['Sand Section', 'Tree Section', 'Hill Section', 'East Manhattan Beach', 'Manhattan Village'],
            'landmarks'     => ['Manhattan Beach Pier', 'The Strand', 'Manhattan Beach Boulevard'],
        ],
        'hermosa-beach' => [
            'city'          => 'Hermosa Beach',
            'state'         => 'CA',
            'zips'          => ['90254'],
            'lat'           => 33.8622,
            'lng'           => -118.3995,
            'slug'          => 'roofing-hermosa-beach-ca',
            'neighborhoods' => ['Upper Hermosa', 'Lower Hermosa', 'Hermosa Valley'],
            'landmarks'     => ['Hermosa Beach Pier', 'Pier Avenue', 'The Strand', 'Greenbelt'],
        ],
        'redondo-beach' => [
            'city'          => 'Redondo Beach',
            'state'         => 'CA',
            'zips'          => ['90277', '90278'],
            'lat'           => 33.8492,
            'lng'           => -118.3884,
            'slug'          => 'roofing-redondo-beach-ca',
            'neighborhoods' => ['North Redondo', 'South Redondo', 'Riviera Village'],
            'landmarks'     => ['King Harbor', 'Redondo Beach Pier', 'Aviation Boulevard'],
        ],
        'palos-verdes' => [
            'city'          => 'Palos Verdes Estates',
            'state'         => 'CA',
            'zips'          => ['90274'],
            'lat'           => 33.7834,
            'lng'           => -118.3906,
            'slug'          => 'roofing-palos-verdes-ca',
            'neighborhoods' => ['Lunada Bay', 'Malaga Cove', 'Valmonte', 'Rolling Hills', 'Rolling Hills Estates'],
            'landmarks'     => ['Trump National Golf Club', 'Malaga Cove Plaza', 'Palos Verdes Drive'],
        ],
        'rancho-palos-verdes' => [
            'city'          => 'Rancho Palos Verdes',
            'state'         => 'CA',
            'zips'          => ['90275'],
            'lat'           => 33.7444,
            'lng'           => -118.3870,
            'slug'          => 'roofing-rancho-palos-verdes-ca',
            'neighborhoods' => ['Portuguese Bend', 'Eastview', 'Miraleste'],
            'landmarks'     => ['Point Vicente Lighthouse', 'Wayfarers Chapel', 'Terranea Resort', 'Abalone Cove'],
        ],
    ];
}

function golem_geo_get_services(): array {
    return [
        ['name' => 'Roof Installation',            'slug' => 'roof-installation',            'category' => 'installation'],
        ['name' => 'Flat Roof Installation',        'slug' => 'flat-roof-installation',       'category' => 'installation'],
        ['name' => 'Tile Roof Installation',        'slug' => 'tile-roof-installation',       'category' => 'installation'],
        ['name' => 'Shingle Roof Installation',     'slug' => 'shingle-roof-installation',    'category' => 'installation'],
        ['name' => 'Roof Replacement',              'slug' => 'roof-replacement',             'category' => 'replacement'],
        ['name' => 'Flat Roof Replacement',         'slug' => 'flat-roof-replacement',        'category' => 'replacement'],
        ['name' => 'Tile Roof Replacement',         'slug' => 'tile-roof-replacement',        'category' => 'replacement'],
        ['name' => 'Shingle Roof Replacement',      'slug' => 'shingle-roof-replacement',     'category' => 'replacement'],
        ['name' => 'Clay Tile Roof Replacement',    'slug' => 'clay-tile-roof-replacement',   'category' => 'replacement'],
        ['name' => 'Concrete Tile Roof Replacement', 'slug' => 'concrete-tile-roof-replacement', 'category' => 'replacement'],
        ['name' => 'Roof Repair',                   'slug' => 'roof-repair',                  'category' => 'repair'],
        ['name' => 'Flat Roof Repair',              'slug' => 'flat-roof-repair',             'category' => 'repair'],
        ['name' => 'Tile Roof Repair',              'slug' => 'tile-roof-repair',             'category' => 'repair'],
        ['name' => 'Shingle Roof Repair',           'slug' => 'shingle-roof-repair',          'category' => 'repair'],
        ['name' => 'Silicone Roof Restoration',     'slug' => 'silicone-roof-restoration',    'category' => 'special'],
    ];
}

// ═══════════════════════════════════════════════════════════════
// 1. llms.txt ENDPOINT
// ═══════════════════════════════════════════════════════════════

add_action('init', 'golem_geo_llms_rewrite');
function golem_geo_llms_rewrite(): void {
    add_rewrite_rule('^llms\.txt$', 'index.php?golem_llms=short', 'top');
    add_rewrite_rule('^llms-full\.txt$', 'index.php?golem_llms=full', 'top');
}

add_filter('query_vars', function (array $vars): array {
    $vars[] = 'golem_llms';
    return $vars;
});

add_action('template_redirect', 'golem_geo_serve_llms');

// Prevent WP canonical redirect from adding trailing slash to llms.txt
add_filter('redirect_canonical', function ($redirect_url) {
    if (get_query_var('golem_llms')) return false;
    return $redirect_url;
}, 10, 1);
function golem_geo_serve_llms(): void {
    $mode = get_query_var('golem_llms');
    if (!$mode) return;

    header('Content-Type: text/plain; charset=utf-8');
    header('X-Robots-Tag: noindex');

    $areas    = golem_geo_get_service_areas();
    $services = golem_geo_get_services();
    $site_url = 'https://golemroofing.com';

    $cities_list = implode(', ', array_map(fn($a) => $a['city'], $areas));

    // --- SHORT VERSION ---
    $out = "# Golem Roofing — Professional Roofing Contractor in Long Beach & South Bay\n\n";
    $out .= "> Licensed, bonded, and insured roofing company serving {$cities_list}, and surrounding areas in California. Roof installation, replacement, repair, and silicone restoration with 12-year No-Leak workmanship warranty and 50-year manufacturer warranty.\n\n";

    $out .= "## Company Facts\n\n";
    $out .= "| Fact | Value |\n";
    $out .= "|------|-------|\n";
    $out .= "| Founded | 2025 (over 12 years of combined hands-on roofing experience) |\n";
    $out .= "| Rating | 5.0 / 5 (200+ five-star reviews across trusted profiles) |\n";
    $out .= "| Workmanship Warranty | 12 years No-Leak |\n";
    $out .= "| Manufacturer Warranty | 50 years |\n";
    $out .= "| Insurance | \$1M liability + \$25K bond |\n";
    $out .= "| Third-Party Protection | Up to \$250K documented third-party protection where eligible |\n";
    $out .= "| Starting Price | \$9,900 (full roof) |\n";
    $out .= "| Certifications | GAF Certified, ASC Certified |\n";
    $out .= "| License | California CSLB Licensed |\n\n";

    $out .= "## Services\n\n";
    foreach ($services as $s) {
        $out .= "- [{$s['name']}]({$site_url}/{$s['slug']}/)\n";
    }

    $out .= "\n## Service Areas\n\n";
    foreach ($areas as $a) {
        $zips = implode('/', $a['zips']);
        $out .= "- [{$a['city']}, CA {$zips}]({$site_url}/{$a['slug']}/)\n";
    }

    $out .= "\n## Contact\n\n";
    $out .= "- Phone: (562) 991-8165\n";
    $out .= "- Email: Golemroofing@gmail.com\n";
    $out .= "- Website: {$site_url}\n";
    $out .= "- Hours: Mon-Fri 7am-7pm, Sat 8am-5pm\n\n";

    $out .= "## Key Pages\n\n";
    $out .= "- [Homepage]({$site_url}/): Main landing page with service overview\n";
    $out .= "- [Blog]({$site_url}/blog/): 56+ articles on roofing tips, projects, and guides\n";
    $out .= "- [Free Roof Inspection]({$site_url}/roof-inspection-request-form/): Request a free inspection\n";

    if ($mode === 'full') {
        $out .= "\n---\n\n";
        $out .= "## Detailed Service Descriptions\n\n";

        $descriptions = [
            'Roof Installation'             => 'Complete new roof installation using premium materials (GAF Timberline HDZ, TPO, tile, composite). Includes tear-off of old roofing, deck inspection, underlayment, and new roof system.',
            'Flat Roof Installation'         => 'TPO and modified bitumen flat roof systems for commercial and residential buildings. Energy-efficient, durable, and backed by manufacturer warranty.',
            'Tile Roof Installation'         => 'Clay and concrete tile installation for Mediterranean, Spanish, and modern-style homes. Underlayment systems designed for Southern California climate.',
            'Shingle Roof Installation'      => 'Architectural and 3-tab shingle installation. GAF certified installer with access to premium color selections and extended warranties.',
            'Roof Replacement'               => 'Full tear-off and replacement of existing roof. Includes deck repair, modern underlayment, and new roofing material installation.',
            'Flat Roof Replacement'          => 'Removal of old torch-down, built-up, or failing flat roof systems. Replacement with TPO or silicone-coated systems.',
            'Tile Roof Replacement'          => 'Replacement of broken, cracked, or aging tile roofs. Options include clay, concrete, and composite tiles.',
            'Shingle Roof Replacement'       => 'Full shingle roof tear-off and replacement with GAF Timberline HDZ-RS or equivalent premium shingles.',
            'Clay Tile Roof Replacement'     => 'Specialized clay tile replacement preserving original aesthetic. Custom color matching available.',
            'Concrete Tile Roof Replacement' => 'Concrete tile roof replacement with modern lightweight alternatives or matching concrete tiles.',
            'Roof Repair'                    => 'Emergency and scheduled repairs for all roof types. Leak detection, patch repair, flashing replacement, and storm damage repair.',
            'Flat Roof Repair'               => 'Flat roof leak repair, ponding water solutions, membrane patching, and seam re-welding for TPO and modified bitumen.',
            'Tile Roof Repair'               => 'Individual tile replacement, underlayment repair, re-pointing, and valley repair for tile roofs.',
            'Shingle Roof Repair'            => 'Shingle replacement, wind damage repair, nail pop fixes, and flashing repairs.',
            'Silicone Roof Restoration'      => 'No tear-off silicone coating system for existing flat roofs. Extends roof life 15-20 years at fraction of replacement cost.',
        ];

        foreach ($services as $s) {
            $desc = $descriptions[$s['name']] ?? '';
            $out .= "### {$s['name']}\n{$desc}\n[Learn more]({$site_url}/{$s['slug']}/)\n\n";
        }

        $out .= "## Detailed Service Areas\n\n";
        foreach ($areas as $a) {
            $zips   = implode(', ', $a['zips']);
            $hoods  = implode(', ', $a['neighborhoods']);
            $marks  = implode(', ', $a['landmarks']);
            $out   .= "### {$a['city']}, CA (ZIP: {$zips})\n";
            $out   .= "Neighborhoods: {$hoods}\n";
            $out   .= "Landmarks: {$marks}\n";
            $out   .= "[City page]({$site_url}/{$a['slug']}/)\n\n";
        }

        $out .= "## Frequently Asked Questions\n\n";
        $faqs = golem_geo_get_homepage_faqs();
        foreach ($faqs as $faq) {
            $out .= "**Q: {$faq['q']}**\n{$faq['a']}\n\n";
        }
    }

    echo $out;
    exit;
}

// ═══════════════════════════════════════════════════════════════
// 2. ROBOTS.TXT — AI CRAWLER RULES
// ═══════════════════════════════════════════════════════════════

add_filter('robots_txt', 'golem_geo_robots_txt', 999, 2);
function golem_geo_robots_txt(string $output, bool $public): string {
    if (!$public) return $output;

    $ai_rules  = "\n# AI Search Crawlers — Allowed\n";
    $ai_rules .= "User-agent: GPTBot\nAllow: /\n\n";
    $ai_rules .= "User-agent: Google-Extended\nAllow: /\n\n";
    $ai_rules .= "User-agent: ClaudeBot\nAllow: /\n\n";
    $ai_rules .= "User-agent: PerplexityBot\nAllow: /\n\n";
    $ai_rules .= "User-agent: Applebot\nAllow: /\n\n";
    $ai_rules .= "User-agent: ChatGPT-User\nAllow: /\n\n";

    return $output . $ai_rules;
}

// ═══════════════════════════════════════════════════════════════
// 3. SCHEMA.ORG — COMPREHENSIVE STRUCTURED DATA
// ═══════════════════════════════════════════════════════════════

add_action('wp_head', 'golem_geo_schema_output', 1);
function golem_geo_schema_output(): void {
    if (is_front_page() || is_home()) {
        golem_geo_schema_homepage();
    } elseif (is_singular('post')) {
        golem_geo_schema_article();
    } elseif (is_singular('page')) {
        golem_geo_schema_page();
    }

    // BreadcrumbList on every page
    golem_geo_schema_breadcrumb();
}

/**
 * Homepage Schema: RoofingContractor + ServiceAreaBusiness + FAQPage
 */
function golem_geo_schema_homepage(): void {
    $areas    = golem_geo_get_service_areas();
    $services = golem_geo_get_services();

    // Build areaServed with GeoCoordinates
    $area_served = [];
    foreach ($areas as $a) {
        $area_served[] = [
            '@type'       => 'City',
            'name'        => $a['city'] . ', CA',
            'geo'         => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => $a['lat'],
                'longitude' => $a['lng'],
            ],
        ];
    }

    // Build service catalog
    $offer_items = [];
    foreach ($services as $s) {
        $offer_items[] = [
            '@type'        => 'Offer',
            'itemOffered'  => [
                '@type'       => 'Service',
                'name'        => $s['name'],
                'url'         => 'https://golemroofing.com/' . $s['slug'] . '/',
                'provider'    => ['@id' => 'https://golemroofing.com/#business'],
                'areaServed'  => array_map(fn($a) => ['@type' => 'City', 'name' => $a['city'] . ', CA'], $areas),
            ],
        ];
    }

    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => ['RoofingContractor', 'LocalBusiness'],
        '@id'         => 'https://golemroofing.com/#business',
        'name'        => 'Golem Roofing',
        'alternateName' => 'Golem Roofing',
        'description' => 'Professional roofing contractor serving Seal Beach, Long Beach, Manhattan Beach, Hermosa Beach, Redondo Beach, Palos Verdes, and surrounding areas in Long Beach and the South Bay, California. Licensed, bonded, insured. 12-year No-Leak workmanship warranty.',
        'url'         => 'https://golemroofing.com',
        'telephone'   => '+1-562-991-8165',
        'email'       => 'Golemroofing@gmail.com',
        'logo'        => [
            '@type'  => 'ImageObject',
            'url'    => 'https://golemroofing.com/wp-content/uploads/2025/08/7bf0ac983262c3171f71cc5a0495567e.png',
            'width'  => 798,
            'height' => 392,
        ],
        'image'       => 'https://golemroofing.com/wp-content/uploads/2025/08/d45507ae-55b3-4144-b589-eac3cd6e0a67.png',
        'address'     => [
            '@type'            => 'PostalAddress',
            'streetAddress'    => 'Long Beach',
            'addressLocality'  => 'Long Beach',
            'addressRegion'    => 'CA',
            'postalCode'       => '90802',
            'addressCountry'   => 'US',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => 33.786671,
            'longitude' => -118.182354,
        ],
        'areaServed'  => $area_served,
        'priceRange'  => '$$$',
        'currenciesAccepted' => 'USD',
        'paymentAccepted'    => 'Cash, Credit Card, Check',
        'openingHoursSpecification' => [
            [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens'     => '07:00',
                'closes'    => '19:00',
            ],
            [
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Saturday',
                'opens'     => '08:00',
                'closes'    => '17:00',
            ],
        ],
        'sameAs' => [
            'https://www.instagram.com/golemroofing/',
            'https://www.facebook.com/profile.php?id=61574735318556',
            'https://www.yelp.com/biz/golem-roofing-long-beach',
        ],
        'hasOfferCatalog' => [
            '@type'           => 'OfferCatalog',
            'name'            => 'Roofing Services',
            'itemListElement' => $offer_items,
        ],
        'aggregateRating' => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '5.0',
            'bestRating'  => '5',
            'worstRating' => '1',
            'ratingCount' => '192',
            'reviewCount' => '192',
        ],
        'slogan'       => 'Power You Can Trust',
        'foundingDate' => '2025',
    ];

    golem_geo_emit_jsonld($schema);

    // FAQPage schema — expanded
    $faqs      = golem_geo_get_homepage_faqs();
    $faq_items = [];
    foreach ($faqs as $f) {
        $faq_items[] = [
            '@type'          => 'Question',
            'name'           => $f['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $f['a'],
            ],
        ];
    }

    $faq_schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faq_items,
    ];
    golem_geo_emit_jsonld($faq_schema);
}

/**
 * Blog post Schema: Article
 */
function golem_geo_schema_article(): void {
    global $post;
    if (!$post) return;

    $schema = [
        '@context'      => 'https://schema.org',
        '@type'         => 'Article',
        'headline'      => get_the_title($post),
        'url'           => get_permalink($post),
        'datePublished' => get_the_date('c', $post),
        'dateModified'  => get_the_modified_date('c', $post),
        'author'        => [
            '@type'    => 'Organization',
            'name'     => 'Golem Roofing',
            'url'      => 'https://golemroofing.com',
        ],
        'publisher'     => [
            '@type' => 'Organization',
            'name'  => 'Golem Roofing',
            'logo'  => [
                '@type' => 'ImageObject',
                'url'   => 'https://golemroofing.com/wp-content/uploads/2025/08/7bf0ac983262c3171f71cc5a0495567e.png',
            ],
        ],
        'description'   => wp_trim_words(wp_strip_all_tags($post->post_content), 30, '...'),
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id'   => get_permalink($post),
        ],
        'about' => [
            '@type' => 'Service',
            'name'  => 'Roofing Services',
            'provider' => ['@id' => 'https://golemroofing.com/#business'],
        ],
    ];

    // Add image if post has thumbnail
    $thumb = get_the_post_thumbnail_url($post, 'full');
    if ($thumb) {
        $schema['image'] = $thumb;
    }

    golem_geo_emit_jsonld($schema);
}

/**
 * Generic page Schema: WebPage (future city/service pages will match here)
 */
function golem_geo_schema_page(): void {
    global $post;
    if (!$post) return;

    $slug  = $post->post_name;
    $areas = golem_geo_get_service_areas();

    // Check if this is a city landing page
    foreach ($areas as $a) {
        if ($slug === $a['slug']) {
            golem_geo_schema_city_page($a);
            return;
        }
    }

    // Check if this is a service page
    $services = golem_geo_get_services();
    foreach ($services as $s) {
        if ($slug === $s['slug']) {
            golem_geo_schema_service_page($s);
            return;
        }
    }
}

/**
 * City landing page Schema
 */
function golem_geo_schema_city_page(array $area): void {
    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => ['RoofingContractor', 'LocalBusiness'],
        'name'        => 'Golem Roofing — ' . $area['city'] . ', CA',
        'description' => "Professional roofing services in {$area['city']}, CA. Roof installation, replacement, and repair. Licensed, bonded, insured. Call (562) 991-8165.",
        'url'         => 'https://golemroofing.com/' . $area['slug'] . '/',
        'telephone'   => '+1-562-991-8165',
        'parentOrganization' => ['@id' => 'https://golemroofing.com/#business'],
        'areaServed'  => [
            '@type' => 'City',
            'name'  => $area['city'] . ', CA',
            'geo'   => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => $area['lat'],
                'longitude' => $area['lng'],
            ],
        ],
        'address' => [
            '@type'           => 'PostalAddress',
            'addressLocality' => $area['city'],
            'addressRegion'   => 'CA',
            'postalCode'      => $area['zips'][0],
            'addressCountry'  => 'US',
        ],
    ];

    golem_geo_emit_jsonld($schema);
}

/**
 * Service page Schema: Service + FAQPage
 */
function golem_geo_schema_service_page(array $service): void {
    $areas = golem_geo_get_service_areas();
    $descs = golem_geo_get_service_descriptions();

    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => $service['name'],
        'description' => $descs[$service['name']] ?? '',
        'url'         => 'https://golemroofing.com/' . $service['slug'] . '/',
        'provider'    => ['@id' => 'https://golemroofing.com/#business'],
        'areaServed'  => array_map(fn($a) => [
            '@type' => 'City',
            'name'  => $a['city'] . ', CA',
        ], $areas),
        'serviceType' => 'Roofing',
    ];

    golem_geo_emit_jsonld($schema);

    // FAQPage for this service category
    $faqs = golem_geo_get_service_faqs($service['category']);
    $faq_items = [];
    foreach ($faqs as $f) {
        $faq_items[] = [
            '@type'          => 'Question',
            'name'           => $f['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $f['a'],
            ],
        ];
    }
    golem_geo_emit_jsonld([
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faq_items,
    ]);
}

/**
 * BreadcrumbList Schema — all pages
 */
function golem_geo_schema_breadcrumb(): void {
    if (is_front_page()) return;

    $items   = [];
    $items[] = ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://golemroofing.com/'];

    if (is_singular('post')) {
        $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => 'https://golemroofing.com/blog/'];
        $items[] = ['@type' => 'ListItem', 'position' => 3, 'name' => get_the_title()];
    } elseif (is_singular('page')) {
        global $post;
        $slug     = $post->post_name;
        $areas    = golem_geo_get_service_areas();
        $services = golem_geo_get_services();

        $is_city = false;
        foreach ($areas as $a) {
            if ($slug === $a['slug']) {
                $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Service Areas'];
                $items[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $a['city'] . ', CA'];
                $is_city = true;
                break;
            }
        }
        if (!$is_city) {
            foreach ($services as $s) {
                if ($slug === $s['slug']) {
                    $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services'];
                    $items[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $s['name']];
                    $is_city = true;
                    break;
                }
            }
        }
        if (!$is_city) {
            $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => get_the_title()];
        }
    }

    if (count($items) < 2) return;

    $schema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
    golem_geo_emit_jsonld($schema);
}

// ═══════════════════════════════════════════════════════════════
// 4. EXPANDED FAQ DATA
// ═══════════════════════════════════════════════════════════════

function golem_geo_get_homepage_faqs(): array {
    return [
        [
            'q' => 'How much does a new roof cost in Long Beach and the South Bay?',
            'a' => 'At Golem Roofing, new roof installations start from $9,900. The final price depends on roof size, material type, number of stories, and existing layers. We offer free estimates — call (562) 991-8165.',
        ],
        [
            'q' => 'What areas do you serve in California?',
            'a' => 'Golem Roofing serves Seal Beach, Long Beach, Los Alamitos, Rossmoor, Manhattan Beach, Hermosa Beach, Redondo Beach, Palos Verdes Estates, Rolling Hills Estates, and Rancho Palos Verdes. We cover both Los Angeles County and Orange County.',
        ],
        [
            'q' => 'Do you offer warranties on roofing work?',
            'a' => 'Yes. We provide a 12-year No-Leak workmanship warranty, 50-year manufacturer warranty, $1M liability insurance, $25K bond, and $250K third-party protection through Directorii where eligible.',
        ],
        [
            'q' => 'Are you factory-certified by roofing manufacturers?',
            'a' => 'Yes. Golem Roofing is officially certified by GAF and ASC (Associated Builders and Contractors). Our team undergoes rigorous training and follows strict manufacturer standards to ensure your roof is built to last with the best warranties in the industry.',
        ],
        [
            'q' => 'Are you a licensed roofing contractor?',
            'a' => 'Yes, Golem Roofing is fully licensed with the California State License Board (CSLB), carries $25K bond and $1M liability insurance.',
        ],
        [
            'q' => 'How long does a roof replacement take?',
            'a' => 'Most residential roof replacements are completed in 1-3 days depending on roof size and complexity. Flat roof projects may take 2-4 days. We start early morning and work efficiently to minimize disruption.',
        ],
        [
            'q' => 'What roofing materials do you use?',
            'a' => 'We install GAF Timberline HDZ shingles, TPO membrane for flat roofs, clay and concrete tiles, and silicone coating systems. All materials come with manufacturer warranties of up to 50 years.',
        ],
        [
            'q' => 'Do you handle emergency roof repairs?',
            'a' => 'Yes, we provide emergency roof leak repair services across all our service areas. Call (562) 991-8165 for immediate assistance. We aim to respond within 24 hours for emergencies.',
        ],
        [
            'q' => 'What is silicone roof restoration?',
            'a' => 'Silicone roof restoration is a no-tear-off coating system applied over existing flat roofs. It seals leaks, reflects UV rays, and extends roof life by 15-20 years at a fraction of full replacement cost.',
        ],
        [
            'q' => 'Do I need a permit for roof work in California?',
            'a' => 'Most roof replacements in California require a building permit. As a licensed contractor, Golem Roofing handles all permit applications and inspections for you at no additional charge.',
        ],
        [
            'q' => 'How do I know if I need a roof repair or full replacement?',
            'a' => 'If your roof is under 15 years old with isolated damage, repair is usually sufficient. Roofs over 20 years or with widespread issues typically need replacement. We offer free inspections to help you decide.',
        ],
    ];
}

// ═══════════════════════════════════════════════════════════════
// HELPER
// ═══════════════════════════════════════════════════════════════

function golem_geo_emit_jsonld(array $data): void {
    echo '<script type="application/ld+json">' .
         wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) .
         "</script>\n";
}

// ═══════════════════════════════════════════════════════════════
// 4b. SERVICE DATA HELPERS
// ═══════════════════════════════════════════════════════════════

function golem_geo_get_service_descriptions(): array {
    return [
        'Roof Installation'             => 'Complete new roof installation using premium materials (GAF Timberline HDZ, TPO, tile, composite). Includes tear-off of old roofing, deck inspection, underlayment, and new roof system.',
        'Flat Roof Installation'         => 'TPO and modified bitumen flat roof systems for commercial and residential buildings. Energy-efficient, durable, and backed by manufacturer warranty.',
        'Tile Roof Installation'         => 'Clay and concrete tile installation for Mediterranean, Spanish, and modern-style homes. Underlayment systems designed for Southern California climate.',
        'Shingle Roof Installation'      => 'Architectural and 3-tab shingle installation. GAF certified installer with access to premium color selections and extended warranties.',
        'Roof Replacement'               => 'Full tear-off and replacement of existing roof. Includes deck repair, modern underlayment, and new roofing material installation.',
        'Flat Roof Replacement'          => 'Removal of old torch-down, built-up, or failing flat roof systems. Replacement with TPO or silicone-coated systems.',
        'Tile Roof Replacement'          => 'Replacement of broken, cracked, or aging tile roofs. Options include clay, concrete, and composite tiles.',
        'Shingle Roof Replacement'       => 'Full shingle roof tear-off and replacement with GAF Timberline HDZ-RS or equivalent premium shingles.',
        'Clay Tile Roof Replacement'     => 'Specialized clay tile replacement preserving original aesthetic. Custom color matching available.',
        'Concrete Tile Roof Replacement' => 'Concrete tile roof replacement with modern lightweight alternatives or matching concrete tiles.',
        'Roof Repair'                    => 'Emergency and scheduled repairs for all roof types. Leak detection, patch repair, flashing replacement, and storm damage repair.',
        'Flat Roof Repair'               => 'Flat roof leak repair, ponding water solutions, membrane patching, and seam re-welding for TPO and modified bitumen.',
        'Tile Roof Repair'               => 'Individual tile replacement, underlayment repair, re-pointing, and valley repair for tile roofs.',
        'Shingle Roof Repair'            => 'Shingle replacement, wind damage repair, nail pop fixes, and flashing repairs.',
        'Silicone Roof Restoration'      => 'No tear-off silicone coating system for existing flat roofs. Extends roof life 15-20 years at fraction of replacement cost.',
    ];
}

function golem_geo_get_service_faqs(string $category): array {
    $all = [
        'installation' => [
            ['q' => 'How long does a new roof installation take?', 'a' => 'Most residential roof installations take 1-3 days depending on roof size, complexity, and weather conditions. Flat roof projects may take 2-4 days. Golem Roofing works efficiently to minimize disruption to your daily life.'],
            ['q' => 'What roofing materials does Golem Roofing install?', 'a' => 'We install GAF Timberline HDZ architectural shingles, TPO membrane for flat roofs, clay and concrete tiles, and composite materials. All materials come with up to 50-year manufacturer warranties.'],
            ['q' => 'Do I need a permit for roof installation in California?', 'a' => 'Yes, most new roof installations in California require a building permit. As a CSLB-licensed contractor, Golem Roofing handles all permits and inspections at no additional charge.'],
            ['q' => 'How much does a new roof cost in Long Beach and the South Bay?', 'a' => 'New roof installations start from $9,900 depending on roof size, material, number of stories, and existing conditions. We offer free estimates — call (562) 991-8165.'],
            ['q' => 'What warranty do you offer on new roof installations?', 'a' => 'Every Golem Roofing installation comes with a 12-year No-Leak workmanship warranty, 50-year manufacturer warranty, $1M liability insurance, $25K bond, and $250K third-party protection through Directorii where eligible.'],
        ],
        'replacement' => [
            ['q' => 'How do I know if I need a roof replacement?', 'a' => 'Signs you need replacement include: roof over 20 years old, widespread shingle damage, multiple leaks, sagging, daylight through roof boards, or excessive granule loss. Golem Roofing offers free inspections to help you decide.'],
            ['q' => 'What is included in a full roof replacement?', 'a' => 'Our roof replacement includes complete tear-off of old materials, deck inspection and repair, new underlayment, drip edge and flashing, new roofing material installation, and full cleanup with debris hauling.'],
            ['q' => 'How long does a roof replacement take?', 'a' => 'Most residential roof replacements are completed in 1-3 days. Complex projects with structural repairs may take 3-5 days. We start early morning and work efficiently.'],
            ['q' => 'Can I stay in my home during roof replacement?', 'a' => 'Yes, you can stay home during roof replacement. There will be noise and vibration during work hours (typically 7am-5pm). We take precautions to protect your property and landscaping.'],
            ['q' => 'What happens to my old roofing materials?', 'a' => 'Golem Roofing handles complete removal and disposal of all old roofing materials. We use dedicated dumpsters and leave your property clean. Disposal fees are included in our quote.'],
        ],
        'repair' => [
            ['q' => 'How much does a roof repair cost?', 'a' => 'Roof repairs vary based on damage type and extent. Minor repairs start from $350-$800, while major repairs can range from $1,500-$4,000. We provide detailed estimates after free inspection.'],
            ['q' => 'Do you offer emergency roof repair?', 'a' => 'Yes, Golem Roofing provides emergency roof leak repair across all our service areas. Call (562) 991-8165 for immediate assistance. We respond within 24 hours for emergencies.'],
            ['q' => 'Can you repair any type of roof?', 'a' => 'Yes, our team repairs all roof types: asphalt shingles, flat/TPO/modified bitumen, clay tiles, concrete tiles, and metal roofs. We carry materials for most common repairs.'],
            ['q' => 'How long does a roof repair last?', 'a' => 'Quality repairs typically last 5-15 years depending on the original roof condition and repair type. If your roof needs frequent repairs, replacement may be more cost-effective long-term.'],
            ['q' => 'Will my homeowner insurance cover roof repairs?', 'a' => 'Insurance typically covers repairs for sudden damage (storms, fallen trees) but not wear and tear. Golem Roofing can help document damage for insurance claims and work directly with your adjuster.'],
        ],
        'special' => [
            ['q' => 'What is silicone roof restoration?', 'a' => 'Silicone roof restoration applies a durable silicone coating over your existing flat roof without tear-off. It seals leaks, reflects UV rays, and extends roof life by 15-20 years at a fraction of replacement cost.'],
            ['q' => 'How long does silicone roof coating last?', 'a' => 'A properly applied silicone roof coating lasts 15-20 years with minimal maintenance. It can be recoated to extend life further without ever needing full tear-off.'],
            ['q' => 'Is silicone restoration cheaper than full replacement?', 'a' => 'Yes, silicone restoration typically costs 40-60% less than full roof replacement. Since there is no tear-off, labor and disposal costs are dramatically reduced.'],
            ['q' => 'What types of roofs can get silicone restoration?', 'a' => 'Silicone restoration is ideal for flat and low-slope commercial roofs with TPO, EPDM, modified bitumen, or built-up roofing. The existing roof must be structurally sound.'],
            ['q' => 'Does silicone coating stop roof leaks?', 'a' => 'Yes, silicone coating creates a seamless waterproof membrane over your entire roof. It fills cracks, seals seams, and prevents ponding water damage — the most common cause of flat roof leaks.'],
        ],
    ];
    return $all[$category] ?? $all['installation'];
}

// ═══════════════════════════════════════════════════════════════
// 5. CITY LANDING PAGE CONTENT
// ═══════════════════════════════════════════════════════════════

add_filter('the_content', 'golem_geo_city_content', 20);
function golem_geo_city_content(string $content): string {
    if (!is_singular('page') || !in_the_loop() || !is_main_query()) return $content;

    global $post;
    $slug  = $post->post_name;
    $areas = golem_geo_get_service_areas();
    $match = null;

    foreach ($areas as $a) {
        if ($slug === $a['slug']) {
            $match = $a;
            break;
        }
    }

    if (!$match) return $content;

    $city       = esc_html($match['city']);
    $state      = esc_html($match['state']);
    $zips       = esc_html(implode(', ', $match['zips']));
    $hoods      = $match['neighborhoods'];
    $landmarks  = $match['landmarks'];
    $services   = golem_geo_get_services();
    $faqs       = golem_geo_get_homepage_faqs();
    $site       = 'https://golemroofing.com';

    // Neighborhood pills
    $hood_html = '';
    foreach ($hoods as $h) {
        $hood_html .= '<span class="gc-pill">' . esc_html($h) . '</span>';
    }

    // Landmark pills
    $mark_html = '';
    foreach ($landmarks as $m) {
        $mark_html .= '<span class="gc-pill gc-pill--outline">' . esc_html($m) . '</span>';
    }

    // Service cards (grouped)
    $groups = ['installation' => 'Installation', 'replacement' => 'Replacement', 'repair' => 'Repair', 'special' => 'Specialty'];
    $icons  = ['installation' => '🏗️', 'replacement' => '🔄', 'repair' => '🔧', 'special' => '⭐'];
    $svc_html = '';
    foreach ($groups as $cat => $label) {
        $items = array_filter($services, fn($s) => $s['category'] === $cat);
        if (empty($items)) continue;
        $list = '';
        foreach ($items as $s) {
            $list .= '<li><a href="' . esc_url($site . '/' . $s['slug'] . '/') . '">' . esc_html($s['name']) . '</a></li>';
        }
        $icon = $icons[$cat];
        $svc_html .= '<div class="gc-svc-card"><div class="gc-svc-icon">' . $icon . '</div><h3>' . esc_html($label) . '</h3><ul>' . $list . '</ul></div>';
    }

    // FAQ accordion
    $faq_html = '';
    $city_faqs = array_slice($faqs, 0, 6);
    foreach ($city_faqs as $i => $f) {
        $q = esc_html($f['q']);
        $a_text = esc_html($f['a']);
        $open = $i === 0 ? ' open' : '';
        $faq_html .= '<details class="gc-faq"' . $open . '><summary>' . $q . '</summary><p>' . $a_text . '</p></details>';
    }

    // Credentials
    $creds = [
        ['🛡️', '12-Year Warranty', 'No-Leak guarantee on every project'],
        ['📋', 'CSLB #1140626', 'California State License Board certified'],
        ['💰', '$1M Insurance', 'Full liability coverage + $25K bond'],
        ['⭐', '200+ Reviews', 'Google, Yelp, and trusted platforms'],
        ['🏭', 'Factory-Certified', 'GAF and ASC certified experts'],
        ['🔒', '$250K Protection', 'Directorii-backed third-party protection'],
    ];
    $cred_html = '';
    foreach ($creds as $c) {
        $cred_html .= '<div class="gc-cred"><div class="gc-cred-icon">' . $c[0] . '</div><strong>' . esc_html($c[1]) . '</strong><span>' . esc_html($c[2]) . '</span></div>';
    }

    // Other cities
    $other_html = '';
    foreach ($areas as $a) {
        if ($a['slug'] === $slug) continue;
        $other_html .= '<a href="' . esc_url($site . '/' . $a['slug'] . '/') . '" class="gc-city-link">' . esc_html($a['city']) . '</a>';
    }

    $html = <<<HTML
<style>
.gc-landing{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;color:#1a1a1a;max-width:960px;margin:0 auto;padding:0 16px}
.gc-hero{text-align:center;padding:48px 0 32px;border-bottom:3px solid #1a5276}
.gc-hero h1{font-size:clamp(1.6rem,4vw,2.4rem);color:#1a5276;margin:0 0 12px;line-height:1.2}
.gc-hero .gc-subtitle{font-size:clamp(1rem,2.5vw,1.25rem);color:#555;margin:0 0 20px}
.gc-hero .gc-zips{font-size:.9rem;color:#777;margin:0}
.gc-cta-btn{display:inline-block;background:#1a5276;color:#fff!important;padding:14px 32px;border-radius:6px;text-decoration:none;font-weight:600;font-size:1.05rem;margin-top:20px;transition:background .2s}
.gc-cta-btn:hover{background:#154360;color:#fff!important}
.gc-section{padding:40px 0}
.gc-section h2{font-size:clamp(1.3rem,3vw,1.8rem);color:#1a5276;margin:0 0 24px;text-align:center}
.gc-section h2::after{content:'';display:block;width:60px;height:3px;background:#e67e22;margin:10px auto 0}
.gc-pills{display:flex;flex-wrap:wrap;gap:8px;justify-content:center}
.gc-pill{background:#eaf2f8;color:#1a5276;padding:6px 14px;border-radius:20px;font-size:.9rem;font-weight:500}
.gc-pill--outline{background:transparent;border:1px solid #ccc;color:#555}
.gc-svc-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px}
.gc-svc-card{background:#f8f9fa;border-radius:10px;padding:24px 20px;text-align:center;border:1px solid #e9ecef}
.gc-svc-card h3{margin:8px 0 12px;color:#1a5276;font-size:1.1rem}
.gc-svc-icon{font-size:2rem;line-height:1}
.gc-svc-card ul{list-style:none;padding:0;margin:0;text-align:left}
.gc-svc-card li{padding:6px 0;border-bottom:1px solid #e9ecef;font-size:.9rem}
.gc-svc-card li:last-child{border-bottom:none}
.gc-svc-card a{color:#1a5276;text-decoration:none}
.gc-svc-card a:hover{text-decoration:underline}
.gc-creds{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px}
.gc-cred{background:#fff;border:1px solid #e9ecef;border-radius:10px;padding:20px 16px;text-align:center}
.gc-cred-icon{font-size:1.8rem;margin-bottom:6px}
.gc-cred strong{display:block;color:#1a5276;font-size:.95rem;margin-bottom:4px}
.gc-cred span{font-size:.8rem;color:#777}
.gc-faq{border:1px solid #e9ecef;border-radius:8px;margin-bottom:10px;overflow:hidden}
.gc-faq summary{padding:14px 18px;cursor:pointer;font-weight:600;color:#1a5276;background:#f8f9fa;font-size:.95rem;list-style:none}
.gc-faq summary::-webkit-details-marker{display:none}
.gc-faq summary::before{content:'＋';margin-right:10px;font-weight:700;color:#e67e22}
.gc-faq[open] summary::before{content:'−'}
.gc-faq p{padding:12px 18px 16px;margin:0;color:#555;font-size:.9rem;line-height:1.6}
.gc-other{text-align:center;padding:40px 0 20px;border-top:1px solid #e9ecef}
.gc-other h2::after{display:none}
.gc-city-links{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-top:16px}
.gc-city-link{background:#eaf2f8;color:#1a5276;padding:8px 16px;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:500}
.gc-city-link:hover{background:#1a5276;color:#fff}
.gc-cta-box{text-align:center;background:#1a5276;color:#fff;padding:40px 24px;border-radius:12px;margin:32px 0}
.gc-cta-box h2{color:#fff!important;margin-bottom:12px}
.gc-cta-box h2::after{background:#e67e22}
.gc-cta-box p{color:rgba(255,255,255,.85);margin:0 0 20px;font-size:1rem}
.gc-cta-box .gc-cta-btn{background:#e67e22;color:#fff!important}
.gc-cta-box .gc-cta-btn:hover{background:#cf6d17}
.gc-cta-box .gc-phone{display:block;margin-top:12px;color:#fff;font-size:1.1rem;text-decoration:none;font-weight:600}
@media(max-width:600px){
.gc-hero{padding:32px 0 24px}
.gc-section{padding:28px 0}
.gc-svc-grid{grid-template-columns:1fr 1fr}
.gc-creds{grid-template-columns:1fr 1fr}
.gc-cta-box{padding:28px 16px;border-radius:8px}
}
</style>
<div class="gc-landing">

<div class="gc-hero">
<h1>Professional Roofing in {$city}, {$state}</h1>
<p class="gc-subtitle">Licensed Roof Installation, Replacement &amp; Repair</p>
<p class="gc-zips">Serving ZIP: {$zips}</p>
<a href="tel:+15629918165" class="gc-cta-btn">📞 Call (562) 991-8165</a>
</div>

<div class="gc-section">
<h2>Neighborhoods We Serve in {$city}</h2>
<div class="gc-pills">{$hood_html}</div>
</div>

<div class="gc-section">
<h2>Local Landmarks</h2>
<div class="gc-pills">{$mark_html}</div>
</div>

<div class="gc-section">
<h2>Our Roofing Services</h2>
<div class="gc-svc-grid">{$svc_html}</div>
</div>

<div class="gc-section">
<h2>Why Choose Golem Roofing</h2>
<div class="gc-creds">{$cred_html}</div>
</div>

<div class="gc-cta-box">
<h2>Get a Free Roof Estimate in {$city}</h2>
<p>We offer free inspections for homeowners in {$city} and surrounding areas.</p>
<a href="#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6Ijk3IiwidG9nZ2xlIjpmYWxzZX0%3D" class="gc-cta-btn">Get A Free Quote</a>
<a href="tel:+15629918165" class="gc-phone">📞 (562) 991-8165</a>
</div>

<div class="gc-section">
<h2>Frequently Asked Questions</h2>
{$faq_html}
</div>

<div class="gc-other gc-section">
<h2>Other Cities We Serve</h2>
<div class="gc-city-links">{$other_html}</div>
</div>

</div>
HTML;

    return $html;
}

// ═══════════════════════════════════════════════════════════════
// 5b. SERVICE PAGE CONTENT
// ═══════════════════════════════════════════════════════════════

add_filter('the_content', 'golem_geo_service_content', 21);
function golem_geo_service_content(string $content): string {
    if (!is_singular('page') || !in_the_loop() || !is_main_query()) return $content;

    global $post;
    $slug     = $post->post_name;
    $services = golem_geo_get_services();
    $match    = null;

    foreach ($services as $s) {
        if ($slug === $s['slug']) {
            $match = $s;
            break;
        }
    }

    if (!$match) return $content;

    $name        = esc_html($match['name']);
    $category    = $match['category'];
    $areas       = golem_geo_get_service_areas();
    $descs       = golem_geo_get_service_descriptions();
    $desc        = $descs[$match['name']] ?? '';
    $faqs        = golem_geo_get_service_faqs($category);
    $site        = 'https://golemroofing.com';
    $cities_list = implode(', ', array_map(fn($a) => $a['city'], $areas));
    $intro       = esc_html("Golem Roofing provides professional " . strtolower($match['name']) . " services across Long Beach, the South Bay, and nearby coastal communities. " . $desc . " We serve homeowners in " . $cities_list . " and surrounding areas.");

    // City links
    $city_html = '';
    foreach ($areas as $a) {
        $zips = esc_html(implode(', ', $a['zips']));
        $city_html .= '<a href="' . esc_url($site . '/' . $a['slug'] . '/') . '" class="gc-city-link">' . esc_html($a['city']) . ' <small>(' . $zips . ')</small></a>';
    }

    // Related services (same category, excluding current)
    $related_html = '';
    foreach ($services as $s) {
        if ($s['slug'] === $match['slug']) continue;
        if ($s['category'] === $category) {
            $related_html .= '<a href="' . esc_url($site . '/' . $s['slug'] . '/') . '" class="gc-city-link">' . esc_html($s['name']) . '</a>';
        }
    }
    $related_section = '';
    if (!empty($related_html)) {
        $related_section = '<div class="gc-section"><h2>Related Services</h2><div class="gc-city-links">' . $related_html . '</div></div>';
    }

    // Other category services
    $groups = ['installation' => 'Installation', 'replacement' => 'Replacement', 'repair' => 'Repair', 'special' => 'Specialty'];
    $icons  = ['installation' => "\xF0\x9F\x8F\x97\xEF\xB8\x8F", 'replacement' => "\xF0\x9F\x94\x84", 'repair' => "\xF0\x9F\x94\xA7", 'special' => "\xE2\xAD\x90"];
    $other_svc_html = '';
    foreach ($groups as $cat => $label) {
        if ($cat === $category) continue;
        $items = array_filter($services, fn($s) => $s['category'] === $cat);
        if (empty($items)) continue;
        $list = '';
        foreach ($items as $s) {
            $list .= '<li><a href="' . esc_url($site . '/' . $s['slug'] . '/') . '">' . esc_html($s['name']) . '</a></li>';
        }
        $other_svc_html .= '<div class="gc-svc-card"><div class="gc-svc-icon">' . $icons[$cat] . '</div><h3>' . esc_html($label) . '</h3><ul>' . $list . '</ul></div>';
    }

    // FAQ accordion
    $faq_html = '';
    foreach ($faqs as $i => $f) {
        $open = $i === 0 ? ' open' : '';
        $faq_html .= '<details class="gc-faq"' . $open . '><summary>' . esc_html($f['q']) . '</summary><p>' . esc_html($f['a']) . '</p></details>';
    }

    // Credentials
    $creds = [
        ["\xF0\x9F\x9B\xA1\xEF\xB8\x8F", '12-Year Warranty', 'No-Leak guarantee on every project'],
        ["\xF0\x9F\x93\x8B", 'CSLB #1140626', 'California State License Board certified'],
        ["\xF0\x9F\x92\xB0", '$1M Insurance', 'Full liability coverage + $25K bond'],
        ["\xE2\xAD\x90", '200+ Reviews', 'Google, Yelp, and trusted platforms'],
        ["\xF0\x9F\x8F\xAD", 'Factory-Certified', 'GAF and ASC certified experts'],
        ["\xF0\x9F\x94\x92", '$250K Protection', 'Directorii-backed third-party protection'],
    ];
    $cred_html = '';
    foreach ($creds as $c) {
        $cred_html .= '<div class="gc-cred"><div class="gc-cred-icon">' . $c[0] . '</div><strong>' . esc_html($c[1]) . '</strong><span>' . esc_html($c[2]) . '</span></div>';
    }

    // What's included
    $includes = [
        'installation' => ['Free roof inspection and measurement', 'Old roof tear-off (if applicable)', 'Roof deck inspection and repair', 'Premium underlayment installation', 'New drip edge and flashing', 'Full material installation', 'Cleanup and debris removal', '12-year No-Leak workmanship warranty'],
        'replacement'  => ['Complete tear-off of existing roof', 'Deck inspection and structural repair', 'New underlayment and ice/water shield', 'New drip edge, flashing, and vents', 'Premium material installation', 'Ridge cap and finishing', 'Full cleanup and debris hauling', '12-year No-Leak workmanship warranty'],
        'repair'       => ['Thorough roof inspection', 'Leak source identification', 'Damaged material replacement', 'Flashing repair or replacement', 'Sealant and caulking', 'Before/after documentation', 'Repair warranty included'],
        'special'      => ['Roof surface cleaning and prep', 'Seam and crack repair', 'Primer application', 'Silicone coating (2 coats)', 'Ponding water treatment', 'UV-reflective finish', 'No tear-off required', '12-year eligible coating warranty'],
    ];
    $inc_html = '';
    foreach (($includes[$category] ?? $includes['installation']) as $item) {
        $inc_html .= '<li>' . esc_html($item) . '</li>';
    }

    $html = <<<HTML
<style>
.gc-landing{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;color:#1a1a1a;max-width:960px;margin:0 auto;padding:0 16px}
.gc-hero{text-align:center;padding:48px 0 32px;border-bottom:3px solid #1a5276}
.gc-hero h1{font-size:clamp(1.6rem,4vw,2.4rem);color:#1a5276;margin:0 0 12px;line-height:1.2}
.gc-hero .gc-subtitle{font-size:clamp(1rem,2.5vw,1.25rem);color:#555;margin:0 0 20px}
.gc-cta-btn{display:inline-block;background:#1a5276;color:#fff!important;padding:14px 32px;border-radius:6px;text-decoration:none;font-weight:600;font-size:1.05rem;margin-top:20px;transition:background .2s}
.gc-cta-btn:hover{background:#154360;color:#fff!important}
.gc-section{padding:40px 0}
.gc-section h2{font-size:clamp(1.3rem,3vw,1.8rem);color:#1a5276;margin:0 0 24px;text-align:center}
.gc-section h2::after{content:'';display:block;width:60px;height:3px;background:#e67e22;margin:10px auto 0}
.gc-about-text{max-width:720px;margin:0 auto;line-height:1.8;color:#444;font-size:1.05rem;text-align:center}
.gc-includes{list-style:none;padding:0;max-width:600px;margin:0 auto}
.gc-includes li{padding:10px 0;border-bottom:1px solid #e9ecef;font-size:.95rem;color:#444}
.gc-includes li:last-child{border-bottom:none}
.gc-svc-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px}
.gc-svc-card{background:#f8f9fa;border-radius:10px;padding:24px 20px;text-align:center;border:1px solid #e9ecef}
.gc-svc-card h3{margin:8px 0 12px;color:#1a5276;font-size:1.1rem}
.gc-svc-icon{font-size:2rem;line-height:1}
.gc-svc-card ul{list-style:none;padding:0;margin:0;text-align:left}
.gc-svc-card li{padding:6px 0;border-bottom:1px solid #e9ecef;font-size:.9rem}
.gc-svc-card li:last-child{border-bottom:none}
.gc-svc-card a{color:#1a5276;text-decoration:none}
.gc-svc-card a:hover{text-decoration:underline}
.gc-creds{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px}
.gc-cred{background:#fff;border:1px solid #e9ecef;border-radius:10px;padding:20px 16px;text-align:center}
.gc-cred-icon{font-size:1.8rem;margin-bottom:6px}
.gc-cred strong{display:block;color:#1a5276;font-size:.95rem;margin-bottom:4px}
.gc-cred span{font-size:.8rem;color:#777}
.gc-faq{border:1px solid #e9ecef;border-radius:8px;margin-bottom:10px;overflow:hidden}
.gc-faq summary{padding:14px 18px;cursor:pointer;font-weight:600;color:#1a5276;background:#f8f9fa;font-size:.95rem;list-style:none}
.gc-faq summary::-webkit-details-marker{display:none}
.gc-faq summary::before{content:'+';margin-right:10px;font-weight:700;color:#e67e22}
.gc-faq[open] summary::before{content:'-'}
.gc-faq p{padding:12px 18px 16px;margin:0;color:#555;font-size:.9rem;line-height:1.6}
.gc-city-links{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-top:16px}
.gc-city-link{background:#eaf2f8;color:#1a5276;padding:8px 16px;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:500}
.gc-city-link:hover{background:#1a5276;color:#fff}
.gc-city-link small{color:#777;font-weight:400}
.gc-cta-box{text-align:center;background:#1a5276;color:#fff;padding:40px 24px;border-radius:12px;margin:32px 0}
.gc-cta-box h2{color:#fff!important;margin-bottom:12px}
.gc-cta-box h2::after{background:#e67e22}
.gc-cta-box p{color:rgba(255,255,255,.85);margin:0 0 20px;font-size:1rem}
.gc-cta-box .gc-cta-btn{background:#e67e22;color:#fff!important}
.gc-cta-box .gc-cta-btn:hover{background:#cf6d17}
.gc-cta-box .gc-phone{display:block;margin-top:12px;color:#fff;font-size:1.1rem;text-decoration:none;font-weight:600}
@media(max-width:600px){
.gc-hero{padding:32px 0 24px}
.gc-section{padding:28px 0}
.gc-svc-grid{grid-template-columns:1fr 1fr}
.gc-creds{grid-template-columns:1fr 1fr}
.gc-cta-box{padding:28px 16px;border-radius:8px}
}
</style>
<div class="gc-landing">

<div class="gc-hero">
<h1>{$name} in Long Beach &amp; South Bay</h1>
<p class="gc-subtitle">Licensed &amp; Insured &middot; 12-Year No-Leak Warranty &middot; CSLB #1140626</p>
<a href="tel:+15629918165" class="gc-cta-btn">&#128222; Call (562) 991-8165</a>
</div>

<div class="gc-section">
<h2>About This Service</h2>
<p class="gc-about-text">{$intro}</p>
</div>

<div class="gc-section">
<h2>What&rsquo;s Included</h2>
<ul class="gc-includes">{$inc_html}</ul>
</div>

<div class="gc-section">
<h2>Cities We Serve</h2>
<div class="gc-city-links">{$city_html}</div>
</div>

<div class="gc-section">
<h2>Why Choose Golem Roofing</h2>
<div class="gc-creds">{$cred_html}</div>
</div>

<div class="gc-cta-box">
<h2>Get a Free {$name} Estimate</h2>
<p>Contact us for a free inspection and detailed quote. Licensed, bonded, and insured.</p>
<a href="#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6Ijk3IiwidG9nZ2xlIjpmYWxzZX0%3D" class="gc-cta-btn">Get A Free Quote</a>
<a href="tel:+15629918165" class="gc-phone">&#128222; (562) 991-8165</a>
</div>

<div class="gc-section">
<h2>Frequently Asked Questions</h2>
{$faq_html}
</div>

{$related_section}

<div class="gc-section">
<h2>All Roofing Services</h2>
<div class="gc-svc-grid">{$other_svc_html}</div>
</div>

</div>
HTML;

    return $html;
}

// ═══════════════════════════════════════════════════════════════
// 6. DEACTIVATE OLD SCHEMA PLUGIN (golem-schema.php)
// ═══════════════════════════════════════════════════════════════

// Remove old schema hooks if golem-schema.php is still active
add_action('after_setup_theme', function (): void {
    remove_action('wp_head', 'golem_roofing_schema_markup', 1);
    remove_action('wp_head', 'golem_roofing_faq_schema', 2);
}, 99);

// ═══════════════════════════════════════════════════════════════
// 7. ABOUT US PAGE CONTENT
// ═══════════════════════════════════════════════════════════════

add_filter('the_content', 'golem_geo_about_content', 20);
function golem_geo_about_content(string $content): string {
    if (!is_singular('page') || !in_the_loop() || !is_main_query()) return $content;

    global $post;
    if ($post->post_name !== 'about') return $content;

    $areas    = golem_geo_get_service_areas();
    $services = golem_geo_get_services();
    $faqs     = golem_geo_get_homepage_faqs();
    $site     = 'https://golemroofing.com';

    // Service cards grouped
    $groups = ['installation' => 'Installation', 'replacement' => 'Replacement', 'repair' => 'Repair', 'special' => 'Specialty'];
    $icons  = ['installation' => '🏗️', 'replacement' => '🔄', 'repair' => '🔧', 'special' => '⭐'];
    $svc_html = '';
    foreach ($groups as $cat => $label) {
        $items = array_filter($services, fn($s) => $s['category'] === $cat);
        if (empty($items)) continue;
        $list = '';
        foreach ($items as $s) {
            $list .= '<li><a href="' . esc_url($site . '/' . $s['slug'] . '/') . '">' . esc_html($s['name']) . '</a></li>';
        }
        $svc_html .= '<div class="gc-svc-card"><div class="gc-svc-icon">' . $icons[$cat] . '</div><h3>' . esc_html($label) . '</h3><ul>' . $list . '</ul></div>';
    }

    // Credentials
    $creds = [
        ['🛡️', '12-Year Warranty', 'No-Leak guarantee on every project'],
        ['📋', 'CSLB License #1140626', 'California State License Board certified'],
        ['💰', '$1M Insurance', 'Full liability coverage + $25K bond'],
        ['⭐', '200+ Reviews', 'Google, Yelp, and trusted platforms'],
        ['🏭', 'Factory-Certified', 'GAF and ASC certified experts'],
        ['🔒', '$250K Protection', 'Directorii-backed third-party protection'],
        ['🏅', 'GAF Certified™', 'Factory-certified roofing contractor'],
        ['📜', '12 Years Experience', 'Licensed, insured, and bonded'],
    ];
    $cred_html = '';
    foreach ($creds as $c) {
        $cred_html .= '<div class="gc-cred"><div class="gc-cred-icon">' . $c[0] . '</div><strong>' . esc_html($c[1]) . '</strong><span>' . esc_html($c[2]) . '</span></div>';
    }

    // Service area links
    $area_html = '';
    foreach ($areas as $a) {
        $zips = esc_html(implode(', ', $a['zips']));
        $area_html .= '<a href="' . esc_url($site . '/' . $a['slug'] . '/') . '" class="gc-city-link">' . esc_html($a['city']) . ' <small>(' . $zips . ')</small></a>';
    }

    // FAQ accordion
    $faq_html = '';
    foreach (array_slice($faqs, 0, 8) as $i => $f) {
        $open = $i === 0 ? ' open' : '';
        $faq_html .= '<details class="gc-faq"' . $open . '><summary>' . esc_html($f['q']) . '</summary><p>' . esc_html($f['a']) . '</p></details>';
    }

    $html = <<<HTML
<style>
.gc-landing{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;color:#1a1a1a;max-width:960px;margin:0 auto;padding:0 16px}
.gc-hero{text-align:center;padding:48px 0 32px;border-bottom:3px solid #1a5276}
.gc-hero h1{font-size:clamp(1.6rem,4vw,2.4rem);color:#1a5276;margin:0 0 12px;line-height:1.2}
.gc-hero .gc-subtitle{font-size:clamp(1rem,2.5vw,1.25rem);color:#555;margin:0 0 8px}
.gc-hero .gc-address{font-size:.9rem;color:#777;margin:0 0 4px}
.gc-hero .gc-license{font-size:.85rem;color:#999;margin:0}
.gc-cta-btn{display:inline-block;background:#1a5276;color:#fff!important;padding:14px 32px;border-radius:6px;text-decoration:none;font-weight:600;font-size:1.05rem;margin-top:20px;transition:background .2s}
.gc-cta-btn:hover{background:#154360;color:#fff!important}
.gc-section{padding:40px 0}
.gc-section h2{font-size:clamp(1.3rem,3vw,1.8rem);color:#1a5276;margin:0 0 24px;text-align:center}
.gc-section h2::after{content:'';display:block;width:60px;height:3px;background:#e67e22;margin:10px auto 0}
.gc-about-text{max-width:720px;margin:0 auto;line-height:1.8;color:#444;font-size:1rem;text-align:center}
.gc-svc-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px}
.gc-svc-card{background:#f8f9fa;border-radius:10px;padding:24px 20px;text-align:center;border:1px solid #e9ecef}
.gc-svc-card h3{margin:8px 0 12px;color:#1a5276;font-size:1.1rem}
.gc-svc-icon{font-size:2rem;line-height:1}
.gc-svc-card ul{list-style:none;padding:0;margin:0;text-align:left}
.gc-svc-card li{padding:6px 0;border-bottom:1px solid #e9ecef;font-size:.9rem}
.gc-svc-card li:last-child{border-bottom:none}
.gc-svc-card a{color:#1a5276;text-decoration:none}
.gc-svc-card a:hover{text-decoration:underline}
.gc-creds{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px}
.gc-cred{background:#fff;border:1px solid #e9ecef;border-radius:10px;padding:20px 16px;text-align:center}
.gc-cred-icon{font-size:1.8rem;margin-bottom:6px}
.gc-cred strong{display:block;color:#1a5276;font-size:.95rem;margin-bottom:4px}
.gc-cred span{font-size:.8rem;color:#777}
.gc-faq{border:1px solid #e9ecef;border-radius:8px;margin-bottom:10px;overflow:hidden}
.gc-faq summary{padding:14px 18px;cursor:pointer;font-weight:600;color:#1a5276;background:#f8f9fa;font-size:.95rem;list-style:none}
.gc-faq summary::-webkit-details-marker{display:none}
.gc-faq summary::before{content:'＋';margin-right:10px;font-weight:700;color:#e67e22}
.gc-faq[open] summary::before{content:'−'}
.gc-faq p{padding:12px 18px 16px;margin:0;color:#555;font-size:.9rem;line-height:1.6}
.gc-city-links{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-top:16px}
.gc-city-link{background:#eaf2f8;color:#1a5276;padding:8px 16px;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:500}
.gc-city-link:hover{background:#1a5276;color:#fff}
.gc-city-link small{color:#777;font-weight:400}
.gc-cta-box{text-align:center;background:#1a5276;color:#fff;padding:40px 24px;border-radius:12px;margin:32px 0}
.gc-cta-box h2{color:#fff!important;margin-bottom:12px}
.gc-cta-box h2::after{background:#e67e22}
.gc-cta-box p{color:rgba(255,255,255,.85);margin:0 0 20px;font-size:1rem}
.gc-cta-box .gc-cta-btn{background:#e67e22;color:#fff!important}
.gc-cta-box .gc-cta-btn:hover{background:#cf6d17}
.gc-cta-box .gc-phone{display:block;margin-top:12px;color:#fff;font-size:1.1rem;text-decoration:none;font-weight:600}
@media(max-width:600px){
.gc-hero{padding:32px 0 24px}
.gc-section{padding:28px 0}
.gc-svc-grid{grid-template-columns:1fr 1fr}
.gc-creds{grid-template-columns:1fr 1fr}
.gc-cta-box{padding:28px 16px;border-radius:8px}
}
</style>
<div class="gc-landing">

<div class="gc-hero">
<h1>About Golem Roofing</h1>
<p class="gc-subtitle">Licensed Roofing Contractor — Long Beach &amp; South Bay</p>
<p class="gc-address">📍 1821 E 5th St Unit #1, Long Beach, CA 90802</p>
<p class="gc-license">CSLB License #1140626 · GAF Certified™ · 12 Years of Roofing Experience</p>
<a href="tel:+15629918165" class="gc-cta-btn">📞 Call (562) 991-8165</a>
</div>

<div class="gc-section">
<h2>Who We Are</h2>
<p class="gc-about-text">
Golem Roofing is a licensed, insured, and bonded roofing company serving homeowners across Long Beach, the South Bay, and nearby coastal communities. With over 12 years of professional roofing experience, we specialize in roof installation, replacement, repair, and silicone restoration. As a GAF Certified™ contractor, we deliver premium roofing solutions backed by a 12-year No-Leak workmanship warranty, 50-year manufacturer warranty, \$1M liability insurance, and \$250K third-party protection through Directorii where eligible.
</p>
</div>

<div class="gc-section">
<h2>Why Choose Golem Roofing</h2>
<div class="gc-creds">{$cred_html}</div>
</div>

<div class="gc-section">
<h2>Our Roofing Services</h2>
<div class="gc-svc-grid">{$svc_html}</div>
</div>

<div class="gc-section">
<h2>Service Areas</h2>
<div class="gc-city-links">{$area_html}</div>
</div>

<div class="gc-cta-box">
<h2>Get a Free Roof Estimate</h2>
<p>We offer free inspections for homeowners across LA and Orange County.</p>
<a href="#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6Ijk3IiwidG9nZ2xlIjpmYWxzZX0%3D" class="gc-cta-btn">Get A Free Quote</a>
<a href="tel:+15629918165" class="gc-phone">📞 (562) 991-8165</a>
</div>

<div class="gc-section">
<h2>Frequently Asked Questions</h2>
{$faq_html}
</div>

</div>
HTML;

    return $html;
}

// ═══════════════════════════════════════════════════════════════
// 8. FOOTER BRANDING FIX (3-level fallback)
// ═══════════════════════════════════════════════════════════════

// --- Level 1: PHP filters (works if Phlox uses its own hooks) ---
add_filter('auxin_the_footer_copyright', 'golem_geo_footer_copyright');
add_filter('auxin_footer_copyright_text', 'golem_geo_footer_copyright');
function golem_geo_footer_copyright(string $text = ''): string {
    return '&copy; ' . gmdate('Y') . ' Golem Roofing. CA License #1140626. Long Beach, CA.';
}

// --- Level 2: PHP output buffer (catches Elementor-rendered HTML) ---
// Hook at mu-plugins_loaded (earliest reliable WP hook) to catch even supercache
add_action('muplugins_loaded', 'golem_geo_ob_start', 0);
// Also hook WP Super Cache's filter to fix HTML before it gets cached
add_filter('wp_cache_ob_callback_filter', 'golem_geo_ob_footer_replace');
function golem_geo_ob_start(): void {
    if (is_admin() || wp_doing_ajax() || wp_doing_cron() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }
    ob_start('golem_geo_ob_footer_replace');
}
function golem_geo_ob_footer_replace(string $html): string {
    if (empty($html) || strlen($html) < 200) {
        return $html;
    }
    $year = gmdate('Y');
    $copy = "© {$year} Golem Roofing. CA License #1140626. Long Beach, CA.";
    $html = preg_replace(
        '/Copyright\s*(?:©|&copy;)?\s*\d{4}\s+averta\.?\s*All\s+Rights\s+Reserved\.?/i',
        $copy,
        $html
    );
    $html = str_replace('andy-s-custom-solutions-long-beach', 'golem-roofing-long-beach', $html);
    return $html;
}

// --- Level 3: JS DOM fallback (last resort, if cached HTML slips through) ---
add_action('wp_footer', 'golem_geo_footer_copyright_js', 999);
function golem_geo_footer_copyright_js(): void {
    $year = gmdate('Y');
    $copy = esc_js("© {$year} Golem Roofing. CA License #1140626. Long Beach, CA.");
    echo <<<JS
<script>
(function(){
    var c='{$copy}';
    function fix(){
        var w=document.createTreeWalker(document.body,NodeFilter.SHOW_TEXT,null,false);
        while(w.nextNode()){
            var n=w.currentNode;
            if(n.nodeValue&&n.nodeValue.indexOf('averta')!==-1){
                n.nodeValue=n.nodeValue.replace(/Copyright\s*©?\s*\d{0,4}\s*averta[^.]*/i,c);
            }
        }
        document.querySelectorAll('a[href*="andy-s-custom-solutions"]').forEach(function(a){
            a.href=a.href.replace('andy-s-custom-solutions-long-beach','golem-roofing-long-beach');
        });
    }
    if(document.readyState==='loading'){document.addEventListener('DOMContentLoaded',fix);}else{fix();}
})();
</script>
JS;
}

// --- CSS fixes: star ratings alignment + hide Financing sticker ---
add_action('wp_head', 'golem_css_fixes', 999);
function golem_css_fixes(): void {
    echo '<style>
/* Fix star rating section alignment on homepage */
.elementor-star-rating{display:flex;align-items:center;justify-content:center}
.elementor-widget-star-rating{display:flex;align-items:center;justify-content:center}
/* Hide Financing badge/sticker globally */
img[src*="Financing"],img[src*="financing"],img[alt*="Financing"],img[alt*="financing"]{display:none!important}
a[href*="financing" i] img{display:none!important}
.elementor-widget-aux_image img[src*="inancing"]{display:none!important}
</style>' . "\n";
}

// Footer badges removed — now managed via Elementor HTML widget in footer template #67
