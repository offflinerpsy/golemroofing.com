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

## 🚀 Deployment

### Automatic (GitHub Actions)
Every push to `main` triggers automatic deployment:
1. Files sync to production server via rsync over SSH
2. WordPress cache cleared automatically
3. Deployment status shown in Actions tab

### Manual
```bash
# SSH to server
ssh root@5.78.65.51

# Navigate to WordPress
cd /home/admin/web/golemroofing.com/public_html

# Pull changes (if git initialized on server)
git pull origin main
```

---

## 🔧 Development

### Local Setup
```bash
# Clone repository
git clone git@github.com:offflinerpsy/golemroofing.com.git
cd golemroofing.com

# Make changes to mu-plugins
code wp-content/mu-plugins/

# Commit and push (auto-deploys)
git add .
git commit -m "feat: add new feature"
git push origin main
```

### File Locations on Server
| Local Path | Server Path |
|------------|-------------|
| `wp-content/mu-plugins/` | `/home/admin/web/golemroofing.com/public_html/wp-content/mu-plugins/` |
| `robots.txt` | `/home/admin/web/golemroofing.com/public_html/robots.txt` |

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
