<?php
/**
 * Single 最新情報 (news CPT).
 *
 * Compact news article layout: date prominent above title, narrow content,
 * recent news list at the foot for cross-navigation.
 */
get_header();

while ( have_posts() ) :
    the_post();
    $current_id = get_the_ID();
?>

<section class="page-head page-head--news">
    <div class="site-container">
        <p class="page-head__eyebrow">News</p>
        <p class="page-head__meta">
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time>
        </p>
        <h1 class="page-head__title"><?php the_title(); ?></h1>
    </div>
</section>

<article <?php post_class( 'single-body single-body--news' ); ?>>
    <div class="site-container site-main__inner site-main__inner--narrow">
        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="single-body__thumb"><?php the_post_thumbnail( 'large' ); ?></figure>
        <?php endif; ?>

        <div class="prose">
            <?php the_content(); ?>
        </div>

        <nav class="post-nav" aria-label="記事ナビゲーション">
            <div class="post-nav__prev"><?php previous_post_link( '%link', '&larr; %title' ); ?></div>
            <div class="post-nav__next"><?php next_post_link( '%link', '%title &rarr;' ); ?></div>
        </nav>

        <p class="section__more">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="button button--outline">最新情報一覧へ戻る</a>
        </p>
    </div>
</article>

<?php
    $recent = get_posts( array(
        'post_type'      => 'news',
        'posts_per_page' => 5,
        'post__not_in'   => array( $current_id ),
    ) );
    if ( $recent ) :
?>
<section class="section section--news-recent">
    <div class="site-container">
        <header class="section__head">
            <p class="section__eyebrow">Recent News</p>
            <h2 class="section__title">最近のお知らせ</h2>
            <p class="section__divider" aria-hidden="true"></p>
        </header>
        <ul class="news-list news-list--full">
            <?php foreach ( $recent as $n ) : ?>
                <li class="news-list__item">
                    <a href="<?php echo esc_url( get_permalink( $n ) ); ?>" class="news-list__link">
                        <time class="news-list__date" datetime="<?php echo esc_attr( get_the_date( 'c', $n ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d', $n ) ); ?></time>
                        <span class="news-list__title"><?php echo esc_html( get_the_title( $n ) ); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<?php endif; ?>

<?php
endwhile;

get_footer();
