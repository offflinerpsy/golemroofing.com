# Deployment

## Safe Deploy Rule

Do not bulk-sync `wp-content/mu-plugins` with `rsync --delete`.

Production may contain fixes that are newer than the local snapshot. A destructive sync can remove live SEO/GEO coverage.

## GitHub Actions

Workflow:

`.github/workflows/deploy.yml`

Manual deploy scopes:

- `single-file` - deploy one file
- `changed-files` - deploy changed allowlisted files
- `mu-plugins` - deploy top-level mu-plugin PHP files without deleting server extras
- `robots` - deploy only `robots.txt`
- `all` - deploy mu-plugin PHP files and `robots.txt` without delete
- `rollback-file` - restore one file from a production backup

Allowlisted deploy paths:

- `wp-content/mu-plugins/*.php`
- `robots.txt`

Before deploy/rollback, the workflow backs up selected production files to:

`/home/admin/web/golemroofing.com/deploy-backups/<UTC_TIMESTAMP>-<GIT_SHA>/`

## Rollback

Run the workflow manually:

- `deploy_scope=rollback-file`
- `file_path=<target file>`
- `backup_stamp=<backup folder name>`

## Current SEO/GEO Caution

Do not deploy local `golem-geo-engine.php` or `golem-blog-seo.php` until local config is reconciled with production.

Known mismatch as of 2026-04-30:

- local GEO engine: 8 city areas, 15 services
- live production: 12 city areas, 17 service/resource links

