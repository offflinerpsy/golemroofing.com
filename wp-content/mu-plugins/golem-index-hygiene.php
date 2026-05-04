<?php
/**
 * Plugin Name: Golem Index Hygiene
 * Description: Keeps demo/thin theme archives out of search indexes and XML sitemaps.
 * Version: 1.0.0
 * Author: Golem Roofing Dev
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function golem_index_hygiene_should_noindex(): bool {
    if ( is_admin() || wp_doing_ajax() || wp_is_json_request() ) {
        return false;
    }

    if ( is_singular( 'portfolio' ) || is_post_type_archive( 'portfolio' ) ) {
        return true;
    }

    if ( is_tax( array( 'portfolio-cat', 'portfolio-tag', 'portfolio-filter' ) ) ) {
        return true;
    }

    if ( is_author() || is_category( 'uncategorized' ) ) {
        return true;
    }

    return false;
}

add_filter( 'wpseo_robots', 'golem_index_hygiene_yoast_robots', 99 );
function golem_index_hygiene_yoast_robots( string $robots ): string {
    if ( golem_index_hygiene_should_noindex() ) {
        return 'noindex, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
    }

    return $robots;
}

add_filter( 'wp_robots', 'golem_index_hygiene_wp_robots', 99 );
function golem_index_hygiene_wp_robots( array $robots ): array {
    if ( ! golem_index_hygiene_should_noindex() ) {
        return $robots;
    }

    unset( $robots['index'] );
    $robots['noindex'] = true;
    $robots['follow']  = true;

    return $robots;
}

add_filter( 'wpseo_sitemap_exclude_post_type', 'golem_index_hygiene_exclude_post_type_from_sitemap', 10, 2 );
function golem_index_hygiene_exclude_post_type_from_sitemap( bool $excluded, string $post_type ): bool {
    if ( $post_type === 'portfolio' ) {
        return true;
    }

    return $excluded;
}

add_filter( 'wpseo_sitemap_exclude_taxonomy', 'golem_index_hygiene_exclude_taxonomy_from_sitemap', 10, 2 );
function golem_index_hygiene_exclude_taxonomy_from_sitemap( bool $excluded, string $taxonomy ): bool {
    if ( in_array( $taxonomy, array( 'portfolio-cat', 'portfolio-tag', 'portfolio-filter' ), true ) ) {
        return true;
    }

    return $excluded;
}

add_filter( 'wpseo_sitemap_exclude_author', '__return_true' );

add_filter( 'wpseo_sitemap_entry', 'golem_index_hygiene_exclude_thin_entries_from_sitemap', 10, 3 );
function golem_index_hygiene_exclude_thin_entries_from_sitemap( $url, string $type, $object ) {
    $loc = is_array( $url ) && isset( $url['loc'] ) ? (string) $url['loc'] : '';

    if (
        str_contains( $loc, '/category/uncategorized/' ) ||
        str_contains( $loc, '/author/' ) ||
        str_contains( $loc, 'portfolio-filter=' )
    ) {
        return false;
    }

    return $url;
}
