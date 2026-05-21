<?php
/**
 * Archive 会社情報 (company CPT) — landing page for /company/.
 *
 * Shows all company sub-pages as cards so visitors can navigate from a
 * single 会社情報 hub. Order respects menu_order set in the legacy site
 * (ごあいさつ → 企業理念 → 会社概要 → 沿革 → アクセス → プライバシーポリシー).
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
<section class="page-head page-head--company">
    <div class="site-container">
        <p class="page-head__eyebrow">Company</p>
        <h1 class="page-head__title">会社情報</h1>
        <p class="page-head__catch">技術と知識、<br>顧客ニーズ実現へ</p>
    </div>
</section>

<div class="site-container site-main__inner">
    <?php if ( $items ) : ?>
        <ul class="card-grid card-grid--3">
            <?php foreach ( $items as $item ) :
                if ( 'privacy-policy' === $item->post_name ) {
                    continue;
                }
            ?>
                <li class="card">
                    <?php if ( has_post_thumbnail( $item ) ) : ?>
                        <a class="card__cover" href="<?php echo esc_url( get_permalink( $item ) ); ?>">
                            <?php echo get_the_post_thumbnail( $item, 'medium_large' ); ?>
                        </a>
                    <?php endif; ?>
                    <div class="card__body">
                        <h2 class="card__title"><a href="<?php echo esc_url( get_permalink( $item ) ); ?>"><?php echo esc_html( get_the_title( $item ) ); ?></a></h2>
                        <p class="card__text"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $item->post_content ), 50, '…' ) ); ?></p>
                        <a class="card__link" href="<?php echo esc_url( get_permalink( $item ) ); ?>">詳しくみる</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p class="empty-state">表示できる項目がありません。</p>
    <?php endif; ?>
</div>

<?php
get_footer();
