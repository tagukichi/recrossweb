<?php
/**
 * ACF field group definitions (PHP export style).
 *
 * Re-creates the legacy ACF fields the theme reads in templates:
 *   - TOPページ:  TOPスライダー / 広告用バナー
 *   - 会社情報:    company_title / company_sub_title / company_catch /
 *                  recross_company_info_rows / recross_access_rows /
 *                  recross_access_map_embed / recross_company_history
 *
 * Only registers if ACF (or ACF PRO) is active. If ACF is unavailable, the
 * template-functions.php helpers fall back to get_post_meta() reads or sane
 * defaults so the theme still renders.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function recross_register_acf_fields() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // === TOPページ =========================================================
    acf_add_local_field_group( array(
        'key'      => 'group_recross_front',
        'title'    => 'TOPページ',
        'fields'   => array(
            array(
                'key'        => 'field_recross_top_slider',
                'name'       => 'top_slider',
                'label'      => 'TOPスライダー',
                'type'       => 'repeater',
                'min'        => 0,
                'layout'     => 'block',
                'button_label' => 'スライドを追加',
                'sub_fields' => array(
                    array(
                        'key'           => 'field_recross_top_slider_imgpc',
                        'name'          => 'slider_imgpc',
                        'label'         => 'スライダー画像PC',
                        'type'          => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key'           => 'field_recross_top_slider_imgsp',
                        'name'          => 'slider_imgsp',
                        'label'         => 'スライダー画像SP',
                        'type'          => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key'   => 'field_recross_top_slider_link',
                        'name'  => 'slider_link',
                        'label' => 'スライダーリンク',
                        'type'  => 'url',
                    ),
                    array(
                        'key'           => 'field_recross_top_slider_target',
                        'name'          => 'target',
                        'label'         => '別タブで開く',
                        'type'          => 'true_false',
                        'ui'            => 1,
                        'default_value' => 0,
                    ),
                ),
            ),
            array(
                'key'           => 'field_recross_top_banner',
                'name'          => 'banner',
                'label'         => '広告用バナー',
                'type'          => 'image',
                'return_format' => 'array',
            ),
            array(
                'key'   => 'field_recross_top_bannerlink',
                'name'  => 'bannerlink',
                'label' => '広告用バナーリンク',
                'type'  => 'url',
            ),
        ),
        'location' => array(
            array(
                array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ),
            ),
        ),
        'position' => 'normal',
        'style'    => 'default',
    ) );

    // === 会社情報（company CPT 共通） ======================================
    acf_add_local_field_group( array(
        'key'      => 'group_recross_company',
        'title'    => '会社情報ページ',
        'fields'   => array(
            array(
                'key'   => 'field_recross_company_title',
                'name'  => 'company_title',
                'label' => 'ページタイトル（日本語）',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_recross_company_sub_title',
                'name'  => 'company_sub_title',
                'label' => 'サブタイトル（英字）',
                'type'  => 'text',
            ),
            array(
                'key'   => 'field_recross_company_catch',
                'name'  => 'company_catch',
                'label' => 'キャッチコピー',
                'type'  => 'textarea',
                'rows'  => 3,
                'new_lines' => 'br',
            ),
            array(
                'key'        => 'field_recross_company_info_rows',
                'name'       => 'recross_company_info_rows',
                'label'      => '会社概要テーブル',
                'type'       => 'repeater',
                'layout'     => 'table',
                'button_label' => '行を追加',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_recross_company_info_label',
                        'name'  => 'label',
                        'label' => '項目',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_recross_company_info_value',
                        'name'  => 'value',
                        'label' => '内容',
                        'type'  => 'textarea',
                        'rows'  => 3,
                        'new_lines' => 'br',
                    ),
                ),
            ),
            array(
                'key'        => 'field_recross_access_rows',
                'name'       => 'recross_access_rows',
                'label'      => 'アクセス情報テーブル',
                'type'       => 'repeater',
                'layout'     => 'table',
                'sub_fields' => array(
                    array( 'key' => 'field_recross_access_label', 'name' => 'label', 'label' => '項目', 'type' => 'text' ),
                    array( 'key' => 'field_recross_access_value', 'name' => 'value', 'label' => '内容', 'type' => 'textarea', 'rows' => 2, 'new_lines' => 'br' ),
                ),
            ),
            array(
                'key'   => 'field_recross_access_map_embed',
                'name'  => 'recross_access_map_embed',
                'label' => 'Google Maps 埋め込みコード',
                'type'  => 'textarea',
                'rows'  => 4,
            ),
            array(
                'key'        => 'field_recross_company_history',
                'name'       => 'recross_company_history',
                'label'      => '沿革',
                'type'       => 'repeater',
                'layout'     => 'block',
                'sub_fields' => array(
                    array( 'key' => 'field_recross_history_year',  'name' => 'year',  'label' => '年月', 'type' => 'text' ),
                    array( 'key' => 'field_recross_history_event', 'name' => 'event', 'label' => '出来事', 'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br' ),
                ),
            ),
        ),
        'location' => array(
            array(
                array( 'param' => 'post_type', 'operator' => '==', 'value' => 'company' ),
            ),
        ),
        'position' => 'normal',
        'style'    => 'default',
    ) );
}
add_action( 'acf/init', 'recross_register_acf_fields' );
