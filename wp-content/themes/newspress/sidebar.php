<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Newspress
 */
?>

		<div id="sidebar" class="widget-area" role="complementary">
			<ul class="xoxo">

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
    		<li id="tabs" class="widget-container widget_newspress_tabs">
            	<ul id="tab-nav">
                	<li><a href="#tab-latest">Latest</a></li>
                    <li><a href="#tab-comments">Comments</a></li>
                    <li><a href="#tab-tags">Tags</a></li>
                </ul>
            	<div id="tab-boxes">
                    <div id="tab-latest" class="widget-content">
                        <ul>
                            <?php $recent_post = new WP_Query('showposts=5'); if ($recent_post->have_posts()) : while ($recent_post->have_posts()) : $recent_post->the_post(); ?>
                            <li class="clearfix">
                            	<?php if(has_post_thumbnail( $post->ID )) : $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ); ?>
                                	<img src="<?php bloginfo("template_directory"); ?>/timthumb.php?src=<?php echo $image[0]; ?>&w=48&h=48&zc=1" border="0" alt="<?php the_title(); ?>" />
                                <?php endif; ?>
                                <a <?php if($image <> "") { echo 'class="has_thumb"'; } ?> href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                <span <?php if($image <> "") { echo 'class="has_thumb"'; } ?>><?php the_time('F jS, Y'); ?></span>
                            </li>
                            <?php $image = ''; endwhile; endif; ?>
                        </ul>
                    </div>
                    
                    <div id="tab-comments" class="widget-content">
                        <ul>
                            <?php newspress_recent_comments(); ?>
                        </ul>
                    </div>
                    
                    <div id="tab-tags" class="widget-content">
                        <ul>
                            <?php wp_tag_cloud(', '); ?>
                        </ul>
                    </div>
                </div>
			</li>

			<li id="archives" class="widget-container">
            	<h3 class="widget-title"><?php _e( 'Archives', 'newspress' ); ?></h3>
                <div class="widget-content">
                    <ul>
                        <?php wp_get_archives( 'type=monthly' ); ?>
                    </ul>
				</div>
			</li>

			<li id="meta" class="widget-container">
            	<h3 class="widget-title"><?php _e( 'Categories', 'newspress' ); ?></h3>
            	<div class="widget-content">
                    <ul>
                        <?php wp_list_categories( 'title_li=&hide_empty=0&exclude=1' ); ?>
                    </ul>
				</div>
			</li>

		<?php endif; // end primary widget area ?>
			</ul>
		</div><!-- #sidebar .widget-area -->
