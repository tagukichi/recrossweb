<?php
/**
 * TOP main visual — split layout.
 *
 * Upper band: 16:9 image slider sourced from ACF top_slider (one image
 *             per slide, cover/center). Rotates every 5.5s if >1 slide.
 * Lower band: ivory editorial text area with the Catch / Lead / CTAs.
 *
 * When no slides are configured, the image band is omitted and the text
 * band stands on its own.
 */

$slides = recross_top_slides();
$banner = recross_top_banner();

// Keep only slides whose `slider_img` actually resolves to a URL.
$slides = array_values( array_filter( $slides, function ( $s ) {
    $img = $s['slider_img'] ?? null;
    return is_array( $img ) ? ! empty( $img['url'] ) : ! empty( $img );
} ) );
$has_slides = ! empty( $slides );
?>

<section class="hero" aria-label="メインビジュアル">

    <?php if ( $has_slides ) : ?>
        <div class="hero__image">
            <div class="hero__slider" data-recross-slider>
                <?php foreach ( $slides as $i => $slide ) :
                    $img    = $slide['slider_img'] ?? null;
                    $url    = is_array( $img ) ? ( $img['url'] ?? '' ) : $img;
                    $alt    = is_array( $img ) ? ( $img['alt'] ?? '' ) : '';
                    $link   = $slide['slider_link'] ?? '';
                    $blank  = ! empty( $slide['target'] );

                    if ( ! $url ) {
                        continue;
                    }
                ?>
                    <div class="hero__slide<?php echo 0 === $i ? ' is-active' : ''; ?>">
                        <?php if ( $link ) : ?>
                            <a href="<?php echo esc_url( $link ); ?>"<?php echo $blank ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
                        <?php endif; ?>
                            <img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="<?php echo 0 === $i ? 'eager' : 'lazy'; ?>">
                        <?php if ( $link ) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="hero__text">
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
