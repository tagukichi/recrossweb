<?php
/**
 * TOP main visual — Editorial hero with image background.
 *
 * Pulls the ACF top_slider images and uses them as the hero background
 * (auto-rotating via main.js). A dark gradient overlay sits on top so
 * the catch copy stays readable. ACF `banner` field is honored as a
 * small promo strip below the hero.
 */

$slides = recross_top_slides();
$banner = recross_top_banner();

// Filter to slides that actually have a PC image.
$slides = array_values( array_filter( $slides, function ( $s ) {
    $pc = $s['slider_imgpc'] ?? null;
    return is_array( $pc ) ? ! empty( $pc['url'] ) : ! empty( $pc );
} ) );
$has_slides = ! empty( $slides );
?>

<section class="hero<?php echo $has_slides ? ' hero--image' : ''; ?>" aria-label="メインビジュアル">

    <?php if ( $has_slides ) : ?>
        <div class="hero__bg" data-recross-slider aria-hidden="true">
            <?php foreach ( $slides as $i => $slide ) :
                $pc     = $slide['slider_imgpc'] ?? null;
                $sp     = $slide['slider_imgsp'] ?? null;
                $pc_url = is_array( $pc ) ? ( $pc['url'] ?? '' ) : $pc;
                $sp_url = is_array( $sp ) ? ( $sp['url'] ?? '' ) : $sp;
                $alt    = is_array( $pc ) ? ( $pc['alt'] ?? '' ) : '';
            ?>
                <div class="hero__slide<?php echo 0 === $i ? ' is-active' : ''; ?>">
                    <picture>
                        <?php if ( $sp_url ) : ?>
                            <source media="(max-width: 749px)" srcset="<?php echo esc_url( $sp_url ); ?>">
                        <?php endif; ?>
                        <img src="<?php echo esc_url( $pc_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="eager">
                    </picture>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="hero__overlay" aria-hidden="true"></div>
    <?php else : ?>
        <div class="hero__bg hero__bg--text" aria-hidden="true">
            <span class="hero__bg-number">2026</span>
        </div>
    <?php endif; ?>

    <div class="site-container hero__inner">
        <div class="hero__meta">
            <span class="hero__meta-line" aria-hidden="true"></span>
            <span class="hero__meta-text">Since 2014 — Yokohama / Kawasaki</span>
        </div>

        <h1 class="hero__catch">
            <span class="hero__catch-line hero__catch-line--1">ゼロから、</span>
            <span class="hero__catch-line hero__catch-line--2">無限の<em>可能性</em>を。</span>
        </h1>

        <div class="hero__foot">
            <p class="hero__lead">
                ホームページ・印刷・デザイン・ポスティング・ウェア・印鑑・看板。<br>
                ブランディングのすべてを、一社で。
            </p>

            <div class="hero__cta">
                <a href="<?php echo esc_url( home_url( '/service/' ) ); ?>" class="link-mega">
                    <span class="link-mega__label">事業内容を見る</span>
                    <span class="link-mega__arrow" aria-hidden="true">→</span>
                </a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="link-mega link-mega--ghost">
                    <span class="link-mega__label">お問合せ</span>
                    <span class="link-mega__arrow" aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
$banner_image = $banner['image'] ?? null;
$banner_url   = is_array( $banner_image ) ? ( $banner_image['url'] ?? '' ) : $banner_image;
$banner_alt   = is_array( $banner_image ) ? ( $banner_image['alt'] ?? '' ) : '';
if ( $banner_url ) :
?>
    <div class="hero-banner site-container">
        <?php if ( ! empty( $banner['link'] ) ) : ?>
            <a href="<?php echo esc_url( $banner['link'] ); ?>" target="_blank" rel="noopener noreferrer">
        <?php endif; ?>
        <img src="<?php echo esc_url( $banner_url ); ?>" alt="<?php echo esc_attr( $banner_alt ); ?>" loading="lazy">
        <?php if ( ! empty( $banner['link'] ) ) : ?>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>
