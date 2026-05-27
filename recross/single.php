<?php
/**
 * Single post (blog / 標準投稿) — Editorial.
 */
get_header();

while ( have_posts() ) :
    the_post();
    $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    $cats = get_the_category();
    $cat  = ! empty( $cats ) ? $cats[0]->name : '';
?>

<article <?php post_class( 'editorial-page editorial-page--post' ); ?>>

    <?php get_template_part( 'template-parts/parts/page-head-editorial', null, array(
        'eyebrow'   => 'Blog',
        'meta'      => trim( get_the_date( 'Y.m.d' ) . ( $cat ? ' / ' . $cat : '' ) ),
        'title'     => get_the_title(),
        'cover_url' => $thumb_url ?: '',
    ) ); ?>

    <div class="editorial-page__body">
        <div class="site-container editorial-page__body-inner">
            <div class="prose-editorial">
                <?php the_content(); ?>
            </div>

            <nav class="post-nav-editorial" aria-label="記事ナビゲーション">
                <div class="post-nav-editorial__prev"><?php previous_post_link( '<span class="post-nav-editorial__label">前の記事</span><span class="post-nav-editorial__title">%link</span>', '%title' ); ?></div>
                <div class="post-nav-editorial__next"><?php next_post_link( '<span class="post-nav-editorial__label">次の記事</span><span class="post-nav-editorial__title">%link</span>', '%title' ); ?></div>
            </nav>

            <p class="editorial-page__back">
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="link-mega link-mega--small">
                    <span class="link-mega__arrow" aria-hidden="true">←</span>
                    <span class="link-mega__label">ブログ一覧へ戻る</span>
                </a>
            </p>
        </div>
    </div>

</article>

<?php
endwhile;

get_footer();
