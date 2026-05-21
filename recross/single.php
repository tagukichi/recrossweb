<?php
/**
 * Single post template (handles post / news / service / company).
 */
get_header();

while ( have_posts() ) :
    the_post();

    $post_type = get_post_type();
    $eyebrow_map = array(
        'post'    => 'Blog',
        'news'    => 'News',
        'service' => 'Service',
        'company' => 'Company',
    );
    $eyebrow = $eyebrow_map[ $post_type ] ?? '';
?>
<section class="page-head">
    <div class="site-container">
        <?php if ( $eyebrow ) : ?>
            <p class="page-head__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
        <?php endif; ?>
        <h1 class="page-head__title"><?php the_title(); ?></h1>
        <?php if ( 'post' === $post_type || 'news' === $post_type ) : ?>
            <p class="page-head__meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></time></p>
        <?php endif; ?>
    </div>
</section>

<article <?php post_class( 'single-body' ); ?>>
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
    </div>
</article>
<?php
endwhile;

get_footer();
