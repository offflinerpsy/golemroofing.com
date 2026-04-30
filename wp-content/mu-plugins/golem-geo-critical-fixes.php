<?php
/**
 * Plugin Name: Golem GEO Critical Fixes
 * Description: Small, reversible fixes for AI/GEO fact consistency and canonical links.
 * Version: 1.0.1
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
        '2025 (8+ years of roofing experience)' => '2025 (over 12 years of combined hands-on roofing experience)',
        '2025 (12 Years of Roofing Experience)' => '2025 (over 12 years of combined hands-on roofing experience)',
        '8+ years of experience'                => 'over 12 years of combined hands-on roofing experience',
        '8+ Years of Roofing Experience'        => '12 Years of Combined Roofing Experience',
        '8+ Years Experience'                   => '12 Years Combined Experience',
        '10 Year Workmanship Warranty'          => '12 Year No-Leak Workmanship Warranty',
        '10-Year Workmanship Warranty'          => '12-Year No-Leak Workmanship Warranty',
        '10-year workmanship warranty'          => '12-year no-leak workmanship warranty',
        '15-Year Workmanship & 20+ Year Manufacturer Warranties' => '12-Year No-Leak Workmanship Warranty & Eligible Manufacturer Warranties',
        '15-year workmanship warranty'          => '12-year no-leak workmanship warranty',
        '20+ year manufacturer warranty'        => 'manufacturer warranty on eligible systems',
        '20+ Year Manufacturer Warranties'      => 'Eligible Manufacturer Warranties',
        '$250K third-party guarantee through Directorii.' => 'third-party guarantee coverage; Directorii-backed projects may qualify for a $30,000 Guarantee.',
        '$250K third-party guarantee through Directorii' => 'third-party guarantee coverage; Directorii-backed projects may qualify for a $30,000 Guarantee',
        '| Third-Party Guarantee | $250K |' => '| Third-Party Protection | Directorii-backed projects may qualify for a $30,000 Guarantee; additional documented protection may apply |',
        '$250K Guarantee\', \'Third-party backed by Directorii' => 'Third-Party Protection\', \'Directorii-backed guarantee where eligible',
        '$250K Guarantee'                       => 'Third-Party Protection',
        'Directorii ($250K)'                    => 'Directorii Guarantee',
        '150+ verified 5-star reviews across platforms (Google, Yelp, BBB, Houzz, Directorii)' => 'verified reviews across trusted profiles including Google, Yelp, Directorii and local business listings',
        '150+ verified 5-star reviews'          => 'verified reviews across trusted profiles',
    );

    $html = str_ireplace( array_keys( $replacements ), array_values( $replacements ), $html );

    $html = preg_replace(
        '/"streetAddress"\s*:\s*"Long Beach"/',
        '"streetAddress": "1821 E 5th St Unit #1"',
        $html
    ) ?? $html;

    return $html;
}
