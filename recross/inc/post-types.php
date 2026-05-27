<?php
/**
 * Custom post type & taxonomy registration.
 *
 * Mirrors the structure of the legacy site so existing posts/permalinks keep
 * working after the theme switch:
 *   - service : 事業内容  (rewrite /service/{slug}/, archive /service/)
 *   - news    : 最新情報  (rewrite /news/{slug}/,    archive /news/)
 *   - company : 会社情報  (rewrite /company/{slug}/, archive /company/)
 *
 * In the legacy site these were created via the ACF "ACF Post Type" UI; we
 * re-declare them in code so the theme is self-sufficient even if ACF Post
 * Types aren't configured.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function recross_register_post_types() {

    register_post_type( 'service', array(
        'label'         => '事業内容',
        'labels'        => array(
            'name'          => '事業内容',
            'singular_name' => '事業内容',
            'add_new_item'  => '新規事業を追加',
            'edit_item'     => '事業を編集',
            'all_items'     => '事業一覧',
        ),
        'public'        => true,
        'show_in_rest'  => true,
        'has_archive'   => 'service',
        'rewrite'       => array( 'slug' => 'service', 'with_front' => false ),
        'menu_icon'     => 'dashicons-portfolio',
        'menu_position' => 20,
        'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields' ),
    ) );

    register_post_type( 'news', array(
        'label'         => '最新情報',
        'labels'        => array(
            'name'          => '最新情報',
            'singular_name' => '最新情報',
            'add_new_item'  => '新規お知らせを追加',
            'edit_item'     => 'お知らせを編集',
            'all_items'     => 'お知らせ一覧',
        ),
        'public'        => true,
        'show_in_rest'  => true,
        'has_archive'   => 'news',
        'rewrite'       => array( 'slug' => 'news', 'with_front' => false ),
        'menu_icon'     => 'dashicons-megaphone',
        'menu_position' => 21,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
    ) );

    register_post_type( 'company', array(
        'label'         => '会社情報',
        'labels'        => array(
            'name'          => '会社情報',
            'singular_name' => '会社情報',
            'add_new_item'  => '新規会社情報を追加',
            'edit_item'     => '会社情報を編集',
            'all_items'     => '会社情報一覧',
        ),
        'public'        => true,
        'show_in_rest'  => true,
        'has_archive'   => 'company',
        'rewrite'       => array( 'slug' => 'company', 'with_front' => false ),
        'menu_icon'     => 'dashicons-building',
        'menu_position' => 22,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields' ),
    ) );
}
add_action( 'init', 'recross_register_post_types' );
