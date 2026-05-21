<?php
/**
 * TOP main visual (slider).
 *
 * Pulls slides from ACF (TOPページ -> top_slider) on the front page.
 * Falls back to a single hero block if no slides are configured.
 */

$slides = recross_top_slides();
$banner = recross_top_banner();
?>

<section class="mv" aria-label="メインビジュアル">
    <?php if ( ! empty( $slides ) ) : ?>
        <div class="mv__slider" data-recross-slider>
            <?php foreach ( $slides as $slide ) :
                $pc   = isset( $slide['slider_imgpc'] ) ? $slide['slider_imgpc'] : null;
                $sp   = isset( $slide['slider_imgsp'] ) ? $slide['slider_imgsp'] : null;
                $link = isset( $slide['slider_link'] ) ? $slide['slider_link'] : '';
                $blank = ! empty( $slide['target'] );

                $pc_url = is_array( $pc ) ? ( $pc['url'] ?? '' ) : $pc;
                $sp_url = is_array( $sp ) ? ( $sp['url'] ?? '' ) : $sp;
                $alt    = is_array( $pc ) ? ( $pc['alt'] ?? '' ) : '';
                if ( ! $pc_url ) {
                    continue;
                }
            ?>
                <div class="mv__slide">
                    <?php if ( $link ) : ?>
                        <a href="<?php echo esc_url( $link ); ?>"<?php echo $blank ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
                    <?php endif; ?>
                    <picture>
                        <?php if ( $sp_url ) : ?>
                            <source media="(max-width: 749px)" srcset="<?php echo esc_url( $sp_url ); ?>">
                        <?php endif; ?>
                        <img src="<?php echo esc_url( $pc_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="eager">
                    </picture>
                    <?php if ( $link ) : ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="mv__fallback">
            <div class="site-container">
                <p class="mv__eyebrow">recross</p>
                <h1 class="mv__catch">ゼロから無限の<br>可能性を生み出す</h1>
                <p class="mv__lead">横浜・川崎を拠点に、ホームページ・デザイン・印刷・ポスティング・ウェアまで一貫サポート。</p>
                <p class="mv__cta">
                    <a href="<?php echo esc_url( home_url( '/service/' ) ); ?>" class="button button--accent">事業内容を見る</a>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <?php
    $banner_image = $banner['image'] ?? null;
    $banner_url   = is_array( $banner_image ) ? ( $banner_image['url'] ?? '' ) : $banner_image;
    $banner_alt   = is_array( $banner_image ) ? ( $banner_image['alt'] ?? '' ) : '';
    if ( $banner_url ) :
    ?>
        <div class="mv__banner site-container">
            <?php if ( ! empty( $banner['link'] ) ) : ?>
                <a href="<?php echo esc_url( $banner['link'] ); ?>" target="_blank" rel="noopener noreferrer">
            <?php endif; ?>
            <img src="<?php echo esc_url( $banner_url ); ?>" alt="<?php echo esc_attr( $banner_alt ); ?>" loading="lazy">
            <?php if ( ! empty( $banner['link'] ) ) : ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
