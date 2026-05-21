<?php
/**
 * Single 事業内容 (service CPT).
 *
 * Detail page for a service line (デザイン・DTP / 印刷 / ポスティング etc.).
 * Renders cover image (from featured thumbnail), body content, and a
 * "他の事業" cross-link footer plus お問合せ CTA.
 */
get_header();

while ( have_posts() ) :
    the_post();
    $service_id = get_the_ID();
?>

<section class="page-head page-head--service">
    <div class="site-container">
        <p class="page-head__eyebrow">Service</p>
        <h1 class="page-head__title"><?php the_title(); ?></h1>
    </div>
</section>

<article <?php post_class( 'single-body single-body--service' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <figure class="service-hero">
            <?php the_post_thumbnail( 'full' ); ?>
        </figure>
    <?php endif; ?>

    <div class="site-container site-main__inner site-main__inner--narrow">
        <div class="prose">
            <?php the_content(); ?>
        </div>

        <div class="service-cta">
            <p class="service-cta__lead">この事業についてお問い合わせ・お見積もりはお気軽にどうぞ。</p>
            <p class="service-cta__buttons">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="button button--accent">お問合せフォーム</a>
                <a href="tel:0442807820" class="button button--outline">TEL 044-280-7820</a>
            </p>
        </div>
    </div>
</article>

<?php
    // Other services (exclude current).
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
<section class="section section--service-related">
    <div class="site-container">
        <header class="section__head">
            <p class="section__eyebrow">Other Services</p>
            <h2 class="section__title">他の事業</h2>
            <p class="section__divider" aria-hidden="true"></p>
        </header>
        <ul class="card-grid card-grid--4">
            <?php foreach ( $others as $svc ) :
                $thumb = get_the_post_thumbnail_url( $svc, 'medium' );
            ?>
                <li class="card card--service">
                    <a href="<?php echo esc_url( get_permalink( $svc ) ); ?>" class="card__cover">
                        <?php if ( $thumb ) : ?>
                            <img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="lazy">
                        <?php else : ?>
                            <span class="card__cover-placeholder" aria-hidden="true"></span>
                        <?php endif; ?>
                    </a>
                    <div class="card__body">
                        <h3 class="card__title"><a href="<?php echo esc_url( get_permalink( $svc ) ); ?>"><?php echo esc_html( get_the_title( $svc ) ); ?></a></h3>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<?php endif; ?>

<?php
endwhile;

get_footer();
