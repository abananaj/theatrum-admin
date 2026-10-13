/**
 * Rich Excerpt — replaces the core plain-text Excerpt panel with a compact TinyMCE editor (bold, italic, links) and a pop-up with the full Classic Editor toolbar.
 */
import { createElement as el, Fragment, useEffect, useState } from '@wordpress/element';
// @ts-ignore
import { registerPlugin } from '@wordpress/plugins';
// @ts-ignore
import { PluginDocumentSettingPanel, store as editorStore } from '@wordpress/editor';
// @ts-ignore
import { dispatch, useDispatch, useSelect } from '@wordpress/data';
// @ts-ignore
import { Button, Modal } from '@wordpress/components';

interface RichExcerptEditorProps {
	id: string;
	height: number;
	full?: boolean;
}

// Inline-only, matching the card teasers the excerpt usually feeds.
const COMPACT_SETTINGS = {
	forced_root_block: false,
	toolbar1: 'bold,italic,link,unlink,removeformat,undo,redo',
	toolbar2: '',
};

// The Classic Editor's toolbar (both rows, always shown), minus Read More and fullscreen.
const FULL_SETTINGS = {
	forced_root_block: 'p',
	toolbar1: 'formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink',
	toolbar2: 'strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
};

function RichExcerptEditor({ id, height, full = false }: RichExcerptEditorProps) {
	const { editPost } = useDispatch(editorStore);
	const excerpt = useSelect(
		(select: any) => select(editorStore).getEditedPostAttribute('excerpt'),
		[]
	);
	// TinyMCE owns the textarea once initialised, so only the mount-time value is passed in.
	const [initialExcerpt] = useState(excerpt);

	useEffect(() => {
		const oldEditor = (window as any).wp?.oldEditor;
		if (!oldEditor?.initialize) {
			return;
		}

		oldEditor.initialize(id, {
			tinymce: {
				wpautop: false,
				menubar: false,
				...(full ? FULL_SETTINGS : COMPACT_SETTINGS),
				toolbar3: '',
				toolbar4: '',
				height,
				setup(editor: any) {
					editor.on('input change undo redo ExecCommand', () =>
						editPost({ excerpt: editor.getContent() })
					);
				},
			},
			quicktags: false,
			mediaButtons: false,
		});

		return () => oldEditor.remove(id);
	}, []);

	return el(
		'div',
		{ className: 'chance-rich-excerpt' },
		el('textarea', { id, defaultValue: initialExcerpt })
	);
}

function RichExcerptPanel() {
	const [isExpanded, setIsExpanded] = useState(false);
	const close = () => setIsExpanded(false);

	return el(
		Fragment,
		null,
		// Only one editor is mounted at a time, so the modal always opens on the latest text and the sidebar remounts with the modal's edits.
		isExpanded
			? el('p', { className: 'chance-rich-excerpt__placeholder' }, 'Editing in the expanded editor…')
			: el(RichExcerptEditor, { id: 'chance-rich-excerpt', height: 160 }),
		el(
			Button,
			{
				variant: 'secondary',
				size: 'compact',
				icon: 'fullscreen-alt',
				onClick: () => setIsExpanded(true),
				disabled: isExpanded,
				style: { marginTop: '8px' },
			},
			'Expand editor'
		),
		isExpanded &&
			el(
				Modal,
				{
					title: 'Excerpt',
					size: 'large',
					onRequestClose: close,
					// TinyMCE's link toolbar renders outside the modal, so clicking it must not count as an outside click.
					shouldCloseOnClickOutside: false,
				},
				el(RichExcerptEditor, { id: 'chance-rich-excerpt-expanded', height: 400, full: true }),
				el(
					'div',
					{ style: { display: 'flex', justifyContent: 'flex-end', marginTop: '16px' } },
					el(Button, { variant: 'primary', onClick: close }, 'Done')
				)
			)
	);
}

// Non-persistent (session-only) removal, so deactivating the plugin restores the core panel.
dispatch(editorStore).removeEditorPanel('post-excerpt');

registerPlugin('chance-rich-excerpt', {
	render: () =>
		el(
			PluginDocumentSettingPanel,
			{ name: 'chance-rich-excerpt', title: 'Excerpt' },
			el(RichExcerptPanel)
		),
});
