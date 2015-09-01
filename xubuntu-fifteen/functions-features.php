<?php

/*  Register widget areas
 *
 */

add_action( 'widgets_init', 'xubuntu_widgets_init' );
function xubuntu_widgets_init( ) {
	if( function_exists( 'register_sidebar' ) ) {
		/* Frontpage widget areas */
		register_sidebars( 3, array(
			'name' => 'Front page %d',
			'id' => 'front',
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		) );

		/* Navigation for blog pages */
		register_sidebar( array(
			'name' => 'Blog navigation',
			'id' => 'blog_navigation',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		) );
		/* Footer */
		register_sidebars( 2, array(
			'name' => 'Footer %d',
			'id' => 'footer-widgets',
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		) );
	}
}

/*  Register menu locations
 *
 */

register_nav_menu( 'main_navigation', 'Main navigation' );
register_nav_menu( 'footer_navigation', 'Footer navigation' );

/*  Register scripts
 *
 */

add_action( 'wp_enqueue_scripts', 'xubuntu_scripts' );
function xubuntu_scripts( ) {
	if( !is_admin( ) ) {
		wp_enqueue_script( 'xubuntu-menu', get_template_directory_uri( ) . '/menu.js', 'jquery', '0.1' );
	}
}

/*  Enable theme support
 *  - HTML5 galleries
 *  - Post thumbnails
 *
 */

add_action( 'after_setup_theme', 'xubuntu_after_setup_theme' );
function xubuntu_after_setup_theme( ) {
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
	add_theme_support( 'post-thumbnails' );
}

/*  Remove unwanted metadata from <head>
 *
 */

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

/*  Add RSS2 feed link to <head>
 *
 */

add_action( 'wp_head', 'xubuntu_head' );
function xubuntu_head( ) {
	print '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo( 'name' ) . '" href="' . get_bloginfo( 'rss2_url' ) . '" />' . "\n";
}

?>