<?php
/**
 * NewCo_Helsinki functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NewCo_Helsinki
 */

if ( ! function_exists( 'newco_helsinki_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function newco_helsinki_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on NewCo_Helsinki, use a find and replace
		 * to change 'newco_helsinki' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'newco_helsinki', get_template_directory() . '/languages' );

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
			'top-menu' => esc_html__( 'Top Menu location', 'newco_helsinki' ),
			'language-menu' => esc_html__( 'Language Menu location', 'newco_helsinki' ),
			'footer-menu' => esc_html__( 'Footer Menu location', 'newco_helsinki' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'newco_helsinki_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'newco_helsinki_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newco_helsinki_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'newco_helsinki_content_width', 640 );
}
add_action( 'after_setup_theme', 'newco_helsinki_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newco_helsinki_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'newco_helsinki' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'newco_helsinki' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'newco_helsinki_widgets_init' );

function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

/**
 * Enqueue scripts and styles.
 */
function newco_helsinki_scripts() {
	wp_enqueue_style( 'newco_helsinki-style', get_stylesheet_uri() );

	wp_register_style( 'newco_helsinki-default', get_template_directory_uri() . '/default.css', array(), 1, 'all');
	wp_enqueue_style('newco_helsinki-default');
	
	wp_register_style( 'slick-css', get_template_directory_uri() . '/slick/slick.css', array(), 1, 'all');
	wp_enqueue_style('slick-css');

	wp_register_style( 'slick-theme', get_template_directory_uri() . '/slick/slick-theme.css', array(), 1, 'all');
	wp_enqueue_style('slick-theme');	

	wp_enqueue_script( 'newco_helsinki-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'newco_helsinki-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1', true );		

	wp_enqueue_script( 'newco_helsinki-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newco_helsinki_scripts' );

function loadjs(){
    wp_register_script('jquery' , get_stylesheet_directory_uri() . '/js/jquery-3.5.0.min.js', '', "3.3.1",false);
	wp_enqueue_script('jquery');

    wp_register_script('slickminjs' , get_stylesheet_directory_uri() . '/slick/slick.min.js', '', 1,false);
    wp_enqueue_script('slickminjs');
}
add_action('wp_enqueue_scripts', 'loadjs');

function getFilteredServices() {
	if (isset($_POST["categoryName"])) {
		$categoryName = $_POST["categoryName"];
	}else{
		$categoryName = "";
	}
	$services = get_posts(array(
		"post_type" => "service",
		"category_name" => $categoryName,
		"numberposts" => -1,
		"posts_per_page" => -1
	));

	foreach ($services as $service) {
		echo "<div class='Card'>";
		echo 	"<img class='cardIcon' src='" . get_field("service_item_icon", $service->ID) . "' alt='placeholder icon'>";
		echo 	"<p>" . $service->post_title . "</p>";
		echo 	"<hr>";
		echo 	"<p>" . get_field("service_item_featured_text", $service->ID) . "</p>";
		echo 	"<div class='readMore'>";
		echo 		"<a href='" . get_permalink($service->ID) . "' class='dropbtn'>Lue lisää";
		echo "<img class='cardArrow' src='" . get_stylesheet_directory_uri() . "/Icons/keyboard_arrow_right-24px.svg' alt='placeholder icon'>";
		echo 		"</a>";
		echo 	"</div>";
		echo "</div>";
	}
	exit;
}
add_action( 'wp_ajax_getFilteredServices', 'getFilteredServices' );
add_action( 'wp_ajax_nopriv_getFilteredServices', 'getFilteredServices' );

function getFilteredEvents() {
	if (isset($_POST["categoryName"])) {
		$categoryName = $_POST["categoryName"];
	}else{
		$categoryName = "";
	}

	if (isset($_POST["eventsOffset"])) {
		$eventsOffset = $_POST["eventsOffset"];
	}else{
		$eventsOffset = 0;
	}

	if ($categoryName == '') {
		$events = new WP_Query(array(
			"post_type" => "event",
			"numberposts" => 3,
			"posts_per_page" => 3,
			"offset" => $eventsOffset
		));
	}else{
		$events = new WP_Query(array(
			"post_type" => "event",
			"tax_query" => array(array(
				'taxonomy'  => 'event-category',
	            'field'     => 'slug',
	            'terms'     => $categoryName
			)),
			"numberposts" => 3,
			"posts_per_page" => 3,
			"offset" => $eventsOffset
		));
	}

	if ($events->have_posts()) {
		while ($events->have_posts()) {
			$events->the_post();
			$startString = get_post_meta($event->ID)['_event_start_date'][0];
	        $startDateAndTime = explode(" ", $startString);
	        $startDate = implode(".", array_reverse(explode("-", $startDateAndTime[0])));
	        $startTime = substr($startDateAndTime[1], 0, 5);

	        echo "<div class='EventCard'>";
	        echo    "<div class='datetime'>";
	        echo        "<h4>" . $startDate . "</h4>";
	        echo        "<p>" . $startTime . "<p>";
	        echo    "</div>";
	        echo    "<div class='Cardcontent'>";
	        echo        "<h4>" . get_the_title() . "</h4>";
	        echo        "<p>" . wp_trim_words(get_the_content(), 10) . "</p>";
	        echo    "</div>";
	        echo    "<div class='readMore'>";
	        echo        "<a href='" . get_the_permalink() . "' class='dropbtn bold'>Lue lisää";
	        echo "<img class='cardArrow' src='" . get_stylesheet_directory_uri() . "/Icons/keyboard_arrow_right-24px.svg' alt='placeholder icon'>";
	        echo        "</a>";
	        echo    "</div>";
	        echo "</div>";
	    }
    }

    if ($events->found_posts - $eventsOffset > 3) {
    	echo "<a href='javascript:void(0)' id='loadMoreEvents' data-offset='" . ($eventsOffset + 3) . "'>Load more</a>";
    }

    wp_reset_postdata();
	exit;
}
add_action( 'wp_ajax_getFilteredEvents', 'getFilteredEvents' );
add_action( 'wp_ajax_nopriv_getFilteredEvents', 'getFilteredEvents' );

function getFilteredNews() {
	if (isset($_POST["categoryName"])) {
		$categoryName = $_POST["categoryName"];
	}else{
		$categoryName = "";
	}

	if (isset($_POST["newsOffset"])) {
		$newsOffset = $_POST["newsOffset"];
	}else{
		$newsOffset = 0;
	}

	if (isset($_POST["newsLimit"])) {
		$newsLimit = 4;
	}else{
		$newsLimit = 3;
	}

	if (isset($_POST["loadMoreButton"])) {
		$loadMoreButton = false;
	}else{
		$loadMoreButton = true;
	}

	if (!$loadMoreButton) {
		if ($categoryName == '') {
			$news = new WP_Query(array(
				"post_type" => "news"
			));
		}else{
			$news = new WP_Query(array(
				"post_type" => "news",
				"post__not_in" => array((int)$_POST["postId"]),
				"tax_query" => array(
						array(
			 				"taxonomy" => "news_categories",
			 				"field" => "name",
			 				"terms" => $categoryName
		 				)
					)
			));
		}
	}else{
			if ($categoryName == '') {
				$news = new WP_Query(array(
					"post_type" => "news",
					"numberposts" => $newsLimit,
					"posts_per_page" => $newsLimit,
					"offset" => $newsOffset
				));
			}else{
				$news = new WP_Query(array(
					"post_type" => "news",
					"numberposts" => $newsLimit,
					"posts_per_page" => $newsLimit,
					"offset" => $newsOffset,
					"tax_query" => array(
						array(
			 				"taxonomy" => "news_categories",
			 				"field" => "name",
			 				"terms" => $categoryName
		 				)
					)
				));
			}
	};

	if ($news->have_posts()) {
		while($news->have_posts()) {
			$news->the_post();
			echo "<div class='News'>";
	            echo "<img class='newsPhoto' src='" . get_the_post_thumbnail_url() . "' alt='placeholder icon' class='object-fit: cover'>";
	            echo "<div class='newsText'>";
	                echo "<p>" . get_the_date('d.m.Y') . "</p>";
	                echo "<h4>" . get_the_title() . "</h4>";


					if ( have_rows( 'singular_news_article_content' ) ) {
						while ( have_rows( 'singular_news_article_content' ) ) {
							the_row();
							if ( get_row_layout() == 'top_content_text' ) {
								echo "<p>" . wp_trim_words(get_sub_field( 'description' ), 10) . "</p>";
							}
						}
					}
	                echo "<div class='readMore'>";
	                    echo "<a href='" . get_the_permalink() . "' class='dropbtn'>Lue lisää";
	                        echo "<img class='cardArrow' src='" . get_stylesheet_directory_uri() . "/Icons/keyboard_arrow_right-24px.svg' alt='placeholder icon'>";
	                    echo "</a>";
	               echo " </div>";
	           echo " </div>";
	        echo "</div>";
    	}
    }

    if ($news->found_posts - $newsOffset > $newsLimit) {
    	echo "</div>"; //ZATVORI PRETHODNI DIV JER JE FLEX
    	echo "<a href='javascript:void(0)' id='loadMoreNews' data-offset='" . ($eventsOffset + $newsLimit) . "'>Load more</a>";
    }

    wp_reset_postdata();
	exit;
}
add_action( 'wp_ajax_getFilteredNews', 'getFilteredNews' );
add_action( 'wp_ajax_nopriv_getFilteredNews', 'getFilteredNews' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}



// Register Custom Post Type
function service_post_type() {

	$labels = array(
		'name'                  => _x( 'Post Services', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Post Service', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Services', 'text_domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Service Icon', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured icon', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured icon', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured icon', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		
	);
	$args = array(
		'label'                 => __( 'Post Service', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'service', $args );

	$labels = array(
		'name'                  => _x( 'Post News', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Post News Article', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'News', 'text_domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
		'archives'              => __( 'News Archives', 'text_domain' ),
		'attributes'            => __( 'News Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All News', 'text_domain' ),
		'add_new_item'          => __( 'Add News Article', 'text_domain' ),
		'add_new'               => __( 'Add News', 'text_domain' ),
		'new_item'              => __( 'New News Article', 'text_domain' ),
		'edit_item'             => __( 'Edit News Article', 'text_domain' ),
		'update_item'           => __( 'Update News', 'text_domain' ),
		'view_item'             => __( 'View News Article', 'text_domain' ),
		'view_items'            => __( 'View News', 'text_domain' ),
		'search_items'          => __( 'Search News', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'News featured image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		
	);
	$args = array(
		'label'                 => __( 'Post News', 'text_domain' ),
		'description'           => __( 'News', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats' ),
		'taxonomies'            => array( 'news_categories' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'news', $args );

}
add_action( 'init', 'service_post_type', 0 );

//NOVI TAX

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'News Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'News Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'News Categories', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'news_categories', array( 'news' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );