/**
 * @license Copyright (c) 2014-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

import { ClassicEditor } from '@ckeditor/ckeditor5-editor-classic';

import { Bold, Italic, Underline } from '@ckeditor/ckeditor5-basic-styles';
import type { EditorConfig } from '@ckeditor/ckeditor5-core';
import { Essentials } from '@ckeditor/ckeditor5-essentials';
import {
	Image,
	ImageResize,
	ImageStyle,
	ImageToolbar,
	ImageUpload
} from '@ckeditor/ckeditor5-image';
import { Indent, IndentBlock } from '@ckeditor/ckeditor5-indent';
import { Link } from '@ckeditor/ckeditor5-link';
import { List } from '@ckeditor/ckeditor5-list';
import { MediaEmbed } from '@ckeditor/ckeditor5-media-embed';
import { Paragraph } from '@ckeditor/ckeditor5-paragraph';
import {
	Table,
	TableCellProperties,
	TableColumnResize,
	TableProperties,
	TableToolbar
} from '@ckeditor/ckeditor5-table';
import { Undo } from '@ckeditor/ckeditor5-undo';
import { Base64UploadAdapter } from '@ckeditor/ckeditor5-upload';

// You can read more about extending the build with additional plugins in the "Installing plugins" guide.
// See https://ckeditor.com/docs/ckeditor5/latest/installation/plugins/installing-plugins.html for details.

class Editor extends ClassicEditor {
	public static override builtinPlugins = [
		Base64UploadAdapter,
		Bold,
		Essentials,
		Image,
		ImageResize,
		ImageStyle,
		ImageToolbar,
		ImageUpload,
		Indent,
		IndentBlock,
		Italic,
		Link,
		List,
		MediaEmbed,
		Paragraph,
		Table,
		TableCellProperties,
		TableColumnResize,
		TableProperties,
		TableToolbar,
		Underline,
		Undo
	];

	public static override defaultConfig: EditorConfig = {
		toolbar: {
			items: [
				'bold',
				'italic',
				'underline',
				'link',
				'bulletedList',
				'numberedList',
				'|',
				'outdent',
				'indent',
				'|',
				'imageUpload',
				'insertTable',
				'mediaEmbed',
				'undo',
				'redo'
			]
		},
		language: 'id',
		image: {
			toolbar: [
				'imageTextAlternative',
				'imageStyle:inline',
				'imageStyle:block',
				'imageStyle:side'
			]
		},
		table: {
			contentToolbar: [
				'tableColumn',
				'tableRow',
				'mergeTableCells',
				'tableCellProperties',
				'tableProperties'
			]
		}
	};
}

export default Editor;
