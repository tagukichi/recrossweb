<?php
/**
 * Generic page template — Editorial.
 */
get_header();

while ( have_posts() ) :
    the_post();
    $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
?>

<article <?php post_class( 'editorial-page editorial-page--page' ); ?>>

    <?php get_template_part( 'template-parts/parts/page-head-editorial', null, array(
        'eyebrow'   => 'Page',
        'title'     => get_the_title(),
        'cover_url' => $thumb_url ?: '',
    ) ); ?>

    <div class="editorial-page__body">
        <div class="site-container editorial-page__body-inner">
            <div class="prose-editorial">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

</article>

<?php
endwhile;

get_footer();
