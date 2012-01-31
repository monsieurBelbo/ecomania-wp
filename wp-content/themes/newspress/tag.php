<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Obscure
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<?php /* Display breadcrumb trail */ ?>
                <div id="breadcrumb">
                    <?php include("breadcrumb.php"); ?>
                </div><!-- #breadcrumb -->

<?php
/* Run the loop for the tag archive to output the posts
 */
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
