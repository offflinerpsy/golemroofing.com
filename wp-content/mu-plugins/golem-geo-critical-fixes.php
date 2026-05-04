<?php
/**
 * Plugin Name: Golem GEO Critical Fixes
 * Description: Small, reversible fixes for AI/GEO fact consistency and canonical links.
 * Version: 1.0.5
 * Author: Golem Roofing Dev
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'template_redirect', 'golem_geo_critical_redirects', 0 );
add_action( 'template_redirect', 'golem_geo_critical_start_buffer', 0 );

function golem_geo_critical_redirects(): void {
    if ( is_admin() || wp_doing_ajax() || wp_is_json_request() ) {
        return;
    }

    $path = trim( (string) parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    $map  = array(
        'service-areas/seal-beach'            => 'roofing-seal-beach-ca/',
        'service-areas/redondo-beach'         => 'roofing-redondo-beach-ca/',
        'service-areas/manhattan-beach'       => 'roofing-manhattan-beach-ca/',
        'service-areas/hermosa-beach'         => 'roofing-hermosa-beach-ca/',
        'service-areas/palos-verdes-estates'  => 'roofing-palos-verdes-ca/',
        'services/flat-roofing'               => 'flat-roof-installation/',
        'services/tile-roofing'               => 'tile-roof-installation/',
        'services/shingle-roofing'            => 'shingle-roof-installation/',
    );

    if ( isset( $map[ $path ] ) ) {
        wp_safe_redirect( home_url( '/' . $map[ $path ] ), 301 );
        exit;
    }
}

function golem_geo_critical_start_buffer(): void {
    if ( is_admin() || wp_doing_ajax() || wp_is_json_request() ) {
        return;
    }

    ob_start( 'golem_geo_critical_rewrite_owned_facts' );
}

function golem_geo_critical_rewrite_owned_facts( string $html ): string {
    $llms_intro = '> Licensed, bonded, and insured roofing company serving Seal Beach, Long Beach, Los Alamitos, Manhattan Beach, Hermosa Beach, Redondo Beach, Palos Verdes Estates, Rancho Palos Verdes, Torrance, Carson, San Pedro, Signal Hill, and surrounding areas in California. Roof installation, replacement, repair, and silicone restoration with 12-year No-Leak workmanship warranty and 50-year manufacturer warranty.';
    $llms_intro_with_policy = $llms_intro . "\n\n## AI Bot Access Policy\n\nGolem Roofing permits reputable search engines and answer engines to crawl public pages for indexing, citations, snippets, and AI-assisted search discovery when they follow `robots.txt`. See https://golemroofing.com/robots.txt for the current crawler policy.";

    $replacements = array(
        $llms_intro => $llms_intro_with_policy,
        '2025 (8+ years of roofing experience)' => '2025 (8 years of roofing experience)',
        '2025 (12 Years of Roofing Experience)' => '2025 (8 years of roofing experience)',
        'over 12 years of combined hands-on roofing experience' => '8 years of hands-on roofing experience',
        'over 12 years of professional roofing experience' => '8 years of professional roofing experience',
        'over 12 years of hands-on experience'  => '8 years of hands-on experience',
        'over 12 years'                         => '8 years',
        '12 Years of Roofing Experience'        => '8 Years of Roofing Experience',
        '12 years of roofing experience'        => '8 years of roofing experience',
        '12 Years Experience'                   => '8 Years Experience',
        '12 years experience'                   => '8 years experience',
        '12Years Experience'                    => '8Years Experience',
        '8+ years of experience'                => '8 years of experience',
        '8+ Years of Roofing Experience'        => '8 Years of Roofing Experience',
        '8+ Years Experience'                   => '8 Years Experience',
        '8Years Experience'                     => '8Years Experience',
        '10 Year Workmanship Warranty'          => '12 Year No-Leak Workmanship Warranty',
        '10-Year Workmanship Warranty'          => '12-Year No-Leak Workmanship Warranty',
        '10-year workmanship warranty'          => '12-year no-leak workmanship warranty',
        '10-Year Warranty'                      => '12-Year Warranty',
        '10-year warranty'                      => '12-year warranty',
        '15-Year Workmanship & 20+ Year Manufacturer Warranties' => '12-Year No-Leak Workmanship Warranty & Eligible Manufacturer Warranties',
        '15-year workmanship warranty'          => '12-year no-leak workmanship warranty',
        '20+ year manufacturer warranty'        => 'manufacturer warranty on eligible systems',
        '20+ Year Manufacturer Warranties'      => 'Eligible Manufacturer Warranties',
        '| Workmanship Warranty | 10 years |'   => '| Workmanship Warranty | 12 years No-Leak |',
        '| Rating | 5.0 / 5 (47 reviews) |'     => '| Rating | 5.0 / 5 (200 reviews across trusted profiles) |',
        '| Third-Party Guarantee | $250K |'     => '| Third-Party Protection | Up to $250K documented third-party protection where eligible |',
        '$250K third-party guarantee through Directorii.' => '$250K third-party protection through Directorii.',
        '$250K third-party guarantee through Directorii' => '$250K third-party protection through Directorii',
        '$250K Guarantee\', \'Third-party backed by Directorii' => '$250K Protection\', \'Directorii-backed third-party protection',
        '$250K Guarantee'                       => '$250K Protection',
        '$250k Third-Party Guarantee'           => '$250k Third-Party Protection',
        'Third-party backed by Directorii'      => 'Directorii-backed third-party protection',
        '47 five-star reviews on Google'        => '200 reviews across trusted profiles',
        '47 reviews'                            => '200 reviews',
        '23 Google + 49 Yelp five-star reviews' => '200 reviews across Google, Yelp, and trusted platforms',
        '170+Five-Star Reviews'                 => '200 Five-Star Reviews',
        '170+'                                  => '200',
        '200+Five-Star Reviews'                 => '200 Five-Star Reviews',
        '200+ Reviews'                          => '200 Reviews',
        '200+ reviews'                          => '200 reviews',
        '200+ five-star reviews'                => '200 five-star reviews',
        '5.0 Rating'                            => '200 Reviews',
        '150+ verified 5-star reviews across platforms (Google, Yelp, BBB, Houzz, Directorii)' => '200 reviews across Google, Yelp, and trusted profiles',
        '150+ verified 5-star reviews'          => '200 reviews across trusted profiles',
        'Licensed & Insured · 10-Year Warranty · Free Estimates' => 'Licensed & Insured · 12-Year No-Leak Warranty · CSLB #1140626',
        'Los Angeles & Orange County'           => 'Long Beach & South Bay',
        'Los Angeles and Orange County'         => 'Long Beach and the South Bay',
        'across Los Angeles and Orange County, California' => 'across Long Beach, the South Bay, and nearby coastal communities',
        'roofing and solar experts'             => 'roofing experts',
        'roofing &amp; solar experts'           => 'roofing experts',
        'roofing and solar solutions'           => 'roofing solutions',
        'reduce energy costs with sustainable, high-performance solutions' => 'protect their property with durable, high-performance roofing solutions',
        'protect their property and protect their property with' => 'protect their property with',
        'Solar Panel Installation, Removal & Reinstallation' => 'Roof Inspection & Project Planning',
        'Solar Panel Installation, Removal &amp; Reinstallation' => 'Roof Inspection &amp; Project Planning',
        'Seamless integration with your roof to maximize performance and reduce energy costs.' => 'Clear roof assessments, scope planning, and material guidance before every project.',
        'Seamless integration with your roof to maximize<br>performance and reduce energy costs.' => 'Clear roof assessments, scope planning,<br>and material guidance before every project.',
        'Integrated Solar Systems'              => 'Roofing System Planning',
        'We design and install solar systems that work seamlessly with your roof, cut your bills and boost property value.' => 'We plan durable roofing systems that protect Southern California homes and support long-term property value.',
        '4126 E Ransom St, Long Beach, CA 90804' => '1821 E 5th St Unit #1, Long Beach, CA 90802',
        '1821 E 5th St, Long Beach, CA 90802'   => '1821 E 5th St Unit #1, Long Beach, CA 90802',
    );

    $html = str_ireplace( array_keys( $replacements ), array_values( $replacements ), $html );

    $html = preg_replace(
        '/(<div class="elementor-element elementor-element-f9b2ec7\b.*?<h2 class="elementor-heading-title elementor-size-default">)5 star(<\/h2>)/is',
        '${1}200 Reviews${2}',
        $html,
        1
    ) ?? $html;

    $html = preg_replace(
        '/"streetAddress"\s*:\s*"Long Beach"/',
        '"streetAddress": "1821 E 5th St Unit #1"',
        $html
    ) ?? $html;

    return $html;
}
