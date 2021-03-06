<?php

/*  Init admin
 *
 */

add_action( 'admin_init', 'xubuntu_admin_init' );

function xubuntu_admin_init( ) {
	add_editor_style( 'style-common.css' );
	add_editor_style( 'style-editor.css' );
	add_editor_style( 'font-noto-sans.css' );

	wp_enqueue_style( 'style-admin', get_template_directory_uri( ) . '/style-admin.css' );
}

/*  Tweak TinyMCE menus
 *
 */

add_filter( 'mce_buttons', 'xubuntu_mcebuttons' );

function xubuntu_mcebuttons( $buttons ) {
	$buttons = array(
		"formatselect",
		"bold",
		"italic",
		"underline",
		"strikethrough",
		"styleselect",
		"bullist",
		"numlist",
		"link",
		"unlink",
		"charmap",
		"fullscreen",
//		"wp_adv"
	);

	return $buttons;
}

add_filter( 'mce_buttons_2', 'xubuntu_mcebuttons2' );

function xubuntu_mcebuttons2( $buttons ) {
	return array( );
}

add_filter( 'tiny_mce_before_init', 'xubuntu_tinymceinit' );

function xubuntu_tinymceinit( $init_array ) {
	/*  http://codex.wordpress.org/TinyMCE_Custom_Styles#Using_style_formats
	 *  See templates.css for styling
	 *
	 */
	$current = get_current_screen( );

	$style_formats = array(
		array(
			'title' => 'Blockquote',
			'block' => 'blockquote',
			'wrapper' => true
		),
		array(
			'title' => 'Code: Block',
			'inline' => 'code',
			'classes' => 'block',
			'wrapper' => true
		),
		array(
			'title' => 'Code: Inline',
			'inline' => 'code'
		),
		array(
			'title' => 'Preface',
			'block' => 'p',
			'classes' => 'preface',
		),
	);

	if( current_user_can( 'publish_posts' ) && $current->post_type == 'page' ) {
		$style_formats_2 = array(
			array(
				'title' => 'Highlight: Generic/White',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb white',
			),
			array(
				'title' => 'Highlight: New/Fresh/Green',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb green',
			),
			array(
				'title' => 'Highlight: Important/Warning/Red',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb red',
			),
			array(
				'title' => 'Highlight: Blue c',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb blue',
			),
			array(
				'title' => 'Highlight: Pink',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'hb pink',
			),
			array(
				'title' => 'Button: Primary/Blue',
				'selector' => 'a',
				'classes' => 'button primary'
			),
			array(
				'title' => 'Button: Regular',
				'selector' => 'a',
				'classes' => 'button'
			),
			array(
				'title' => 'Three-column list',
				'selector' => 'ul',
				'classes' => 'columnlist group'
			),
			array(
				'title' => 'Boxed content',
				'block' => 'div',
				'wrapper' => true,
				'classes' => 'boxed group'
			)
		);

		$style_formats = array_merge( $style_formats, $style_formats_2 );
	}

	$init_array['style_formats'] = json_encode( $style_formats );

	$init_array['theme_advanced_blockformats'] = 'p,h2,h3,h4';
	$init_array['block_formats'] = 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4';

	return $init_array;
}

?>