<?php
/**
 * Search results
 */
get_header();
?>
<section class="page-head">
    <div class="site-container">
        <p class="page-head__eyebrow">Search</p>
        <h1 class="page-head__title">「<?php echo esc_html( get_search_query() ); ?>」の検索結果</h1>
    </div>
</section>

<div class="site-container site-main__inner">
    <?php get_search_form(); ?>

    <?php if ( have_posts() ) : ?>
        <ul class="news-list news-list--full">
            <?php while ( have_posts() ) : the_post(); ?>
                <li class="news-list__item">
                    <a href="<?php the_permalink(); ?>" class="news-list__link">
                        <time class="news-list__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
                        <span class="news-list__title"><?php the_title(); ?></span>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>

        <nav class="pagination" aria-label="ページネーション">
            <?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '前へ', 'next_text' => '次へ' ) ); ?>
        </nav>
    <?php else : ?>
        <p class="empty-state">検索結果がありませんでした。別のキーワードでお試しください。</p>
    <?php endif; ?>
</div>

<?php
get_footer();
