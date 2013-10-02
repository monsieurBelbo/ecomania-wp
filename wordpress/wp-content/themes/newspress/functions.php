<?php
/**
 * newspress functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, newspress_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * @package WordPress
 * @subpackage Newspress
 */

/** Tell WordPress to run newspress_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'newspress_setup' );

if ( ! function_exists( 'newspress_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 */
function newspress_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary-menu' => __( 'Primary Navigation', 'newspress' )
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Larger images will be auto-cropped to fit, smaller ones will be ignored.
	set_post_thumbnail_size( 300, 300, true );
	
	// Load all custom widgets
	require_once(TEMPLATEPATH . '/widgets.php');
	
	// Remove some defaults
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link');
	remove_action('wp_head', 'next_post_rel_link');
	remove_action('wp_head', 'previous_post_rel_link');
}
endif;

/**
 * Get Theme Info - Credits: Joern Kretzschmar & Thematic
 */
 
$themeData = get_theme_data(TEMPLATEPATH . '/style.css');
$version = trim($themeData['Version']);
if(!$version)
	$version = "unknown";

/**
 * Set Theme Info in Constant
 */
 
define('THEMENAME', $themeData['Title']);
define('THEMEVERSION', $version);

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). newspress uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function newspress_filter_wp_title( $title, $separator ) {
	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;
	
	if(is_feed()) return;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'newspress' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'newspress' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'newspress' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'newspress_filter_wp_title', 10, 2 );

/**
 * Replace wp version to theme version.
 */

function newspress_wp_generator()
{
	echo '<meta name="generator" content="'.THEMENAME." ".THEMEVERSION.'" />';
}
add_filter('the_generator','newspress_wp_generator');

/**
 * SEO: Create meta data tags.
 */
function newspress_create_metadata() {
	if(is_home()) {
		if ( get_option('newspress_meta_description') <> "" ) { echo '<meta name="description" content="'.stripslashes(get_option('newspress_meta_description')).'" />' . "\n"; }
		if ( get_option('newspress_meta_keywords') <> "" ) { echo '<meta name="keywords" content="'.stripslashes(get_option('newspress_meta_keywords')).'" />' . "\n"; }
		if ( get_option('newspress_meta_author') <> "" ) { echo '<meta name="author" content="'.stripslashes(get_option('newspress_meta_author')).'" />' . "\n"; }
	}
}

/**
 * SEO: Create robots.
 */
function newspress_create_robots() {
	global $paged;

	if((is_home() && ($paged < 2 )) || is_front_page() || is_single() || is_page() || is_attachment()) {
		$content .= "<meta name=\"robots\" content=\"index,follow\" />";
	} elseif (is_search()) {
		$content .= "<meta name=\"robots\" content=\"noindex,nofollow\" />";
	} else {	
		$content .= "<meta name=\"robots\" content=\"noindex,follow\" />";
	}
	$content .= "\n";
	if (get_option('blog_public')) {
		echo apply_filters('newspress_create_robots', $content);
	}
}
 
/**
 * SEO: Create canonical url.
 */
function newspress_canonical_url() {
	if(get_option("newspress_canonical") <> "") {
		if ( is_singular() ) {
			$canonical_url .= '<link rel="canonical" href="' . get_permalink() . '" />';
			$canonical_url .= "\n";        
			echo apply_filters('newspress_canonical_url', $canonical_url);
		}
	}
}

/**
 * Load required javascript to wp_head().
 */
function newspress_head_scripts() {
	$scriptdir_start .= '<script type="text/javascript" src="';
	$scriptdir_start .= get_bloginfo('template_directory');
	$scriptdir_start .= '/library/scripts/';
	$scriptdir_end = '"></script>';
//	$scripts .= $scriptdir_start . 'jquery-1.7.1.min.js' . $scriptdir_end . "\n";
	$scripts .= $scriptdir_start . 'common.js' . $scriptdir_end . "\n";
	$scripts .= $scriptdir_start . 'hoverIntent.js' . $scriptdir_end . "\n";
	$scripts .= $scriptdir_start . 'superfish.js' . $scriptdir_end . "\n";
	$scripts .= $scriptdir_start . 'supersubs.js' . $scriptdir_end . "\n";
	$dropdown_options = $scriptdir_start . 'dropdowns.js' . $scriptdir_end . "\n";
	$scripts = $scripts . apply_filters('dropdown_options', $dropdown_options);
	$scripts .= $scriptdir_start . 'jquery.cycle.js' . $scriptdir_end . "\n";
	$scripts .= '<script type="text/javascript">' . "\n";
	$scripts .= '//<![CDATA[' . "\n";
	$scripts .= 'jQuery.noConflict();' . "\n";
	$scripts .= 'jQuery(document).ready(function(){' . "\n";
	$scripts .= 'jQuery(".commentlist li:last").css("border","0");' . "\n";
	$scripts .= 'jQuery("#featured .panel").hover(function(){jQuery(this).find(".panel-meta").stop().animate({top:0}, 150);}, function(){jQuery(this).find(".panel-meta").stop().animate({top:180}, 150);});' . "\n";
	$scripts .= 'var tabContainer = jQuery("#tab-boxes div");' . "\n";
	$scripts .= 'var tabNav = jQuery("#tab-nav a");' . "\n";
	$scripts .= 'tabContainer.hide().filter(":first").show();' . "\n";
	$scripts .= 'jQuery("#tab-nav a").click(function(){' . "\n";
	$scripts .= 'tabContainer.hide().filter(this.hash).show();' . "\n";
	$scripts .= 'tabNav.removeClass("selected");' . "\n";
	$scripts .= 'jQuery(this).addClass("selected");' . "\n";
	$scripts .= 'return false;' . "\n";
	$scripts .= '}).filter(":first").click();' . "\n";
	$scripts .= '});' . "\n";
	$scripts .= 'jQuery(window).load(function(){equalHeight();})' . "\n";
	$scripts .= '//]]>' . "\n";
	$scripts .= '</script>' . "\n";
	
	// Inset custom header script - via theme option
	if(get_option("newspress_enable_headercode") == "enable") {
		$scripts .= stripslashes(get_option("newspress_headercode")) . "\n";
	}
	
	// Print filtered scripts
	print apply_filters('newspress_head_scripts', $scripts);
	
}
add_action('wp_head','newspress_head_scripts');

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function newspress_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'newspress_page_menu_args' );

/**
 * Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu.
 */
function newspress_add_menuclass($ulclass) {
	return preg_replace('/<ul>/', '<ul class="sf-menu">', $ulclass, 1);
}
add_filter('wp_page_menu','newspress_add_menuclass');

/**
 * Add the proper class of menu container if wp_nav_menu is not set.
 */
function newspress_proper_containerclass($containerclass) {
	return preg_replace('/<div class="sf-menu">/', '<div class="menu">', $containerclass, 1);
}
add_filter('wp_page_menu','newspress_proper_containerclass');

/**
 * Add post and comment rss link to the first <ul> occurence in wp_page_menu and wp_nav_menu ( top-menu ).
 */
function newspress_add_rsslink($ulelement) {
	return preg_replace('/class="sf-menu">/', 'class="sf-menu"><li class="rss_link"><a href="'.get_bloginfo('comments_rss2_url').'">Comments</a></li><li class="rss_link"><a href="'.get_bloginfo('rss2_url').'">Posts</a></li>', $ulelement, 1);
}

/**
 * Add twitter and facebook links
 */

function newspress_add_sociallink($ulelement) {
    return preg_replace('/class="sf-menu">/', 'class="sf-menu"><li class="social_link twitter"><a href="https://twitter.com/#!/ecomaniatweets" target="_blank">Twitter</a></li><li class="social_link facebook"><a href="http://www.facebook.com/RevistaEcomania" target="_blank">Facebook</a></li><li class="social_link newsletter"><a href="http://eepurl.com/xae85" target="_blank">Newsletter</a></li>', $ulelement, 1);
}
add_filter('wp_nav_menu','newspress_add_sociallink');
add_filter('wp_page_menu','newspress_add_sociallink');

/**
 * Sets the post excerpt length to 40 characters.
 *
 * @return int
 */
function newspress_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'newspress_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @return string "Continue Reading" link
 */
function newspress_continue_reading_link() {
	return '<a class="continue_reading_link" href="'. get_permalink() . '">' . __( 'Seguir leyendo <span class="meta-nav">&raquo;</span>', 'newspress' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and newspress_continue_reading_link().
 *
 * @return string An ellipsis
 */
function newspress_auto_excerpt_more( $more ) {
	return ' &hellip;' . newspress_continue_reading_link();
}
add_filter( 'excerpt_more', 'newspress_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function newspress_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= newspress_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'newspress_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function newspress_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'newspress_remove_gallery_css' );

if ( ! function_exists( 'newspress_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function newspress_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-info clearfix">
            <div class="comment-avatar clearfix">
                <?php get_avatar( $comment, 48 ); ?>
            </div><!-- .comment-author .vcard -->
    
            <div class="comment-meta commentmetadata">
            	<span class="comment-author vcard"><?php comment_author_link(); ?></span>
                <?php
                    /* translators: 1: date, 2: time, 3: permalink */
                    printf( __( '%1$s at %2$s | <a href="#comment-%3$s">Permalink</a> | ', 'newspress' ), get_comment_date(),  get_comment_time(), get_comment_id() );
					comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                ?>
            </div><!-- .comment-meta .commentmetadata -->
        </div>

		<div class="comment-body"><?php comment_text(); ?></div>
        <?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'newspress' ); ?></em>
			<br />
		<?php endif; ?>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
    	<div id="comment-<?php comment_ID(); ?>">
        	<div class="comment-info clearfix">
            	<div class="comment-body">
					<p><?php _e( 'Pingback:', 'newspress' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'newspress'), ' ' ); ?></p>
				</div>
            </div>
		</div>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * @uses register_sidebar
 */
function newspress_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'newspress' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'newspress' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div></li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">',
	) );

	// Area 3, located in the footer.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'newspress' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'newspress' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'newspress' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'newspress' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'newspress' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'newspress' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running newspress_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'newspress_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function newspress_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'newspress_remove_recent_comments_style' );

if ( ! function_exists( 'newspress_post_utility' ) ) :
/**
 * Prints HTML with meta information for the current author, number of comments and categories.
 */
function newspress_post_utility() {
}
endif;

if ( ! function_exists( 'newspress_post_meta' ) ) :
/**
 * Prints HTML with meta information for the current post date and edit link.
 */
function newspress_post_meta($is_2col = false) {
	if(!is_attachment()) :
		printf( '<div class="datetime-link"><a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a></div>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		);
		if(!$is_2col) :
			echo '<div class="category-link">'.get_the_category_list( ', ' ).'</div>'; 
		endif;
	?> <div class="comments-link"><?php comments_popup_link( __( 'Dejar un comentario', 'newspress' ), __( '1 Comment', 'newspress' ), __( '% Comments', 'newspress' ) ); ?></div> <?php
	else:
		printf( __('<div class="published-link"><span class="%1$s">Published</span> %2$s', 'newspress'),
			'meta-prep meta-prep-entry-date',
			sprintf( '<span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span> |</div>',
				esc_attr( get_the_time() ),
				get_the_date()
			)
		);
		if ( wp_attachment_is_image() ) {
			$metadata = wp_get_attachment_metadata();
			printf( __( '<div class="attachment-link">Full size is %s pixels</div>', 'newspress'),
				sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
					wp_get_attachment_url(),
					esc_attr( __('Link to full-size image', 'newspress') ),
					$metadata['width'],
					$metadata['height']
				)
			);
		}
	endif;
}
endif;

/**
 * Here lies ol custom functions
 *
 * 1.
 * Add slider gallery shortcode - use jquery cycle
 */
function add_slider_gallery($atts) {
	extract(shortcode_atts(array(
		'id' => '',
		'fx' => 'fade',
		'timeout' => '5000',
	), $atts));
	
	echo '<script type="text/javascript" language="javascript">jQuery(document).ready(function(){ jQuery("#post_js_gallery_'.$id.'").cycle({ fx:"'.$fx.'", timeout:"'.$timeout.'", containerResize: false }); });</script>';
	echo '<div id="post_slider"><div id="post_js_gallery_'.$id.'" class="post_js_gallery">';
		$args = array(
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'numberposts' => -1,
			'post_status' => 'published',
			'post_parent' => $id
		);
		$attachments = get_posts($args);
		if($attachments) {
			foreach ($attachments as $attachment) {
				$img_url = wp_get_attachment_url($attachment->ID);
				echo '<a href="'.$img_url.'"><img src="'.get_bloginfo('template_directory')."/timthumb.php?src=".$img_url.'&w=600&h=250&zc=1" /></a>';
			}
		}
	echo '</div><div style="clear:both;"></div></div>';
}
add_shortcode('post_slider_gallery','add_slider_gallery');

/**
 * 2.
 * Display all recent comments.
 */
function newspress_recent_comments($no_comments = 5, $comment_len = 35) {
    global $wpdb;
	$request = "SELECT * FROM $wpdb->comments";
	$request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
	$request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''";
	$request .= " ORDER BY comment_date DESC LIMIT $no_comments";
	$comments = $wpdb->get_results($request);
	if ($comments) {
		foreach ($comments as $comment) {
			ob_start();
			?>
				<li>
					<a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo newspress_get_author_in_comment($comment); ?>:
					<span><?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?></span></a>
				</li>
			<?php
			ob_end_flush();
		}
	} else {
		echo '<li>'.__('No comments', 'newspress').'</li>';
	}
}
function newspress_get_author_in_comment($comment) {
	$author = "";
	if ( empty($comment->comment_author) )
		$author = __('Anonymous', 'newspress');
	else
		$author = $comment->comment_author;
	return $author;
}

/**
 * Handle IE8 compatibility.
 */
if (!is_admin())
	header('X-UA-Compatible: IE=EmulateIE7');
	
/**
 * Load theme options.
 */
$themename = "Newspress";
$pre = "newspress";
$settings_navigation = array('general', 'seo', 'layout', 'advertisement', 'integration', 'support');
	
$options = array();
	
$functions_path = TEMPLATEPATH . '/library/admin/';
	
define( OPTION_FILES, 'base.php' );
	
function startit() {
	global $themename, $options, $pre, $functions_path;
			
	if (function_exists('add_menu_page')) {
		$basename = basename( OPTION_FILES );
		add_theme_page( $themename." Options", "$themename Theme Options", 'edit_themes', 'base.php', 'build_options');
	}
}
	
function build_options() {
	global $themename, $pre, $functions_path, $options, $settings_navigation;
	$page = $_GET["page"];
	include( $functions_path . '/options/' . $page );
	if ( isset($_GET['page']) && $_GET['page'] == "base.php" ) {
		if ( isset($_REQUEST['action']) ) {
			if ( 'save' == $_REQUEST['action'] ) {
				foreach ($options as $value) {
					if( isset( $value['id'] ) ) { 
						if( isset( $_REQUEST[ $value['id'] ] ) ) {
							if ($value['type'] == 'textarea' || $value['type'] == 'text') update_option( $value['id'], stripslashes($_REQUEST[$value['id']]) );
							elseif ($value['type'] == 'select' || $value['type'] == 'select-switch') update_option( $value['id'], htmlspecialchars($_POST[$value['id']]) );
							else update_option( $value['id'], $_POST[$value['id']] );
						}
					}
				}
				header("Location: themes.php?page=base.php&saved=true");
				die;	
			} else if( 'reset' == $_REQUEST['action'] ) {
				foreach ($options as $value) {
					if (isset($value['id'])) {
						delete_option( $value['id'] );
						if (isset($value['std'])) $$value['id'] = $value['std'];
					}
				}
				header("Location:themes.php?page=base.php&reset=true");
				die;
			}
		}
	}
	if(isset($_GET['reset']) && $_GET['reset'] == true) echo '<div id="action_info">' .$themename. ' configiruation has been reset back to defaults.</div>';
	include( $functions_path . '/build.php' );
}
	
function build_admin_head() {
	global $functions_path;
	
	if ('themes.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/library/admin/build.css" media="screen" />';
		?>
        <script type="text/javascript" src="<?php bloginfo("template_directory"); ?>/library/admin/js/epanel.js"></script>
		<script type="text/javascript" language="javascript">
			jQuery(document).ready(function(){
				//= Tipsy
				jQuery('select, input[type="text"], textarea').tipsy({gravity: 'n'});
				
				//facebox
				jQuery('a[rel*=facebox]').facebox({
					loadingImage : '<?php bloginfo("template_directory"); ?>/library/admin/images/loading.gif',
					closeImage : '<?php bloginfo("template_directory"); ?>/library/admin/images/closebox.png'
				});
				//= Navigation Tabs
				var navContainer = jQuery("#epanel #navigation").find("a");
				var optContainer = jQuery("#epanel #container").find(".primary-container");
				
				optContainer.hide().filter(':first').show();
				jQuery("#navigation a").click(function(){
					optContainer.hide();
					optContainer.filter(this.hash).css("margin-top","50px");
					optContainer.filter(this.hash).animate({ 'margin-top': '0px', opacity: 'show' }, "normal");
					navContainer.parent().removeClass("nav-selected");
					jQuery(this).parent().addClass("nav-selected");
					jQuery(this).parent()
					return false;
				}).filter(':first').click();
				
				jQuery('#defaults_button').click(function(e){
					var reset_settings = confirm("Are your sure to reset the settings?");
					if(!reset_settings){return false;}
					jQuery('#action').val("reset");
					
					var options_fromform = jQuery('#buildform').serialize();
					e.preventDefault();
					jQuery.facebox(function(){
						jQuery.ajax({
							type: "POST",
							url: "themes.php?page=base.php",
							data: options_fromform,
							success: function(response){
								window.location.href = "themes.php?page=base.php&reset=true";
							},
							error: function(err){
								jQuery.facebox("Error!");
							}
						});	
					});
				});	
				jQuery('#save_button').click(function(e){
					var options_fromform = jQuery('#buildform').serialize();
					var save_button = jQuery(this);
					
					e.preventDefault();
					jQuery.facebox(function(){
						jQuery.ajax({
							type: "POST",
							url: "themes.php?page=base.php",
							data: options_fromform,
							success: function(response){
								jQuery.facebox('Settings Saved!');
								setTimeout(function(){
									jQuery(document).trigger('close.facebox');
								},1500);
							},
							error: function(err){
								jQuery.facebox("Error!");
							}
						});
					});	
					return false;
				});
			});
		</script>
		<?php
	}  //end of theme accesibility mode
}

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if(empty($first_img)){ //Defines a default image
        $first_img = "/images/default.jpg";
    }
    return $first_img;
}
	
add_action('admin_menu', 'startit');
add_action('admin_head', 'build_admin_head');
?>
