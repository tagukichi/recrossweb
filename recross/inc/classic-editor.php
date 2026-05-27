<?php
/**
 * Classic Editor (TinyMCE) integration.
 *
 * Mirrors the Gutenberg block-style variations so writers who keep
 * using the Classic Editor (TinyMCE) have the same one-click styled
 * heading / lead paragraph / highlight box options.
 *
 * Surfaces in:
 *   - "段落▼" dropdown (style_formats)
 *   - Toolbar color picker (textcolor_map)
 *   - Text (HTML) tab buttons (quicktags.js)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Make the "Formats" (styleselect) dropdown visible in the second toolbar row.
 */
function recross_classic_mce_buttons_2( $buttons ) {
    if ( ! in_array( 'styleselect', $buttons, true ) ) {
        array_unshift( $buttons, 'styleselect' );
    }
    return $buttons;
}
add_filter( 'mce_buttons_2', 'recross_classic_mce_buttons_2' );

/**
 * Register the recross style formats + brand text-color palette inside TinyMCE.
 */
function recross_classic_tinymce_init( $init ) {

    $style_formats = array(
        array(
            'title' => '見出し',
            'items' => array(
                array( 'title' => '赤バー付き H2',  'block' => 'h2', 'classes' => 'is-style-recross-red-bar',  'wrapper' => false ),
                array( 'title' => '下線付き H2',    'block' => 'h2', 'classes' => 'is-style-recross-underline','wrapper' => false ),
                array( 'title' => '装飾なし H2',    'block' => 'h2', 'classes' => 'is-style-recross-plain',    'wrapper' => false ),
                array( 'title' => '赤バー付き H3',  'block' => 'h3', 'classes' => 'is-style-recross-red-bar',  'wrapper' => false ),
                array( 'title' => '下線付き H3',    'block' => 'h3', 'classes' => 'is-style-recross-underline','wrapper' => false ),
            ),
        ),
        array(
            'title' => '段落',
            'items' => array(
                array( 'title' => 'リード文（大きめ）',  'block' => 'p', 'classes' => 'is-style-recross-lead',    'wrapper' => false ),
                array( 'title' => 'キャプション（小さめ）','block' => 'p', 'classes' => 'is-style-recross-caption', 'wrapper' => false ),
                array( 'title' => '注釈ボックス（赤バー）','block' => 'p', 'classes' => 'is-style-recross-note',   'wrapper' => false ),
            ),
        ),
        array(
            'title' => '囲み枠',
            'items' => array(
                array( 'title' => 'アイボリー背景ボックス','block' => 'div', 'classes' => 'is-style-recross-ivory-box',    'wrapper' => true ),
                array( 'title' => '枠線ボックス',          'block' => 'div', 'classes' => 'is-style-recross-bordered-box', 'wrapper' => true ),
                array( 'title' => '赤アクセント線',        'block' => 'div', 'classes' => 'is-style-recross-accent-box',   'wrapper' => true ),
            ),
        ),
        array(
            'title' => 'リスト',
            'items' => array(
                array( 'title' => 'チェックリスト',     'selector' => 'ul',     'classes' => 'is-style-recross-checked' ),
                array( 'title' => '番号大きめ',         'selector' => 'ol',     'classes' => 'is-style-recross-big-number' ),
                array( 'title' => '赤マーカー',         'selector' => 'ul,ol',  'classes' => 'is-style-recross-red-marker' ),
            ),
        ),
        array(
            'title' => '画像',
            'items' => array(
                array( 'title' => '枠線付き', 'selector' => 'img', 'classes' => 'is-style-recross-border' ),
                array( 'title' => '角丸',     'selector' => 'img', 'classes' => 'is-style-recross-rounded' ),
                array( 'title' => '影付き',   'selector' => 'img', 'classes' => 'is-style-recross-shadow' ),
            ),
        ),
        array(
            'title' => '文字装飾',
            'items' => array(
                array( 'title' => 'ブランド赤マーカー', 'inline' => 'span', 'classes' => 'recross-marker-red' ),
                array( 'title' => '太字（強調）',       'inline' => 'strong' ),
            ),
        ),
    );

    $init['style_formats']       = wp_json_encode( $style_formats );
    $init['style_formats_merge'] = false;

    // Lock the text-color palette to brand swatches.
    $init['textcolor_map'] = wp_json_encode( array(
        'D11C2C', 'ブランド赤',
        'A91421', 'ブランド赤(暗)',
        '111111', 'テキスト',
        '666666', '薄文字',
        'D7D7D7', 'ライン',
        'F6F1E7', 'アイボリー',
    ) );
    $init['textcolor_cols'] = 6;
    $init['textcolor_rows'] = 1;

    return $init;
}
add_filter( 'tiny_mce_before_init', 'recross_classic_tinymce_init' );

/**
 * Allow div / span tag selections in TinyMCE's "Block" dropdown so style_formats
 * with block=div can actually apply.
 */
function recross_classic_extend_valid_elements( $init ) {
    // Append div / span variations explicitly so wrapper formats survive cleanup.
    $extras = 'div[class|id|style],span[class|id|style]';
    $init['extended_valid_elements'] = isset( $init['extended_valid_elements'] )
        ? $init['extended_valid_elements'] . ',' . $extras
        : $extras;
    return $init;
}
add_filter( 'tiny_mce_before_init', 'recross_classic_extend_valid_elements' );

/**
 * Enqueue Quicktags buttons for the Text (HTML) tab.
 */
function recross_classic_quicktags() {
    if ( ! wp_script_is( 'quicktags' ) ) {
        return;
    }
    wp_enqueue_script(
        'recross-quicktags',
        RECROSS_THEME_URI . '/assets/js/quicktags.js',
        array( 'quicktags' ),
        RECROSS_THEME_VERSION,
        true
    );
}
add_action( 'admin_print_footer_scripts', 'recross_classic_quicktags', 100 );

/**
 * Add a small dashboard widget summarising the recross editing helpers.
 */
function recross_classic_dashboard_widget() {
    wp_add_dashboard_widget(
        'recross_editing_help',
        'recross — 記事を書くときのヒント',
        'recross_classic_dashboard_widget_render'
    );
}
add_action( 'wp_dashboard_setup', 'recross_classic_dashboard_widget' );

function recross_classic_dashboard_widget_render() {
    echo '<p style="margin-top:0;">ブログを書きやすくするために、次の機能が追加されています。</p>';
    echo '<ul style="list-style:disc;padding-left:20px;line-height:1.8;">';
    echo '<li><strong>段落▼プルダウン</strong>：見出しを「赤バー付き」「下線付き」などから選べます。</li>';
    echo '<li><strong>段落▼ &gt; 囲み枠</strong>：アイボリー背景・赤アクセント線などのボックスを文章に追加できます。</li>';
    echo '<li><strong>ショートコード</strong>：<code>[recross-cta href="/contact/" label="お問合せ"]</code> でCTAボタンを挿入。</li>';
    echo '<li><strong>テキスト（HTML）モードのボタン</strong>：「リード文」「アイボリー枠」などをワンクリックで挿入。</li>';
    echo '<li><strong>画像のリンク設定</strong>：画像を挿入する際の「リンク先」は、迷ったら「<em>なし</em>」が安全。クリックで拡大したいなら「<em>メディアファイル</em>」を選びます。</li>';
    echo '</ul>';
}
