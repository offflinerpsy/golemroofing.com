<?php
/**
 * Golem Roofing Schema Markup
 * Добавить в Code Snippets или functions.php
 * 
 * ИНСТРУКЦИЯ:
 * 1. Войти в WordPress Admin
 * 2. Перейти в Snippets → Add New
 * 3. Название: "Golem Roofing Schema Markup"
 * 4. Скопировать код ниже (БЕЗ <?php тега)
 * 5. Scope: "Only run on the front end"
 * 6. Активировать
 */

// ============= НАЧАЛО КОДА ДЛЯ SNIPPET =============

/**
 * LocalBusiness + RoofingContractor Schema
 */
function golem_roofing_schema_markup() {
    if (!is_front_page() && !is_home()) {
        return;
    }
    
    $schema = [
        "@context" => "https://schema.org",
        "@type" => ["LocalBusiness", "RoofingContractor"],
        "name" => "Golem Roofing",
        "alternateName" => "Golem Roofing & Solar",
        "description" => "Professional roofing and solar installation services in Los Angeles and Orange County, California. Expert roof installation, repair, replacement, and maintenance with 15-year workmanship warranty.",
        "url" => "https://golemroofing.com",
        "telephone" => "+1-562-991-8165",
        "email" => "Golemroofing@gmail.com",
        "logo" => [
            "@type" => "ImageObject",
            "url" => "https://golemroofing.com/wp-content/uploads/2025/08/7bf0ac983262c3171f71cc5a0495567e.png",
            "width" => 798,
            "height" => 392
        ],
        "image" => "https://golemroofing.com/wp-content/uploads/2025/08/d45507ae-55b3-4144-b589-eac3cd6e0a67.png",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "Long Beach",
            "addressLocality" => "Long Beach",
            "addressRegion" => "CA",
            "postalCode" => "90802",
            "addressCountry" => "US"
        ],
        "geo" => [
            "@type" => "GeoCoordinates",
            "latitude" => 33.786671,
            "longitude" => -118.182354
        ],
        "areaServed" => [
            ["@type" => "City", "name" => "Los Angeles"],
            ["@type" => "City", "name" => "Long Beach"],
            ["@type" => "AdministrativeArea", "name" => "Orange County"],
            ["@type" => "City", "name" => "Anaheim"],
            ["@type" => "City", "name" => "Irvine"],
            ["@type" => "City", "name" => "Santa Ana"],
            ["@type" => "City", "name" => "Huntington Beach"],
            ["@type" => "City", "name" => "Torrance"]
        ],
        "priceRange" => "$$$",
        "currenciesAccepted" => "USD",
        "paymentAccepted" => "Cash, Credit Card, Financing Available",
        "openingHoursSpecification" => [
            [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                "opens" => "07:00",
                "closes" => "19:00"
            ],
            [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => "Saturday",
                "opens" => "08:00",
                "closes" => "17:00"
            ]
        ],
        "sameAs" => [
            "https://www.instagram.com/golemroofing/",
            "https://www.facebook.com/profile.php?id=61574735318556",
            "https://www.yelp.com/biz/andy-s-custom-solutions-long-beach"
        ],
        "hasOfferCatalog" => [
            "@type" => "OfferCatalog",
            "name" => "Roofing Services",
            "itemListElement" => [
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => "New Roof Installation",
                        "description" => "Complete new roof installation with premium materials."
                    ]
                ],
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => "Roof Repair & Maintenance",
                        "description" => "Fast, reliable fixes for leaks and damaged shingles."
                    ]
                ],
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => "Solar Panel Installation",
                        "description" => "Professional solar panel installation on roofs."
                    ]
                ],
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => "Gutter Installation",
                        "description" => "High-quality gutter installation services."
                    ]
                ]
            ]
        ],
        "aggregateRating" => [
            "@type" => "AggregateRating",
            "ratingValue" => "5.0",
            "bestRating" => "5",
            "worstRating" => "1",
            "ratingCount" => "47",
            "reviewCount" => "47"
        ],
        "slogan" => "Power You Can Trust",
        "foundingDate" => "2018"
    ];
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'golem_roofing_schema_markup', 1);

/**
 * FAQ Schema
 */
function golem_roofing_faq_schema() {
    if (!is_front_page() && !is_home()) {
        return;
    }
    
    $faq_schema = [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => [
            [
                "@type" => "Question",
                "name" => "How much does a new roof cost in Los Angeles?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "At Golem Roofing, new roof installations start from $9,900. The final price depends on roof size, material type, number of stories, and existing layers. We offer free estimates and flexible financing options starting at $149/month."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "What areas do you serve in California?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Golem Roofing serves the entire Los Angeles and Orange County areas, including Long Beach, Anaheim, Irvine, Santa Ana, Huntington Beach, Torrance, and surrounding communities."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Do you offer warranties on roofing work?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes! We provide comprehensive protection: 15-Year Workmanship Warranty, 20+ Year Manufacturer's Warranty, $25k Bond + $1M Liability Insurance, and $250k Third-Party Guarantee."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Do you offer financing for roof replacement?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes, we offer flexible financing options through Acorn Finance. Full roof replacements can be financed from as low as $149 per month. Easy approval process available."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Are you a licensed roofing contractor?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes, Golem Roofing is a fully licensed contractor with the California State License Board (CSLB). We carry $25k bond and $1M liability insurance for your protection."
                ]
            ]
        ]
    ];
    
    echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'golem_roofing_faq_schema', 2);

// ============= КОНЕЦ КОДА ДЛЯ SNIPPET =============
