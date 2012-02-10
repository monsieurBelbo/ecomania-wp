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
				Oops!
			</div><!-- #breadcrumb -->
				<div id="post-0" class="post no-results not-found">
	            	<h2 class="entry-title"><?php _e( 'Nada encontrado', 'newspress' ); ?></h2><!-- .entry-title -->
					<div class="entry-content">
						<p><?php _e( 'Parece que no econtramos ninguna entrada para lo que estás buescando. ¿Probaste buscando con otras palabras?', 'newspress' ); ?></p>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
