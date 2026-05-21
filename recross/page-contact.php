<?php
/**
 * Template Name: お問合せ
 * Template Post Type: page
 *
 * Used by the お問合せ page (slug `contact`). Provides:
 *   - Hero
 *   - 2-column layout: form (CF7 short-code from page content) + contact info
 *   - Map embed below
 *
 * The CF7 form short-code lives in the page content as before; this template
 * just decorates around it.
 */
get_header();

while ( have_posts() ) :
    the_post();
?>

<section class="page-head page-head--contact">
    <div class="site-container">
        <p class="page-head__eyebrow">Contact</p>
        <h1 class="page-head__title">お問合せ</h1>
        <p class="page-head__catch">ご依頼・ご相談・お見積もりなど、<br>お気軽にお問い合わせください。</p>
    </div>
</section>

<section class="contact-grid">
    <div class="site-container contact-grid__inner">

        <div class="contact-grid__form">
            <h2 class="contact-grid__heading">フォームからのお問合せ</h2>
            <p class="contact-grid__note">下記フォームに必要事項をご記入の上、送信してください。<br>2〜3営業日以内に担当者より返信いたします。</p>

            <div class="cf7-contact prose">
                <?php the_content(); ?>
            </div>
        </div>

        <aside class="contact-grid__info">
            <h2 class="contact-grid__heading">お電話・メールでのお問合せ</h2>

            <dl class="contact-info">
                <dt>会社名</dt>
                <dd>株式会社リクロス<br><small>（適格請求書発行事業者 T5020001107176）</small></dd>

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
                <dd>平日 9:00〜18:00<br><small>（土日祝・年末年始は休業）</small></dd>
            </dl>

            <p class="contact-info__note">
                お電話の際は「ホームページを見て」とお伝えいただくとスムーズです。
            </p>
        </aside>

    </div>
</section>

<section class="contact-map">
    <div class="site-container">
        <h2 class="section__title section__title--center">アクセス</h2>
        <div class="responsive-embed contact-map__embed">
            <iframe
                src="https://www.google.com/maps?q=%E7%A5%9E%E5%A5%88%E5%B7%9D%E7%9C%8C%E5%B7%9D%E5%B4%8E%E5%B8%82%E5%B7%9D%E5%B4%8E%E5%8C%BA%E6%B8%A1%E7%94%B0%E6%96%B0%E7%94%BA%EF%BC%93%E4%B8%81%E7%9B%AE%EF%BC%92%E2%88%92%EF%BC%98&output=embed"
                width="100%" height="450" style="border:0;"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php
endwhile;

get_footer();
