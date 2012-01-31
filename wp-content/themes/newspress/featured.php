<?php
/**
 * The featured posts template file.
 *
 *
 * @package WordPress
 * @subpackage Newspress
 */

remove_filter( 'excerpt_more', 'newspress_auto_excerpt_more' );
?>
<?php if(get_option('newspress_display_postsgallery') == "on") : $is_empty = true; ?>
<div id="featured" class="clearfix">
	<?php $featured_post = new WP_Query('showposts=4&cat=' . get_option("newspress_featured_category"));
		if ($featured_post->have_posts()) : while ($featured_post->have_posts()) : $featured_post->the_post(); 
		if(has_post_thumbnail( $post->ID )) : $is_empty = false; ?>
	<div class="panel">
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
		<img id="thumbnail-<?php echo $post->ID; ?>" src="<?php bloginfo("template_directory"); ?>/timthumb.php?src=<?php echo $image[0]; ?>&w=220&h=250&zc=1" border="0" />
		<div class="panel-meta">
			<h3><a href="<?php the_permalink(); ?>" title="Continue reading <?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<p><?php echo get_the_excerpt(); ?></p>
		</div>
	</div>
	<?php endif; endwhile; endif; if($is_empty) { echo '<p align="center" style="padding:5px; margin:0;">Eh! Nothing in here?</p>'; } wp_reset_query(); ?>
</div><!-- #featured posts -->
<?php endif;
	add_filter( 'excerpt_more', 'newspress_auto_excerpt_more' );
?>