(function() {

	tinymce.PluginManager.add( 'vogue_shortcodes', function( editor, url ) {

		editor.addButton( 'vogue_chortcodes_megabutton', {

			type: 'menubutton',

			text: '简码',
			tooltip: '主题简码',

			icon: false,

			menu:
			[
				// Gap
				{
					text: '间隙',
					onclick: function() {
						editor.insertContent( '[dt_gap height="10" /]' );
					}
				},

				// Divider
				{
					text: '分隔',
					menu:
					[
						{
							text: '细',
							onclick: function() {
								editor.insertContent( '[dt_divider style="thin" /]' );
							}
						},

						{
							text: '粗',
							onclick: function() {
								editor.insertContent( '[dt_divider style="thick" /]' );
							}
						}
					]
				},

				// List
				{
					text: '列表',
					menu:
					[
						{
							text: '列表',
							onclick: function() {

								var attr = ['style="1"', 'bullet_position="middle"', 'dividers="true"'],

									content = [
										'[dt_list_item image=""]内容[/dt_list_item]',
										'[dt_list_item image=""]内容[/dt_list_item]',
										'[dt_list_item image=""]内容[/dt_list_item]'
									];

								editor.insertContent( '[dt_list ' + attr.join(' ') + ']' + content.join('') + '[/dt_list]' );
							}
						},

						{
							text: '项目',
							onclick: function() {
								editor.insertContent( '[dt_list_item image=""]内容[/dt_list_item]' );
							}
						}
					]
				},

				// Button
				{
					text: '按钮',
					menu:
					[

						{
							text : '链接',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="default"',
										'bg_color_style="custom"',
										'bg_color="#333333"',
										'bg_hover_color_style="custom"',
										'bg_hover_color="#444444"',
										'text_color_style="custom"',
										'text_color="#ffffff"',
										'text_hover_color_style="custom"',
										'text_hover_color="#dddddd"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"'
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']按钮[/dt_button]' );
							}
						},

						{
							text : '默认风格',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="default"',
										'bg_color_style="default"',
										'bg_hover_color_style="default"',
										'text_color_style="default"',
										'text_hover_color_style="default"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']按钮名[/dt_button]' );
							}
						},

						{
							text : '轮廓带背景',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="outline_with_bg"',
										'bg_color_style="custom"',
										'bg_color="#333333"',
										'bg_hover_color_style="custom"',
										'bg_hover_color="#333333"',
										'text_color_style="custom"',
										'text_color="#333333"',
										'text_hover_color_style="custom"',
										'text_hover_color="#ffffff"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']按钮[/dt_button]' );
							}
						},

						{
							text : '轮廓',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="outline"',
										'bg_color_style="custom"',
										'bg_color="rgba(51,51,51,0.25)"',
										'bg_hover_color_style="custom"',
										'bg_hover_color="#333333"',
										'text_color_style="custom"',
										'text_color="rgba(51,51,51,0.3)"',
										'text_hover_color_style="custom"',
										'text_hover_color="#333333"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']按钮[/dt_button]' );
							}
						},

						{
							text : '浅色带背景',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="light_with_bg"',
										'bg_hover_color_style="accent"',
										'text_color_style="context"',
										'text_hover_color_style="custom"',
										'text_hover_color="#ffffff"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']按钮[/dt_button]' );
							}
						},

						{
							text : '浅色',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="light"',
										'text_color_style="context"',
										'text_hover_color_style="accent"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']按钮[/dt_button]' );
							}
						},

						{
							text : '链接',
							onclick : function() {

								var attr = [
										'link=""',
										'target_blank="false"',
										'button_alignment="default"',
										'animation="fadeIn"',
										'size="medium"',
										'style="link"',
										'text_color_style="context"',
										'text_hover_color_style="accent"',
										'icon="fa fa-chevron-circle-right"',
										'icon_align="left"',
									],
									attr_str = attr.join(' ');

								editor.insertContent( '[dt_button ' + attr_str + ']按钮[/dt_button]' );
							}
						}
					]
				},

				// Tooltip
				{
					text: '提示',
					onclick: function() {
						editor.insertContent( '[dt_tooltip title="TITLE"]' + editor.selection.getContent() + '[/dt_tooltip]' );
					}
				},

				// Highlight
				{
					text: '高亮',
					onclick: function() {
						editor.insertContent( '[dt_highlight color="" text_color="" bg_color=""]' + editor.selection.getContent() + '[/dt_highlight]' );
					}
				},

				// Code
				{
					text: '代码',
					onclick: function() {
						editor.insertContent( '[dt_code]' + editor.selection.getContent() + '[/dt_code]' );
					}
				},

				// Social icons
				{
					text: '社交图标',
					onclick: function() {
						var items = [
								'[dt_social_icon target_blank="true" icon="facebook" link="" /]',
								'[dt_social_icon target_blank="true" icon="twitter" link="" /]',
								'[dt_social_icon target_blank="true" icon="google" link="" /]'
							];

						editor.insertContent( '[dt_social_icons animation="none" alignment="default"]' + items.join('') + '[/dt_social_icons]' );
					}
				},

				// Fancy media
				{
					text: '花式媒体',
					onclick: function() {

						var attr = [
								'type=""',
								'lightbox="0"',
								'align=""',
								'margin_top="0"',
								'margin_bottom="0"',
								'margin_right="0"',
								'margin_left="0"',
								'width=""',
								'height=""',
								'animation="none"',
								'media=""',
								'image_alt=""',
								'hd_image=""',
								'image=""'
							];

						editor.insertContent( '[dt_fancy_image ' + attr.join(' ') + ']' + editor.selection.getContent() + '[/dt_fancy_image]' );
					}
				},

				// Quote
				{
					text: '引用',
					menu:
					[
						{
							text : '引用',
							onclick : function() {

								var attr = [
										'type="pullquote"',
										'layout="left"',
										'font_size="big"',
										'animation="none"',
										'size="1"',
									];

								editor.insertContent( '[dt_quote ' + attr.join(' ') + ']内容[/dt_quote]' );
							}
						},

						{
							text : '大块引用',
							onclick : function() {

								var attr = [
										'type="blockquote"',
										'font_size="big"',
										'animation="none"',
										'background="plain"'
									];

								editor.insertContent( '[dt_quote ' + attr.join(' ') + ']内容[/dt_quote]' );
							}
						}
					]
				},

				// Progress bars
				{
					text: '进度条',
					menu:
					[
						{
							text : '多进度条',
							onclick : function() {

								var attr = [
										'title="TITLE"',
										'color=""',
										'percentage=""'
									],
									attr_str = attr.join(' '),
									bars = [
										'[dt_progress_bar ' + attr_str + ' /]',
										'[dt_progress_bar ' + attr_str + ' /]',
										'[dt_progress_bar ' + attr_str + ' /]'
									];

								editor.insertContent( '[dt_progress_bars show_percentage="true"]' + bars.join('') + '[/dt_progress_bars]' );
							}
						},

						{
							text : '进度条',
							onclick : function() {

								var attr = [
										'title="TITLE"',
										'color=""',
										'percentage=""'
									];

								editor.insertContent( '[dt_progress_bar ' + attr.join(' ') + ' /]' );
							}
						}
					]
				},

				// Simple Login Form
				{
					text: '简单登录表',
					onclick: function() {

						var attr = [
								'label_username=""',
								'label_password=""',
								'label_remember=""',
								'label_log_in=""',
							];

						editor.insertContent( '[dt_simple_login_form ' + attr.join(' ') + ']' );
					}
				},
			]

		} );

	});

})();