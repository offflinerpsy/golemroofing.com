<?php
/**
 * Code Snippet #5: Elementor Forms → Telegram
 * 
 * Отправляет данные форм Elementor в Telegram нескольким получателям.
 * 
 * ВАЖНО: Этот код хранится в БД (таблица wp_snippets), НЕ в файлах!
 * Плагин: Code Snippets (https://wordpress.org/plugins/code-snippets/)
 * 
 * Как восстановить/обновить:
 * 1. WP Admin → Snippets → найти сниппет без имени (id=5)
 * 2. Или через WP-CLI: wp db query "UPDATE wp_snippets SET code='...' WHERE id=5"
 * 
 * История изменений:
 * - 2026-02-02: Добавлен второй получатель (576534060, Dmitry)
 * - 2026-01-XX: Создан, один получатель (705412224, Андрей)
 * 
 * @package GolemRoofing
 */

// Elementor → Telegram: отправка формы ДВУМ получателям
add_action( 'elementor_pro/forms/new_record', function( $record ) {
    // === НАСТРОЙКИ ===
    $token = '8236749569:AAG8lRtQXDHGHv0HzXgdRSnQ4FARAg0IejA';
    
    // Массив получателей (добавляй новых сюда)
    $chat_ids = [
        '705412224',  // Андрей (@andrei_markovets)
        '576534060',  // Dmitry
    ];

    $raw   = $record->get('fields');
    $lines = ["🚀 Новая заявка с сайта golemroofing.com"];
    foreach ( $raw as $id => $field ) {
        $label = isset($field['title']) ? $field['title'] : $id;
        $value = is_array($field['value']) ? implode(', ', $field['value']) : $field['value'];
        if (!empty($value)) {
            $lines[] = "📌 {$label}: {$value}";
        }
    }
    $text = implode("\n", $lines);
    $text .= "\n\n🕐 " . date('d.m.Y H:i');

    // Отправка ВСЕМ получателям
    foreach ( $chat_ids as $chat_id ) {
        $resp = wp_remote_post( "https://api.telegram.org/bot{$token}/sendMessage", [
            'timeout' => 10,
            'body'    => [
                'chat_id'                  => $chat_id,
                'text'                     => $text,
                'parse_mode'               => 'HTML',
                'disable_web_page_preview' => true,
            ],
        ] );

        if ( is_wp_error( $resp ) ) {
            error_log( "TG send to {$chat_id} failed: " . $resp->get_error_message() );
        }
    }
}, 10 );
