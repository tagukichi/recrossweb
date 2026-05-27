<?php
/**
 * Block editor (Gutenberg) integration.
 *
 *   - Loads editor preview CSS so the admin canvas looks like the
 *     published article (typography, prose styles, custom block
 *     variations).
 *   - Loads a small JS plugin that injects a Japanese help panel
 *     into the image block sidebar, explaining the link-to options
 *     for non-technical writers.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function recross_setup_editor_styles() {
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    // Make the editor canvas match the frontend prose styling.
    add_editor_style( 'assets/css/editor.css' );
    // Also load the brand Google fonts inside the editor.
    add_editor_style( 'https://fonts.googleapis.com/css2?family=M+PLUS+1:wght@400;500;600;700;800;900&family=Manrope:wght@400;600;800&display=swap' );
}
add_action( 'after_setup_theme', 'recross_setup_editor_styles' );

/**
 * Enqueue the image-link help JS extension in the block editor.
 */
function recross_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'recross-editor-image-link-guide',
        RECROSS_THEME_URI . '/assets/js/editor-image-link-guide.js',
        array( 'wp-blocks', 'wp-element', 'wp-hooks', 'wp-compose', 'wp-i18n', 'wp-block-editor', 'wp-components' ),
        RECROSS_THEME_VERSION,
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'recross_enqueue_block_editor_assets' );
