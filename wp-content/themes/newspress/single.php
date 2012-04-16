<?php
/**
 * The Template for displaying all single posts.
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

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'newspress' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2><!-- .entry-title -->
            
					<div class="entry-meta clearfix">
					    <?php newspress_post_meta(); ?>
					    <div class="social_toolbar">
                            <div class="fb-like" data-href="http://www.ecomania.org.ar" data-send="false" data-layout="button_count" data-width="20" data-show-faces="true"></div>
                            <a href="https://twitter.com/share" class="twitter-share-button" data-via="ecomaniatweets">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                       </div>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'newspress' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'newspress' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'newspress' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
