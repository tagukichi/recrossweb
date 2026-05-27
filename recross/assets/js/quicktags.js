/**
 * Classic Editor — Text (HTML) tab quicktags.
 *
 * Adds shortcut buttons above the textarea so writers can drop in
 * pre-styled snippets without remembering the class names.
 */
(function () {
    'use strict';
    if (typeof QTags === 'undefined') {
        return;
    }

    QTags.addButton('recross_lead',   'リード文',    '<p class="is-style-recross-lead">', '</p>', '', 'リード文（大きめ）');
    QTags.addButton('recross_note',   '注釈',        '<p class="is-style-recross-note">', '</p>', '', '注釈ボックス（赤バー付き）');
    QTags.addButton('recross_ivory',  'アイボリー枠','<div class="is-style-recross-ivory-box">\n',  '\n</div>', '', 'アイボリー背景ボックス');
    QTags.addButton('recross_accent', '赤枠',        '<div class="is-style-recross-accent-box">\n', '\n</div>', '', '赤アクセント線ボックス');
    QTags.addButton('recross_check',  'チェック',    '<ul class="is-style-recross-checked">\n  <li>', '</li>\n</ul>', '', 'チェックリスト');
    QTags.addButton('recross_steps',  '番号付ステップ','<ol class="is-style-recross-big-number">\n  <li>', '</li>\n</ol>', '', '番号付きステップリスト');
    QTags.addButton('recross_cta',    'CTA',         '[recross-cta href="/contact/" label="お問合せはこちら"]', '', '', 'CTAボタンショートコード');
})();
