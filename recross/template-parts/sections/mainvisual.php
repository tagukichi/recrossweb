<?php
/**
 * TOP main visual — Editorial hero.
 *
 * The editorial hero IS the main visual; the legacy ACF top_slider data
 * is intentionally NOT rendered here (the editorial design replaces it).
 * The ACF `banner` field is still honored as a small promo strip under
 * the hero, since the legacy site uses it to push KYOSO/seasonal banners.
 */

$banner = recross_top_banner();
?>

<section class="hero" aria-label="メインビジュアル">
    <div class="hero__bg" aria-hidden="true">
        <span class="hero__bg-number">2026</span>
    </div>

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

        <div class="hero__scroll" aria-hidden="true">
            <span>Scroll</span>
            <span class="hero__scroll-line"></span>
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

