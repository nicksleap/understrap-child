<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/vendor/autoload.php';
use Respect\Validation\Validator as v;


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

	wp_localize_script( 'child-understrap-scripts', 'ns_ajax',
		array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ns_ajax-nonce')
		)
	);
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


// Пост-тайпы были сгенерированы при помощи сервиса 
// https://generatewp.com/

if ( !function_exists( 'register_real_estate_post_type' ) ) {

	// Register Custom Post Type
	function register_real_estate_post_type() {

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
			'label'                 => 'Real Estate',
			'description'           => 'Real Estates information page.',
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
	add_action( 'init', 'register_real_estate_post_type', 0 );
	
}

if ( !function_exists( 'register_real_estate_type_taxonomy' ) ) {
	// Register Custom Taxonomy
	function register_real_estate_type_taxonomy() {

		$labels = array(
			'name'                       => 'Real Estate Types',
			'singular_name'              => 'Real Estate Type', 
			'menu_name'                  => 'Real Estate Types',
			'all_items'                  => 'All Real Estate Types',
			'parent_item'                => 'Parent Real Estate Type',
			'parent_item_colon'          => 'Parent Real Estate Type:',
			'new_item_name'              => 'New Real Estate Type Name',
			'add_new_item'               => 'Add New Real Estate Type',
			'edit_item'                  => 'Edit Real Estate Type',
			'update_item'                => 'Update Real Estate Type',
			'view_item'                  => 'View Real Estate Type',
			'separate_items_with_commas' => 'Separate real estate types with commas',
			'add_or_remove_items'        => 'Add or remove real estate types',
			'choose_from_most_used'      => 'Choose from the most used real estate types',
			'popular_items'              => 'Popular Real Estate Types',
			'search_items'               => 'Search real estate types',
			'not_found'                  => 'Real Estate Types Not Found',
			'no_terms'                   => 'No real estate types',
			'items_list'                 => 'Real Estate Types list',
			'items_list_navigation'      => 'Real Estate Types list navigation',
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
	add_action( 'init', 'register_real_estate_type_taxonomy', 0 );

}

if ( !function_exists( 'register_cities_post_type' ) ) {
	function register_cities_post_type() {
		$labels = array(
			'name'                  => 'Cities',
			'singular_name'         => 'City',
			'menu_name'             => 'Cities',
			'name_admin_bar'        => 'City',
			'archives'              => 'City Archives',
			'attributes'            => 'City Attributes',
			'parent_item_colon'     => 'Parent City:',
			'all_items'             => 'All Cities',
			'add_new_item'          => 'Add New City',
			'add_new'               => 'Add New',
			'new_item'              => 'New City',
			'edit_item'             => 'Edit City',
			'update_item'           => 'Update City',
			'view_item'             => 'View City',
			'view_items'            => 'View Cities',
			'search_items'          => 'Search Cities',
			'not_found'             => 'No cities found',
			'not_found_in_trash'    => 'No cities found in Trash',
			'featured_image'        => 'Featured Image',
			'set_featured_image'    => 'Set featured image',
			'remove_featured_image' => 'Remove featured image',
			'use_featured_image'    => 'Use as featured image',
			'insert_into_item'      => 'Insert into city',
			'uploaded_to_this_item' => 'Uploaded to this city',
			'items_list'            => 'Cities list',
			'items_list_navigation' => 'Cities list navigation',
			'filter_items_list'     => 'Filter cities list',
		);
		$args = array(
			'label'                 => 'Cities',
			'labels'                => $labels,
			'supports'              => array('title', 'editor', 'thumbnail'),
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
			'capability_type'       => 'page'
		);
		register_post_type('city', $args);
	}
	add_action('init', 'register_cities_post_type');
}


// Линкуем города и недвижимость

// Добавляем метабокс в сайдбаре для пост тайпа недвижимости
function add_city_meta_box() {
	add_meta_box(
		'city_re_relation',
		'City',
		'city_re_relation_callback',
		'real_estate',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'add_city_meta_box' );


// Добавляем коллбэк функцию для метабокса с городами
function city_re_relation_callback( $post ) {
	$selected_city = get_post_meta( $post->ID, 'selected_city', true );
	$cities = get_posts( array(
		'post_type' => 'city', 
		'posts_per_page' => -1
	) );

	if ( !empty( $cities ) ) :
		echo '<label for="selected_city">Choose city:</label>';

		if ( is_array( $cities ) ) {
			echo '<select name="selected_city" id="selected_city">';
				echo '<option value=""> --- </option>';
				foreach ($cities as $city) {
					printf( 
						'<option value="%1$s" %2$s>%3$s</option>',
						$city->ID,
						selected( $selected_city, $city->ID, false ), // https://developer.wordpress.org/reference/functions/selected/
						$city->post_title
					);
				}
			echo '</select>';
		}

	endif;
}

// добавляем экшен который будет линкать город и недвижимость при сохранении недвижимости
function save_city_re_relation( $post_id ) {
	if ( isset( $_POST['selected_city'] ) ) { // если поле с городом не пустое - доавляем мету, иначе удаляем ее
		update_post_meta( $post_id, 'selected_city', sanitize_text_field( $_POST['selected_city'] ) );
	} else {
		delete_post_meta( $post_id, 'selected_city' ); 
	}
}
add_action('save_post', 'save_city_re_relation');


// Удаляем ссылку из excerpt
add_filter( 'excerpt_more', 'remove_excerpt_more_filter' );
function remove_excerpt_more_filter( $more ){
	global $post;
	return '';
}

// Оброботчик аякс запросов
if( wp_doing_ajax() ){
	add_action( 'wp_ajax_create_re', 'create_re_callback' );
	add_action( 'wp_ajax_nopriv_create_re', 'create_re_callback' );
}

function create_re_form_validate() {

	$errors = [];
	
	if ( empty( $_POST['title'] ) ) {
		$errors[] = 'Name of the Real Estate is reqired';
	}

	if ( v::NumericVal()->validate($_POST['price']) == false ) {
		$errors[] = 'Price value is not valid';
	}

	if ( empty( $_POST['address'] ) ) {
		$errors[] = 'address is reqired';
	}

	if ( v::NumericVal()->validate($_POST['area']) == false ) {
		$errors[] = 'Area value is not valid';
	}

	if ( v::NumericVal()->validate($_POST['living_area']) == false ) {
		$errors[] = 'Living Area value is not valid';
	}

	if ( v::NumericVal()->validate($_POST['floor']) == false ) {
		$errors[] = 'Floor value is not valid';
	}

	if ( !empty( $errors ) ) {

		$html = '<div class="alert alert-warning">';

		$html.= '<p>One or more fields are not valid</p><ul>';

		foreach($errors as $error) {
			$html.= sprintf('<li>%s</li>', $error);
		}
		$html.= '</div>';
 		wp_send_json_error( [
			'html' => $html,
			'errors' => $errors
		] );
	}

	return true;

}


function create_re_callback() {
	
	if( ! wp_verify_nonce( $_POST['nonce_code'], 'ns_ajax-nonce' ) ) {
		wp_send_json_error( [
			'html' => sprintf(
				'<div class="alert alert-warning">%s</div>', 
				wp_verify_nonce( $_POST['nonce_code'], 'ns_ajax-nonce' )
			) 
		] );
	};

	create_re_form_validate();

	$success = [];

	$parms = array(
		'post_author'			=> 1,
		'post_status'			=> 'publish',
		'post_title'			=> sanitize_text_field( $_POST['title'] ),
		'post_content'		=> $_POST['post_content'],
		'post_type'				=> 'real_estate',
	);

	$post_id = wp_insert_post( $parms, true );

	if( is_wp_error( $post_id ) ){
		wp_send_json_error( 
			[
				'html' => sprintf('<div class="alert alert-warning">%s</div>', $post_id->get_error_message())
			]
		);
	}

	$success['post_id'] = $post_id;

	if ( function_exists('update_field') ) :
		if ( !empty( $_POST['price'] ) ) {
			update_field( 'price', $_POST['price'], $post_id );
		}

		if ( !empty( $_POST['address'] ) ) {
			update_field( 'address', $_POST['address'], $post_id );
		}
	
		if ( !empty( $_POST['area'] ) ) {
			update_field( 'area', $_POST['area'], $post_id );
		}
	
		if ( !empty( $_POST['living_area'] ) ) {
			update_field( 'living_area', $_POST['price'], $post_id );
		}
	
		if ( !empty( $_POST['floor'] ) ) {
			update_field( 'floor', $_POST['floor'], $post_id );
		}

	endif;


	if ( !empty( $_FILES ) ) {

		$upload_dir = wp_upload_dir();
		$attachments = [];
		
		for ($i=0; $i < count($_FILES['photos']['name']); $i++) { 
			
			$filename = wp_unique_filename($upload_dir['path'], $_FILES['photos']['name'][$i]);
			$uploadfile = $upload_dir['path'] .'/'. $filename;

			$filetype = wp_check_filetype( basename( $filename ), null );

			if (move_uploaded_file($_FILES['photos']['tmp_name'][$i], $uploadfile) ) {
				$attachment_id = wp_insert_attachment(
					array(
						'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
						'post_content' => '',
						'post_status' => 'inherit',
						'post_mime_type' => $filetype['type']
					),
					$uploadfile
				);
				
				$attachments[] = $attachment_id;
				
			} else {
				$phpFileUploadErrors = array(
					0 => 'There is no error, the file uploaded with success',
					1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
					2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
					3 => 'The uploaded file was only partially uploaded',
					4 => 'No file was uploaded',
					6 => 'Missing a temporary folder',
					7 => 'Failed to write file to disk.',
					8 => 'A PHP extension stopped the file upload.',
				);
				wp_send_json_error([
					'message' => $phpFileUploadErrors[$_FILES['photos']['error']],
					'error' => $_FILES['photos']['error'],
					'html' => sprintf('<div class="alert alert-warning">%s</div>', $phpFileUploadErrors[$_FILES['photos']['error']])
				]);
			};
		}
		update_field('photos', $attachments, $post_id);

		$success = array_merge($success, [
			'message' => "Congratulations! File Uploaded Successfully.",
			'files' => $attachments,
			'html' => sprintf('<div class="alert alert-success">Congratulations! Information has been added, please <a href="%s">follow the link to check</a></div>', get_the_permalink( $post_id ))
		]);

	}

	wp_send_json_success( $success );
}