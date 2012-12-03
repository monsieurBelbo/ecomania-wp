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
        <li id="ecomania-subsciption" class="widget-container banner-mag">
            <script src="http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=rsb&c=28&pli=5847822&PluID=0&w=300&h=250&ord=[timestamp]"></script>
			<noscript>
				<a href="http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=brd&FlightID=5847822&Page=&PluID=0&Pos=226" target="_blank"><img src="http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=bsr&FlightID=5847822&Page=&PluID=0&Pos=226" border=0 width=300 height=250></a>
			</noscript>
			<?php if (function_exists('nivoslider4wp_show')) { nivoslider4wp_show(); } ?>
        </li>

        <?php
            $key = 1;
            $newnggShortcodes = new NextGEN_Shortcodes;
            echo $newnggShortcodes->show_gallery( array("id"=>$key,"images"=>x,"template"=>"ads") );
        ?>

        <li id="twitter-2" class="widget-container">
            <h3 class="widget-title">Tweets & Shout</h3>
            <div class="widget-content">
                <script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
                <script>
                    new TWTR.Widget({
                        version: 2,
                        type: 'profile',
                        rpp: 5,
                        interval: 30000,
                        width: 269,
                        height: 300,
                        theme: {
                            shell: {
                                background: '#fafafa',
                                color: '#000000'
                            },
                            tweets: {
                                background: '#fafafa',
                                color: '#555555',
                                links: '#49a9a1'
                            }
                        },
                        features: {
                            scrollbar: true,
                            loop: false,
                            live: true,
                            behavior: 'all'
                        }
                    }).render().setUser('ecomaniatweets').start();
                </script>
            </div>
        </li>




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
                    <li><a href="#tab-tags">Nube de Tags</a></li>
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
                <h3 class="widget-title">Historia</h3>
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

<script type="text/javascript">
    //    See http://nivo.dev7studios.com/support/jquery-plugin-usage/
    $(window).load(function() {
        $('#slider').nivoSlider({
            effect: 'slideInLeft',
            pauseTime: 3000,
            directionNav: false,
            controlNav: true
        });
    });
</script>
