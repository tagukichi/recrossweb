<?php
/**
 * Single 会社情報 (company CPT).
 *
 * The legacy site uses one CPT entry per topic (greeting / philosophy /
 * outline / history / access / privacy-policy) and switches layout by slug.
 * We mirror that here: shared head with ACF eyebrow/catch, body switches on
 * post_name to render the appropriate ACF data (会社概要 table, 沿革 timeline,
 * アクセス map+table).
 */
get_header();

while ( have_posts() ) :
    the_post();

    $slug   = get_post_field( 'post_name', get_the_ID() );
    $eye    = recross_page_eyebrow();
    $title  = $eye['title'] ?: get_the_title();
    $sub    = $eye['sub']   ?: 'Company';
    $catch  = $eye['catch'];
?>

<section class="page-head page-head--company">
    <div class="site-container">
        <p class="page-head__eyebrow"><?php echo esc_html( $sub ); ?></p>
        <h1 class="page-head__title"><?php echo esc_html( $title ); ?></h1>
        <?php if ( $catch ) : ?>
            <p class="page-head__catch"><?php echo wp_kses_post( nl2br( $catch ) ); ?></p>
        <?php endif; ?>
    </div>
</section>

<article <?php post_class( 'single-body single-body--company' ); ?>>
    <div class="site-container site-main__inner site-main__inner--narrow">

        <?php if ( 'outline' === $slug ) : ?>
            <?php $rows = recross_company_info_table(); ?>
            <?php if ( $rows ) : ?>
                <table class="company-table">
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
                <ol class="timeline">
                    <?php foreach ( $history as $row ) : ?>
                        <li class="timeline__item">
                            <span class="timeline__year"><?php echo esc_html( $row['year'] ?? '' ); ?></span>
                            <div class="timeline__body"><?php echo wp_kses_post( nl2br( $row['event'] ?? '' ) ); ?></div>
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
                <div class="access-map responsive-embed">
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
                <table class="company-table">
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

        <div class="prose">
            <?php the_content(); ?>
        </div>

    </div>
</article>

<?php
endwhile;

get_footer();
