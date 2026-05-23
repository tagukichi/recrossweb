<?php
/**
 * Single 会社情報 (company CPT) — Editorial.
 *
 * Layout body switches on post_name:
 *   outline → editorial company info table
 *   history → editorial timeline
 *   access  → map embed + access table
 *   others  → straight prose-editorial
 */
get_header();

while ( have_posts() ) :
    the_post();

    $slug   = get_post_field( 'post_name', get_the_ID() );
    $eye    = recross_page_eyebrow();
    $title  = $eye['title']  ?: get_the_title();
    $sub    = $eye['sub']    ?: 'Company';
    $catch  = $eye['catch'];
?>

<article <?php post_class( 'editorial-page editorial-page--company' ); ?>>

    <?php get_template_part( 'template-parts/parts/page-head-editorial', null, array(
        'eyebrow' => $sub,
        'meta'    => get_the_title(),
        'title'   => $title,
        'lead'    => $catch ? nl2br( esc_html( $catch ) ) : '',
    ) ); ?>

    <div class="editorial-page__body">
        <div class="site-container editorial-page__body-inner">

            <?php if ( 'outline' === $slug ) : ?>
                <?php $rows = recross_company_info_table(); ?>
                <?php if ( $rows ) : ?>
                    <table class="ed-table">
                        <tbody>
                        <?php foreach ( $rows as $row ) : ?>
                            <tr>
                                <th scope="row"><?php echo esc_html( $row['label'] ?? '' ); ?></th>
                                <td><?php echo wp_kses_post( nl2br( $row['value'] ?? '' ) ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            <?php elseif ( 'history' === $slug ) : ?>
                <?php $history = recross_field( 'recross_company_history' ); ?>
                <?php if ( is_array( $history ) && $history ) : ?>
                    <ol class="ed-timeline">
                        <?php foreach ( $history as $row ) : ?>
                            <li class="ed-timeline__item">
                                <span class="ed-timeline__year"><?php echo esc_html( $row['year'] ?? '' ); ?></span>
                                <div class="ed-timeline__body"><?php echo wp_kses_post( nl2br( $row['event'] ?? '' ) ); ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                <?php endif; ?>

            <?php elseif ( 'access' === $slug ) : ?>
                <?php
                    $access_rows = recross_field( 'recross_access_rows' );
                    $map_embed   = recross_field( 'recross_access_map_embed' );
                ?>
                <?php if ( $map_embed ) : ?>
                    <div class="ed-map responsive-embed">
                        <?php echo wp_kses( $map_embed, array(
                            'iframe' => array(
                                'src' => true, 'width' => true, 'height' => true,
                                'style' => true, 'allowfullscreen' => true,
                                'loading' => true, 'referrerpolicy' => true,
                                'frameborder' => true,
                            ),
                        ) ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_array( $access_rows ) && $access_rows ) : ?>
                    <table class="ed-table">
                        <tbody>
                        <?php foreach ( $access_rows as $row ) : ?>
                            <tr>
                                <th scope="row"><?php echo esc_html( $row['label'] ?? '' ); ?></th>
                                <td><?php echo wp_kses_post( nl2br( $row['value'] ?? '' ) ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php endif; ?>

            <div class="prose-editorial">
                <?php the_content(); ?>
            </div>

            <p class="editorial-page__back">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'company' ) ); ?>" class="link-mega link-mega--small">
                    <span class="link-mega__arrow" aria-hidden="true">←</span>
                    <span class="link-mega__label">会社情報一覧へ戻る</span>
                </a>
            </p>
        </div>
    </div>

</article>

<?php
endwhile;

get_footer();
