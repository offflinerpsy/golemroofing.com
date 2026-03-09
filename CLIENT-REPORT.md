# Golem Roofing — Отчёт о проделанной работе

**Сайт:** [golemroofing.com](https://golemroofing.com)  
**Период:** Январь — Март 2026  
**Цель:** GEO-оптимизация сайта + техническое SEO + производительность

---

## Что такое GEO и зачем это нужно

**GEO (Generative Engine Optimization)** — это новое направление в продвижении сайтов, которое дополняет классическое SEO.

Сегодня люди всё чаще ищут информацию не через Google, а через **AI-системы**: ChatGPT, Perplexity, Google AI Overview, Claude. Эти системы работают иначе — они не просто показывают ссылки, а **формируют готовые ответы** на основе данных с сайтов.

**Проблема:** Если сайт не подготовлен для AI-ботов, он просто не попадёт в их ответы — даже если он хорошо ранжируется в обычном Google.

**Что мы сделали:** Подготовили golemroofing.com так, чтобы AI-системы:
- Находили сайт и правильно понимали, чем занимается компания
- Знали все города обслуживания, услуги и контакты
- Рекомендовали Golem Roofing, когда кто-то спрашивает AI «roofing company near me» в Лос-Анджелесе

> **Итого:** GEO — это видимость в AI-поиске. SEO — это видимость в Google. Мы сделали и то, и другое.

---

## 1. GEO — Оптимизация для AI-поисковиков

### Файлы для AI-ботов
Созданы специальные файлы, которые AI-системы проверяют в первую очередь:
- **llms.txt** — краткая справка о компании (услуги, города, контакты)
- **llms-full.txt** — полная версия с подробным описанием каждой услуги и зоны обслуживания

### Доступ для AI-краулеров
Открыт доступ для всех основных AI-ботов:
- ✅ GPTBot (ChatGPT)
- ✅ ClaudeBot (Claude / Anthropic)
- ✅ PerplexityBot (Perplexity AI)
- ✅ Google-Extended (Google AI Overview / Gemini)
- ✅ ChatGPT-User
- ✅ Applebot (Apple Intelligence / Siri)

### 8 городских страниц с гео-привязкой
Каждая страница содержит структурированные данные (Schema.org) с GPS-координатами, списком районов и почтовыми индексами:

| Город | Ссылка |
|-------|--------|
| Seal Beach | [golemroofing.com/roofing-seal-beach-ca/](https://golemroofing.com/roofing-seal-beach-ca/) |
| Long Beach | [golemroofing.com/roofing-long-beach-ca/](https://golemroofing.com/roofing-long-beach-ca/) |
| Los Alamitos / Rossmoor | [golemroofing.com/roofing-los-alamitos-rossmoor-ca/](https://golemroofing.com/roofing-los-alamitos-rossmoor-ca/) |
| Manhattan Beach | [golemroofing.com/roofing-manhattan-beach-ca/](https://golemroofing.com/roofing-manhattan-beach-ca/) |
| Hermosa Beach | [golemroofing.com/roofing-hermosa-beach-ca/](https://golemroofing.com/roofing-hermosa-beach-ca/) |
| Redondo Beach | [golemroofing.com/roofing-redondo-beach-ca/](https://golemroofing.com/roofing-redondo-beach-ca/) |
| Palos Verdes Estates | [golemroofing.com/roofing-palos-verdes-ca/](https://golemroofing.com/roofing-palos-verdes-ca/) |
| Rancho Palos Verdes | [golemroofing.com/roofing-rancho-palos-verdes-ca/](https://golemroofing.com/roofing-rancho-palos-verdes-ca/) |

Каждая страница включает:
- Название компании + город + штат
- GPS-координаты (широта / долгота)
- Районы и микрорайоны (neighborhoods)
- Местные ориентиры (landmarks)
- Почтовые индексы (ZIP codes)
- Полный перечень из 15 услуг

---

## 2. SEO — Поисковая оптимизация

### Структурированные данные (Schema.org)
На каждой странице сайта добавлена расширенная разметка:
- **Главная страница:** RoofingContractor + 8 городов + 15 услуг + 12 FAQ
- **Блог (56 постов):** Article + FAQ + BreadcrumbList + ImageObject
- **Городские страницы:** LocalBusiness + GeoCoordinates

### Image SEO
- **3 811 изображений** конвертированы в формат WebP (меньше размер, быстрее загрузка)
- **397 изображений** получили контекстные alt-теги на основе заголовков статей (ранее 79% были с бессмысленными именами типа «IMG_0042»)

### Блог-оптимизация
- Article Schema на всех 56 постах
- FAQ Schema (вопросы-ответы) автоматически
- BreadcrumbList (навигационные цепочки)
- Перелинковка между статьями (cross-links)
- LCP Preload — приоритетная загрузка главного изображения поста

---

## 3. Оптимизация производительности

| Показатель | Было | Стало |
|------------|------|-------|
| **Время ответа сервера (TTFB)** | 0.79 сек | 0.032 сек |
| **Кэширование** | Нет | WP Super Cache |
| **Формат изображений** | JPEG / PNG | WebP |
| **Контекстные alt-теги** | 21% | 100% |
| **Schema-блоков на страницу** | 1 | 3-6 |
| **LCP Preload** | Нет | Да |

> Время ответа сервера сократилось в **25 раз** — с 0.79 до 0.032 секунды.

---

## 4. Дополнительные работы

- **Галерея изображений** — Instagram-стиль карусель с поддержкой видео-Reels
- **15 видео-Reels** интегрированы в блог-посты (self-hosted, без зависимости от Instagram)
- **Telegram-уведомления** — заявки с сайта приходят в Telegram двум получателям
- **CI/CD** — автоматический деплой через GitHub Actions (push в репозиторий → автодеплой на сервер)
- **Убраны даты и категории** из блога (визуально), сохранены в коде для SEO

---

## Покрытие услуг

Все 15 услуг зарегистрированы в Schema.org и llms.txt по каждому городу:

**Установка:** Roof Installation, Flat Roof, Tile Roof, Shingle Roof  
**Замена:** Roof Replacement, Flat Roof, Tile Roof, Shingle Roof, Clay Tile, Concrete Tile  
**Ремонт:** Roof Repair, Flat Roof, Tile Roof, Shingle Roof  
**Специальные:** Silicone Roof Restoration

---

## Итог

Сайт golemroofing.com полностью подготовлен для работы как в классическом поиске Google, так и в новых AI-поисковых системах. Каждый город обслуживания имеет отдельную страницу с гео-привязкой, а 56 блог-постов оптимизированы по структурированным данным. Скорость сайта увеличена в 25 раз.

---

*Отчёт подготовлен: Март 2026*
