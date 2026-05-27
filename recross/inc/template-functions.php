<?php
/**
 * Template-side helpers.
 *
 * All ACF reads go through these helpers so the theme degrades gracefully
 * when ACF isn't active (falls back to get_post_meta() or empty arrays).
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function recross_field( $name, $post_id = false ) {
    if ( function_exists( 'get_field' ) ) {
        return get_field( $name, $post_id );
    }
    if ( false === $post_id ) {
        $post_id = get_the_ID();
    }
    return get_post_meta( $post_id, $name, true );
}

function recross_top_slides() {
    $front_id = (int) get_option( 'page_on_front' );
    if ( ! $front_id ) {
        return array();
    }
    $slides = recross_field( 'top_slider', $front_id );
    return is_array( $slides ) ? $slides : array();
}

function recross_top_banner() {
    $front_id = (int) get_option( 'page_on_front' );
    if ( ! $front_id ) {
        return array();
    }
    return array(
        'image' => recross_field( 'banner', $front_id ),
        'link'  => recross_field( 'bannerlink', $front_id ),
    );
}

function recross_company_info_table( $post_id = null ) {
    if ( null === $post_id ) {
        $post_id = get_the_ID();
    }
    $rows = recross_field( 'recross_company_info_rows', $post_id );
    return is_array( $rows ) ? $rows : array();
}

function recross_page_eyebrow( $post_id = null ) {
    if ( null === $post_id ) {
        $post_id = get_the_ID();
    }
    return array(
        'title' => recross_field( 'company_title', $post_id ),
        'sub'   => recross_field( 'company_sub_title', $post_id ),
        'catch' => recross_field( 'company_catch', $post_id ),
    );
}

/**
 * Resolve archive title without the WP default prefix (アーカイブ: 等).
 */
function recross_clean_archive_title( $title ) {
    if ( is_category() || is_tag() || is_tax() ) {
        $title = single_term_title( '', false );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_author() ) {
        $title = get_the_author();
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'recross_clean_archive_title' );

/**
 * Wrap iframe/google maps for responsive ratio.
 */
function recross_responsive_oembed( $html ) {
    if ( false !== strpos( $html, '<iframe' ) ) {
        return '<div class="responsive-embed">' . $html . '</div>';
    }
    return $html;
}
add_filter( 'embed_oembed_html', 'recross_responsive_oembed', 10, 1 );

/**
 * Excerpt utilities.
 */
function recross_excerpt_more( $more ) {
    return '…';
}
add_filter( 'excerpt_more', 'recross_excerpt_more' );

function recross_excerpt_length( $length ) {
    return 60;
}
add_filter( 'excerpt_length', 'recross_excerpt_length' );

/**
 * Tiny formatter for news dates.
 */
function recross_format_date( $post_id = null ) {
    return get_the_date( 'Y.m.d', $post_id );
}
