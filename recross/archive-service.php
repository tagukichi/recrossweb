<?php
/**
 * Archive 事業内容 (service CPT) — /service/ landing.
 *
 * Lists all services as a 4-up card grid in menu_order, then appends the
 * KYOSO external + ちょこぺじ coming-soon cards (matches the homepage
 * service section so the messaging is consistent).
 */
get_header();

$services = get_posts( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
) );
?>
<section class="page-head page-head--service">
    <div class="site-container">
        <p class="page-head__eyebrow">Service</p>
        <h1 class="page-head__title">事業内容</h1>
        <p class="page-head__catch">ゼロから無限の可能性を、<br>多角的な事業でサポートします。</p>
    </div>
</section>

<div class="site-container site-main__inner">
    <ul class="card-grid card-grid--4 card-grid--service">
        <?php foreach ( $services as $service ) :
            $thumb   = get_the_post_thumbnail_url( $service, 'medium_large' );
            $excerpt = has_excerpt( $service ) ? get_the_excerpt( $service ) : wp_trim_words( wp_strip_all_tags( $service->post_content ), 50, '…' );
        ?>
            <li class="card card--service">
                <a href="<?php echo esc_url( get_permalink( $service ) ); ?>" class="card__cover">
                    <?php if ( $thumb ) : ?>
                        <img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="lazy">
                    <?php else : ?>
                        <span class="card__cover-placeholder" aria-hidden="true"></span>
                    <?php endif; ?>
                </a>
                <div class="card__body">
                    <h2 class="card__title"><a href="<?php echo esc_url( get_permalink( $service ) ); ?>"><?php echo esc_html( get_the_title( $service ) ); ?></a></h2>
                    <p class="card__text"><?php echo esc_html( $excerpt ); ?></p>
                </div>
            </li>
        <?php endforeach; ?>

        <li class="card card--service card--extra">
            <a class="card__cover" href="https://recross.co.jp/kyoso/" target="_blank" rel="noopener noreferrer">
                <span class="card__badge">外部サイト</span>
            </a>
            <div class="card__body">
                <h2 class="card__title"><a href="https://recross.co.jp/kyoso/" target="_blank" rel="noopener noreferrer">KYOSO</a></h2>
                <p class="card__text">月額制で「育てる」ホームページサービス。</p>
            </div>
        </li>
        <li class="card card--service card--extra card--coming-soon">
            <div class="card__cover">
                <span class="card__badge">準備中</span>
            </div>
            <div class="card__body">
                <h2 class="card__title">ちょこぺじ</h2>
                <p class="card__text">小さな一歩から始めるホームページサービス（準備中）</p>
            </div>
        </li>
    </ul>
</div>

<?php
get_footer();
