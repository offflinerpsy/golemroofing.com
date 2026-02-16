<?php
/**
 * Plugin Name: Golem Blog Content Styles
 * Description: Professional blog post styling matching site design
 * Version: 2.0
 */

if (!defined('ABSPATH')) exit;

add_action('wp_head', 'golem_blog_content_styles');
function golem_blog_content_styles() {
    ?>
    <style id="golem-blog-styles">
    /* === Golem Blog Post Styles v2 — Site-Matching === */
    
    .instagram-post {
        max-width: 800px;
        margin: 0 auto;
        font-family: "Roboto", sans-serif;
        color: #1E1D23;
        line-height: 1.7;
    }
    
    /* Lead Paragraph */
    .instagram-post .golem-lead {
        font-size: 1.15rem;
        line-height: 1.7;
        color: #1E1D23;
        font-weight: 400;
        margin-bottom: 1.5rem;
        padding: 1.25rem;
        background: #f5f5f5;
        border-left: 4px solid #0D47A1;
        border-radius: 0 4px 4px 0;
    }
    
    /* Section Headings */
    .instagram-post h2 {
        font-family: "Yantramanav", "Roboto", sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E1D23;
        margin: 2rem 0 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #0D47A1;
    }
    
    .instagram-post h3 {
        font-family: "Yantramanav", "Roboto", sans-serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: #1E1D23;
        margin: 1.5rem 0 0.75rem;
    }
    
    /* Material Cards */
    .golem-material-card {
        background: #fff;
        border-radius: 8px;
        padding: 1.25rem;
        margin: 1.25rem 0;
        box-shadow: 0 2px 8px rgba(30, 29, 35, 0.08);
        border: 1px solid #e5e5e5;
    }
    
    .golem-material-card h4 {
        font-family: "Yantramanav", "Roboto", sans-serif;
        font-size: 1.15rem;
        font-weight: 600;
        color: #1E1D23;
        margin: 0 0 0.5rem;
    }
    
    .golem-material-card .material-subtitle {
        font-size: 0.9rem;
        color: rgba(30, 29, 35, 0.7);
        font-style: italic;
        margin-bottom: 1rem;
    }
    
    /* Pros & Cons Lists */
    .golem-pros-cons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin: 1rem 0;
    }
    
    @media (max-width: 600px) {
        .golem-pros-cons {
            grid-template-columns: 1fr;
        }
    }
    
    .golem-pros, .golem-cons {
        padding: 1rem;
        border-radius: 6px;
    }
    
    .golem-pros {
        background: rgba(13, 71, 161, 0.08);
        border-left: 3px solid #0D47A1;
    }
    
    .golem-cons {
        background: rgba(30, 29, 35, 0.05);
        border-left: 3px solid #1E1D23;
    }
    
    .golem-pros h5, .golem-cons h5 {
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0 0 0.5rem;
        color: #1E1D23;
    }
    
    .golem-pros ul, .golem-cons ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .golem-pros li, .golem-cons li {
        padding: 0.3rem 0;
        padding-left: 1.25rem;
        position: relative;
        font-size: 0.9rem;
        color: #1E1D23;
    }
    
    .golem-pros li::before {
        content: '+';
        position: absolute;
        left: 0;
        color: #0D47A1;
        font-weight: bold;
    }
    
    .golem-cons li::before {
        content: '–';
        position: absolute;
        left: 0;
        color: #1E1D23;
        font-weight: bold;
    }
    
    /* Stats Row */
    .golem-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin: 1rem 0;
        padding: 0.75rem;
        background: #f8f8f8;
        border-radius: 6px;
    }
    
    .golem-stat {
        flex: 1;
        min-width: 100px;
        text-align: center;
    }
    
    .golem-stat-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0D47A1;
    }
    
    .golem-stat-label {
        font-size: 0.8rem;
        color: rgba(30, 29, 35, 0.6);
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    /* Best For Badge */
    .golem-best-for {
        display: inline-block;
        background: rgba(13, 71, 161, 0.1);
        color: #0D47A1;
        padding: 0.4rem 0.8rem;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }
    
    /* CTA Box — matches site button style */
    .golem-cta {
        background: #1E1D23;
        color: #fff;
        padding: 1.5rem;
        border-radius: 8px;
        margin: 2rem 0;
        text-align: center;
    }
    
    .golem-cta h4 {
        font-family: "Yantramanav", "Roboto", sans-serif;
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0 0 0.75rem;
        color: #fff;
    }
    
    .golem-cta p {
        margin: 0 0 1rem;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.85);
    }
    
    /* Button — exact site style */
    .golem-cta-button {
        display: inline-block;
        background: #0D47A1;
        color: #fff;
        padding: 14px 32px;
        border-radius: 4px;
        font-family: "Roboto", sans-serif;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
        text-transform: capitalize;
        transition: all 0.3s ease;
        box-shadow: -5px 10px 50px 0px rgba(13, 71, 161, 0.3);
    }
    
    .golem-cta-button:hover {
        background: #fff;
        color: #1E1D23;
        box-shadow: -5px 10px 50px 0px rgba(30, 29, 35, 0.3);
    }
    
    /* Tips Box */
    .golem-tips {
        background: #f5f5f5;
        border-left: 3px solid #0D47A1;
        padding: 1rem;
        border-radius: 0 6px 6px 0;
        margin: 1.25rem 0;
    }
    
    .golem-tips h5 {
        color: #1E1D23;
        font-weight: 600;
        margin: 0 0 0.5rem;
        font-size: 0.95rem;
    }
    
    .golem-tips ul {
        margin: 0;
        padding-left: 1.1rem;
    }
    
    .golem-tips li {
        color: #1E1D23;
        padding: 0.2rem 0;
        font-size: 0.9rem;
    }
    
    /* Regular Paragraphs */
    .instagram-post p {
        line-height: 1.7;
        color: #1E1D23;
        margin-bottom: 1rem;
        font-size: 1rem;
    }
    
    .instagram-post strong {
        font-weight: 600;
        color: #1E1D23;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .instagram-post .golem-lead {
            font-size: 1rem;
            padding: 1rem;
        }
        
        .instagram-post h2 {
            font-size: 1.3rem;
        }
        
        .golem-material-card {
            padding: 1rem;
        }
        
        .golem-cta {
            padding: 1.25rem;
        }
        
        .golem-cta-button {
            padding: 12px 24px;
            font-size: 14px;
        }
    }
    </style>
    <?php
}
