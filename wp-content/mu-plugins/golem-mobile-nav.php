<?php
/**
 * Plugin Name: Golem Mobile Nav
 * Description: Mobile header polish, compact drawer navigation, and first-screen overlap fixes.
 * Version: 2.0.0
 * Author: Golem Roofing Dev
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_footer', 'golem_mobile_nav_render', 30 );

function golem_mobile_nav_render(): void {
    $quote_url = home_url( '/?quote=1' );
    ?>
    <!-- GOLEM-MOBILE-NAV -->
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
                    <span class="golem-nav-drawer__brand-title">Golem Roofing</span>
                    <span class="golem-nav-drawer__brand-subtitle">Power You Can Trust</span>
                </a>
                <button id="golem-nav-close" class="golem-nav-drawer__close" aria-label="Close navigation menu" type="button">×</button>
            </div>

            <nav class="golem-nav-drawer__nav" aria-label="Mobile navigation">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                <a href="<?php echo esc_url( home_url( '/services/roof-replacement/' ) ); ?>">Roof Replacement</a>
                <a href="<?php echo esc_url( home_url( '/services/roof-repair/' ) ); ?>">Roof Repair</a>
                <a href="<?php echo esc_url( home_url( '/services/roof-installation/' ) ); ?>">Roof Installation</a>
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a>
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a>
            </nav>

            <div class="golem-nav-drawer__proof" aria-label="Trust signals">
                <span>BBB A-</span>
                <span>CSLB #1140626</span>
                <span>GAF Certified</span>
                <span>150+ Reviews</span>
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
        .golem-nav-backdrop {
            display: none !important;
        }
    }

    @media (max-width: 767px) {
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .elementor-location-header {
            position: sticky !important;
            top: 0 !important;
            z-index: 9999 !important;
            min-height: 72px !important;
            background: rgba(30, 29, 35, 0.76) !important;
            -webkit-backdrop-filter: blur(16px) saturate(130%);
            backdrop-filter: blur(16px) saturate(130%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 12px 34px rgba(0, 0, 0, 0.18);
        }

        .elementor-location-header .elementor-element-5f97dbf {
            min-width: 220px;
        }

        .elementor-location-header img {
            max-height: 42px !important;
            width: auto !important;
            filter: brightness(0) invert(1);
            opacity: 0.92;
        }

        .elementor-location-header .elementor-widget-text-editor,
        .elementor-location-header .elementor-heading-title,
        .elementor-location-header .aux-logo-anchor {
            color: #ffffff !important;
        }

        .golem-hamburger {
            align-items: center;
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
            border-radius: 999px !important;
            cursor: pointer;
            display: flex !important;
            flex-direction: column;
            gap: 5px;
            height: 42px !important;
            justify-content: center;
            padding: 0 !important;
            position: fixed !important;
            right: 14px !important;
            top: 15px !important;
            width: 42px !important;
            z-index: 10001 !important;
        }

        .golem-hamburger__line {
            background: #ffffff !important;
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
            position: fixed !important;
            right: 0 !important;
            top: 0 !important;
            transform: translateX(100%);
            transition: transform 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            width: min(82vw, 320px) !important;
            z-index: 10002 !important;
        }

        .golem-nav-drawer--open {
            transform: translateX(0) !important;
        }

        .golem-nav-drawer__inner {
            display: flex;
            flex-direction: column;
            gap: 22px;
            min-height: 100%;
            padding: 24px 22px 26px;
        }

        .golem-nav-drawer__top {
            align-items: flex-start;
            display: flex;
            justify-content: space-between;
            gap: 16px;
        }

        .golem-nav-drawer__brand,
        .golem-nav-drawer__brand:hover {
            color: #ffffff !important;
            text-decoration: none !important;
        }

        .golem-nav-drawer__brand-title {
            display: block;
            font-family: "Red Hat Display", Arial, sans-serif;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 0;
            line-height: 1.1;
        }

        .golem-nav-drawer__brand-subtitle {
            color: rgba(255, 255, 255, 0.68);
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-top: 4px;
        }

        .golem-nav-drawer__close {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 999px;
            color: #ffffff;
            cursor: pointer;
            font-size: 24px;
            height: 38px;
            line-height: 1;
            width: 38px;
        }

        .golem-nav-drawer__nav {
            display: grid;
            gap: 2px;
        }

        .golem-nav-drawer__nav a {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
            display: block;
            font-family: "Red Hat Display", Arial, sans-serif;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: 0;
            line-height: 1.2;
            padding: 13px 0;
            text-decoration: none !important;
        }

        .golem-nav-drawer__proof {
            display: grid;
            gap: 8px;
            grid-template-columns: 1fr 1fr;
        }

        .golem-nav-drawer__proof span {
            border: 1px solid rgba(244, 168, 35, 0.34);
            border-radius: 8px;
            color: #f5d28b;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.2;
            min-height: 40px;
            padding: 8px 9px;
        }

        .golem-nav-drawer__contact {
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.74);
            display: grid;
            font-size: 14px;
            gap: 8px;
            padding-top: 18px;
        }

        .golem-nav-drawer__contact a {
            color: #ffffff !important;
            text-decoration: none !important;
        }

        .golem-nav-drawer__phone {
            font-size: 20px;
            font-weight: 800;
        }

        .golem-nav-drawer__cta {
            background: #f4a823;
            border-radius: 8px;
            box-shadow: 0 14px 34px rgba(244, 168, 35, 0.24);
            color: #151515 !important;
            display: block;
            font-family: "Red Hat Display", Arial, sans-serif;
            font-size: 16px;
            font-weight: 900;
            letter-spacing: 0;
            margin-top: auto;
            padding: 16px 18px;
            text-align: center;
            text-decoration: none !important;
        }

        #about {
            overflow: visible !important;
            z-index: 2;
        }

        #about .elementor-element-25007a9 {
            padding-bottom: 170px !important;
            z-index: 5;
        }

        #about .elementor-element-f7b278e,
        #about .aux-modern-button-wrapper,
        #about .aux-modern-button {
            position: relative;
            z-index: 6;
        }

        #about + .elementor-element,
        #about + section {
            margin-top: 0 !important;
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

        if (!btn || !drawer || !backdrop) {
            return;
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
                document.body.style.overflow = 'hidden';
                return;
            }

            drawer.classList.remove('golem-nav-drawer--open');
            backdrop.classList.remove('golem-nav-backdrop--visible');
            btn.classList.remove('golem-hamburger--open');
            btn.setAttribute('aria-expanded', 'false');
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
        });

        window.matchMedia('(min-width: 768px)').addEventListener('change', function(event) {
            if (event.matches && !drawer.hasAttribute('hidden')) {
                setOpen(false);
            }
        });
    })();
    </script>
    <!-- /GOLEM-MOBILE-NAV -->
    <?php
}
