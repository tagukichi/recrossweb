# 引継ぎドキュメント — recross WordPress オリジナルテーマ開発

このファイルはセッション間で開発コンテキストを引き継ぐためのドキュメントです。
新セッション開始時、Claude はまずこのファイルを読んでから作業を再開してください。

---

## 1. プロジェクト概要

- **対象サイト**: https://recross.co.jp/
- **現状**: WordPress + Elementor（`hello-elementor` テーマ）で構築済み
- **ゴール**: コンテンツはそのままに、デザインを一新したオリジナル WordPress テーマを新規開発する
- **追加するサービス**: 2つ（KYOSO、ちょこぺじ）

---

## 2. 確定仕様

### テーマ情報
| 項目 | 値 |
|---|---|
| テーマ名 | `recross` |
| テーマスラッグ（ディレクトリ名） | `recross` |
| バージョン | `1.0` |
| 作者 | `株式会社recross` |
| 形式 | クラシックテーマ（PHP + functions.php + style.css）／ブロックテーマではない |
| 言語 | 日本語のみ |
| ベースの参考デザイン | 現サイト（recross.co.jp）をベースに、信頼感・コーポレートな雰囲気 |

### 前提プラグイン（テーマ側から呼び出し・連携する）
- Contact Form 7（CF7）
- Advanced Custom Fields PRO（ACF PRO）
- Yoast SEO PRO

### レスポンシブ仕様
- ブレイクポイント:
  - SP: `~ 749px`
  - TAB: `min-width: 750px` 〜 `1200px`
  - PC: `min-width: 1201px`
- 左右余白:
  - SP: 左右 **5%**
  - TAB: 左右 **3%**
  - PC: コンテンツ最大幅 **1160px**（中央寄せ）

### ヘッダーメニュー「事業内容」配下に追加する項目
1. **KYOSO**（英字表記）
   - リンク: `https://recross.co.jp/kyoso/`
   - **別タブで開く**（`target="_blank" rel="noopener"`）
2. **ちょこぺじ**（ひらがな表記）
   - リンク先: **未定**（現在構築中）
   - 暫定対応: **「準備中」プレースホルダ**として設置（クリックしても遷移しない、または「準備中」表示）

### 動作環境
- 動作確認用WPは別途用意あり（マルチサイト構成、メディアは既存サイトから引っ張る想定）
- メディアファイル（画像）はテーマ側に同梱しなくてよい（DB/メディアライブラリから参照される）

---

## 3. 既存テーマ資産

- アップロードされた既存テーマ: `hello-elementor.zip`
- 解凍先（一時）: `/tmp/legacy/hello-elementor/`（**ephemeralなので新セッションには残らない**）
- 内容: Elementor公式のベーステーマ。レイアウト・デザインはElementor側（DB内のページデータ）にあるため、このZIP単体には現サイトのデザイン情報はほぼ含まれない
- **新セッションで再度参照したい場合**: ユーザーに `hello-elementor.zip` を再アップロード依頼するか、`legacy/` ディレクトリにコミット済みにする

---

## 4. 未取得・要解析

### 現サイト recross.co.jp の構成情報
旧セッションでは環境のネットワーク許可リストに `recross.co.jp` が無く、WebFetch / curl ともに 403 (`host_not_allowed`) で失敗していた。

**新セッションでは許可リストに追加済みのはず**。最初に以下を実行して到達確認すること:

```bash
curl -sL -A "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36" \
  -o /tmp/recross_top.html \
  -w "HTTP:%{http_code} SIZE:%{size_download}\n" \
  https://recross.co.jp/
```

成功したら、トップページおよび下層ページ（会社概要、事業内容、お問い合わせ等）から以下を抽出する:

1. ヘッダーのナビゲーション項目（メニュー構造）
2. ファーストビュー（メインビジュアル）のキャッチコピー
3. トップページの各セクション（見出し・概要・順番）
4. 使用カラー（背景・メイン・アクセント）
5. フォント（日本語／英字）
6. フッターの内容（リンク、会社情報など）
7. 会社情報（社名、住所、電話、メール）
8. 主要な画像・ロゴのURL
9. 固定ページのURL一覧と内容
10. お問い合わせフォームの項目

---

## 5. 開発ブランチ

- 開発ブランチ: `claude/redesign-wordpress-theme-MmEPk`
- リポジトリ: `tagukichi/recrossweb`
- ディレクトリ構成（予定）:
  ```
  recrossweb/
  ├── HANDOFF.md（このファイル）
  └── recross/                  ← 新オリジナルテーマ本体
      ├── style.css
      ├── functions.php
      ├── header.php
      ├── footer.php
      ├── index.php
      ├── front-page.php
      ├── page.php
      ├── single.php
      ├── archive.php
      ├── 404.php
      ├── searchform.php
      ├── screenshot.png
      ├── assets/
      │   ├── css/
      │   ├── js/
      │   └── images/
      ├── inc/                  ← 各種機能ファイル
      │   ├── enqueue.php
      │   ├── menus.php
      │   ├── post-types.php（必要に応じ）
      │   └── acf-fields.php（必要に応じ）
      └── template-parts/
          ├── header/
          ├── footer/
          └── sections/
  ```

---

## 6. 次セッション開始時の手順

1. **このファイル（HANDOFF.md）を読む**
2. ユーザーに「引継ぎ確認しました。recross.co.jp の解析から再開します」と伝える
3. 上記 §4 の curl コマンドで recross.co.jp に到達できるか確認
   - 失敗したら、ユーザーに許可リスト設定を再確認依頼
   - 成功したら、トップページ＋下層ページを順次解析
4. 解析結果をユーザーに見せて、デザイン方針（カラー・フォント・レイアウト）を最終確認
5. 確認OKをもらってから `recross/` テーマの実装開始

---

## 7. 重要な禁止事項・配慮

- KYOSOリンクは必ず `target="_blank" rel="noopener noreferrer"` を付ける
- ちょこぺじは未公開なので、URL未確定のまま `#` リンクや「準備中」表示にする
- メディアファイルはテーマに同梱しない（マルチサイトのメディアを参照）
- 余白・ブレイクポイントは上記仕様を厳守
- 日本語のみ対応（多言語対応コードは不要）

---

最終更新: 2026-05-21（旧セッション最終時点）

---

## 8. 2026-05-21 セッション進捗

### 入力
- ユーザーから WordPress エクスポート XML を受領 → `legacy/wordpress-export.xml`（コミット済）
- 旧サイトのコンテンツ・カスタム投稿スキーマ・ACF構造・Elementor デザイントークン全部抽出

### 確定したデザイントークン（Elementor Default Kit より）
- ブランド色: `#D11C2C`（メインの赤）／サブ: `#5043A4`（KYOSO紫）
- フォント: `M PLUS 1`（Google Fonts）
- コンテナ最大幅: 1160px（HANDOFFの仕様と一致）
- ロゴ: `https://recross.co.jp/wp-content/uploads/2025/11/logo251112.svg`

### 確定した会社実データ
- 株式会社リクロス（T5020001107176）
- 〒210-0844 神奈川県川崎市川崎区渡田新町３丁目２−８ かわさき保育会館２階
- TEL 044-280-7820 / FAX 044-280-7520
- 設立 2014年8月8日 / 資本金 1,300,000円 / 代表取締役 鈴木 清実賢
- ※ 既に川崎へ移転済み

### 実装済み（recross/ テーマ骨組み）
- style.css / functions.php（テーマブートストラップ）
- inc/enqueue.php / inc/menus.php（KYOSO/ちょこぺじ自動挿入Walker付き）/ inc/post-types.php（service/news/company CPT 登録）/ inc/acf-fields.php / inc/template-functions.php
- header.php / footer.php / front-page.php / index.php / page.php / single.php / archive.php / 404.php / search.php / searchform.php
- template-parts/sections/{mainvisual, top-company, top-service, top-blog}.php
- assets/css/style.css（デザイントークン・レスポンシブ基盤）
- assets/js/main.js（モバイルナビ・スライダー）

### 実装済み（追加分）
- single-company.php / archive-company.php（会社情報CPT専用）
  - outline = 会社概要テーブル、history = 沿革タイムライン、access = 地図＋テーブル
  - archive ではプライバシーポリシーを非表示
- single-service.php / archive-service.php（事業内容CPT専用）
  - single: ヒーロー画像 + 本文 + お問合せCTA + 他事業カード
  - archive: 4-up カードグリッド + KYOSO/ちょこぺじ
- single-news.php / archive-news.php（最新情報CPT専用）
- page-contact.php（お問合せページ専用 / Template Name: お問合せ）
  - 2カラム: フォーム + 会社連絡先情報、下部に地図埋め込み
- CSS 拡張: company-table, timeline, service-hero, service-cta, contact-grid, contact-info, contact-map

### 実装済み（追加分2）
- recross/assets/images/logo.svg — オリジナルロゴ（211×47, brand red #D11C2C）
- recross/screenshot.png — 1200×900 白背景に中央配置（ロゴ55%幅）
- header.php / footer.php フォールバックロゴ表示を SVG に変更
  - フッターは `filter: brightness(0) invert(1)` で白化（暗背景用）

### 実装済み（追加分3）
- htaccess-staging.sample — 動作確認用WP（マルチサイト）の WP ルートに置く .htaccess サンプル
  - `/wp-content/uploads/<file>` がローカルに無ければ recross.co.jp に 302 リダイレクト
  - メディアを本番から拝借する仕組み（ステージングにメディア同期不要）

### 実装済み（追加分4: TOPエディトリアル化）
- ダイナミック・エディトリアル型に TOP ページのみ全面リニューアル
  - Hero: フルブリードのアイボリー背景 + 巨大年号 (2026) を背景, 11vw の Catch コピー (「ゼロから、無限の可能性を。」), 赤 em マーカー, Scroll キュー
  - 01 Company: 5/7 非対称グリッド + 会社情報リンクをミニマル罫線リスト化（カード廃止）
  - 02 Service: 縦型 BIG ROW リスト。02 数字背景 + 88px ナンバー + 40px サービス名 + 矢印, KYOSO/ちょこぺじを同列に
  - 03 News/Blog: 2 列の罫線リスト + Manrope 28px の英字ヘッダー
  - 共通: 巨大背景数字 (01/02/03)、Manrope (英字) + M PLUS 1 900 (見出し) を併用
- inc/enqueue.php に M PLUS 1 weight 800/900 + Manrope 追加

### 実装済み（追加分5: 全ページ エディトリアル化）
- template-parts/parts/page-head-editorial.php — 全テンプレ共通の head パーツ
- 全 12 テンプレートをエディトリアル化:
  - single-service.php / archive-service.php
  - single-news.php / archive-news.php
  - single-company.php (outline=ed-table / history=ed-timeline / access=ed-map+ed-table) / archive-company.php
  - single.php / archive.php / index.php
  - page.php / page-contact.php
  - 404.php / search.php
- CSS 追加: editorial-list--lg / ed-table / ed-timeline / ed-map / post-nav-editorial / editorial-contact / ed-deflist

### 実装済み（追加分6: ブログ記事作成サポート — Gutenberg）
- theme.json — ブランドカラー9色 + フォントサイズ5段階を Gutenberg ピッカーに登録（カスタム色OFFで意図しない色の混入防止）
- inc/block-styles.php — Heading / Paragraph / Image / List / Group / Quote / Button のスタイル変奏（赤バー / 下線 / 装飾なし / リード文 / 注釈ボックス / チェックリスト / 番号大きめ / アイボリーボックス 等）
- inc/block-patterns.php — 6種類の雛形ブロック（リード+見出し / CTA帯 / 2カラム / ハイライト枠 / 番号付きステップ / 注釈）
- inc/editor.php — エディタCSS + JSプラグイン enqueue
- assets/css/editor.css — Gutenberg キャンバスに本番と同じプレビュースタイル
- assets/js/editor-image-link-guide.js — 画像ブロックサイドバーに日本語の「リンク設定ヘルプ」パネルを追加
- assets/css/style.css — フロントエンド側の `is-style-recross-*` バリエーション

### 実装済み（追加分7: ブログ記事作成サポート — クラシックエディタ）
- inc/classic-editor.php — TinyMCE「段落▼」プルダウンに見出し/段落/囲み枠/リスト/画像/文字装飾のカスタムフォーマット、文字色パレットをブランド色に制限、ダッシュボードウィジェットでヘルプ表示
- inc/shortcodes.php — `[recross-lead]` / `[recross-note]` / `[recross-box]` / `[recross-cta]` / `[recross-check]` / `[recross-steps]` ショートコード
- assets/js/quicktags.js — Text(HTML)モードに「リード文」「アイボリー枠」「CTA」等のクイックボタン
- assets/css/editor.css — `body.mce-content-body` セレクタを追加してクラシックエディタ iframe もスタイルが効くように

### 残タスク
- **クライアントから受領するデザインカンプ画像** をベースに既存テーマを修正
- 動作確認用WP環境でのデバッグ
- TOPページのデザイン詳細 FIX

### ブランチ
- 本セッション: `claude/resume-from-handoff-DWZ8d`
