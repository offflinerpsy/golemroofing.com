<?php
/**
 * Plugin Name: Golem Mobile Nav
 * Description: Mobile header polish, compact drawer navigation, and first-screen overlap fixes.
 * Version: 2.1.7
 * Author: Golem Roofing Dev
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_footer', 'golem_mobile_nav_render', 30 );
add_action( 'template_redirect', 'golem_mobile_nav_start_buffer', 1 );

function golem_mobile_nav_start_buffer(): void {
    if ( is_admin() || wp_doing_ajax() || wp_is_json_request() ) {
        return;
    }

    ob_start( 'golem_mobile_nav_fix_experience_years' );
}

function golem_mobile_nav_fix_experience_years( string $html ): string {
    return str_ireplace(
        array(
            'With over 8 years of hands-on experience',
            'over 8 years of hands-on experience',
            'over 8 years',
            '8+ Years of Roofing Experience',
            '8+ years of roofing experience',
            '8+ Years Experience',
            '8+ years experience',
            '8+ years of experience',
            '10 Year Workmanship Warranty',
            '10-Year Workmanship Warranty',
            '10-year workmanship warranty',
            '15-Year Workmanship & 20+ Year Manufacturer Warranties',
        ),
        array(
            'With over 12 years of hands-on experience',
            'over 12 years of hands-on experience',
            'over 12 years',
            '12 Years of Roofing Experience',
            '12 years of roofing experience',
            '12 Years Experience',
            '12 years experience',
            'over 12 years of combined hands-on roofing experience',
            '12 Year No-Leak Workmanship Warranty',
            '12-Year No-Leak Workmanship Warranty',
            '12-year no-leak workmanship warranty',
            '12-Year No-Leak Workmanship Warranty & Eligible Manufacturer Warranties',
        ),
        $html
    );
}

function golem_mobile_nav_render(): void {
    $quote_url    = home_url( '/?quote=1' );
    $mark_url     = 'https://golemroofing.com/wp-content/uploads/2025/08/7bf0ac983262c3171f71cc5a0495567e.webp';
    $wordmark_url = 'https://golemroofing.com/wp-content/uploads/2020/10/00d5a08bd910c0f7830e1acc9f8c2a6a.webp';
    $bbb_url      = 'https://seal-blue.bbb.org/badge/badge.png';
    ?>
    <!-- GOLEM-MOBILE-NAV -->
    <div class="golem-mobile-header-shell" aria-hidden="true"></div>

    <a class="golem-mobile-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Golem Roofing home">
        <img class="golem-mobile-brand__mark" src="<?php echo esc_url( $mark_url ); ?>" alt="" aria-hidden="true" loading="eager">
        <img class="golem-mobile-brand__wordmark" src="<?php echo esc_url( $wordmark_url ); ?>" alt="Golem Roofing — Power You Can Trust" loading="eager">
    </a>

    <nav class="golem-mobile-quick" aria-label="Quick mobile links">
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a>
        <a href="tel:+15629918165">Call</a>
    </nav>

    <button
        id="golem-hamburger"
        class="golem-hamburger"
        aria-label="Open navigation menu"
        aria-expanded="false"
        aria-controls="golem-nav-drawer"
        type="button"
    >
        <span class="golem-hamburger__line"></span>
        <span class="golem-hamburger__line"></span>
        <span class="golem-hamburger__line"></span>
    </button>

    <div id="golem-nav-backdrop" class="golem-nav-backdrop" aria-hidden="true" hidden></div>

    <div
        id="golem-nav-drawer"
        class="golem-nav-drawer"
        role="dialog"
        aria-modal="true"
        aria-label="Navigation menu"
        hidden
    >
        <div class="golem-nav-drawer__inner">
            <div class="golem-nav-drawer__top">
                <a class="golem-nav-drawer__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img class="golem-nav-drawer__brand-mark" src="<?php echo esc_url( $mark_url ); ?>" alt="" aria-hidden="true">
                    <img class="golem-nav-drawer__brand-wordmark" src="<?php echo esc_url( $wordmark_url ); ?>" alt="Golem Roofing — Power You Can Trust">
                </a>
                <button id="golem-nav-close" class="golem-nav-drawer__close" aria-label="Close navigation menu" type="button">×</button>
            </div>

            <nav class="golem-nav-drawer__nav" aria-label="Mobile navigation">
                <div class="golem-nav-drawer__primary">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                    <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a>
                    <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Resources</a>
                </div>

                <details class="golem-nav-group" open>
                    <summary>Services</summary>
                    <div class="golem-nav-group__grid">
                        <a href="<?php echo esc_url( home_url( '/roof-replacement/' ) ); ?>">Replacement</a>
                        <a href="<?php echo esc_url( home_url( '/roof-repair/' ) ); ?>">Repair</a>
                        <a href="<?php echo esc_url( home_url( '/roof-installation/' ) ); ?>">Installation</a>
                        <a href="<?php echo esc_url( home_url( '/flat-roof-installation/' ) ); ?>">Flat Roofing</a>
                        <a href="<?php echo esc_url( home_url( '/tile-roof-installation/' ) ); ?>">Tile Roofing</a>
                        <a href="<?php echo esc_url( home_url( '/shingle-roof-installation/' ) ); ?>">Shingle Roofing</a>
                    </div>
                </details>

                <details class="golem-nav-group">
                    <summary>Service Areas</summary>
                    <div class="golem-nav-group__grid">
                        <a href="<?php echo esc_url( home_url( '/roofing-long-beach-ca/' ) ); ?>">Long Beach</a>
                        <a href="<?php echo esc_url( home_url( '/roofing-seal-beach-ca/' ) ); ?>">Seal Beach</a>
                        <a href="<?php echo esc_url( home_url( '/roofing-redondo-beach-ca/' ) ); ?>">Redondo Beach</a>
                        <a href="<?php echo esc_url( home_url( '/roofing-manhattan-beach-ca/' ) ); ?>">Manhattan Beach</a>
                        <a href="<?php echo esc_url( home_url( '/roofing-hermosa-beach-ca/' ) ); ?>">Hermosa Beach</a>
                        <a href="<?php echo esc_url( home_url( '/roofing-palos-verdes-ca/' ) ); ?>">Palos Verdes</a>
                    </div>
                </details>
            </nav>

            <div class="golem-nav-drawer__proof" aria-label="Trust signals and review badges">
                <span class="golem-proof-card golem-proof-card--bbb">
                    <img class="golem-proof-bbb-img" src="<?php echo esc_url( $bbb_url ); ?>" alt="BBB Accredited Business" loading="lazy">
                </span>
                <span class="golem-proof-card golem-proof-card--gaf">
                    <strong>GAF</strong><em>Certified</em>
                </span>
                <span class="golem-proof-card golem-proof-card--google">
                    <strong>Google</strong><em>★★★★★</em>
                </span>
                <span class="golem-proof-card golem-proof-card--yelp">
            <strong>Yelp</strong><em>★★★★★</em>
                </span>
                <span class="golem-proof-card golem-proof-card--years">
                    <strong>12</strong><em>Years Experience</em>
                </span>
                <span class="golem-proof-card golem-proof-card--reviews">
            <strong>200+</strong><em>Five-Star Reviews</em>
                </span>
            </div>

            <div class="golem-nav-drawer__contact">
                <a href="tel:+15629918165" class="golem-nav-drawer__phone">(562) 991-8165</a>
                <a href="mailto:Golemroofing@gmail.com">Golemroofing@gmail.com</a>
                <span>Long Beach and South Bay, CA</span>
            </div>

            <a href="<?php echo esc_url( $quote_url ); ?>" class="golem-nav-drawer__cta">Get A Free Quote</a>
        </div>
    </div>

    <style>
    @media (min-width: 768px) {
        .golem-hamburger,
        .golem-nav-drawer,
        .golem-nav-backdrop,
        .golem-mobile-brand,
        .golem-mobile-quick {
            display: none !important;
        }
    }

    @media (max-width: 767px) {
        html,
        body {
            height: auto !important;
            max-width: 100%;
            min-height: 100% !important;
            overscroll-behavior-x: none;
            touch-action: pan-y pinch-zoom;
            width: 100% !important;
            overflow-x: hidden !important;
            overflow-y: auto !important;
        }

        body,
        #inner-body,
        .aux-wrapper,
        .aux-container,
        .aux-primary,
        .elementor,
        .elementor-section,
        .elementor-container,
        .elementor-column,
        .elementor-widget-wrap,
        .e-con,
        .e-con-inner {
            max-width: 100vw !important;
        }

        html.golem-nav-open,
        body.golem-nav-open {
            overflow: hidden !important;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .aux-fs-popup,
        .aux-fs-menu,
        .aux-fs-menu *,
        .aux-fs-popup *,
        .aux-burger-box,
        .aux-burger,
        .aux-nav-menu-element .aux-burger,
        .elementor-location-header .aux-widget-logo,
        .elementor-location-header .aux-logo-text,
        .elementor-location-header .aux-elementor-header-menu,
        .elementor-location-header .elementor-widget-aux_logo,
        .elementor-location-header .elementor-widget-aux_menu_box,
        .elementor-location-header .elementor-widget-image,
        .elementor-location-header nav {
            display: none !important;
            pointer-events: none !important;
            visibility: hidden !important;
        }

        .elementor-location-header {
            background: transparent !important;
            background-color: transparent !important;
            border-bottom: 0 !important;
            box-shadow: none !important;
            overflow: visible !important;
            position: sticky !important;
            top: 0 !important;
            z-index: 9999 !important;
            min-height: 70px !important;
            transition: min-height 0.22s ease;
        }

        .elementor-location-header.golem-mobile-header--scrolled {
            min-height: 62px !important;
        }

        .golem-mobile-header-shell {
            background: rgba(20, 86, 121, 0.94) !important;
            border-bottom: 1px solid rgba(244, 168, 35, 0.28) !important;
            box-shadow: 0 12px 30px rgba(10, 37, 55, 0.24) !important;
            -webkit-backdrop-filter: blur(14px) saturate(120%);
            backdrop-filter: blur(14px) saturate(120%);
            height: 92px;
            inset: 0 0 auto 0;
            pointer-events: none;
            position: fixed;
            transition: background 0.22s ease, box-shadow 0.22s ease, height 0.22s ease;
            z-index: 10000;
        }

        .golem-mobile-header-shell.golem-mobile-header-shell--scrolled {
            background: rgba(20, 86, 121, 0.88) !important;
            box-shadow: 0 10px 24px rgba(10, 37, 55, 0.2) !important;
            height: 72px;
        }

        .elementor-location-header .elementor-element-5f97dbf {
            min-width: 118px;
        }

        .elementor-location-header img {
            max-height: 34px !important;
            width: auto !important;
            filter: brightness(0) invert(1);
            opacity: 0.92;
        }

        .golem-mobile-brand {
            align-items: center;
            color: #ffffff !important;
            display: flex !important;
            gap: 10px;
            left: 18px;
            max-width: 210px;
            position: fixed;
            text-decoration: none !important;
            top: 11px;
            transition: top 0.22s ease, transform 0.22s ease;
            z-index: 10001;
        }

        .golem-mobile-brand__mark {
            display: block;
            height: auto;
            max-height: 36px;
            width: 58px;
        }

        .golem-mobile-brand__wordmark {
            display: block;
            filter: brightness(0) invert(1);
            height: auto;
            max-height: 34px;
            opacity: 0.96;
            width: 142px;
        }

        .golem-mobile-quick {
            align-items: center;
            display: flex !important;
            gap: 16px;
            position: fixed;
            right: 64px;
            top: 33px;
            transition: top 0.22s ease, transform 0.22s ease;
            z-index: 10001;
        }

        .golem-mobile-quick a {
            background: transparent;
            border: 0;
            color: #f4a823 !important;
            font-family: "Red Hat Display", Arial, sans-serif;
            font-size: 13px;
            font-weight: 900;
            line-height: 1;
            padding: 0;
            text-decoration: none !important;
            transition: opacity 0.22s ease;
        }

        .elementor-location-header .elementor-widget-text-editor,
        .elementor-location-header .elementor-heading-title,
        .elementor-location-header .aux-logo-anchor {
            color: #ffffff !important;
        }

        .golem-hamburger {
            align-items: center;
            background: #f4a823 !important;
            border: 1px solid rgba(255, 255, 255, 0.28) !important;
            border-radius: 999px !important;
            box-shadow: 0 10px 24px rgba(244, 168, 35, 0.24);
            cursor: pointer;
            display: flex !important;
            flex-direction: column;
            gap: 5px;
            height: 42px !important;
            justify-content: center;
            padding: 0 !important;
            position: fixed !important;
            right: 14px !important;
            top: 14px !important;
            transition: top 0.22s ease, transform 0.22s ease, box-shadow 0.22s ease;
            width: 42px !important;
            z-index: 10001 !important;
        }

        .golem-mobile-brand.golem-mobile-brand--scrolled {
            top: 8px;
        }

        .golem-mobile-quick.golem-mobile-quick--scrolled {
            top: 26px;
        }

        .golem-hamburger.golem-hamburger--scrolled {
            top: 10px !important;
        }

        .golem-hamburger__line {
            background: #145679 !important;
            border-radius: 999px !important;
            display: block !important;
            height: 2px !important;
            transition: transform 0.22s ease, opacity 0.22s ease;
            width: 22px !important;
        }

        .golem-hamburger--open .golem-hamburger__line:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .golem-hamburger--open .golem-hamburger__line:nth-child(2) {
            opacity: 0;
        }

        .golem-hamburger--open .golem-hamburger__line:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        .golem-nav-backdrop {
            background: rgba(10, 12, 16, 0.62) !important;
            inset: 0 !important;
            opacity: 0;
            position: fixed !important;
            transition: opacity 0.24s ease;
            z-index: 10000 !important;
        }

        .golem-nav-backdrop--visible {
            opacity: 1;
        }

        .golem-nav-drawer {
            background:
                linear-gradient(180deg, rgba(30, 29, 35, 0.98), rgba(18, 20, 24, 0.98)) !important;
            bottom: 0 !important;
            box-shadow: -18px 0 50px rgba(0, 0, 0, 0.36) !important;
            color: #ffffff !important;
            max-width: 320px !important;
            overflow-y: auto !important;
            overscroll-behavior: contain;
            position: fixed !important;
            right: 0 !important;
            top: 0 !important;
            transform: translateX(100%);
            transition: transform 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            width: min(92vw, 320px) !important;
            z-index: 10002 !important;
        }

        .golem-nav-drawer--open {
            transform: translateX(0) !important;
        }

        .golem-nav-drawer__inner {
            display: flex;
            flex-direction: column;
            gap: 13px;
            min-height: 100%;
            padding: 18px 18px 18px;
        }

        .golem-nav-drawer__top {
            align-items: flex-start;
            display: flex;
            justify-content: space-between;
            gap: 16px;
        }

        .golem-nav-drawer__brand,
        .golem-nav-drawer__brand:hover {
            align-items: center;
            color: #ffffff !important;
            display: flex;
            gap: 10px;
            text-decoration: none !important;
        }

        .golem-nav-drawer__brand-mark {
            display: block;
            height: auto;
            max-height: 42px;
            width: 68px;
        }

        .golem-nav-drawer__brand-wordmark {
            display: block;
            filter: brightness(0) invert(1);
            height: auto;
            max-height: 38px;
            opacity: 0.96;
            width: 150px;
        }

        .golem-nav-drawer__close {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 999px;
            color: #ffffff;
            cursor: pointer;
            font-size: 24px;
            height: 38px !important;
            line-height: 1;
            min-width: 38px !important;
            padding: 0 !important;
            width: 38px;
        }

        .golem-nav-drawer__nav {
            display: grid;
            gap: 8px;
        }

        .golem-nav-drawer__primary {
            display: grid;
            gap: 6px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .golem-nav-drawer__primary a,
        .golem-nav-group__grid a {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
            display: block;
            font-family: "Red Hat Display", Arial, sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0;
            line-height: 1.2;
            padding: 9px 0;
            text-decoration: none !important;
        }

        .golem-nav-group {
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 10px;
            padding: 0;
        }

        .golem-nav-group summary {
            color: #f5d28b;
            cursor: pointer;
            font-family: "Red Hat Display", Arial, sans-serif;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 0;
            list-style: none;
            padding: 10px 12px;
        }

        .golem-nav-group summary::-webkit-details-marker {
            display: none;
        }

        .golem-nav-group summary::after {
            content: "+";
            float: right;
            font-size: 16px;
            line-height: 0.85;
        }

        .golem-nav-group[open] summary::after {
            content: "-";
        }

        .golem-nav-group__grid {
            display: grid;
            gap: 0 14px;
            grid-template-columns: 1fr 1fr;
            padding: 0 12px 10px;
        }

        .golem-nav-drawer__proof {
            display: grid;
            gap: 8px;
            grid-template-columns: 1fr 1fr;
        }

        .golem-proof-card {
            align-items: center;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(244, 168, 35, 0.32);
            border-radius: 8px;
            color: #145679;
            display: flex;
            flex-direction: column;
            font-family: "Red Hat Display", Arial, sans-serif;
            justify-content: center;
            line-height: 1.2;
            min-height: 48px;
            overflow: hidden;
            padding: 7px 8px;
            text-align: center;
        }

        .golem-proof-card strong {
            display: block;
            font-size: 16px;
            font-weight: 950;
            letter-spacing: 0;
        }

        .golem-proof-card em {
            color: #4e5962;
            display: block;
            font-size: 10px;
            font-style: normal;
            font-weight: 800;
        }

        .golem-proof-card--bbb {
            padding: 0;
        }

        .golem-proof-card--bbb img {
            display: block;
            height: 48px;
            object-fit: contain;
            width: 100%;
        }

        .golem-proof-card--gaf strong {
            color: #d71920;
        }

        .golem-proof-card--google strong {
            color: #4285f4;
            font-size: 15px;
        }

        .golem-proof-card--google em {
            color: #f4a823;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .golem-proof-card--yelp strong {
            color: #d32323;
        }

        .golem-proof-card--years strong,
        .golem-proof-card--reviews strong {
            color: #145679;
            font-size: 18px;
        }

        .golem-nav-drawer__contact {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.74);
            display: grid;
            font-size: 12px;
            gap: 5px;
            padding-top: 10px;
        }

        .golem-nav-drawer__contact a {
            color: #ffffff !important;
            text-decoration: none !important;
        }

        .golem-nav-drawer__phone {
            font-size: 17px;
            font-weight: 800;
        }

        .golem-nav-drawer__cta {
            background: #f4a823;
            border-radius: 9px;
            box-shadow: 0 14px 34px rgba(244, 168, 35, 0.24);
            color: #151515 !important;
            display: block;
            font-family: "Red Hat Display", Arial, sans-serif;
            font-size: 16px;
            font-weight: 900;
            letter-spacing: 0;
            margin-top: 0;
            padding: 13px 16px;
            text-align: center;
            text-decoration: none !important;
        }

        #about {
            background:
                linear-gradient(rgba(0, 0, 0, 0.28), rgba(0, 0, 0, 0.28)),
                url("https://golemroofing.com/wp-content/uploads/2025/08/0807-poster.webp") center center / cover no-repeat !important;
            min-height: calc(100svh - 92px) !important;
            overflow: visible !important;
            z-index: 2;
        }

        #about > .e-con-inner {
            min-height: calc(100svh - 92px) !important;
        }

        #about .elementor-background-video-container {
            background: url("https://golemroofing.com/wp-content/uploads/2025/08/0807-poster.webp") center center / cover no-repeat !important;
        }

        #about .elementor-background-video-container,
        #about .elementor-background-video-hosted {
            inset: 0 !important;
            height: 100% !important;
            min-height: 100% !important;
            opacity: 1 !important;
            position: absolute !important;
            visibility: visible !important;
            width: 100% !important;
        }

        #about .elementor-background-video-hosted {
            object-fit: cover !important;
            transform: none !important;
        }

        #about .elementor-element-25007a9 {
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            margin-bottom: 0 !important;
            min-height: calc(100svh - 92px) !important;
            padding-bottom: 32px !important;
            padding-top: clamp(34px, 8svh, 92px) !important;
            z-index: 5;
        }

        #about .elementor-element-ba0b2de {
            margin-bottom: 28px !important;
        }

        #about .elementor-element-ba0b2de .aux-modern-heading-primary {
            font-size: 17px !important;
            line-height: 1.45 !important;
            margin-bottom: 8px !important;
        }

        #about .elementor-element-ba0b2de .aux-modern-heading-secondary,
        #about .elementor-element-ba0b2de .aux-head-before {
            font-size: 36px !important;
            line-height: 1.05 !important;
        }

        #about .elementor-element-ba0b2de .aux-modern-heading-description,
        #about .elementor-element-ba0b2de .aux-modern-heading-description p,
        #about .elementor-element-ba0b2de .aux-modern-heading-description span {
            font-size: 16px !important;
            line-height: 1.55 !important;
        }

        #about .elementor-element-f7b278e {
            margin-top: auto !important;
            padding-bottom: 0 !important;
        }

        #about .elementor-element-f7b278e,
        #about .aux-modern-button-wrapper,
        #about .aux-modern-button {
            position: relative;
            z-index: 6;
        }

        #about .aux-modern-button-wrapper {
            width: 100% !important;
        }

        #about .aux-modern-button {
            margin-left: 0 !important;
            width: min(100%, calc(100vw - 64px)) !important;
        }

        #about + .elementor-element,
        #about + section {
            margin-top: -28px !important;
            position: relative;
            z-index: 1;
        }

        .home main .aux-appear-watch-animation,
        .home main .aux-animated,
        .home main .elementor-motion-effects-element,
        .home main .elementor-motion-effects-element-type-background,
        .home main .elementor-motion-effects-element-type-scroll {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }

        #bbb-badge {
            display: none !important;
            visibility: hidden !important;
        }

        .home #about + .elementor-element,
        .home #about + section {
            margin-left: 0 !important;
            margin-right: 0 !important;
            margin-top: -34px !important;
            width: 100% !important;
        }

        .home #about + .elementor-element .elementor-element-e4a410b,
        .home #about + section .elementor-element-e4a410b,
        .home #about + .elementor-element .elementor-element-9c4675b,
        .home #about + section .elementor-element-9c4675b {
            border-radius: 18px 18px 0 0 !important;
            overflow: hidden !important;
        }

        .home #about + .elementor-element .elementor-element-42b5fe7,
        .home #about + section .elementor-element-42b5fe7 {
            padding-top: 26px !important;
        }

        .home #about + .elementor-element .elementor-element-b3659ad,
        .home #about + section .elementor-element-b3659ad {
            margin-top: 0 !important;
        }

        .home .elementor-element-a526c99,
        .home .elementor-element-d43fd50 {
            background: #1150a6 !important;
        }

        .home .elementor-element-a526c99 {
            margin-top: 0 !important;
        }

        .home .elementor-element-d43fd50 {
            padding-top: 34px !important;
            padding-bottom: 34px !important;
        }

        .home .elementor-element-d7942bf,
        .home .elementor-element-d7942bf .aux-modern-heading-primary,
        .home .elementor-element-d7942bf .aux-head-highlight {
            color: #d6e6ff !important;
        }

        .home .elementor-element-0fa9014 {
            gap: 18px !important;
        }

        .home .elementor-element-0fa9014 > .e-con,
        .home .elementor-element-a2698b1,
        .home .elementor-element-950bb2d {
            align-self: center !important;
            box-shadow: none !important;
            left: 50% !important;
            margin-left: auto !important;
            margin-right: auto !important;
            max-width: min(390px, calc(100vw - 40px)) !important;
            position: relative !important;
            transform: translateX(-50%) !important;
            width: calc(100vw - 40px) !important;
        }

        .home .elementor-element-641fd80 {
            display: grid !important;
            gap: 18px 16px !important;
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
        }

        .home .elementor-element-641fd80 > .e-con.e-child,
        .home .golem-home-trust-card {
            min-width: 0 !important;
            width: auto !important;
        }

        .home .golem-home-trust-card {
            align-items: center;
            display: flex;
            flex-direction: column;
            gap: 8px;
            justify-content: flex-start;
            text-align: center;
        }

        .home .golem-home-trust-card__media {
            align-items: center;
            display: flex;
            height: 93px;
            justify-content: center;
            width: 100%;
        }

        .home .golem-home-trust-card__media img {
            max-height: 61px;
            max-width: 100%;
            object-fit: contain;
        }

        .home .golem-home-trust-card__badge {
            align-items: center;
            background: #ffffff;
            border: 1px solid rgba(20, 86, 121, 0.18);
            border-radius: 12px;
            color: #145679;
            display: flex;
            flex-direction: column;
            font-family: "Red Hat Display", Arial, sans-serif;
            font-weight: 900;
            height: 61px;
            justify-content: center;
            line-height: 1;
            width: 100%;
        }

        .home .golem-home-trust-card__badge strong {
            display: block;
            font-size: 26px;
        }

        .home .golem-home-trust-card__badge span {
            display: block;
            font-size: 11px;
            letter-spacing: 0;
            margin-top: 4px;
        }

        .home .golem-home-trust-card__label {
            color: #111111;
            display: block;
            font-family: "Red Hat Display", Arial, sans-serif;
            font-size: 20px;
            font-weight: 900;
            line-height: 1;
        }

        .elementor-section,
        .elementor-container,
        .elementor-column,
        .elementor-widget-wrap {
            max-width: 100% !important;
        }

        .elementor-location-footer {
            background: #1e1d23 !important;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }

        .elementor-location-footer .aux-modern-button-wrapper {
            display: flex !important;
            justify-content: center !important;
            text-align: center !important;
            width: 100% !important;
        }

        .elementor-location-footer .aux-modern-button {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .dialog-widget.dialog-lightbox-widget.dialog-type-lightbox.elementor-popup-modal {
            align-items: flex-start !important;
            padding: 0 16px 24px !important;
            z-index: 20000 !important;
        }

        .dialog-widget.dialog-lightbox-widget.dialog-type-lightbox.elementor-popup-modal .dialog-widget-content {
            left: auto !important;
            margin: 0 auto !important;
            max-height: calc(100svh - env(safe-area-inset-top, 0px) - 44px) !important;
            overflow-y: auto !important;
            top: calc(env(safe-area-inset-top, 0px) + 22px) !important;
            transform: none !important;
            width: min(100%, 360px) !important;
        }

        .dialog-widget.dialog-lightbox-widget.dialog-type-lightbox.elementor-popup-modal .dialog-message {
            max-height: inherit !important;
            overflow: visible !important;
        }

        .dialog-widget.dialog-lightbox-widget.dialog-type-lightbox.elementor-popup-modal .dialog-close-button {
            right: 14px !important;
            top: 14px !important;
        }

        html.golem-quote-popup-open .golem-mobile-header-shell,
        html.golem-quote-popup-open .golem-mobile-brand,
        html.golem-quote-popup-open .golem-mobile-quick,
        html.golem-quote-popup-open .golem-hamburger {
            opacity: 0 !important;
            pointer-events: none !important;
            visibility: hidden !important;
        }

        .elementor-location-footer + .gc-seo-links-footer,
        .gc-seo-links-footer {
            background: #1e1d23 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.12) !important;
            margin-top: 0 !important;
            padding: 24px 20px 30px !important;
        }

        .gc-seo-links-footer .gc-cols {
            display: grid !important;
            gap: 22px 18px !important;
            grid-template-columns: 1fr 1fr !important;
            margin: 0 auto !important;
            max-width: 430px !important;
            width: 100% !important;
        }

        .gc-seo-links-footer h4 {
            color: #ffffff !important;
            font-family: "Red Hat Display", Arial, sans-serif !important;
            font-size: 11px !important;
            font-weight: 900 !important;
            letter-spacing: 0.04em !important;
            line-height: 1.25 !important;
            margin: 0 0 12px !important;
            text-transform: uppercase !important;
        }

        .gc-seo-links-footer ul {
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .gc-seo-links-footer li {
            margin: 0 0 8px !important;
            padding: 0 !important;
        }

        .gc-seo-links-footer a {
            color: rgba(255, 255, 255, 0.84) !important;
            font-family: "Red Hat Display", Arial, sans-serif !important;
            font-size: 12px !important;
            line-height: 1.25 !important;
            text-decoration: none !important;
        }

        .gc-seo-links-footer p {
            color: rgba(255, 255, 255, 0.58) !important;
            font-size: 11px !important;
            grid-column: 1 / -1 !important;
            line-height: 1.45 !important;
            margin: 4px 0 0 !important;
        }

        .gc-seo-links-footer .gc-cols.golem-footer-accordion {
            display: grid !important;
            gap: 10px !important;
            grid-template-columns: 1fr !important;
            max-width: 430px !important;
        }

        .gc-seo-links-footer .golem-footer-accordion__item {
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px !important;
            overflow: hidden !important;
        }

        .gc-seo-links-footer .golem-footer-accordion__summary {
            color: #ffffff !important;
            cursor: pointer;
            font-family: "Red Hat Display", Arial, sans-serif !important;
            font-size: 12px !important;
            font-weight: 900 !important;
            letter-spacing: 0.04em !important;
            line-height: 1.2 !important;
            list-style: none !important;
            margin: 0 !important;
            padding: 13px 16px !important;
            position: relative;
            text-transform: uppercase !important;
        }

        .gc-seo-links-footer .golem-footer-accordion__summary::-webkit-details-marker {
            display: none !important;
        }

        .gc-seo-links-footer .golem-footer-accordion__summary::after {
            color: #f4a823 !important;
            content: "+";
            font-size: 18px !important;
            font-weight: 900 !important;
            line-height: 1 !important;
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
        }

        .gc-seo-links-footer .golem-footer-accordion__item[open] .golem-footer-accordion__summary::after {
            content: "−";
        }

        .gc-seo-links-footer .golem-footer-accordion__body {
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
            padding: 0 16px 16px !important;
        }

        .gc-seo-links-footer .golem-footer-accordion__body ul {
            margin-top: 12px !important;
        }

        .gc-seo-links-footer .golem-footer-accordion__body li {
            margin-bottom: 10px !important;
        }

        .gc-seo-links-footer .golem-footer-accordion__body a {
            font-size: 13px !important;
            line-height: 1.35 !important;
        }

        .gc-seo-links-footer .golem-footer-accordion__body .gc-trust-badges {
            display: grid !important;
            gap: 8px !important;
            margin-top: 14px !important;
        }

        .gc-seo-links-footer .golem-footer-accordion__body .gc-trust-badges a {
            margin: 0 !important;
            text-align: center !important;
        }

        @media (max-width: 360px) {
            .golem-mobile-brand {
                left: 14px;
                max-width: 170px;
            }

            .golem-mobile-brand__mark {
                width: 50px;
            }

            .golem-mobile-brand__wordmark {
                width: 116px;
            }

            .golem-mobile-quick a:first-child {
                display: none !important;
            }

            #about .elementor-element-ba0b2de .aux-modern-heading-primary {
                font-size: 16px !important;
            }

            #about .elementor-element-ba0b2de .aux-modern-heading-secondary,
            #about .elementor-element-ba0b2de .aux-head-before {
                font-size: 34px !important;
            }
        }
    }
    </style>

    <script>
    (function() {
        'use strict';

        var btn = document.getElementById('golem-hamburger');
        var drawer = document.getElementById('golem-nav-drawer');
        var backdrop = document.getElementById('golem-nav-backdrop');
        var closeBtn = document.getElementById('golem-nav-close');
        var mobileMedia = window.matchMedia('(max-width: 767px)');
        var quotePopupScrollY = null;
        var quotePopupWasOpen = false;

        if (!btn || !drawer || !backdrop) {
            return;
        }

        document.querySelectorAll('.aux-burger, .aux-burger-box, .aux-fs-popup').forEach(function(el) {
            el.setAttribute('aria-hidden', 'true');
            el.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
            }, true);
        });

        var homeTrustGrid = document.querySelector('.home .elementor-element-641fd80');
        if (homeTrustGrid && !homeTrustGrid.querySelector('.golem-home-trust-card')) {
            var bbbCard = document.createElement('div');
            bbbCard.className = 'golem-home-trust-card';
            bbbCard.innerHTML =
                '<div class=\"golem-home-trust-card__media\"><img src=\"<?php echo esc_js( $bbb_url ); ?>\" alt=\"BBB Accredited Business\" loading=\"lazy\"></div>' +
                '<div class=\"golem-home-trust-card__label\">BBB</div>';

            var yearsCard = document.createElement('div');
            yearsCard.className = 'golem-home-trust-card';
            yearsCard.innerHTML =
                '<div class=\"golem-home-trust-card__media\">' +
                '<div class=\"golem-home-trust-card__badge\"><strong>12</strong><span>Years</span></div>' +
                '</div>' +
                '<div class=\"golem-home-trust-card__label\">Experience</div>';

            homeTrustGrid.appendChild(bbbCard);
            homeTrustGrid.appendChild(yearsCard);
        }

        function syncHeaderState() {
            var header = document.querySelector('.elementor-location-header');
            var shell = document.querySelector('.golem-mobile-header-shell');
            var brand = document.querySelector('.golem-mobile-brand');
            var quick = document.querySelector('.golem-mobile-quick');
            if (!header || !mobileMedia.matches) {
                return;
            }

            var isScrolled = window.scrollY > 18;
            header.classList.toggle('golem-mobile-header--scrolled', isScrolled);
            btn.classList.toggle('golem-hamburger--scrolled', isScrolled);

            if (shell) {
                shell.classList.toggle('golem-mobile-header-shell--scrolled', isScrolled);
            }

            if (brand) {
                brand.classList.toggle('golem-mobile-brand--scrolled', isScrolled);
            }

            if (quick) {
                quick.classList.toggle('golem-mobile-quick--scrolled', isScrolled);
            }
        }

        function buildFooterAccordion() {
            if (!mobileMedia.matches) {
                return;
            }

            var footerCols = document.querySelector('.gc-seo-links-footer .gc-cols');
            if (!footerCols || footerCols.classList.contains('golem-footer-accordion')) {
                return;
            }

            var sections = Array.prototype.slice.call(footerCols.children);
            sections.forEach(function(section) {
                if (!(section instanceof HTMLElement)) {
                    return;
                }

                var heading = section.querySelector('h4');
                if (!heading) {
                    return;
                }

                var details = document.createElement('details');
                details.className = 'golem-footer-accordion__item';

                var summary = document.createElement('summary');
                summary.className = 'golem-footer-accordion__summary';
                summary.textContent = heading.textContent.trim();

                var body = document.createElement('div');
                body.className = 'golem-footer-accordion__body';

                Array.prototype.slice.call(section.children).forEach(function(child) {
                    if (child !== heading) {
                        body.appendChild(child);
                    }
                });

                details.appendChild(summary);
                details.appendChild(body);
                footerCols.replaceChild(details, section);
            });

            footerCols.classList.add('golem-footer-accordion');
        }

        function isVisiblePopup(element) {
            if (!element) {
                return false;
            }

            var style = window.getComputedStyle(element);
            var rect = element.getBoundingClientRect();

            return style.display !== 'none' &&
                style.visibility !== 'hidden' &&
                Number(style.opacity || 1) > 0.05 &&
                rect.width > 40 &&
                rect.height > 40;
        }

        function syncPopupState() {
            var popups = Array.prototype.slice.call(document.querySelectorAll('.elementor-popup-modal'));
            var isPopupOpen = popups.some(isVisiblePopup);

            document.documentElement.classList.toggle('golem-quote-popup-open', isPopupOpen);
            document.body.classList.toggle('golem-quote-popup-open', isPopupOpen);

            if (!isPopupOpen && quotePopupWasOpen && quotePopupScrollY !== null) {
                window.setTimeout(function() {
                    window.scrollTo(0, quotePopupScrollY);
                    quotePopupScrollY = null;
                }, 80);
            }

            quotePopupWasOpen = isPopupOpen;
        }

        function schedulePopupSync() {
            window.requestAnimationFrame(syncPopupState);
            window.setTimeout(syncPopupState, 120);
            window.setTimeout(syncPopupState, 420);
        }

        var touchStartX = 0;
        var touchStartY = 0;

        document.addEventListener('touchstart', function(event) {
            if (!mobileMedia.matches || event.touches.length !== 1) {
                return;
            }

            touchStartX = event.touches[0].clientX;
            touchStartY = event.touches[0].clientY;
        }, { passive: true });

        document.addEventListener('touchmove', function(event) {
            if (!mobileMedia.matches || event.touches.length !== 1) {
                return;
            }

            var target = event.target;
            if (target && target.closest && target.closest('input, textarea, select, .elementor-popup-modal, .golem-nav-drawer')) {
                return;
            }

            var deltaX = event.touches[0].clientX - touchStartX;
            var deltaY = event.touches[0].clientY - touchStartY;

            if (Math.abs(deltaX) > Math.abs(deltaY) + 8) {
                event.preventDefault();
            }
        }, { passive: false });

        if (window.MutationObserver) {
            new MutationObserver(schedulePopupSync).observe(document.body, {
                attributes: true,
                attributeFilter: ['class', 'style', 'hidden', 'aria-hidden'],
                childList: true,
                subtree: true
            });
        }

        function setOpen(isOpen) {
            if (isOpen) {
                drawer.removeAttribute('hidden');
                backdrop.removeAttribute('hidden');
                drawer.offsetHeight;
                drawer.classList.add('golem-nav-drawer--open');
                backdrop.classList.add('golem-nav-backdrop--visible');
                btn.classList.add('golem-hamburger--open');
                btn.setAttribute('aria-expanded', 'true');
                document.documentElement.classList.add('golem-nav-open');
                document.body.classList.add('golem-nav-open');
                document.body.style.overflow = 'hidden';
                return;
            }

            drawer.classList.remove('golem-nav-drawer--open');
            backdrop.classList.remove('golem-nav-backdrop--visible');
            btn.classList.remove('golem-hamburger--open');
            btn.setAttribute('aria-expanded', 'false');
            document.documentElement.classList.remove('golem-nav-open');
            document.body.classList.remove('golem-nav-open');
            document.body.style.overflow = '';
            window.setTimeout(function() {
                drawer.setAttribute('hidden', '');
                backdrop.setAttribute('hidden', '');
            }, 280);
        }

        btn.addEventListener('click', function() {
            setOpen(drawer.hasAttribute('hidden'));
        });

        closeBtn.addEventListener('click', function() {
            setOpen(false);
            btn.focus();
        });

        backdrop.addEventListener('click', function() {
            setOpen(false);
        });

        drawer.addEventListener('click', function(event) {
            if (event.target && event.target.tagName === 'A') {
                setOpen(false);
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !drawer.hasAttribute('hidden')) {
                setOpen(false);
                btn.focus();
            }

            schedulePopupSync();
        });

        document.addEventListener('click', schedulePopupSync, true);

        document.querySelectorAll('a[href*="popup%3Aopen"], a[href*="popup:open"]').forEach(function(link) {
            if (!/quote|free/i.test(link.textContent || link.getAttribute('aria-label') || '')) {
                return;
            }

            link.addEventListener('click', function() {
                quotePopupScrollY = window.scrollY || window.pageYOffset || 0;
                schedulePopupSync();
            }, true);
        });

        mobileMedia.addEventListener('change', function() {
            syncHeaderState();
            buildFooterAccordion();
            schedulePopupSync();
        });

        window.matchMedia('(min-width: 768px)').addEventListener('change', function(event) {
            if (event.matches && !drawer.hasAttribute('hidden')) {
                setOpen(false);
            }
        });

        window.addEventListener('scroll', syncHeaderState, { passive: true });
        syncHeaderState();
        buildFooterAccordion();
        schedulePopupSync();
    })();
    </script>
    <!-- /GOLEM-MOBILE-NAV -->
    <?php
}
