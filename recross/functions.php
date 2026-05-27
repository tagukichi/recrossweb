<?php
/**
 * recross theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'RECROSS_THEME_VERSION', '1.0' );
define( 'RECROSS_THEME_DIR', get_template_directory() );
define( 'RECROSS_THEME_URI', get_template_directory_uri() );

function recross_setup() {
    load_theme_textdomain( 'recross', RECROSS_THEME_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( array(
        'primary'       => __( 'グローバルナビ（PC/SP共用）', 'recross' ),
        'service'       => __( '事業内容サブメニュー', 'recross' ),
        'company'       => __( '会社情報サブメニュー', 'recross' ),
        'footer'        => __( 'フッターメニュー', 'recross' ),
        'footer_legal'  => __( 'フッター下部（プライバシー等）', 'recross' ),
    ) );
}
add_action( 'after_setup_theme', 'recross_setup' );

require_once RECROSS_THEME_DIR . '/inc/enqueue.php';
require_once RECROSS_THEME_DIR . '/inc/menus.php';
require_once RECROSS_THEME_DIR . '/inc/post-types.php';
require_once RECROSS_THEME_DIR . '/inc/acf-fields.php';
require_once RECROSS_THEME_DIR . '/inc/template-functions.php';
require_once RECROSS_THEME_DIR . '/inc/block-styles.php';
require_once RECROSS_THEME_DIR . '/inc/block-patterns.php';
require_once RECROSS_THEME_DIR . '/inc/editor.php';
require_once RECROSS_THEME_DIR . '/inc/classic-editor.php';
require_once RECROSS_THEME_DIR . '/inc/shortcodes.php';
