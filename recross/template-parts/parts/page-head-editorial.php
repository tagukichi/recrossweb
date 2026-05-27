<?php
/**
 * Reusable editorial page head band.
 *
 * Render via:
 *   get_template_part( 'template-parts/parts/page-head-editorial', null, array(
 *       'eyebrow'   => 'Service',
 *       'meta'      => '02 / 08',
 *       'title'     => 'デザイン・DTP',
 *       'lead'      => '...',
 *       'cover_url' => 'https://...jpg',   // optional 3:2 cover
 *   ) );
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$eyebrow   = $args['eyebrow']   ?? '';
$meta      = $args['meta']      ?? '';
$title     = $args['title']     ?? '';
$lead      = $args['lead']      ?? '';
$cover_url = $args['cover_url'] ?? '';
?>

<?php if ( $cover_url ) : ?>
    <div class="editorial-page__cover">
        <img src="<?php echo esc_url( $cover_url ); ?>" alt="" loading="eager">
    </div>
<?php endif; ?>

<header class="editorial-page__head">
    <div class="site-container editorial-page__head-inner">
        <?php if ( $eyebrow || $meta ) : ?>
            <div class="editorial-page__meta">
                <?php if ( $eyebrow ) : ?>
                    <span class="editorial-page__meta-en"><?php echo esc_html( $eyebrow ); ?></span>
                <?php endif; ?>
                <?php if ( $meta ) : ?>
                    <span class="editorial-page__meta-divider" aria-hidden="true"></span>
                    <span class="editorial-page__meta-num"><?php echo esc_html( $meta ); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( $title ) : ?>
            <h1 class="editorial-page__title"><?php echo wp_kses_post( $title ); ?></h1>
        <?php endif; ?>

        <?php if ( $lead ) : ?>
            <p class="editorial-page__lead"><?php echo wp_kses_post( $lead ); ?></p>
        <?php endif; ?>
    </div>
</header>
