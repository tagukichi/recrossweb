<?php
/**
 * Site header.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#site-main">本文へスキップ</a>

<header class="site-header" role="banner">
    <div class="site-container site-header__inner">
        <div class="site-header__brand">
            <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo-link" rel="home">
                    <span class="site-header__logo-text"><?php bloginfo( 'name' ); ?></span>
                </a>
            <?php endif; ?>
        </div>

        <button class="site-header__toggle" type="button" aria-controls="primary-nav" aria-expanded="false">
            <span class="site-header__toggle-bar" aria-hidden="true"></span>
            <span class="site-header__toggle-bar" aria-hidden="true"></span>
            <span class="site-header__toggle-bar" aria-hidden="true"></span>
            <span class="screen-reader-text">メニューを開閉</span>
        </button>

        <div id="primary-nav" class="site-header__nav">
            <?php recross_primary_nav(); ?>
            <div class="site-header__cta">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="button button--accent">お問合せ</a>
            </div>
        </div>
    </div>
</header>

<main id="site-main" class="site-main">
