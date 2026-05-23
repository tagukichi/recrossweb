<?php
/**
 * Archive 会社情報 (company CPT) — Editorial.
 *
 * Bigrow list of company sub-pages (privacy hidden), in menu_order.
 */
get_header();

$items = get_posts( array(
    'post_type'      => 'company',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
) );
?>

<article class="editorial-page editorial-page--archive">

    <?php get_template_part( 'template-parts/parts/page-head-editorial', null, array(
        'eyebrow' => 'Company',
        'meta'    => 'About Us',
        'title'   => '会社情報',
        'lead'    => '技術と知識で、お客様のブランディングをサポートする株式会社リクロスの会社情報です。',
    ) ); ?>

    <section class="editorial editorial--list">
        <div class="site-container">
            <?php if ( $items ) : ?>
                <ol class="bigrow">
                    <?php
                    $n = 1;
                    foreach ( $items as $item ) :
                        if ( 'privacy-policy' === $item->post_name ) {
                            continue;
                        }
                        $excerpt = has_excerpt( $item )
                            ? get_the_excerpt( $item )
                            : wp_trim_words( wp_strip_all_tags( $item->post_content ), 28, '…' );
                    ?>
                        <li class="bigrow__item">
                            <a class="bigrow__link" href="<?php echo esc_url( get_permalink( $item ) ); ?>">
                                <span class="bigrow__num"><?php echo esc_html( sprintf( '%02d', $n++ ) ); ?></span>
                                <div class="bigrow__main">
                                    <h2 class="bigrow__title"><?php echo esc_html( get_the_title( $item ) ); ?></h2>
                                    <p class="bigrow__excerpt"><?php echo esc_html( $excerpt ); ?></p>
                                </div>
                                <span class="bigrow__arrow" aria-hidden="true">→</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            <?php else : ?>
                <p class="empty-state">表示できる項目がありません。</p>
            <?php endif; ?>
        </div>
    </section>

</article>

<?php
get_footer();
