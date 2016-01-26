<?php
/**
 * Zen Theme Alpha functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Zen_Theme_Alpha
 */

if ( ! function_exists( 'zentheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zentheme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Zen Theme Alpha, use a find and replace
	 * to change 'zentheme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'zentheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'zentheme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'zentheme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

//	add_theme_support( 'infinite-scroll', array(
//			'container'    => 'main',
//	) );
}
endif; // zentheme_setup
add_action( 'after_setup_theme', 'zentheme_setup' );

/***************
 * UPDATES via KERNL
 ***************/
require 'theme_update_check.php';
$MyUpdateChecker = new ThemeUpdateChecker(
		'zentheme',
		'https://kernl.us/api/v1/theme-updates/565e651ab731728f79f6a4f5/'
);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zentheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zentheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'zentheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zentheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'zentheme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
			'name'          => esc_html__( 'Resume Footer', 'zentheme' ),
			'id'            => 'resume-footer',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
	) );
	register_sidebar( array(
			'name'          => esc_html__( 'Portfolio Footer', 'zentheme' ),
			'id'            => 'portfolio-footer',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'zentheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zentheme_scripts() {

	//dependencies/libraries
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', ( 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js' ), false, null, false );
	wp_enqueue_script( 'jquery-ui', ( 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js' ), array( 'jquery' ), null, false );

	wp_enqueue_script( 'metaquery', get_template_directory_uri() . '/bower_components/metaquery/metaquery.min.js', array(), '', true );

	wp_enqueue_script( 'history-js', get_template_directory_uri() . '/bower_components/history.js/scripts/bundled/html4+html5/jquery.history.js', array(), '', true );

	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/bower_components/waypoints/lib/jquery.waypoints.js', array(), '', true );
	wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/bower_components/waypoints/lib/shortcuts/sticky.min.js', array(), '', true );

	//custom scripts and styles
	wp_enqueue_style( 'zentheme-style', get_stylesheet_uri() );

	wp_enqueue_style( 'material-design-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons' );

	wp_enqueue_style( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css' );

//	wp_enqueue_style( 'prism-css', get_template_directory_uri() . '/css/vendor/prism/themes/twilight.css' );

	wp_enqueue_script( 'prism-js', get_template_directory_uri() . '/js/vendor/prism/prism.js', array(), '', true );

	wp_enqueue_script( 'ajaxify', get_template_directory_uri() . '/js/vendor/ajaxify/ajaxify-html5.js', array(), '', true );

	wp_enqueue_script( 'zentheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'zentheme-cards', get_template_directory_uri() . '/js/cards.js', array(), '', true );

	wp_enqueue_script( 'zentheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'zentheme-ajax-pagination',  get_template_directory_uri() . '/js/ajax-pagination.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'zentheme-ajax-gallery',  get_template_directory_uri() . '/js/ajax-gallery.js', array( 'jquery' ), '1.0', true );

//	wp_enqueue_script( 'zentheme-ajax-get-post',  get_template_directory_uri() . '/js/ajax-get-post.js', array( 'jquery' ), '1.0', true );

//	wp_enqueue_script( 'zentheme-ajax-modal',  get_template_directory_uri() . '/js/ajaxify.js', array( 'jquery' ), '1.0', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Localize AJAX scripts here
	 */
	$ajax_url = admin_url( 'admin-ajax.php' );
	global $wp_query;
	$query_vars = json_encode( $wp_query->query_vars );
	$ajax_nonce = wp_create_nonce('zentheme_ajax_nonce');

//	var_dump($wp_query->query_vars);
	wp_localize_script('zentheme-ajax-pagination','ajaxification', array(
			'ajaxurl' => $ajax_url,
			'query_vars' => $query_vars,
			'ajax_nonce' => $ajax_nonce
	));
//	wp_localize_script('zentheme-ajax-ajaxgetpost','ajaxgetpost', array());
}
add_action( 'wp_enqueue_scripts', 'zentheme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load CMB2
 */
if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
	require_once  __DIR__ . '/cmb2/init.php';
}

/**
 * Load theme options setup
 */
require get_template_directory() . '/options.php';

/*********************
RANDOM CLEANUP ITEMS
 *********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function zentheme_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function zentheme_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'zentheme' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'zentheme' ) .'</a>';
}
add_filter( 'excerpt_more', 'zentheme_excerpt_more' );

function zentheme_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length','zentheme_excerpt_length',999);

/***************
IMAGE SIZES
 ***************/
add_filter( 'image_size_names_choose', 'zentheme_custom_image_sizes' );

add_image_size( 'card-min', 480, 300, true );
add_image_size( 'card-max', 960, 600, true );

function zentheme_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
			'card-min' => __('480px by 300px','zentheme'),
			'card-max' => __('960px by 600px','zentheme'),
	) );
}

function my_image_size_override() {
	return array( 825, 510 );
}
/*********************
PAGE NAVI
 *********************/

// Numeric Page Navi (built into the theme by default)
function zentheme_page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
		return;
	echo '<nav class="pagination">';
	echo paginate_links( array(
			'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
			'format'       => '',
			'current'      => max( 1, get_query_var('paged') ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => '&larr;',
			'next_text'    => '&rarr;',
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
	) );
	echo '</nav>';
} /* end page navi */


/***************
 AJAX FUNCTIONS
***************/

add_action( 'wp_ajax_nopriv_ajax_pagination','zentheme_ajax_pagination');
add_action( 'wp_ajax_ajax_pagination','zentheme_ajax_pagination');

function zentheme_ajax_pagination(){
	check_ajax_referer('zentheme_ajax_nonce','security');

	$query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );

	$query_vars['paged'] = $_POST['page'];
	$query_vars['post_status'] = 'publish';

	$posts = new WP_Query( $query_vars );
	$GLOBALS['wp_query'] = $posts;

	add_filter( 'editor_max_image_size', 'my_image_size_override' );

	if( ! $posts->have_posts() ) {
		get_template_part( 'template-parts/content', 'none' );
	}
	else {
		while ( $posts->have_posts() ) {
			$posts->the_post();
			get_template_part( 'template-parts/card', get_post_format() );
		}
	}
	remove_filter( 'editor_max_image_size', 'my_image_size_override' );

	the_posts_pagination( array(
			'mid_size' 			 => 0,
			'prev_text'          => __( 'Previous page', 'zentheme' ),
			'next_text'          => __( 'More posts', 'zentheme' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'zentheme' ) . ' </span>',
	) );

	wp_die();
}



add_action( 'wp_ajax_nopriv_ajax_get_post','zentheme_ajax_get_post');
add_action( 'wp_ajax_ajax_get_post','zentheme_ajax_get_post');

function zentheme_ajax_get_post(){
	check_ajax_referer('zentheme_ajax_nonce','security');
	$post_id = $_POST['post_id'];
	$args = array(
		'p' => $post_id
	);
	$post = new WP_Query( $args );
	if( $post->have_posts() ) :	while( $post->have_posts() ) : $post->the_post();
		get_template_part('template-parts/content','single');
	endwhile; endif;

	wp_die();

}

add_action( 'wp_ajax_nopriv_ajax_get_project','zentheme_ajax_get_project');
add_action( 'wp_ajax_ajax_get_project','zentheme_ajax_get_project');
function zentheme_ajax_get_project(){
	check_ajax_referer('zentheme_ajax_nonce','security');
	$args = array(
			'p' => $_POST['post_id'],
			'post_type' => 'project'
	);
	$post = new WP_Query( $args );
	if( $post->have_posts() ) :	while( $post->have_posts() ) : $post->the_post();
		get_template_part('template-parts/content','project');
	endwhile;
	else : var_dump('failure');
	endif;

	wp_die();

}

add_action( 'wp_ajax_nopriv_ajax_get_attachment','zentheme_ajax_get_attachment');
add_action( 'wp_ajax_ajax_get_attachment','zentheme_ajax_get_attachment');

function zentheme_ajax_get_attachment(){
	check_ajax_referer('zentheme_ajax_nonce','security');
	$args = array(
		'p' => $_POST['post_id'],
		'post_type' => 'attachment'
	);
	$post = new WP_Query( $args );
	if( $post->have_posts() ) :	while( $post->have_posts() ) : $post->the_post();
		get_template_part('template-parts/content','ajax-attachment');
	endwhile; endif;

	wp_die();

}

/*********************
HELPERS
 *********************/
/**
 * function to change the number of posts that appear on specific archive pages
 * @param $query
 */
function zentheme_project_pagesize($query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( is_post_type_archive( 'project' ) ) {
		// Display 50 posts for a custom post type called 'movie'
		$query->set( 'posts_per_page', 50 );
//		$query->set( 'orderby', 'date');
		return;
	}
}
add_action( 'pre_get_posts', 'zentheme_project_pagesize', 1 );


/*********************
THEME OPTIONS
 *********************/

