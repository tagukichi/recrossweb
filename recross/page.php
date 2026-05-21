<?php
/**
 * Default page template.
 */
get_header();

while ( have_posts() ) :
    the_post();
?>
<section class="page-head">
    <div class="site-container">
        <p class="page-head__eyebrow">Page</p>
        <h1 class="page-head__title"><?php the_title(); ?></h1>
    </div>
</section>

<article <?php post_class( 'page-body' ); ?>>
    <div class="site-container site-main__inner">
        <div class="prose">
            <?php the_content(); ?>
        </div>
    </div>
</article>
<?php
endwhile;

get_footer();
