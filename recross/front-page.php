<?php
/**
 * Front page (TOP).
 *
 * Section order mirrors the legacy site:
 *   1. メインビジュアル（スライダー）
 *   2. 会社情報セクション
 *   3. 事業内容セクション
 *   4. ブログ最新セクション
 */
get_header();
?>

<?php get_template_part( 'template-parts/sections/mainvisual' ); ?>

<?php get_template_part( 'template-parts/sections/top-company' ); ?>

<?php get_template_part( 'template-parts/sections/top-service' ); ?>

<?php get_template_part( 'template-parts/sections/top-blog' ); ?>

<?php
get_footer();
