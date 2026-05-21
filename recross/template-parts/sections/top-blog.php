<?php
/**
 * TOP section: ブログ／最新情報
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
<section class="section section--blog" aria-labelledby="top-blog-heading">
    <div class="site-container">
        <header class="section__head">
            <p class="section__eyebrow">News &amp; Blog</p>
            <h2 id="top-blog-heading" class="section__title">最新情報・ブログ</h2>
            <p class="section__divider" aria-hidden="true"></p>
        </header>

        <div class="news-blog">
            <div class="news-blog__column">
                <h3 class="news-blog__heading">最新情報</h3>
                <?php if ( $news_q->have_posts() ) : ?>
                    <ul class="news-list">
                        <?php while ( $news_q->have_posts() ) : $news_q->the_post(); ?>
                            <li class="news-list__item">
                                <a href="<?php the_permalink(); ?>" class="news-list__link">
                                    <time class="news-list__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
                                    <span class="news-list__title"><?php the_title(); ?></span>
                                </a>
                            </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                    <p class="news-blog__more"><a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="link-arrow">最新情報一覧</a></p>
                <?php else : ?>
                    <p class="news-blog__empty">現在お知らせはありません。</p>
                <?php endif; ?>
            </div>

            <div class="news-blog__column">
                <h3 class="news-blog__heading">ブログ</h3>
                <?php if ( $blog_q->have_posts() ) : ?>
                    <ul class="news-list">
                        <?php while ( $blog_q->have_posts() ) : $blog_q->the_post(); ?>
                            <li class="news-list__item">
                                <a href="<?php the_permalink(); ?>" class="news-list__link">
                                    <time class="news-list__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
                                    <span class="news-list__title"><?php the_title(); ?></span>
                                </a>
                            </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                    <p class="news-blog__more"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="link-arrow">ブログ一覧</a></p>
                <?php else : ?>
                    <p class="news-blog__empty">現在ブログ記事はありません。</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
