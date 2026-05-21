<?php
/**
 * Site footer.
 */
?>
</main><!-- #site-main -->

<footer class="site-footer" role="contentinfo">
    <div class="site-container site-footer__inner">
        <div class="site-footer__brand">
            <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo-link" rel="home">
                    <span class="site-footer__logo-text"><?php bloginfo( 'name' ); ?></span>
                </a>
            <?php endif; ?>
            <p class="site-footer__address">
                〒210-0844<br>
                神奈川県川崎市川崎区渡田新町３丁目２−８<br>
                かわさき保育会館２階
            </p>
            <p class="site-footer__contact">
                TEL <a href="tel:0442807820">044-280-7820</a><br>
                FAX 044-280-7520
            </p>
        </div>

        <nav class="site-footer__nav" aria-label="フッターナビゲーション">
            <?php
            if ( has_nav_menu( 'footer' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'site-footer__menu',
                    'depth'          => 2,
                ) );
            } else {
                ?>
                <ul class="site-footer__menu">
                    <li><a href="<?php echo esc_url( home_url( '/company/' ) ); ?>">会社情報</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/service/' ) ); ?>">事業内容</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">最新情報</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">ブログ</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">お問合せ</a></li>
                    <li><a href="https://recross.co.jp/kyoso/" target="_blank" rel="noopener noreferrer">KYOSO</a></li>
                    <li><a href="https://recross.shop/" target="_blank" rel="noopener noreferrer">ECサイト</a></li>
                </ul>
                <?php
            }
            ?>
        </nav>
    </div>

    <div class="site-footer__bottom">
        <div class="site-container site-footer__bottom-inner">
            <?php
            if ( has_nav_menu( 'footer_legal' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'footer_legal',
                    'container'      => false,
                    'menu_class'     => 'site-footer__legal',
                    'depth'          => 1,
                ) );
            } else {
                ?>
                <ul class="site-footer__legal">
                    <li><a href="<?php echo esc_url( home_url( '/company/privacy-policy/' ) ); ?>">プライバシーポリシー</a></li>
                </ul>
                <?php
            }
            ?>
            <p class="site-footer__copy">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> 株式会社リクロス All Rights Reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
