<?php
/**
 * Pre-built block patterns ("雛形").
 *
 * Shows up under エディタ右上 "+" → パターン → recross カテゴリ.
 * One click drops a ready-made composition (lead text, CTA strip,
 * two-column info, highlight box, etc.) into the post.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function recross_register_pattern_category() {
    if ( ! function_exists( 'register_block_pattern_category' ) ) {
        return;
    }
    register_block_pattern_category( 'recross', array(
        'label' => 'recross',
    ) );
}
add_action( 'init', 'recross_register_pattern_category' );

function recross_register_block_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    // --- 1. Lead + Heading -----------------------------------------------
    register_block_pattern( 'recross/lead-heading', array(
        'title'       => 'リード文 + 見出し',
        'description' => '記事冒頭の導入文と最初のセクション見出し。',
        'categories'  => array( 'recross' ),
        'content'     => '<!-- wp:paragraph {"className":"is-style-recross-lead"} --><p class="is-style-recross-lead">ここに記事のリード（導入）文を書きます。読者が「この先を読みたい」と思える要約を 2〜3 行で。</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">最初の見出し</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>本文を書き始めます。</p><!-- /wp:paragraph -->',
    ) );

    // --- 2. CTA strip -----------------------------------------------------
    register_block_pattern( 'recross/cta-strip', array(
        'title'       => 'CTA ボタン帯',
        'description' => 'お問合せ等への誘導帯（見出し + 説明 + ボタン）。',
        'categories'  => array( 'recross' ),
        'content'     => '<!-- wp:group {"className":"is-style-recross-ivory-box","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-recross-ivory-box">
<!-- wp:heading {"level":3} --><h3 class="wp-block-heading">ご相談はお気軽に</h3><!-- /wp:heading -->
<!-- wp:paragraph --><p>ご依頼・ご相談・お見積もりなど、お気軽にお問い合わせください。</p><!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-recross-arrow"} -->
<div class="wp-block-button is-style-recross-arrow"><a class="wp-block-button__link wp-element-button" href="/contact/">お問合せフォーム</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
    ) );

    // --- 3. Two-column info box ------------------------------------------
    register_block_pattern( 'recross/two-col-info', array(
        'title'       => '2カラム情報ボックス',
        'description' => '左右に分けて情報を並列表示。',
        'categories'  => array( 'recross' ),
        'content'     => '<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":4} --><h4 class="wp-block-heading">項目A</h4><!-- /wp:heading -->
<!-- wp:paragraph --><p>左カラムの説明を書きます。</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":4} --><h4 class="wp-block-heading">項目B</h4><!-- /wp:heading -->
<!-- wp:paragraph --><p>右カラムの説明を書きます。</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->',
    ) );

    // --- 4. Highlight box -------------------------------------------------
    register_block_pattern( 'recross/highlight-box', array(
        'title'       => 'ハイライト枠（赤アクセント）',
        'description' => '重要なポイントを目立たせるための囲み。',
        'categories'  => array( 'recross' ),
        'content'     => '<!-- wp:group {"className":"is-style-recross-accent-box","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-recross-accent-box">
<!-- wp:heading {"level":4} --><h4 class="wp-block-heading">ここがポイント</h4><!-- /wp:heading -->
<!-- wp:paragraph --><p>強調したい内容をここに書きます。読者に必ず伝えたいことに使ってください。</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->',
    ) );

    // --- 5. Numbered steps -----------------------------------------------
    register_block_pattern( 'recross/numbered-steps', array(
        'title'       => '番号付きステップ',
        'description' => '手順・流れを番号付きで案内。',
        'categories'  => array( 'recross' ),
        'content'     => '<!-- wp:list {"ordered":true,"className":"is-style-recross-big-number"} -->
<ol class="wp-block-list is-style-recross-big-number"><!-- wp:list-item --><li><strong>最初の手順</strong>　ここに最初に行うことを書きます。</li><!-- /wp:list-item -->
<!-- wp:list-item --><li><strong>次の手順</strong>　二つめのステップ。</li><!-- /wp:list-item -->
<!-- wp:list-item --><li><strong>最後の手順</strong>　仕上げに行うこと。</li><!-- /wp:list-item --></ol>
<!-- /wp:list -->',
    ) );

    // --- 6. Note callout --------------------------------------------------
    register_block_pattern( 'recross/note', array(
        'title'       => '注釈（補足説明）',
        'description' => '本文の補足説明や注意書きに使う小さめのボックス。',
        'categories'  => array( 'recross' ),
        'content'     => '<!-- wp:paragraph {"className":"is-style-recross-note"} -->
<p class="is-style-recross-note">※ 補足説明や注意書きをここに書きます。</p>
<!-- /wp:paragraph -->',
    ) );
}
add_action( 'init', 'recross_register_block_patterns' );
