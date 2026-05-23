<?php
/**
 * Archive 最新情報 (news CPT) — Editorial.
 */
get_header();
?>

<article class="editorial-page editorial-page--archive">

    <?php get_template_part( 'template-parts/parts/page-head-editorial', null, array(
        'eyebrow' => 'News',
        'meta'    => 'All',
        'title'   => '最新情報',
        'lead'    => '株式会社リクロスからのお知らせ・更新情報をお届けします。',
    ) ); ?>

    <section class="editorial editorial--list">
        <div class="site-container site-main__inner--narrow">
            <?php if ( have_posts() ) : ?>
                <ul class="editorial-list editorial-list--lg">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
                                <span class="editorial-list__title"><?php the_title(); ?></span>
                                <span class="editorial-list__arrow" aria-hidden="true">→</span>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <nav class="pagination" aria-label="ページネーション">
                    <?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '前へ', 'next_text' => '次へ' ) ); ?>
                </nav>
            <?php else : ?>
                <p class="empty-state">現在お知らせはありません。</p>
            <?php endif; ?>
        </div>
    </section>

</article>

<?php
get_footer();
