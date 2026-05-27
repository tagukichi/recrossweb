<?php
/**
 * Register Gutenberg block style variations.
 *
 * Each variation surfaces as a one-click pick in the block sidebar
 * ("スタイル" panel), so ライターさん can choose a styled heading /
 * paragraph / image / list / group without writing any HTML or CSS.
 *
 * Frontend rules for these classes live in assets/css/style.css and
 * are mirrored 1:1 in assets/css/editor.css so the editor preview
 * matches the published page.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function recross_register_block_styles() {

    // --- Heading variations (H2 / H3 share the same set) ------------------
    foreach ( array( 'core/heading' ) as $block ) {
        register_block_style( $block, array(
            'name'  => 'recross-red-bar',
            'label' => '赤バー付き',
        ) );
        register_block_style( $block, array(
            'name'  => 'recross-underline',
            'label' => '下線付き',
        ) );
        register_block_style( $block, array(
            'name'  => 'recross-plain',
            'label' => '装飾なし',
        ) );
    }

    // --- Paragraph variations --------------------------------------------
    register_block_style( 'core/paragraph', array(
        'name'  => 'recross-lead',
        'label' => 'リード文（大きめ）',
    ) );
    register_block_style( 'core/paragraph', array(
        'name'  => 'recross-caption',
        'label' => 'キャプション（小さめ）',
    ) );
    register_block_style( 'core/paragraph', array(
        'name'  => 'recross-note',
        'label' => '注釈ボックス（赤バー）',
    ) );

    // --- Image variations ------------------------------------------------
    register_block_style( 'core/image', array(
        'name'  => 'recross-border',
        'label' => '枠線付き',
    ) );
    register_block_style( 'core/image', array(
        'name'  => 'recross-rounded',
        'label' => '角丸',
    ) );
    register_block_style( 'core/image', array(
        'name'  => 'recross-shadow',
        'label' => '影付き',
    ) );

    // --- List variations -------------------------------------------------
    register_block_style( 'core/list', array(
        'name'  => 'recross-red-marker',
        'label' => 'マーカー赤',
    ) );
    register_block_style( 'core/list', array(
        'name'  => 'recross-checked',
        'label' => 'チェックリスト',
    ) );
    register_block_style( 'core/list', array(
        'name'  => 'recross-big-number',
        'label' => '番号大きめ',
    ) );

    // --- Group variations (use for boxed sections) -----------------------
    register_block_style( 'core/group', array(
        'name'  => 'recross-ivory-box',
        'label' => 'アイボリー背景',
    ) );
    register_block_style( 'core/group', array(
        'name'  => 'recross-bordered-box',
        'label' => '枠線ボックス',
    ) );
    register_block_style( 'core/group', array(
        'name'  => 'recross-accent-box',
        'label' => '赤アクセント線',
    ) );

    // --- Quote variations ------------------------------------------------
    register_block_style( 'core/quote', array(
        'name'  => 'recross-brand',
        'label' => 'ブランドカラー',
    ) );

    // --- Button variations -----------------------------------------------
    register_block_style( 'core/button', array(
        'name'  => 'recross-arrow',
        'label' => '矢印リンク（罫線）',
    ) );
}
add_action( 'init', 'recross_register_block_styles' );
