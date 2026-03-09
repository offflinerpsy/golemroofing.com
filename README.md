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
│       ├── golem-geo-engine.php       # 🆕 GEO engine: llms.txt, Schema.org, robots.txt AI rules
│       ├── golem-schema.php           # Schema.org (LEGACY — hooks деактивированы geo-engine)
│       ├── golem-blog-seo.php          # Blog SEO: Article Schema, FAQ, BreadcrumbList, LCP preload
│       ├── golem-swiper-gallery.php   # Swiper.js gallery + video Reel player v2.3
│       ├── golem-blog-fixes.php       # Blog thumbnails, author/date hiding, image fixes v5.1
│       ├── golem-blog-styles.php      # Blog post content styling v2.0
│       └── auto-alt-tags.php          # SEO image ALT generator v2.0
├── snippets/                   # Code Snippets (stored in DB, backup copy here)
│   └── elementor-telegram.php  # Elementor Forms → Telegram notifications
├── robots.txt                  # Search engine directives + AI crawler rules
└── README.md
```

---

## 🔌 Custom Plugins (mu-plugins)

### `golem-swiper-gallery.php` — v2.3.0
Instagram-style image gallery & video Reel player:
- **Swiper.js v11** CDN-based carousel with touch, keyboard, autoplay
- **Video Reel mode**: `[golem_gallery video="url" images="poster"]` renders playable mp4
- **WebP auto-serving**: `golem_gallery_webp_url()` serves .webp versions when available
- **Dynamic alt tags**: "Post Title — photo N of M" format for SEO
- Single-image handling (no arrows/pagination for 1 image)
- Instagram-style navigation (circular buttons, dot pagination, dynamic bullets)
- Play overlay with blur backdrop, Reel badge
- Responsive: mobile touch targets, hidden arrows on small screens

### `golem-blog-fixes.php` — v5.1
Blog listing & thumbnail display fixes:
- **Author hiding** across all theme locations (CSS + filters)
- **Date & category hiding** from frontend (`.entry-date`, Elementor date widgets, "Uncategorized")
- Dates preserved in HTML `<time>` tags and Schema.org for SEO crawlers
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

### `golem-blog-seo.php` — v2.0 🆕
Blog post SEO automation:
- **Article Schema** with author, datePublished, dateModified, ImageObject
- **FAQ Schema** auto-generated from post content FAQ sections
- **BreadcrumbList** on all blog posts
- **LCP preload** — featured image preloaded via `<link rel="preload">`
- **ImageObject Schema** for featured images
- **Cross-links** — related posts section for internal linking

### `golem-geo-engine.php` — v1.0.0
GEO (Generative Engine Optimization) — оптимизация сайта для AI-поисковиков:

**llms.txt — файлы для AI-краулеров:**
- `/llms.txt` — краткая версия (~50 строк): компания, услуги, города, контакты
- `/llms-full.txt` — полная версия (~200 строк): описания услуг, районы, FAQ
- AI-боты (ChatGPT, Perplexity, Claude) проверяют этот файл как первый источник информации

**Schema.org — расширенная разметка:**
- **Главная:** RoofingContractor + 8 городов с GPS-координатами + 15 услуг + 12 FAQ
- **Блог-посты:** Article schema (author, datePublished, dateModified) — автоматически на все 56+ постов
- **Городские страницы:** LocalBusiness + город-специфичные GeoCoordinates (активируется по slug)
- **Сервисные страницы:** Service schema + areaServed (активируется по slug)
- **Все страницы:** BreadcrumbList (хлебные крошки)
- Автоматически деактивирует старые hooks из golem-schema.php

**robots.txt — правила для AI-ботов:**
- WordPress filter добавляет Allow для GPTBot, ClaudeBot, PerplexityBot, Google-Extended, ChatGPT-User, Applebot
- (Основной robots.txt — статический файл, фильтр работает как fallback)

**Конфигурация сервисных зон (8 городов):**
- Seal Beach (90740), Long Beach (90803/90808/90807), Los Alamitos/Rossmoor (90720)
- Manhattan Beach (90266), Hermosa Beach (90254), Redondo Beach (90277/90278)
- Palos Verdes Estates/Rolling Hills Estates (90274), Rancho Palos Verdes (90275)

**Целевые услуги (15):**
- Installation: Roof / Flat / Tile / Shingle
- Replacement: Roof / Flat / Tile / Shingle / Clay Tile / Concrete Tile
- Repair: Roof / Flat / Tile / Shingle
- Special: Silicone Roof Restoration

### `golem-schema.php` ⚠️ LEGACY
Schema.org structured data (JSON-LD) — **hooks деактивированы golem-geo-engine.php:**
- Файл остаётся как backup, но его функции `golem_roofing_schema_markup` и `golem_roofing_faq_schema` отключены
- Вся Schema теперь генерируется через golem-geo-engine.php

### `auto-alt-tags.php` — v2.0
Contextual ALT text for images:
- Generates ALT from **parent post title** (e.g., "Roof Replacement in Carson — photo")
- Falls back to readable filename → generic branding
- Adds "— Golem Roofing" suffix for consistency
- Auto-hooks new uploads via `add_attachment` action

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

## 📊 Performance Metrics (March 2026)

| Metric | Before | After |
|--------|--------|-------|
| **TTFB** | 0.79s | 0.032s |
| **WebP images** | 0 | 3,811 |
| **Image alt tags** | 21% contextual | 100% contextual |
| **Schema blocks** | 1 per page | 3-6 per page |
| **LCP preload** | No | Yes |
| **Cache** | None | WP Super Cache |

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

### 2026-03-09 (Performance & SEO Update)
- ⚡ **Performance Optimization**:
  - All images converted to WebP (3,811 WebP files)
  - WP Super Cache installed — TTFB: 0.79s → 0.032s (25x improvement)
  - LCP preload on blog posts and homepage
  - ImageObject Schema in structured data
- 🔍 **Blog SEO** — golem-blog-seo.php v2.0:
  - Article Schema, FAQ Schema, BreadcrumbList on all 56 blog posts
  - Cross-links for internal linking
  - LCP preload for featured images
- 🖼️ **Image SEO** — auto-alt-tags.php v2.0:
  - All 397 images now have contextual alt tags based on parent post title
  - Gallery images: "Post Title — photo N of M" format
- 📅 **Date/Category Hiding** — golem-blog-fixes.php v5.1:
  - Dates and "Uncategorized" hidden from frontend via CSS
  - Dates preserved in HTML/Schema for SEO crawlers
- 🖼️ **Gallery** — golem-swiper-gallery.php v2.3:
  - WebP auto-serving via `golem_gallery_webp_url()`
  - Dynamic contextual alt tags
- � **GEO Engine v1.0** — golem-geo-engine.php:
  - `/llms.txt` и `/llms-full.txt` — файлы для AI-краулеров (ChatGPT, Perplexity, Claude)
  - Schema.org расширена: 8 городов с GPS, 15 услуг, 12 FAQ, Article на всех постах, BreadcrumbList
  - robots.txt: убрана блокировка `/wp-json/`, добавлены Allow для GPTBot, ClaudeBot, PerplexityBot, Google-Extended, ChatGPT-User, Applebot
  - Старый golem-schema.php деактивирован автоматически
- �🔄 Sync verification: server, GitHub, and local repo confirmed identical
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
  ☎️ (562) 991-8165
</p>
