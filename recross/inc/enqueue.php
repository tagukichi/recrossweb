<?php
/**
 * Asset enqueue.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function recross_enqueue_assets() {
    wp_enqueue_style(
        'recross-fonts',
        'https://fonts.googleapis.com/css2?family=M+PLUS+1:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'recross-style',
        RECROSS_THEME_URI . '/assets/css/style.css',
        array( 'recross-fonts' ),
        RECROSS_THEME_VERSION
    );

    wp_enqueue_script(
        'recross-script',
        RECROSS_THEME_URI . '/assets/js/main.js',
        array(),
        RECROSS_THEME_VERSION,
        true
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'recross_enqueue_assets' );

function recross_preconnect_fonts( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'recross_preconnect_fonts', 10, 2 );
