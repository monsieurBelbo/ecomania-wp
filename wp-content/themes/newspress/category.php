<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Newspress
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
            	<?php /* Display breadcrumb trail */ ?>
                <div id="breadcrumb">
                    <?php include("breadcrumb.php"); ?>
                </div><!-- #breadcrumb -->
				<?php
				/* Run the loop for the category page to output the posts.
				 */
				get_template_part( 'loop', 'category' );
				?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
