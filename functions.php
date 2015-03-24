<?php
/**
 * Twenty Fourteen functions and definitions
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
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see twentyfourteen_content_width()
 *
 * @since Twenty Fourteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfourteen_setup' ) ) :
/**
 * Twenty Fourteen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_setup() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'twentyfourteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'twentyfourteen_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'twentyfourteen_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function twentyfourteen_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Twenty Fourteen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'twentyfourteen_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function twentyfourteen_has_featured_posts() {
	return ! is_paged() && (bool) twentyfourteen_get_featured_posts();
}

/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'twentyfourteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );

/**
 * Register Lato Google font for Twenty Fourteen.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return string
 */
function twentyfourteen_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'twentyfourteen' ) ) {
//		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri(), array( 'genericons' ) );
	wp_enqueue_style( 'flexslider-style', get_template_directory_uri() . '/css/flexslider.css', array() );
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style', 'genericons' ), '20131205' );
    wp_enqueue_style( 'bootstrap-style' , 'http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css',array(),'');
	wp_style_add_data( 'twentyfourteen-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfourteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		wp_enqueue_script( 'twentyfourteen-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );

		wp_localize_script( 'twentyfourteen-slider', 'featuredSliderDefaults', array(
			'prevText' => __( 'Previous', 'twentyfourteen' ),
			'nextText' => __( 'Next', 'twentyfourteen' )
		) );
	}

	wp_enqueue_script( 'twentyfourteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140616', true );
	wp_enqueue_script( 'slider',get_template_directory_uri() . '/js/jquery.flexslider.js');
}
add_action( 'wp_enqueue_scripts', 'twentyfourteen_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );

if ( ! function_exists( 'twentyfourteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'twentyfourteen_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

	<div class="contributor">
		<div class="contributor-info">
<!--			<div class="contributor-avatar">--><?php echo get_avatar( $contributor_id, 132 ); ?><!--</div>-->
			<div class="contributor-summary">
				<h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
				<p class="contributor-bio">
					<?php echo get_the_author_meta( 'description', $contributor_id ); ?>
				</p>
				<a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
					<?php printf( _n( '%d Article', '%d Articles', $post_count, 'twentyfourteen' ), $post_count ); ?>
				</a>
			</div><!-- .contributor-summary -->
		</div><!-- .contributor-info -->
	</div><!-- .contributor -->

	<?php
	endforeach;
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Load script
 * */
function load_the_script(){
    wp_deregister_script('jquery');
    wp_register_script('jquery','http://libs.baidu.com/jquery/2.0.0/jquery.min.js');
    wp_enqueue_script('jquery');
}
add_filter('get_header','load_the_script');
/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}

function my_get_header(){
    $header_file_name = custom_header_footer();
    get_header($header_file_name);
}

function my_get_footer(){
    $footer_file_name = custom_header_footer();
    get_footer($footer_file_name);
}
function custom_header_footer(){
    $theme_name = '';
    if(wp_is_mobile() || is_weixin_browser()){
        if (is_weixin_browser() && !is_single()){
            $theme_name = 'mobile';
        }else if(is_single()){
            $theme_name = 'mobile-single';
        }else{
            $theme_name = 'mobile';
        }
    }else{
        //加载自定义style
//        $custom_style = get_template_directory_uri().'/style-custom.css';
//        wp_register_style('style-custom',$custom_style);
//        wp_enqueue_style('style-custom',$custom_style);
    }
    return $theme_name;
//    return wp_is_mobile() ? 'icalendar' : '';
}

function is_weixin_browser(){
    return strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Windows Phone') !== false ;
}
/*
 * @desc 自定义字段搜索
 * @param string $search 搜索字符串
 * @return string 搜索字符串
 * */
function custom_field_search($search){
    $s = $_GET['s'];
    if (!trim($s)) return $search;
//    if(preg_match('/[\d]+年\d+月\d+日/',$s)) {
//        $s = str_replace(array('年', '月', '日'), '', $s);
//    }
//    if (strtotime($s)){
//        $s = strtotime($s);
//        $search = "AND ( $s<= (CAST wp_postmeta.meta_value  AS bigint) OR $s >= (CAST wp_postmeta.meta_value  AS bigint)) ";
//     }else
    return $search;
}
//add_filter( 'posts_search', 'custom_field_search' );
function custom_search_where($where) { // put the custom fields into an array
    global $wpdb;
    if (is_admin()) return $where;
    $s = get_query_var('s');
    if (trim($s)){
    	$where = " AND ($wpdb->posts.post_status = 'publish') ";
    	$customs = array('wpcf-place', 'wpcf-address', 'wpcf-description','wpcf-organizer','wpcf-hosts');
    	$query = '';
    	$sep = '';
    	foreach($customs as $custom) {
        	$query .= $sep;//" OR (";
        	$query .= "(wp_postmeta.meta_key = '$custom')";
        	$query .= " AND (wp_postmeta.meta_value LIKE '%{$s}%')";
        	$query .= ")";
        	$sep = ' OR (';
    	}
    	$query = ' ('.$query;
    	$where .= " AND ({$query})";
    }
    if (!is_single() && !get_query_var('s')) {
    	$where.= " AND  wp_postmeta.meta_key =  'wpcf-start-time'";
    }
    return($where);
}
add_filter('posts_where', 'custom_search_where');
function custom_filed_join($join){
	if (!is_single() || get_query_var('s'))  {
		$join .= " INNER JOIN wp_postmeta ON (wp_posts.ID = wp_postmeta.post_id)";
	}
    return $join;
}

function queryOrderby($orderby_statement){
	if (! is_single() && !get_query_var('s')) {
		$orderby_statement = ' wp_postmeta.meta_value DESC';
	}
	return $orderby_statement;
}
add_filter('posts_join','custom_filed_join');
add_filter('posts_distinct', 'search_distinct');
add_filter( 'posts_orderby','queryOrderby');

function search_distinct() {
    return "DISTINCT"; 
}

add_filter('template_include', 'my_custom_template');
function my_custom_template($single)
{
    if (isset($_GET['city-list']) || isset($_GET['art-list'])) {
        $single = TEMPLATEPATH . '/content-city-list.php';
    }
    return $single;
}
if (ua_icalendar_app()){
    add_filter('gettext','archive_title');
}
function archive_title($translate){
    global $wp_query;
    if ($translate == '归档'){
        if (get_query_var('s')){
            return  get_query_var('s');
        }else if (isset($_GET[''])){
            return '我的收藏列表';
        }else if ($wp_query->query_vars['taxonomy']){
            $value    = get_query_var($wp_query->query_vars['taxonomy']);
            $term = get_term_by('slug',$value,$wp_query->query_vars['taxonomy']);
            return $term->name;
        }
    }
    return $translate;
}
/**
 * 获取轮播图片
 */
function get_slider_img(){
    if (ua_icalendar_app()){
        $query_img = new WP_Query();
        $args = array(
            'post_type'=>'post',
            'tag_id'=>300,
            'order'=>'DESC',
            'orderby'=>'ID'
        );
        $img_posts = $query_img->query($args);// 'tag=featured&post_type=post&order=DESC&limit=5');
        $html = '';
        if (count($img_posts)){
            $html.='<div class="flexslider icalendar-slider"><ul class="slides">';
            foreach ($img_posts as $img_post) {
                if ($img_post->post_type == 'post') {
                    $html .= '<li>' . get_the_post_thumbnail($img_post->ID, 'large') . '</li>';
                }
            }
            $html.='</ul></div>';
        }
        return $html;
    }
    return '';
}
/**
 * 查询置顶贴
 */ 
add_filter( 'the_posts', 'sticky_post_top' );
function sticky_post_top( $posts ) {
	$page = get_query_var('paged');
	if ($page > 1) return $posts;
    $sticky_posts = get_option( 'sticky_posts' );
	if ( is_main_query() && !is_single() && !is_admin() ) {
        $oldPosts = $posts;
		$post_nums = count($posts);
		$sticky_offset = 0;
		for ($i= 0; $i < count($post_nums) ; $i++){
			if ( in_array( $posts[$i]->ID, $sticky_posts ) ) {
				$sticky_post = $posts[$i];
				array_splice( $posts, $i, 1 );
				array_splice( $posts, $sticky_offset, 0, array($sticky_post) );
				$sticky_offset++;
				$offset = array_search($sticky_post->ID, $sticky_posts);
				unset( $sticky_posts[$offset] );
			}
		}
		if ( !empty( $sticky_posts) ) {
            global $wp_query;
            $stickArgs = array(
                'post__in' => $sticky_posts,
                'post_type' => $wp_query->query_vars['post_type'],
                'post_status' => 'publish',
                'tax_query' => $wp_query->tax_query->queries,
                'nopaging' => true
            );
            $stickies = get_posts( $stickArgs );
			foreach ( $stickies as $sticky_post ) {
				array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
				$sticky_offset++;
			}
		}
	}
	return $posts;
}

add_action('init', 'event_rewrite');
function event_rewrite() {
    global $wp_rewrite;
    add_rewrite_rule(
        'event/(\d+)/?',
        'index.php?post_type=event&p=$matches[1]',
        'top'
    );
}

add_filter('post_type_link', 'event_permalink', 1, 3);
function event_permalink($post_link, $id = 0, $leavename) {
    global $wp_rewrite;
    $post = &get_post($id);
    if ( is_wp_error( $post ) )
        return $post;
    if ($post->post_type != 'event') return $post_link;
    $permalink_structure = get_option( 'permalink_structure' );
    if (trim($permalink_structure) == '') return $post_link;
    $newlink = $wp_rewrite->get_extra_permastruct('event');
    $newlink = str_replace("%event%", $post->ID, $newlink);
    $newlink = home_url(user_trailingslashit($newlink));
    return $newlink;
}
/**
 * 设置样式 
 */

function set_sticky_class($classes) {
	if ( is_sticky()){
		$classes[] = 'sticky';
	}
	return $classes;
}
add_filter('post_class', 'set_sticky_class');

//add_filter( 'posts_request', 'dump_request' );
function dump_request( $input ) {
    var_dump($input);
    return $input;
}
/*fanzhanao 添加
 * @desc 对自定义字段值，加上标签和class
 * @param array|string $arr 要处理的字符串或者数组
 * @param string  $tagname  标签名 如 p,span,div etc
 * @param string  $class   样式class
 * @param Boolean $string  是否返回string
 * @return string | array
*/
function wrap_tag($arr,$tagname='p',$class='',$string = true){
    if (is_string($arr)){
        //$arr =preg_split("/[\s,;]+/",$arr);
	$arr = explode("\n",$arr);
    }
    $result = array();
    $begintag = '<'.$tagname .($class ? ' class="'.$class .'" ': ' ').'>';
    $endtag = '</'.$tagname.'>';
    if (!empty($arr)){
       while(list($k,$v) = each($arr)){
	  if (trim($v))
          	$result[] = ($begintag.$v.$endtag);
       }
    }
    return $string === false ?  $result : implode(' ',$result);
}

function add_sticky_scripts() {
  wp_enqueue_script( 'sticky_scripts', get_template_directory_uri() . '/js/sticky.js', array('jquery'), '1.0.0', true );
  wp_localize_script( 'sticky_scripts', 'StickyAjax', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'security' => wp_create_nonce( 'sticky_post' ),
    'StickyIds' => get_option ('sticky_posts')
  ));

}
//add_action( 'wp_enqueue_scripts', 'add_sticky_scripts' );
//add_action('wp_enqueue_scripts','add_icalendar_script');
//function add_icalendar_script(){
//    if (wp_is_mobile() && strpos($_SERVER['HTTP_USER_AGENT'], 'iArtCalendar') !== false  ){
//        wp_enqueue_script( 'icalendar_scripts', get_template_directory_uri() . '/js/icalendar.js', array('jquery'), '1.0.0', true );
//    }
//}

/**
 * 判断是否为icalendar ua
 * @return bool
 */
function ua_icalendar_app(){
    return (preg_match('/iArt\s+Calendar/',$_SERVER['HTTP_USER_AGENT']) > 0 && wp_is_mobile()) ? true : false;
}

function my_action_callback() {
  check_ajax_referer( 'sticky_post', 'security' );
  $postId = $_POST['post_ID'];
  if ($postId){
  	if ($_POST['sticky'] == 'sticky') {
  		stick_post( intval($postId) );
  	}else{
  		unstick_post( intval($postId));
  	}
  }
  echo $postId;
  die();
}
add_action( 'wp_ajax_my_action', 'my_action_callback' );


//function setArchiveTitle($title){
//    if (isset($_GET[''])){
//
//    }
//}

add_action('wp_footer','flex_slider');
function flex_slider(){
	if (is_single()) {
		echo <<<EOF
    <script type="text/javascript">
        $(document).ready(function(){
            if ($('.flexslider').length > 0){
                $('.flexslider').flexslider({"smoothHeight":true});
            }
        });
	</script>
EOF;
	}else{
		echo <<<EOF
    <script type="text/javascript">
        $(document).ready(function(){
            $('.post-thumbnail img').css('max-height','230px');
        });
	</script>
EOF;
	}
    
}
