# golemroofing.com — Performance & GEO Optimization Plan

**Date:** 2026-03-09
**Status:** In Progress

## Audit Summary

| Metric | Current | Target |
|--------|---------|--------|
| Non-WebP images | 1,493 files (1.8 GB) | 0 (all WebP) |
| Gallery serving | JPEG (634 MB) | WebP (215 MB) — already on server |
| Bad alt tags | 315 / 397 (79%) | 0 — all descriptive |
| Gallery img alt | "Golem Roofing project" (same for all) | Unique per post |
| Cache plugin | None | WP Super Cache |
| TTFB | 0.79s | < 0.3s |
| LCP preload | None | Hero image preloaded |
| ImageObject Schema | None | On all blog posts |

---

## Step 1 — Gallery WebP Switch
**File:** `wp-content/mu-plugins/golem-swiper-gallery.php`
**Risk:** Low (WebP files already exist on server)
**Change:** Modify `golem_gallery_v2_shortcode()` to serve `.webp` instead of `.jpeg` for gallery images, with fallback
**Verify:** Open city page → gallery images load, no broken images

## Step 2 — Gallery Alt Tags (Descriptive)
**File:** `wp-content/mu-plugins/golem-swiper-gallery.php`
**Change:** Replace hardcoded `alt="Golem Roofing project"` with dynamic alt based on post title + slide number
**Verify:** View source of blog post → each gallery img has unique descriptive alt

## Step 3 — Convert Remaining PNG/JPG → WebP on Server
**Server script** (not in repo — one-time operation)
**Change:** Use `cwebp` to convert all non-WebP images in uploads/, update WP attachment URLs in DB
**Verify:** Homepage images load as WebP, no 404s

## Step 4 — Fix WP Media Library Alt Tags
**File:** `wp-content/mu-plugins/auto-alt-tags.php` (rewrite)
**Change:** Replace filename-based alt generation with contextual alt based on post association, known image categories
**Verify:** Check homepage alt tags — no more hash-based garbage alts

## Step 5 — Install WP Super Cache
**Plugin install via WP-CLI**
**Change:** `wp plugin install wp-super-cache --activate`
**Verify:** TTFB drops below 0.3s on cached pages

## Step 6 — LCP Preload
**File:** `wp-content/mu-plugins/golem-blog-seo.php` (update)
**Change:** Add `<link rel="preload" as="image">` for hero/LCP image on each page type
**Verify:** Lighthouse shows no "Preload LCP image" warning

## Step 7 — ImageObject Schema
**File:** `wp-content/mu-plugins/golem-blog-seo.php` (update)
**Change:** Add `ImageObject` Schema.org markup for featured images and gallery images
**Verify:** Rich Results Test shows ImageObject in structured data

## Step 8 — Git Commit All Changes
**Commit all modified mu-plugins and plan to GitHub**
