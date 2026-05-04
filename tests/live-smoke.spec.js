const { test, expect } = require('@playwright/test');

const CANONICAL = {
  street: '1821 E 5th St Unit #1',
  city: 'Long Beach',
  region: 'CA',
  postalCode: '90802',
  phoneSchema: '+1-562-991-8165',
  phoneVisible: '(562) 991-8165',
  phoneDigits: '5629918165',
};

const PAGES = [
  { path: '/', name: 'home' },
  { path: '/roof-installation/', name: 'roof installation' },
  { path: '/about/', name: 'about' },
];

const STALE_FACTS = [
  '4126 E Ransom',
  'E Ransom St',
  'E 4th St',
  'Long Beach, CA 90814',
  '(310) 291-1350',
  '310-291-1350',
  '+1-310-291-1350',
  '192 reviews',
  '192 Reviews',
  '200+ Reviews',
  '200+ reviews',
  '200+Five-Star',
  '12 Years Experience',
  '12 Years of Roofing Experience',
  'over 12 years',
];

async function openAndCheck(page, path) {
  const elementorCss = [];
  page.on('response', response => {
    if (/\/wp-content\/uploads\/elementor\/css\/post-\d+\.css/.test(response.url())) {
      elementorCss.push({ url: response.url(), status: response.status() });
    }
  });

  const response = await page.goto(path, { waitUntil: 'networkidle' });
  expect(response, `${path} has response`).not.toBeNull();
  expect(response.status(), `${path} HTTP status`).toBeLessThan(400);

  const cssLinks = await page.locator('link[href*="/wp-content/uploads/elementor/css/post-"]').evaluateAll(links =>
    links.map(link => ({ href: link.href, hasSheet: Boolean(link.sheet) }))
  );
  expect(cssLinks.length, `${path} has Elementor generated CSS links`).toBeGreaterThan(0);
  expect(elementorCss.filter(item => item.status >= 400), `${path} Elementor CSS 404/500`).toEqual([]);
  expect(cssLinks.filter(item => !item.hasSheet), `${path} Elementor CSS attached`).toEqual([]);

  const text = await page.locator('body').innerText();
  for (const stale of STALE_FACTS) {
    expect(text.includes(stale), `${path} stale visible fact: ${stale}`).toBe(false);
  }

  const overflowX = await page.evaluate(() => (
    Math.max(document.documentElement.scrollWidth, document.body.scrollWidth) -
    document.documentElement.clientWidth
  ));
  expect(overflowX, `${path} horizontal overflow`).toBeLessThanOrEqual(2);

  return text;
}

test.describe('live site smoke', () => {
  for (const item of PAGES) {
    test(`${item.name}: status, generated CSS, stale NAP facts`, async ({ page }) => {
      const text = await openAndCheck(page, item.path);
      expect(text.replace(/\D/g, ''), `${item.path} visible phone digits`).toContain(CANONICAL.phoneDigits);
    });
  }

  test('home: schema NAP and trust row are consistent', async ({ page }) => {
    await openAndCheck(page, '/');

    const schemaText = await page.locator('script[type="application/ld+json"]').evaluateAll(nodes =>
      nodes.map(node => node.textContent || '').join('\n')
    );
    expect(schemaText).toContain(CANONICAL.street);
    expect(schemaText).toContain(CANONICAL.city);
    expect(schemaText).toContain(CANONICAL.region);
    expect(schemaText).toContain(CANONICAL.postalCode);
    expect(schemaText).toContain(CANONICAL.phoneSchema);
    expect(schemaText).toMatch(/"reviewCount"\s*:\s*"200"/);
    expect(schemaText).toMatch(/"ratingCount"\s*:\s*"200"/);

    const trust = page.locator('.home .elementor-element-641fd80');
    await expect(trust).toContainText('200 Reviews');
    await expect(trust).not.toContainText('BBB');
    await expect(trust).not.toContainText('Experience');
    await expect(page.locator('.golem-home-trust-card')).toHaveCount(0);
  });

  test('home: visual sanity prevents unstyled giant-logo regression', async ({ page }, testInfo) => {
    await openAndCheck(page, '/');

    const topImages = await page.locator('img').evaluateAll(images =>
      images
        .map(img => {
          const rect = img.getBoundingClientRect();
          return { width: rect.width, height: rect.height, top: rect.top, left: rect.left };
        })
        .filter(rect => rect.top < 180 && rect.width > 20 && rect.height > 20)
    );
    expect(topImages.length, 'top branding images exist').toBeGreaterThan(0);
    const widestTopImage = Math.max(...topImages.map(rect => rect.width));
    expect(widestTopImage, 'top logo/image is not unstyled giant').toBeLessThan(420);

    const screenshot = await page.screenshot({ fullPage: false });
    await testInfo.attach('home-viewport', { body: screenshot, contentType: 'image/png' });
  });
});
