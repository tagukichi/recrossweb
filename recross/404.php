<?php
/**
 * 404 Not Found
 */
get_header();
?>
<section class="page-head">
    <div class="site-container">
        <p class="page-head__eyebrow">404</p>
        <h1 class="page-head__title">ページが見つかりません</h1>
    </div>
</section>

<div class="site-container site-main__inner site-main__inner--narrow">
    <p>申し訳ございません。お探しのページが見つかりませんでした。<br>URLをご確認の上、もう一度お試しください。</p>
    <p class="section__more">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button button--outline">トップへ戻る</a>
    </p>
</div>

<?php
get_footer();
