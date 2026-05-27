<?php
/**
 * Archive 事業内容 (service CPT) — Editorial.
 *
 * Reuses TOP section 02's bigrow layout for the /service/ landing.
 */
get_header();

$services = get_posts( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
) );

$rows = array();
$idx = 1;
foreach ( $services as $service ) {
    $excerpt = has_excerpt( $service )
        ? get_the_excerpt( $service )
        : wp_trim_words( wp_strip_all_tags( $service->post_content ), 28, '…' );
    $rows[] = array(
        'num'     => sprintf( '%02d', $idx++ ),
        'title'   => get_the_title( $service ),
        'excerpt' => $excerpt,
        'url'     => get_permalink( $service ),
        'target'  => '',
        'rel'     => '',
        'badge'   => '',
    );
}
$rows[] = array(
    'num'     => sprintf( '%02d', $idx++ ),
    'title'   => 'KYOSO',
    'excerpt' => '月額制で「育てる」ホームページサービス。',
    'url'     => 'https://recross.co.jp/kyoso/',
    'target'  => '_blank',
    'rel'     => 'noopener noreferrer',
    'badge'   => '外部サイト',
);
$rows[] = array(
    'num'     => sprintf( '%02d', $idx++ ),
    'title'   => 'ちょこぺじ',
    'excerpt' => '小さな一歩から始めるホームページサービス。',
    'url'     => '#',
    'target'  => '',
    'rel'     => '',
    'badge'   => '準備中',
);
?>

<article class="editorial-page editorial-page--archive">

    <?php get_template_part( 'template-parts/parts/page-head-editorial', null, array(
        'eyebrow' => 'Service',
        'meta'    => 'All',
        'title'   => '事業内容',
        'lead'    => 'ホームページ・印刷・デザイン・ポスティング・ウェア・印鑑・看板。「伝える」あらゆる手段を、一社で完結できる体制を整えています。',
    ) ); ?>

    <section class="editorial editorial--list" aria-label="事業内容一覧">
        <div class="site-container">
            <ol class="bigrow">
                <?php foreach ( $rows as $r ) :
                    $is_disabled = ( '#' === $r['url'] );
                    $tag         = $is_disabled ? 'div' : 'a';
                ?>
                    <li class="bigrow__item<?php echo $is_disabled ? ' is-disabled' : ''; ?>">
                        <<?php echo $tag; ?> class="bigrow__link"<?php if ( ! $is_disabled ) : ?> href="<?php echo esc_url( $r['url'] ); ?>"<?php endif; ?><?php if ( $r['target'] ) : ?> target="<?php echo esc_attr( $r['target'] ); ?>"<?php endif; ?><?php if ( $r['rel'] ) : ?> rel="<?php echo esc_attr( $r['rel'] ); ?>"<?php endif; ?>>
                            <span class="bigrow__num"><?php echo esc_html( $r['num'] ); ?></span>
                            <div class="bigrow__main">
                                <h2 class="bigrow__title">
                                    <?php echo esc_html( $r['title'] ); ?>
                                    <?php if ( $r['badge'] ) : ?>
                                        <span class="bigrow__badge"><?php echo esc_html( $r['badge'] ); ?></span>
                                    <?php endif; ?>
                                </h2>
                                <p class="bigrow__excerpt"><?php echo esc_html( $r['excerpt'] ); ?></p>
                            </div>
                            <span class="bigrow__arrow" aria-hidden="true"><?php echo $r['target'] === '_blank' ? '↗' : ( $is_disabled ? '—' : '→' ); ?></span>
                        </<?php echo $tag; ?>>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>

</article>

<?php
get_footer();
