<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
	wp_enqueue_script( 'jquery' );
	
	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );
	
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );


if ( ! function_exists('create_real_estate_post_type') ) {

	// Register Custom Post Type
	function create_real_estate_post_type() {

		$labels = array(
			'name'                  => 'Real Estate',
			'singular_name'         => 'Real Estate',
			'menu_name'             => 'Real Estate',
			'name_admin_bar'        => 'Real Estate',
			'archives'              => 'Real Estate Archives',
			'attributes'            => 'Real Estate Attributes',
			'parent_item_colon'     => 'Parent Real Estate:',
			'all_items'             => 'All Real Estate',
			'add_new_item'          => 'Add New Real Estate',
			'add_new'               => 'Add New',
			'new_item'              => 'New Real Estate',
			'edit_item'             => 'Edit Real Estate',
			'update_item'           => 'Update Real Estate',
			'view_item'             => 'View Real Estate',
			'view_items'            => 'View Real Estate',
			'search_items'          => 'Search Real Estate',
			'not_found'             => 'Real Estate Not found',
			'not_found_in_trash'    => 'Real Estate Not found in Trash',
			'featured_image'        => 'Featured Image',
			'set_featured_image'    => 'Set featured image',
			'remove_featured_image' => 'Remove featured image',
			'use_featured_image'    => 'Use as featured image',
			'insert_into_item'      => 'Insert into real estate',
			'uploaded_to_this_item' => 'Uploaded to this real estate',
			'items_list'            => 'Real Estate list',
			'items_list_navigation' => 'Real Estate list navigation',
			'filter_items_list'     => 'Filter real estate list',
	);
		$args = array(
			'label'                 => __( 'real_estate' ),
			'description'           => __( 'Properties information page.' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'revisions', ),
			'taxonomies'            => array( 'city' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'building',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'real_estate', $args );

	}
	add_action( 'init', 'create_real_estate_post_type', 0 );
	
}

if ( ! function_exists('real_estate_type_taxonomy') ) {
	// Register Custom Taxonomy
	function real_estate_type_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Real Estate Types', 'Taxonomy General Name' ),
			'singular_name'              => _x( 'Real Estate Type', 'Taxonomy Singular Name' ),
			'menu_name'                  => __( 'Real Estate Types' ),
			'all_items'                  => __( 'All Real Estate Types' ),
			'parent_item'                => __( 'Parent Real Estate Type' ),
			'parent_item_colon'          => __( 'Parent Real Estate Type:' ),
			'new_item_name'              => __( 'New Real Estate Type Name' ),
			'add_new_item'               => __( 'Add New Real Estate Type' ),
			'edit_item'                  => __( 'Edit Real Estate Type' ),
			'update_item'                => __( 'Update Real Estate Type' ),
			'view_item'                  => __( 'View Real Estate Type' ),
			'separate_items_with_commas' => __( 'Separate real estate types with commas' ),
			'add_or_remove_items'        => __( 'Add or remove real estate types' ),
			'choose_from_most_used'      => __( 'Choose from the most used real estate types' ),
			'popular_items'              => __( 'Popular Real Estate Types' ),
			'search_items'               => __( 'Search real estate types' ),
			'not_found'                  => __( 'Real Estate Types Not Found' ),
			'no_terms'                   => __( 'No real estate types' ),
			'items_list'                 => __( 'Real Estate Types list' ),
			'items_list_navigation'      => __( 'Real Estate Types list navigation' ),
	);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'real_estate_type', array( 'real_estate' ), $args );

	}
	add_action( 'init', 'real_estate_type_taxonomy', 0 );

}
