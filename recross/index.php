<?php
/**
 * Generic fallback (used for the blog index and as a last-resort template).
 */
get_header();
?>

<section class="page-head">
    <div class="site-container">
        <p class="page-head__eyebrow">Blog</p>
        <h1 class="page-head__title"><?php
            if ( is_home() && ! is_front_page() ) {
                single_post_title();
            } else {
                echo 'ブログ';
            }
        ?></h1>
    </div>
</section>

<div class="site-container site-main__inner">
    <?php if ( have_posts() ) : ?>
        <ul class="post-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <li class="post-list__item">
                    <article <?php post_class( 'post-card' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a class="post-card__thumb" href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="post-card__body">
                            <time class="post-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
                            <h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="post-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                        </div>
                    </article>
                </li>
            <?php endwhile; ?>
        </ul>

        <nav class="pagination" aria-label="ページネーション">
            <?php the_posts_pagination( array(
                'mid_size'  => 1,
                'prev_text' => '前へ',
                'next_text' => '次へ',
            ) ); ?>
        </nav>
    <?php else : ?>
        <p class="empty-state">表示できる記事がありません。</p>
    <?php endif; ?>
</div>

<?php
get_footer();
