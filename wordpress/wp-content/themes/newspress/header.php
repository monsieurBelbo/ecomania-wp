<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Newspress
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php
        /*
       * Print the <title> tag based on what is being viewed.
       * We filter the output of wp_title() a bit -- see
       * newspress_filter_wp_title() in functions.php.
       */
        wp_title( '|', true, 'right' );

        ?></title>
    <?php
    /* Adding meta tags for better SEO
      * newspress_create_metadata() in functions.php.
      */
    newspress_create_metadata();
    ?>
    <link rel="shortcut icon" type="image/png" href="<?php bloginfo( 'template_directory' ); ?>/library/images/favicon.png">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <?php if(get_option("newspress_colorscheme") <> "" && get_option("newspress_colorscheme") <> "default") : $skin = get_option("newspress_colorscheme"); ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/library/color-scheme/<?php echo $skin; ?>/style-<?php echo $skin; ?>.css" />
    <?php endif; ?>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo( 'template_directory' ); ?>/library/css/nivo-slider.css"/>
    <!--[if IE]>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/style-ie.css" />
    <![endif]-->
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/scripts/jquery.nivo.slider.pack.js"></script>
    <?php
    /* Adding custom css file for customization if enabled
      * in theme option.
      */
    if(get_option("newspress_customcss") == "on") {
        echo '<link rel="stylesheet" type="text/css" media="all" href="'.get_bloginfo("template_directory").'/custom/custom.css" />';
    }
    ?>
    <!--[if IE]>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/custom/custom-ie.css" />
    <![endif]-->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php
    /* We add some JavaScript to pages with the comment form
      * to support sites with threaded comments (when in use).
      */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    /*
      * Adding robots and canonical url filter for better SEO
      * newspress_create_robots() and newspress_canonical_url() in functions.php.
      */
    newspress_create_robots();
    newspress_canonical_url();

    /* Always have wp_head() just before the closing </head>
      * tag of your theme, or you will break many plugins, which
      * generally use this hook to add elements to <head> such
      * as styles, scripts, and meta tags.
      */
    wp_head();

    if(get_option('newspress_customcss') == 'on') {
        $custom_css = 'custom';
    } else {$custom_css = '';}
    ?>
<script type="text/javascript">
	// added to avoid issues with missing variable.
        var paginateVal = new Object();
</script>

</head>
<body <?php body_class($custom_css); ?>>
<?php include_once("analyticstracking.php") ?>
<div id="wrapper" class="hfeed">
    <div id="header">
        <div style="float: right;">
            <div class="header-links">
                <div class="header-link link-trashlove" href="http://trashlove.com/"></div>
                <div class="header-link link-ecomania"></div>
                <div class="header-link link-greenbondi" href="http://www.greenbondi.com"></div>
                <div class="header-link link-greca" href="http://grecaweb.com/"></div>
            </div>
            <?php get_search_form(); ?>
        </div>
        <div id="masthead" class="clearfix">
            <div id="branding" role="banner">
                <a href="/">
                    <img src="<?php bloginfo('template_directory');?>/library/images/logo-ecomania.png"
                         border="0" style="position: relative;"/>
                </a>
            </div><!-- #branding -->

            <?php if(get_option("newspress_enable_banneradcode") == "enable") : ?>
            <div id="site-ads">
                <?php if(get_option("newspress_banneradcode") <> "") :
                echo stripslashes(get_option("newspress_banneradcode"));
            else :?>
                <a href="mailto:<?php bloginfo('admin_email'); ?>" title="Advertise Here"><img src="<?php bloginfo('template_directory'); ?>/library/images/ads-top.jpg" border="0" /></a>
                <?php endif; ?>
            </div><!-- #top ads -->
            <?php endif; ?> 

            <div id="access" class="access clearfix" role="navigation">
                <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
                <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'newspress' ); ?>"><?php _e( 'Skip to content', 'newspress' ); ?></a></div>
                <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
                <?php wp_nav_menu( array( 'container_class' => 'menu', 'menu_class' => 'sf-menu', 'theme_location' => 'primary-menu' ) ); ?>
            </div><!-- #access -->
        </div><!-- #masthead -->
    </div><!-- #header -->

    <?php
    /* Run the featured loop to output the featured posts.
          * If you want to overload this in a child theme then include a file
          * called featured.php and that will be used instead.
          */
    get_template_part( 'featured' );
    ?>

    <div id="main" class="clearfix">
        <div class="clearfix sectionHeader">

            <div class="sectionBox">
                <div class="sectionBoxInfo" id="tips-verdes">
                    <div class="sectionBoxInfoTitle">
                        <a href="/colabora/">Colaborá</a>
                    </div>
                </div>
            </div>

            <div class="sectionBox">
                <div class="sectionBoxInfo" id="directorio-verde">
                    <div class="sectionBoxInfoTitle">
                        <a href="/compras-verdes/">Compras Verdes</a>
                    </div>
                </div>
            </div>
            <div class="sectionBox">
                <div class="sectionBoxInfo" id="agenda">
                    <div class="sectionBoxInfoTitle">
                        <a href="/agenda/">Agenda</a>
                    </div>
                </div>
            </div>
            <div class="sectionBox"  style="float: right; margin-right: 0px">
                <div class="sectionBoxInfo" id="fest">
                    <div class="sectionBoxInfoTitle">
                        <a href="/fest">Fest</a>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" charset="utf-8">
            $(function() {
                $(".header-link").hover(function() {
                    $(this).addClass("hover");
                }, function() {
                    $(this).removeClass("hover");
                });

                $(".header-link").click(function() {
                    var href = $(this).attr("href");
                    if (href != null)
                        window.open(href);
                })
            });
            </script>
