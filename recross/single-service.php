<?php
/**
 * Single 事業内容 (service CPT) — Editorial layout.
 *
 * Mirrors the TOP page's split-band aesthetic:
 *   Band 1: 3:2 cover image (contain, centered, ivory bg) — if thumbnail
 *   Band 2: ivory text area with eyebrow + giant title + lead
 *   Band 3: white prose body (editorial styled headings)
 *   Band 4: ivory CTA band (お問合せ + TEL)
 *   Band 5: white bigrow list of other services (matches TOP section 02)
 */
get_header();

while ( have_posts() ) :
    the_post();
    $service_id = get_the_ID();
    $thumb_url  = get_the_post_thumbnail_url( $service_id, 'full' );

    // Position within the service order (e.g. 02 / 08).
    $all_services = get_posts( array(
        'post_type'      => 'service',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'fields'         => 'ids',
    ) );
    $position = array_search( $service_id, $all_services, true );
    $position = false === $position ? 0 : $position + 1;
    $total    = count( $all_services );

    // Lead: excerpt if present, otherwise first 60 words of content.
    $lead = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 60, '…' );
?>

<article <?php post_class( 'editorial-page editorial-page--service' ); ?>>

    <?php if ( $thumb_url ) : ?>
        <div class="editorial-page__cover">
            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="" loading="eager">
        </div>
    <?php endif; ?>

    <header class="editorial-page__head">
        <div class="site-container editorial-page__head-inner">
            <div class="editorial-page__meta">
                <span class="editorial-page__meta-en">Service</span>
                <span class="editorial-page__meta-divider" aria-hidden="true"></span>
                <span class="editorial-page__meta-num"><?php echo esc_html( sprintf( '%02d / %02d', $position, $total ) ); ?></span>
            </div>
            <h1 class="editorial-page__title"><?php the_title(); ?></h1>
            <?php if ( $lead ) : ?>
                <p class="editorial-page__lead"><?php echo esc_html( $lead ); ?></p>
            <?php endif; ?>
        </div>
    </header>

    <div class="editorial-page__body">
        <div class="site-container editorial-page__body-inner">
            <div class="prose-editorial">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <section class="editorial-page__cta" aria-label="お問合せ">
        <div class="site-container editorial-page__cta-inner">
            <div class="editorial-page__cta-text">
                <p class="editorial-page__cta-eyebrow">Contact</p>
                <h2 class="editorial-page__cta-title">
                    この事業について<br>
                    <em>お気軽に</em>ご相談ください。
                </h2>
            </div>
            <div class="editorial-page__cta-links">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="link-mega">
                    <span class="link-mega__label">お問合せフォーム</span>
                    <span class="link-mega__arrow" aria-hidden="true">→</span>
                </a>
                <a href="tel:0442807820" class="link-mega link-mega--ghost">
                    <span class="link-mega__label">TEL 044-280-7820</span>
                    <span class="link-mega__arrow" aria-hidden="true">↗</span>
                </a>
            </div>
        </div>
    </section>

    <?php
        $others = get_posts( array(
            'post_type'      => 'service',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish',
            'post__not_in'   => array( $service_id ),
        ) );
        if ( $others ) :
    ?>
    <section class="editorial editorial--related" aria-labelledby="related-services">
        <div class="site-container editorial__inner">
            <div class="editorial__head">
                <span class="editorial__eyebrow">
                    <span class="editorial__eyebrow-num">+</span>
                    <span class="editorial__eyebrow-divider" aria-hidden="true"></span>
                    <span class="editorial__eyebrow-text">Other Services</span>
                </span>
                <h2 id="related-services" class="editorial__title">
                    <span class="editorial__title-line">他の事業も、ぜひ。</span>
                </h2>
            </div>

            <ol class="bigrow">
                <?php foreach ( $others as $i => $svc ) :
                    $n = array_search( $svc->ID, $all_services, true );
                    $n = false === $n ? ( $i + 1 ) : $n + 1;
                    $excerpt = has_excerpt( $svc )
                        ? get_the_excerpt( $svc )
                        : wp_trim_words( wp_strip_all_tags( $svc->post_content ), 22, '…' );
                ?>
                    <li class="bigrow__item">
                        <a class="bigrow__link" href="<?php echo esc_url( get_permalink( $svc ) ); ?>">
                            <span class="bigrow__num"><?php echo esc_html( sprintf( '%02d', $n ) ); ?></span>
                            <div class="bigrow__main">
                                <h3 class="bigrow__title"><?php echo esc_html( get_the_title( $svc ) ); ?></h3>
                                <p class="bigrow__excerpt"><?php echo esc_html( $excerpt ); ?></p>
                            </div>
                            <span class="bigrow__arrow" aria-hidden="true">→</span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>
    <?php endif; ?>

</article>

<?php
endwhile;

get_footer();
