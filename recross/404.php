<?php
/**
 * 404 Not Found — Editorial.
 */
get_header();
?>

<article class="editorial-page editorial-page--404">

    <?php get_template_part( 'template-parts/parts/page-head-editorial', null, array(
        'eyebrow' => 'Error',
        'meta'    => '404',
        'title'   => 'ページが見つかりません',
        'lead'    => 'お探しのページは移動・削除されたか、URL が間違っている可能性があります。',
    ) ); ?>

    <div class="editorial-page__body">
        <div class="site-container editorial-page__body-inner">
            <p class="editorial-page__back">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="link-mega">
                    <span class="link-mega__arrow" aria-hidden="true">←</span>
                    <span class="link-mega__label">トップへ戻る</span>
                </a>
            </p>
        </div>
    </div>

</article>

<?php
get_footer();
