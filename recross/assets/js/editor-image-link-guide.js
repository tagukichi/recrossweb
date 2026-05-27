/**
 * Image link guide (block editor extension).
 *
 * Adds an inspector panel to the core/image block sidebar that
 * explains, in Japanese, what each "リンク先" option does. Aimed at
 * WordPress beginners — no JSX/build step, plain wp.* globals.
 */
(function (wp) {
    'use strict';
    if (!wp || !wp.hooks || !wp.element || !wp.compose || !wp.blockEditor || !wp.components) {
        return;
    }

    var __                  = wp.i18n && wp.i18n.__ ? wp.i18n.__ : function (s) { return s; };
    var el                  = wp.element.createElement;
    var Fragment            = wp.element.Fragment;
    var addFilter           = wp.hooks.addFilter;
    var createHigherOrderComponent = wp.compose.createHigherOrderComponent;
    var InspectorControls   = wp.blockEditor.InspectorControls;
    var PanelBody           = wp.components.PanelBody;

    var withImageLinkGuide = createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            if (props.name !== 'core/image') {
                return el(BlockEdit, props);
            }

            return el(
                Fragment,
                null,
                el(BlockEdit, props),
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: '🛟 リンク設定のヘルプ', initialOpen: false },
                        el('p', { style: { marginTop: 0, fontSize: '12px', lineHeight: 1.7 } },
                            '画像をクリックしたときの動作を、右側「リンク」欄から設定できます。'
                        ),
                        el('ul', { style: { fontSize: '12px', lineHeight: 1.7, paddingLeft: '16px', margin: 0 } },
                            el('li', { style: { marginBottom: '6px' } },
                                el('strong', null, 'なし'),
                                ' … クリックしても何も起きません（標準）。'
                            ),
                            el('li', { style: { marginBottom: '6px' } },
                                el('strong', null, 'メディアファイル'),
                                ' … クリックで画像が拡大表示されます。ギャラリーや作品写真に。'
                            ),
                            el('li', { style: { marginBottom: '6px' } },
                                el('strong', null, '添付ファイルのページ'),
                                ' … クリックで画像専用ページに移動します（あまり使いません）。'
                            ),
                            el('li', { style: { marginBottom: '6px' } },
                                el('strong', null, 'カスタムURL'),
                                ' … 自分で指定したページへリンクします。「お問合せに誘導したい」「外部サイトに飛ばしたい」時に使用。'
                            )
                        ),
                        el('div', { style: { marginTop: '12px', padding: '10px 12px', background: '#f6f1e7', borderLeft: '3px solid #D11C2C', fontSize: '11px', lineHeight: 1.7 } },
                            el('strong', null, '💡 ヒント:'),
                            ' 外部サイトへのリンクは「新しいタブで開く」を ON にすると、読者がサイトから離れにくくなります。'
                        )
                    )
                )
            );
        };
    }, 'withImageLinkGuide');

    addFilter('editor.BlockEdit', 'recross/image-link-guide', withImageLinkGuide);
}(window.wp));
