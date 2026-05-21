<?php
/**
 * TOP section: 会社情報
 */
?>
<section class="section section--company" aria-labelledby="top-company-heading">
    <div class="site-container">
        <header class="section__head">
            <p class="section__eyebrow">Company</p>
            <h2 id="top-company-heading" class="section__title">会社情報</h2>
            <p class="section__divider" aria-hidden="true"></p>
        </header>

        <div class="section__lead">
            <p>株式会社リクロスは、横浜から創業し、川崎を拠点に「ゼロから無限の可能性を生み出す」を理念として、ホームページ・印刷・デザイン・ポスティング・ウェア・印鑑・看板まで一貫してお客様のブランディングをサポートする会社です。</p>
        </div>

        <ul class="card-grid card-grid--3">
            <li class="card">
                <h3 class="card__title">ごあいさつ</h3>
                <p class="card__text">代表メッセージと、創業からの歩み。</p>
                <a class="card__link" href="<?php echo esc_url( home_url( '/company/greeting/' ) ); ?>">詳しくみる</a>
            </li>
            <li class="card">
                <h3 class="card__title">企業理念</h3>
                <p class="card__text">Re&#39;cross — すべての縁に愛と感謝を。</p>
                <a class="card__link" href="<?php echo esc_url( home_url( '/company/philosophy/' ) ); ?>">詳しくみる</a>
            </li>
            <li class="card">
                <h3 class="card__title">会社概要</h3>
                <p class="card__text">会社名・所在地・事業内容など。</p>
                <a class="card__link" href="<?php echo esc_url( home_url( '/company/outline/' ) ); ?>">詳しくみる</a>
            </li>
        </ul>

        <p class="section__more">
            <a href="<?php echo esc_url( home_url( '/company/' ) ); ?>" class="button button--outline">会社情報をすべて見る</a>
        </p>
    </div>
</section>
