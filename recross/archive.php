<?php
/**
 * Archive template (news / service / company / category etc.).
 */
get_header();

$post_type = get_post_type();
$eyebrow_map = array(
    'post'    => 'Blog',
    'news'    => 'News',
    'service' => 'Service',
    'company' => 'Company',
);
$eyebrow = $eyebrow_map[ $post_type ] ?? 'Archive';
?>
<section class="page-head">
    <div class="site-container">
        <p class="page-head__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
        <h1 class="page-head__title"><?php echo esc_html( get_the_archive_title() ); ?></h1>
        <?php $desc = get_the_archive_description(); if ( $desc ) : ?>
            <div class="page-head__desc"><?php echo wp_kses_post( $desc ); ?></div>
        <?php endif; ?>
    </div>
</section>

<div class="site-container site-main__inner">
    <?php if ( have_posts() ) : ?>
        <?php if ( in_array( $post_type, array( 'news', 'post' ), true ) ) : ?>
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
        <?php else : ?>
            <ul class="card-grid card-grid--3">
                <?php while ( have_posts() ) : the_post(); ?>
                    <li class="card">
                        <a class="card__cover" href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium_large' ); endif; ?>
                        </a>
                        <div class="card__body">
                            <h2 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="card__text"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), 60, '…' ) ); ?></p>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>

        <nav class="pagination" aria-label="ページネーション">
            <?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '前へ', 'next_text' => '次へ' ) ); ?>
        </nav>
    <?php else : ?>
        <p class="empty-state">表示できる記事がありません。</p>
    <?php endif; ?>
</div>

<?php
get_footer();
