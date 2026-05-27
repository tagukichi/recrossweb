<?php
/**
 * Navigation menu helpers.
 *
 * HANDOFF.md §2 requirement: under the global "事業内容" item, append two extra
 * service links — KYOSO (external, new tab) and ちょこぺじ (placeholder/coming soon).
 *
 * Strategy: render the primary menu with a custom Walker, then for each top-level
 * item whose URL ends with /service or /service/ we append two synthetic children.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function recross_extra_service_links() {
    return array(
        array(
            'label'  => 'KYOSO',
            'url'    => 'https://recross.co.jp/kyoso/',
            'target' => '_blank',
            'rel'    => 'noopener noreferrer',
            'classes'=> array( 'menu-item-kyoso' ),
        ),
        array(
            'label'  => 'ちょこぺじ',
            'url'    => '#',
            'target' => '',
            'rel'    => '',
            'classes'=> array( 'menu-item-chocopage', 'is-coming-soon' ),
            'note'   => '準備中',
        ),
    );
}

class Recross_Primary_Walker extends Walker_Nav_Menu {

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        parent::end_el( $output, $item, $depth, $args );

        if ( 0 !== $depth ) {
            return;
        }

        $url      = isset( $item->url ) ? trailingslashit( $item->url ) : '';
        $is_svc   = ( false !== strpos( $url, '/service/' ) );

        if ( ! $is_svc ) {
            return;
        }

        $items = recross_extra_service_links();
        if ( empty( $items ) ) {
            return;
        }

        $extra = '<ul class="sub-menu sub-menu--extra">';
        foreach ( $items as $i ) {
            $classes = ! empty( $i['classes'] ) ? ' ' . esc_attr( implode( ' ', $i['classes'] ) ) : '';
            $target  = $i['target'] ? ' target="' . esc_attr( $i['target'] ) . '"' : '';
            $rel     = $i['rel'] ? ' rel="' . esc_attr( $i['rel'] ) . '"' : '';
            $note    = isset( $i['note'] ) ? ' <span class="menu-note">（' . esc_html( $i['note'] ) . '）</span>' : '';

            $extra .= '<li class="menu-item menu-item--extra' . $classes . '">';
            $extra .= '<a href="' . esc_url( $i['url'] ) . '"' . $target . $rel . '>' . esc_html( $i['label'] ) . $note . '</a>';
            $extra .= '</li>';
        }
        $extra .= '</ul>';

        // Inject the extra UL just before the closing </li> of the parent (service) item.
        // parent::end_el already wrote "</li>\n"; rewrite it with our extras inserted before it.
        $closing = "</li>\n";
        if ( substr( $output, -strlen( $closing ) ) === $closing ) {
            $output = substr( $output, 0, -strlen( $closing ) ) . $extra . $closing;
        }
    }
}

/**
 * Render the primary nav with a fallback when no menu is assigned (so the theme
 * is usable immediately without WP admin setup).
 */
function recross_primary_nav() {
    if ( has_nav_menu( 'primary' ) ) {
        wp_nav_menu( array(
            'theme_location'  => 'primary',
            'container'       => 'nav',
            'container_class' => 'site-nav',
            'menu_class'      => 'site-nav__list',
            'walker'          => new Recross_Primary_Walker(),
            'depth'           => 2,
        ) );
        return;
    }

    // Fallback: hardcoded menu matching the legacy site layout.
    $extras = recross_extra_service_links();
    ?>
    <nav class="site-nav site-nav--fallback">
        <ul class="site-nav__list">
            <li class="menu-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">HOME</a></li>
            <li class="menu-item"><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">最新情報</a></li>
            <li class="menu-item menu-item-has-children">
                <a href="<?php echo esc_url( home_url( '/service/' ) ); ?>">事業内容</a>
                <ul class="sub-menu">
                    <li><a href="<?php echo esc_url( home_url( '/service/sample-service4/' ) ); ?>">ホームページ・WEBサイト制作・運用</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/service/wear/' ) ); ?>">オリジナルウェア製造</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/service/design/' ) ); ?>">デザイン・DTP</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/service/printing/' ) ); ?>">印刷</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/service/posting/' ) ); ?>">ポスティング</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/service/inkan/' ) ); ?>">印鑑彫刻・製造</a></li>
                    <?php foreach ( $extras as $i ) :
                        $cls    = ! empty( $i['classes'] ) ? ' class="' . esc_attr( implode( ' ', $i['classes'] ) ) . '"' : '';
                        $target = $i['target'] ? ' target="' . esc_attr( $i['target'] ) . '"' : '';
                        $rel    = $i['rel'] ? ' rel="' . esc_attr( $i['rel'] ) . '"' : '';
                        $note   = isset( $i['note'] ) ? ' <span class="menu-note">（' . esc_html( $i['note'] ) . '）</span>' : '';
                    ?>
                        <li<?php echo $cls; ?>><a href="<?php echo esc_url( $i['url'] ); ?>"<?php echo $target . $rel; ?>><?php echo esc_html( $i['label'] ) . $note; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li class="menu-item menu-item-has-children">
                <a href="<?php echo esc_url( home_url( '/company/' ) ); ?>">会社情報</a>
                <ul class="sub-menu">
                    <li><a href="<?php echo esc_url( home_url( '/company/greeting/' ) ); ?>">ごあいさつ</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/company/philosophy/' ) ); ?>">企業理念</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/company/outline/' ) ); ?>">会社概要</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/company/history/' ) ); ?>">沿革</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/company/access/' ) ); ?>">アクセス</a></li>
                </ul>
            </li>
            <li class="menu-item"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">ブログ</a></li>
            <li class="menu-item menu-item--cta"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問合せ</a></li>
        </ul>
    </nav>
    <?php
}
