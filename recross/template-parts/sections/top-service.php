<?php
/**
 * TOP section: 事業内容
 *
 * Pulls all `service` posts in menu_order, then appends the two
 * special menu links (KYOSO external, ちょこぺじ coming soon) as cards.
 */

$services = get_posts( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
) );
?>
<section class="section section--service" aria-labelledby="top-service-heading">
    <div class="site-container">
        <header class="section__head">
            <p class="section__eyebrow">Service</p>
            <h2 id="top-service-heading" class="section__title">事業内容</h2>
            <p class="section__divider" aria-hidden="true"></p>
        </header>

        <ul class="card-grid card-grid--4 card-grid--service">
            <?php foreach ( $services as $service ) :
                $thumb = get_the_post_thumbnail_url( $service, 'medium_large' );
                $excerpt = has_excerpt( $service ) ? get_the_excerpt( $service ) : wp_trim_words( wp_strip_all_tags( $service->post_content ), 40, '…' );
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
                        <h3 class="card__title"><a href="<?php echo esc_url( get_permalink( $service ) ); ?>"><?php echo esc_html( get_the_title( $service ) ); ?></a></h3>
                        <p class="card__text"><?php echo esc_html( $excerpt ); ?></p>
                    </div>
                </li>
            <?php endforeach; ?>

            <li class="card card--service card--extra">
                <a class="card__cover" href="https://recross.co.jp/kyoso/" target="_blank" rel="noopener noreferrer">
                    <span class="card__badge">外部サイト</span>
                </a>
                <div class="card__body">
                    <h3 class="card__title"><a href="https://recross.co.jp/kyoso/" target="_blank" rel="noopener noreferrer">KYOSO</a></h3>
                    <p class="card__text">月額制で「育てる」ホームページサービス。</p>
                </div>
            </li>
            <li class="card card--service card--extra card--coming-soon">
                <div class="card__cover">
                    <span class="card__badge">準備中</span>
                </div>
                <div class="card__body">
                    <h3 class="card__title">ちょこぺじ</h3>
                    <p class="card__text">小さな一歩から始めるホームページサービス（準備中）</p>
                </div>
            </li>
        </ul>

        <p class="section__more">
            <a href="<?php echo esc_url( home_url( '/service/' ) ); ?>" class="button button--outline">事業内容をすべて見る</a>
        </p>
    </div>
</section>
