<?php
/**
 * TOP section 03: News & Blog — Editorial.
 *
 * Two columns of date-prominent lists, generous whitespace, no boxes.
 */

$news_q = new WP_Query( array(
    'post_type'      => 'news',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
) );

$blog_q = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
) );
?>
<section class="editorial editorial--03" aria-labelledby="top-blog-heading">
    <div class="editorial__bgnum" aria-hidden="true">03</div>
    <div class="site-container editorial__inner">
        <div class="editorial__head">
            <span class="editorial__eyebrow">
                <span class="editorial__eyebrow-num">03</span>
                <span class="editorial__eyebrow-divider" aria-hidden="true"></span>
                <span class="editorial__eyebrow-text">News &amp; Blog</span>
            </span>
            <h2 id="top-blog-heading" class="editorial__title">
                <span class="editorial__title-line">最近の更新。</span>
            </h2>
        </div>

        <div class="editorial__columns">
            <div class="editorial__column">
                <header class="editorial__column-head">
                    <h3 class="editorial__column-title">News</h3>
                    <p class="editorial__column-sub">最新情報</p>
                </header>
                <?php if ( $news_q->have_posts() ) : ?>
                    <ul class="editorial-list">
                        <?php while ( $news_q->have_posts() ) : $news_q->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
                                    <span class="editorial-list__title"><?php the_title(); ?></span>
                                </a>
                            </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                    <p class="editorial__column-more">
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="link-mega link-mega--small">
                            <span class="link-mega__label">最新情報一覧</span>
                            <span class="link-mega__arrow" aria-hidden="true">→</span>
                        </a>
                    </p>
                <?php else : ?>
                    <p class="editorial__empty">現在お知らせはありません。</p>
                <?php endif; ?>
            </div>

            <div class="editorial__column">
                <header class="editorial__column-head">
                    <h3 class="editorial__column-title">Blog</h3>
                    <p class="editorial__column-sub">ブログ</p>
                </header>
                <?php if ( $blog_q->have_posts() ) : ?>
                    <ul class="editorial-list">
                        <?php while ( $blog_q->have_posts() ) : $blog_q->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
                                    <span class="editorial-list__title"><?php the_title(); ?></span>
                                </a>
                            </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                    <p class="editorial__column-more">
                        <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="link-mega link-mega--small">
                            <span class="link-mega__label">ブログ一覧</span>
                            <span class="link-mega__arrow" aria-hidden="true">→</span>
                        </a>
                    </p>
                <?php else : ?>
                    <p class="editorial__empty">現在ブログ記事はありません。</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
