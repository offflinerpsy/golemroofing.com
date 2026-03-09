# 🏠 Golem Roofing — Custom WordPress Code

[![Deploy to Production](https://github.com/offflinerpsy/golemroofing.com/actions/workflows/deploy.yml/badge.svg)](https://github.com/offflinerpsy/golemroofing.com/actions/workflows/deploy.yml)

**Professional Roofing Services in Los Angeles & Orange County**

> Custom WordPress plugins, SEO automation, and blog infrastructure for [golemroofing.com](https://golemroofing.com)

---

## 📁 Project Structure

```
golemroofing.com/
├── .github/workflows/          # CI/CD automation
│   └── deploy.yml              # Auto-deploy on push to main
├── wp-content/
│   └── mu-plugins/             # Must-Use plugins (auto-loaded by WP)
│       ├── golem-schema.php           # Schema.org structured data (LocalBusiness, FAQ)
│       ├── golem-swiper-gallery.php   # Swiper.js gallery + video Reel player v2.2
│       ├── golem-blog-fixes.php       # Blog thumbnails, author hiding, image fixes v5.0
│       ├── golem-blog-styles.php      # Blog post content styling v2.0
│       └── auto-alt-tags.php          # SEO image ALT generator
├── snippets/                   # Code Snippets (stored in DB, backup copy here)
│   └── elementor-telegram.php  # Elementor Forms → Telegram notifications
├── robots.txt                  # Search engine directives + sitemap
└── README.md
```

---

## 🔌 Custom Plugins (mu-plugins)

### `golem-swiper-gallery.php` — v2.2.0
Instagram-style image gallery & video Reel player:
- **Swiper.js v11** CDN-based carousel with touch, keyboard, autoplay
- **Video Reel mode**: `[golem_gallery video="url" images="poster"]` renders playable mp4
- Single-image handling (no arrows/pagination for 1 image)
- Instagram-style navigation (circular buttons, dot pagination, dynamic bullets)
- Play overlay with blur backdrop, Reel badge
- Responsive: mobile touch targets, hidden arrows on small screens
- WebP upload support

### `golem-blog-fixes.php` — v5.0
Blog listing & thumbnail display fixes:
- **Author hiding** across all theme locations (CSS + filters)
- **Thumbnail injection**: fills empty `aux-media-frame` with featured images
- **Portrait aspect ratio** (4:5) for blog listing cards
- Replaces cropped URLs with originals (instagram/ and uploads/ folders)
- Strips srcset to force original portrait images
- Disables Phlox lazy-loading for reliable thumbnail display

### `golem-blog-styles.php` — v2.0
Professional blog post content styling:
- `.instagram-post` wrapper with Roboto font, 800px max-width
- Lead paragraphs, section headings (H2/H3) with blue accent
- Material cards, pros/cons grids, stats rows
- CTA boxes with site-matching button style
- Tips boxes, best-for badges
- Full responsive breakpoints

### `golem-schema.php`
Schema.org structured data (JSON-LD):
- **LocalBusiness + RoofingContractor** with NAP, geo, hours, services
- **OfferCatalog**: roof installation, repair, solar, gutters
- **AggregateRating**: 5.0 / 47 reviews
- **FAQPage**: 5 common questions with answers
- **areaServed**: LA, Long Beach, Orange County, Anaheim, Irvine, Santa Ana, Huntington Beach, Torrance

### `auto-alt-tags.php`
Automatic ALT text for images:
- Generates ALT from filename/title, cleans up dimensions and dashes
- Adds "Golem Roofing" branding suffix
- Batch processing (50 images/day on admin load)
- Auto-hooks new uploads

### `elementor-telegram.php` (Code Snippet #5)
Elementor form submissions → Telegram:
- Sends to 2 recipients: Андрей (705412224) + Dmitry (576534060)
- Stored in DB via Code Snippets plugin (backup copy in `/snippets/`)

---

## 📦 Server Assets (not in git)

| Asset | Path | Details |
|-------|------|---------|
| **Video Reels** (15 mp4) | `/wp-content/uploads/videos/` | ~82 MB total, self-hosted |
| **Gallery images** (226 WebP) | `/wp-content/uploads/gallery/` | Hi-res originals |
| **Instagram images** | `/wp-content/uploads/instagram/` | Imported from IG |
| **Blog posts** | WordPress DB | 56 published posts |

---

## 🌐 Production

| Property | Value |
|----------|-------|
| **URL** | https://golemroofing.com |
| **Server** | 5.78.65.51 (Hetzner) |
| **Panel** | HestiaCP |
| **WordPress** | 6.9 |
| **Theme** | Phlox Pro 5.17.6 |
| **Builder** | Elementor Pro 3.24.4 |
| **SSH** | `root@5.78.65.51` |
| **WP Path** | `/home/admin/web/golemroofing.com/public_html/` |
| **Deploy** | GitHub Actions → SSH rsync on push to `main` |

---

## 📝 Changelog

### 2026-03-09
- 🔄 Sync verification: server, GitHub, and local repo confirmed identical
- 📝 README updated with full project documentation

### 2026-02-17
- 🎬 Video Reel support: 15 Instagram Reels now play in blog posts (self-hosted mp4)
- 🔌 golem-swiper-gallery.php upgraded to v2.2.0 (video mode, play overlay, Reel badge)
- 📝 Created post #1281 "Real Roof Protection — Warranties, Insurance, and Bond Guarantee"
- 🖼️ ffmpeg frame extraction for video cover images
- 🐛 Fixed missing thumbnail on blog listing for post #1281

### 2026-02-12
- 🖼️ Hi-res gallery images: 226 WebP originals uploaded to `/uploads/gallery/`
- 🔄 Swiper.js v11 carousel with Instagram-style navigation
- 📱 Responsive blog listing with portrait 4:5 thumbnails
- ✍️ Blog content styling v2.0 (material cards, pros/cons, CTA blocks)
- 👤 Author display hidden across all theme locations

### 2026-02-02
- ✅ Telegram: added second recipient (576534060, Dmitry)
- ✅ Elementor form submission debugging and fix
- ✅ Code Snippets documentation in repository

### 2026-01-31
- 🔧 Fixed critical WP Telegram error (JSON format in DB)

### 2026-01-30
- ✅ Initial repository setup
- ✅ Schema.org markup (LocalBusiness, RoofingContractor, FAQ)
- ✅ Auto ALT tag generator for images
- ✅ SEO robots.txt configuration
- ✅ GitHub Actions auto-deploy pipeline

---

## 📄 License

Private repository. All rights reserved.

---

<p align="center">
  <strong>Golem Roofing</strong><br>
  Los Angeles & Orange County<br>
  ☎️ (714) 869-7246
</p>
