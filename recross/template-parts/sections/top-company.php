<?php
/**
 * TOP section 01: 会社情報 — Editorial.
 *
 * Asymmetric 5/7 grid, giant "01" backdrop, no cards.
 */
?>
<section class="editorial editorial--01" aria-labelledby="top-company-heading">
    <div class="editorial__bgnum" aria-hidden="true">01</div>
    <div class="site-container editorial__inner">
        <div class="editorial__head">
            <span class="editorial__eyebrow">
                <span class="editorial__eyebrow-num">01</span>
                <span class="editorial__eyebrow-divider" aria-hidden="true"></span>
                <span class="editorial__eyebrow-text">Company</span>
            </span>
            <h2 id="top-company-heading" class="editorial__title">
                <span class="editorial__title-line">技術と知識で、</span>
                <span class="editorial__title-line">顧客ニーズを実現する。</span>
            </h2>
        </div>

        <div class="editorial__body">
            <p class="editorial__paragraph">
                株式会社リクロスは、横浜から創業し、現在は川崎を拠点に活動するブランディングサポートカンパニーです。ホームページ・印刷・デザインから、ポスティング・ウェア・印鑑・看板まで——あらゆる「伝える手段」を、一社で完結できる体制を整えています。
            </p>
            <p class="editorial__paragraph">
                理念は「ゼロから無限の可能性を生み出す」。創業以来、私たちはこの言葉のもとに、お客様一人ひとりのブランディングと向き合ってきました。
            </p>

            <ul class="editorial__list">
                <li><a href="<?php echo esc_url( home_url( '/company/greeting/' ) ); ?>"><span class="editorial__list-jp">ごあいさつ</span><span class="editorial__list-en">Greeting</span></a></li>
                <li><a href="<?php echo esc_url( home_url( '/company/philosophy/' ) ); ?>"><span class="editorial__list-jp">企業理念</span><span class="editorial__list-en">Philosophy</span></a></li>
                <li><a href="<?php echo esc_url( home_url( '/company/outline/' ) ); ?>"><span class="editorial__list-jp">会社概要</span><span class="editorial__list-en">Outline</span></a></li>
                <li><a href="<?php echo esc_url( home_url( '/company/history/' ) ); ?>"><span class="editorial__list-jp">沿革</span><span class="editorial__list-en">History</span></a></li>
                <li><a href="<?php echo esc_url( home_url( '/company/access/' ) ); ?>"><span class="editorial__list-jp">アクセス</span><span class="editorial__list-en">Access</span></a></li>
            </ul>
        </div>
    </div>
</section>
