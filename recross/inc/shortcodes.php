<?php
/**
 * Recross shortcodes (Classic Editor friendly).
 *
 * These let writers compose styled snippets that are awkward to express
 * in plain TinyMCE markup. All output classes match the existing
 * is-style-recross-* CSS so the styling is shared with Gutenberg.
 *
 * Available:
 *   [recross-lead]リード文[/recross-lead]
 *   [recross-note]注釈[/recross-note]
 *   [recross-box style="ivory|bordered|accent"]中身[/recross-box]
 *   [recross-cta href="/contact/" label="お問合せはこちら" target="_self"]
 *   [recross-check]
 *     [item]項目A[/item]
 *     [item]項目B[/item]
 *   [/recross-check]
 *   [recross-steps]
 *     [step]最初の手順の説明[/step]
 *     [step]次の手順の説明[/step]
 *   [/recross-steps]
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_shortcode( 'recross-lead', function ( $atts, $content = null ) {
    return '<p class="is-style-recross-lead">' . do_shortcode( $content ) . '</p>';
} );

add_shortcode( 'recross-note', function ( $atts, $content = null ) {
    return '<p class="is-style-recross-note">' . do_shortcode( $content ) . '</p>';
} );

add_shortcode( 'recross-box', function ( $atts, $content = null ) {
    $a = shortcode_atts( array( 'style' => 'ivory' ), $atts );
    $style_class_map = array(
        'ivory'    => 'is-style-recross-ivory-box',
        'bordered' => 'is-style-recross-bordered-box',
        'accent'   => 'is-style-recross-accent-box',
    );
    $cls = $style_class_map[ $a['style'] ] ?? $style_class_map['ivory'];
    return '<div class="' . esc_attr( $cls ) . '">' . do_shortcode( wpautop( $content ) ) . '</div>';
} );

add_shortcode( 'recross-cta', function ( $atts ) {
    $a = shortcode_atts( array(
        'href'   => '#',
        'label'  => 'お問合せはこちら',
        'target' => '_self',
        'arrow'  => '→',
    ), $atts );

    $target_attr = '_blank' === $a['target']
        ? ' target="_blank" rel="noopener noreferrer"'
        : '';

    return sprintf(
        '<p class="recross-cta"><a class="link-mega" href="%1$s"%2$s><span class="link-mega__label">%3$s</span><span class="link-mega__arrow" aria-hidden="true">%4$s</span></a></p>',
        esc_url( $a['href'] ),
        $target_attr,
        esc_html( $a['label'] ),
        esc_html( $a['arrow'] )
    );
} );

add_shortcode( 'recross-check', function ( $atts, $content = null ) {
    return '<ul class="is-style-recross-checked">' . do_shortcode( $content ) . '</ul>';
} );

add_shortcode( 'item', function ( $atts, $content = null ) {
    return '<li>' . do_shortcode( $content ) . '</li>';
} );

add_shortcode( 'recross-steps', function ( $atts, $content = null ) {
    return '<ol class="is-style-recross-big-number">' . do_shortcode( $content ) . '</ol>';
} );

add_shortcode( 'step', function ( $atts, $content = null ) {
    return '<li>' . do_shortcode( $content ) . '</li>';
} );

/**
 * Allow shortcodes nested inside `[recross-*]` blocks to render the way
 * editors expect (line-broken to paragraphs) without WP eating empty
 * lines inside our wrappers.
 */
function recross_strip_shortcode_pasted_breaks( $content ) {
    $tags = array( 'recross-box', 'recross-check', 'recross-steps' );
    foreach ( $tags as $tag ) {
        $content = preg_replace( "/(<p>)?\\[$tag([^\\]]*?)\\](<\\/p>)?/", "[$tag$2]", $content );
        $content = preg_replace( "/(<p>)?\\[\\/$tag\\](<\\/p>)?/", "[/$tag]", $content );
    }
    return $content;
}
add_filter( 'the_content', 'recross_strip_shortcode_pasted_breaks', 9 );
