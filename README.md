# 🏠 Golem Roofing - Custom WordPress Code

[![Deploy to Production](https://github.com/offflinerpsy/golemroofing.com/actions/workflows/deploy.yml/badge.svg)](https://github.com/offflinerpsy/golemroofing.com/actions/workflows/deploy.yml)

**Professional Roofing Services in Los Angeles & Orange County**

> Custom WordPress plugins and configurations for [golemroofing.com](https://golemroofing.com)

---

## 📁 Project Structure

```
golemroofing.com/
├── .github/workflows/     # CI/CD automation
│   └── deploy.yml         # Auto-deploy on push
├── wp-content/
│   └── mu-plugins/        # Must-Use plugins (auto-loaded)
│       ├── golem-schema.php      # Schema.org markup
│       └── auto-alt-tags.php     # SEO image ALT generator
├── snippets/              # Code Snippets (stored in DB, backup here)
│   └── elementor-telegram.php    # Elementor Forms → Telegram
├── robots.txt             # Search engine directives
└── README.md
```

---

## 🔌 Custom Plugins

### `golem-schema.php`
Structured data markup for SEO:
- **LocalBusiness** schema with NAP (Name, Address, Phone)
- **RoofingContractor** service schema
- **FAQ** schema for common questions
- Automatic JSON-LD injection in `<head>`

### `auto-alt-tags.php`
Automatic ALT text generation for images:
- Generates descriptive ALT from filename/title
- Cleans up generic names (removes dimensions, dashes)
- Adds "Golem Roofing" branding suffix
- Batch processing on admin load (50 images/run)
- Hooks new uploads automatically

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

---

## 📝 Changelog

### 2026-02-02
- ✅ Telegram интеграция: добавлен второй получатель форм (576534060, Dmitry)
- ✅ Диагностика и исправление отправки форм Elementor
- ✅ Документация Code Snippets в репозитории

### 2026-01-31
- 🔧 Исправлена критическая ошибка WP Telegram (формат JSON в БД)

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
