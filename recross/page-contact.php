<?php
/**
 * Template Name: お問合せ
 * Template Post Type: page
 *
 * Editorial contact page: 2-column form + contact info, map below.
 */
get_header();

while ( have_posts() ) :
    the_post();
?>

<article <?php post_class( 'editorial-page editorial-page--contact' ); ?>>

    <?php get_template_part( 'template-parts/parts/page-head-editorial', null, array(
        'eyebrow' => 'Contact',
        'meta'    => 'お問合せ',
        'title'   => 'ご相談・お見積もり、<br><em>お気軽に</em>。',
        'lead'    => 'ご依頼・ご相談・お見積もりなど、お気軽にお問い合わせください。2〜3営業日以内に担当者よりご返信いたします。',
    ) ); ?>

    <section class="editorial-contact">
        <div class="site-container editorial-contact__inner">

            <div class="editorial-contact__form">
                <header class="editorial-contact__heading">
                    <span class="editorial-contact__index">01</span>
                    <h2 class="editorial-contact__title">フォームから</h2>
                    <p class="editorial-contact__sub">Contact Form</p>
                </header>

                <div class="cf7-contact prose-editorial">
                    <?php the_content(); ?>
                </div>
            </div>

            <aside class="editorial-contact__info">
                <header class="editorial-contact__heading">
                    <span class="editorial-contact__index">02</span>
                    <h2 class="editorial-contact__title">お電話・郵送で</h2>
                    <p class="editorial-contact__sub">Direct Contact</p>
                </header>

                <dl class="ed-deflist">
                    <dt>会社名</dt>
                    <dd>株式会社リクロス<br><small>適格請求書発行事業者 T5020001107176</small></dd>

                    <dt>所在地</dt>
                    <dd>
                        〒210-0844<br>
                        神奈川県川崎市川崎区渡田新町３丁目２−８<br>
                        かわさき保育会館２階
                    </dd>

                    <dt>TEL</dt>
                    <dd><a href="tel:0442807820">044-280-7820</a></dd>

                    <dt>FAX</dt>
                    <dd>044-280-7520</dd>

                    <dt>営業時間</dt>
                    <dd>平日 9:00〜18:00<br><small>土日祝・年末年始は休業</small></dd>
                </dl>

                <p class="editorial-contact__note">
                    お電話の際は「ホームページを見て」とお伝えいただくとスムーズです。
                </p>
            </aside>

        </div>
    </section>

    <section class="editorial-contact-map">
        <div class="site-container">
            <header class="editorial-contact__heading">
                <span class="editorial-contact__index">03</span>
                <h2 class="editorial-contact__title">アクセス</h2>
                <p class="editorial-contact__sub">Access Map</p>
            </header>
            <div class="responsive-embed editorial-contact-map__embed">
                <iframe
                    src="https://www.google.com/maps?q=%E7%A5%9E%E5%A5%88%E5%B7%9D%E7%9C%8C%E5%B7%9D%E5%B4%8E%E5%B8%82%E5%B7%9D%E5%B4%8E%E5%8C%BA%E6%B8%A1%E7%94%B0%E6%96%B0%E7%94%BA%EF%BC%93%E4%B8%81%E7%9B%AE%EF%BC%92%E2%88%92%EF%BC%98&output=embed"
                    width="100%" height="450" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

</article>

<?php
endwhile;

get_footer();
