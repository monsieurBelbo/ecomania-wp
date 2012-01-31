<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Newspress
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) : ?>
				<?php /* Display breadcrumb trail */ ?>
                <div id="breadcrumb">
                    <?php include("breadcrumb.php"); ?>
                </div><!-- #breadcrumb -->
				<?php
				/* Run the loop for the search to output the results.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
			<?php /* Display breadcrumb trail */ ?>
			<div id="breadcrumb">
				You just found our 404 error page.
			</div><!-- #breadcrumb -->
				<div id="post-0" class="post no-results not-found">
	            	<h2 class="entry-title"><?php _e( 'Nothing Found', 'newspress' ); ?></h2><!-- .entry-title -->
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'newspress' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
