<?php
declare(strict_types=1);

$base = getenv('GOLEM_MONITOR_BASE_URL') ?: 'https://golemroofing.com';
$statusFile = getenv('GOLEM_MONITOR_STATUS_FILE') ?: '';
$pages = ['/', '/roof-installation/', '/about/'];
$canonical = [
    'street' => '1821 E 5th St Unit #1',
    'phone_schema' => '+1-562-991-8165',
    'phone_visible' => '(562) 991-8165',
];
$staleFacts = [
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
    '12 Years Experience',
    '12 Years of Roofing Experience',
    'over 12 years',
];

function fetch_url(string $url): array {
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 20,
            'ignore_errors' => true,
            'header' => "User-Agent: GolemSiteMonitor/1.0\r\nAccept: text/html,*/*;q=0.8\r\n",
        ],
        'ssl' => [
            'verify_peer' => true,
            'verify_peer_name' => true,
        ],
    ]);

    $body = @file_get_contents($url, false, $context);
    $headers = $http_response_header ?? [];
    $status = 0;
    foreach ($headers as $header) {
        if (preg_match('/^HTTP\/\S+\s+(\d+)/', $header, $match)) {
            $status = (int) $match[1];
        }
    }

    return [
        'url' => $url,
        'status' => $status,
        'body' => is_string($body) ? $body : '',
        'error' => is_string($body) ? null : 'fetch_failed',
    ];
}

function absolute_url(string $base, string $href): string {
    if (preg_match('/^https?:\/\//i', $href)) {
        return $href;
    }
    if (str_starts_with($href, '//')) {
        return 'https:' . $href;
    }
    return rtrim($base, '/') . '/' . ltrim($href, '/');
}

$checks = [];
$failures = [];

foreach ($pages as $path) {
    $url = rtrim($base, '/') . $path;
    $result = fetch_url($url);
    $pageFailures = [];

    if ($result['status'] < 200 || $result['status'] >= 400) {
        $pageFailures[] = 'http_status_' . $result['status'];
    }
    if (strlen($result['body']) < 2000) {
        $pageFailures[] = 'body_too_short';
    }

    foreach ($staleFacts as $fact) {
        if (stripos($result['body'], $fact) !== false) {
            $pageFailures[] = 'stale_fact:' . $fact;
        }
    }

    if ($path === '/') {
        if (strpos($result['body'], $canonical['street']) === false) {
            $pageFailures[] = 'missing_canonical_street';
        }
        if (strpos($result['body'], $canonical['phone_schema']) === false && strpos($result['body'], $canonical['phone_visible']) === false) {
            $pageFailures[] = 'missing_canonical_phone';
        }
    }

    preg_match_all('/<link[^>]+href=["\']([^"\']+\/wp-content\/uploads\/elementor\/css\/post-\d+\.css[^"\']*)["\']/i', $result['body'], $matches);
    $cssUrls = array_values(array_unique(array_map(fn($href) => absolute_url($base, html_entity_decode($href)), $matches[1] ?? [])));
    if (!$cssUrls) {
        $pageFailures[] = 'missing_elementor_generated_css_links';
    }
    $cssStatuses = [];
    foreach ($cssUrls as $cssUrl) {
        $css = fetch_url($cssUrl);
        $cssStatuses[] = ['url' => $cssUrl, 'status' => $css['status'], 'bytes' => strlen($css['body'])];
        if ($css['status'] < 200 || $css['status'] >= 400 || strlen($css['body']) < 50) {
            $pageFailures[] = 'bad_elementor_css:' . $cssUrl . ':' . $css['status'];
        }
    }

    $checks[] = [
        'path' => $path,
        'status' => $result['status'],
        'bytes' => strlen($result['body']),
        'elementor_css_count' => count($cssUrls),
        'elementor_css' => $cssStatuses,
        'failures' => $pageFailures,
    ];
    foreach ($pageFailures as $failure) {
        $failures[] = $path . ' ' . $failure;
    }
}

$report = [
    'ok' => count($failures) === 0,
    'checked_at' => gmdate('c'),
    'base_url' => $base,
    'failures' => $failures,
    'checks' => $checks,
];

$json = json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
if ($statusFile !== '') {
    @file_put_contents($statusFile, $json . PHP_EOL);
}

echo $json . PHP_EOL;
exit($report['ok'] ? 0 : 1);
