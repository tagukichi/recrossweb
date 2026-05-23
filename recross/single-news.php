<?php
/**
 * Single 最新情報 (news CPT) — Editorial.
 */
get_header();

while ( have_posts() ) :
    the_post();
    $current_id = get_the_ID();
    $thumb_url  = get_the_post_thumbnail_url( $current_id, 'full' );
?>

<article <?php post_class( 'editorial-page editorial-page--news' ); ?>>

    <?php get_template_part( 'template-parts/parts/page-head-editorial', null, array(
        'eyebrow'   => 'News',
        'meta'      => get_the_date( 'Y.m.d' ),
        'title'     => get_the_title(),
        'cover_url' => $thumb_url ?: '',
    ) ); ?>

    <div class="editorial-page__body">
        <div class="site-container editorial-page__body-inner">
            <div class="prose-editorial">
                <?php the_content(); ?>
            </div>

            <nav class="post-nav-editorial" aria-label="記事ナビゲーション">
                <div class="post-nav-editorial__prev"><?php previous_post_link( '<span class="post-nav-editorial__label">前のお知らせ</span><span class="post-nav-editorial__title">%link</span>', '%title' ); ?></div>
                <div class="post-nav-editorial__next"><?php next_post_link( '<span class="post-nav-editorial__label">次のお知らせ</span><span class="post-nav-editorial__title">%link</span>', '%title' ); ?></div>
            </nav>

            <p class="editorial-page__back">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ); ?>" class="link-mega link-mega--small">
                    <span class="link-mega__arrow" aria-hidden="true">←</span>
                    <span class="link-mega__label">最新情報一覧へ戻る</span>
                </a>
            </p>
        </div>
    </div>

    <?php
        $recent = get_posts( array(
            'post_type'      => 'news',
            'posts_per_page' => 5,
            'post__not_in'   => array( $current_id ),
        ) );
        if ( $recent ) :
    ?>
    <section class="editorial editorial--related editorial--related-news">
        <div class="site-container editorial__inner">
            <div class="editorial__head">
                <span class="editorial__eyebrow">
                    <span class="editorial__eyebrow-num">+</span>
                    <span class="editorial__eyebrow-divider" aria-hidden="true"></span>
                    <span class="editorial__eyebrow-text">Recent News</span>
                </span>
                <h2 class="editorial__title">
                    <span class="editorial__title-line">最近のお知らせ。</span>
                </h2>
            </div>
            <ul class="editorial-list editorial-list--lg">
                <?php foreach ( $recent as $n ) : ?>
                    <li>
                        <a href="<?php echo esc_url( get_permalink( $n ) ); ?>">
                            <time datetime="<?php echo esc_attr( get_the_date( 'c', $n ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d', $n ) ); ?></time>
                            <span class="editorial-list__title"><?php echo esc_html( get_the_title( $n ) ); ?></span>
                            <span class="editorial-list__arrow" aria-hidden="true">→</span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>

</article>

<?php
endwhile;

get_footer();
