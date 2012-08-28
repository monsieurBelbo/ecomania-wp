<?php
/**
 * Contains all newspress custom widget.
 *
 * 1.
 * Newspress Tabs ( latest posts, recent comments, tags cloud )
 */
class newspress_widget_tabs {
	function show_newspress_widget_tabs() {
		$settings = get_option( 'tabs_sidebar_widget' );
		$posts_no = $settings['posts_no'] <> "" ? $settings['posts_no'] : 5;
		$comments_no = $settings['comments_no'] <> "" ? $settings['comments_no'] : 5;
	?>
    <li id="tabs" class="widget-container widget_newspress_tabs">
		<ul id="tab-nav">
			<li><a href="#tab-latest">Latest</a></li>
			<li><a href="#tab-comments">Comments</a></li>
			<li><a href="#tab-tags">Tags</a></li>
		</ul><!-- #tab-nav -->
		<div id="tab-boxes">
			<div id="tab-latest" class="widget-content">
				<ul>
					<?php $recent_post = new WP_Query('showposts=' . $posts_no . '&caller_get_posts=1'); if ($recent_post->have_posts()) : while ($recent_post->have_posts()) : $recent_post->the_post(); ?>
					<li class="clearfix">
						<?php if(has_post_thumbnail( $post->ID )) : $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ); ?>
							<img src="<?php bloginfo("template_directory"); ?>/timthumb.php?src=<?php echo $image[0]; ?>&w=48&h=48&zc=1" border="0" alt="<?php the_title(); ?>" />
						<?php endif; ?>
						<a <?php if($image <> "") { echo 'class="has_thumb"'; } ?> href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						<span <?php if($image <> "") { echo 'class="has_thumb"'; } ?>><?php the_time('F jS, Y'); ?></span>
					</li>
					<?php $image = ''; endwhile; endif; ?>
				</ul>
			</div><!-- #tab-latest -->
						
			<div id="tab-comments" class="widget-content">
				<ul>
					<?php newspress_recent_comments($comments_no); ?>
				</ul>
			</div><!-- #tab-comments -->
						
			<div id="tab-tags" class="widget-content">
				<ul>
					<?php wp_tag_cloud(', '); ?>
				</ul>
			</div><!-- #tab-tags -->
		</div><!-- #tab-boxes -->
	</li><!-- #tabs -->
	<?php
	}
	
	function newspress_widget_tabs_control() {
		$settings = get_option( 'tabs_sidebar_widget' );
	
		if( isset( $_POST[ 'tabs_sidebar_widget' ] ) ) {
			$settings[ 'posts_no' ] = stripslashes( $_POST[ 'posts_no' ] );
			$settings[ 'comments_no' ] = stripslashes( $_POST[ 'comments_no' ] );
			update_option( 'tabs_sidebar_widget', $settings );
		}
		$posts_no = $settings['posts_no'] <> "" ? $settings['posts_no'] : 5;
		$comments_no = $settings['comments_no'] <> "" ? $settings['comments_no'] : 5;
	?>
		<p>
			<label for="posts_no">Number of post to show:</label><br />
            <select id="posts_no" name="posts_no">
            	<?php for($i = 1; $i <= 10; $i++) : ?>
            	<option <?php if($posts_no == $i){ echo "selected"; } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select><br/>
            <label for="comments_no">Number of comments to show:</label><br />
            <select id="comments_no" name="comments_no">
            	<?php for($i = 1; $i <= 10; $i++) : ?>
            	<option <?php if($comments_no == $i){ echo "selected"; } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
		</p>
		<input type="hidden" id="tabs_sidebar_widget" name="tabs_sidebar_widget" value="1" />
	<?php
	}
}
if(function_exists('register_sidebar_widget')){ register_sidebar_widget('Newspress Tabs', array('newspress_widget_tabs', 'show_newspress_widget_tabs')); }
if (function_exists('register_widget_control')){ register_widget_control( 'Newspress Tabs', array('newspress_widget_tabs', 'newspress_widget_tabs_control'), 300, 200 ); }


/**
 * 2.
 * Newspress site and social subscription
 */
class newspress_widget_subscription {
	function show_newspress_widget_subscription() {
		$settings = get_option( 'subscription_sidebar_widget' );
		$rss = $settings['rss'] <> "" ? $settings['rss'] : get_bloginfo("rss2_url");
		$email = $settings['email'] <> "" ? $settings['email'] : "javascript:alert('Not yet configure');";
		$twitter = $settings['twitter'] <> "" ? $settings['twitter'] : "http://twitter.com";
		$facebook = $settings['facebook'] <> "" ? $settings['facebook'] : "http://facebook.com";
	?>
    	<li id="site_social_subscription" class="widget-container">
			<div class="widget-content">
            	<?php if($settings['is_sRSS'] == "true") : ?>
            	<div class="subscription_link clearfix">
                	<img src="<?php bloginfo('template_directory'); ?>/library/images/sRSS.png" border="0" />
                    <span><a href="<?php echo $rss; ?>">Subscribe via RSS</a></span>
                </div>
                <?php endif; ?>
                
                <?php if($settings['is_sEmail'] == "true") : ?>
                <div class="subscription_link clearfix">
                	<img src="<?php bloginfo('template_directory'); ?>/library/images/sEmail.png" border="0" />
                    <span><a href="<?php echo $email; ?>">Subscribe via Email</a></span>
                </div>
                <?php endif; ?>
                
                <?php if($settings['is_sTwitter'] == "true") : ?>
                <div class="subscription_link clearfix">
                	<img src="<?php bloginfo('template_directory'); ?>/library/images/sTwitter.png" border="0" />
                    <span><a href="<?php echo $twitter; ?>">Follow us on twitter</a></span>
                </div>
                <?php endif; ?>
                
                <?php if($settings['is_sFacebook'] == "true") : ?>
                <div class="subscription_link clearfix">
                	<img src="<?php bloginfo('template_directory'); ?>/library/images/sFacebook.png" border="0" />
                    <span><a href="<?php echo $facebook; ?>">Join us on facebook</a></span>
                </div>
                <?php endif; ?>
			</div>
		</li>
    <?php
	}
	
	function newspress_widget_subscription_control() {
		$settings = get_option( 'subscription_sidebar_widget' );
	
		if( isset( $_POST[ 'subscription_sidebar_widget' ] ) ) {
			$settings[ 'rss' ] = stripslashes( $_POST[ 'rss' ] );
			$settings[ 'email' ] = stripslashes( $_POST[ 'email' ] );
			$settings[ 'twitter' ] = stripslashes( $_POST[ 'twitter' ] );
			$settings[ 'facebook' ] = stripslashes( $_POST[ 'facebook' ] );
			$settings[ 'is_sRSS' ] = stripslashes( $_POST[ 'is_sRSS' ] );
			$settings[ 'is_sEmail' ] = stripslashes( $_POST[ 'is_sEmail' ] );
			$settings[ 'is_sTwitter' ] = stripslashes( $_POST[ 'is_sTwitter' ] );
			$settings[ 'is_sFacebook' ] = stripslashes( $_POST[ 'is_sFacebook' ] );
			update_option( 'subscription_sidebar_widget', $settings );
		}
		$settings[ 'is_sRSS' ] = $settings['is_sRSS'] <> "" ? $settings['is_sRSS'] : 1;
		$settings[ 'is_sEmail' ] = $settings['is_sEmail'] <> "" ? $settings['is_sEmail'] : 1;
		$settings[ 'is_sTwitter' ] = $settings['is_sTwitter'] <> "" ? $settings['is_sTwitter'] : 1;
		$settings[ 'is_sFacebook' ] = $settings['is_sFacebook'] <> "" ? $settings['is_sFacebook'] : 1;
	?>
		<p>
        	<!-- =rss -->
			<label for="is_sRSS">Show RSS Link:</label>
            <select id="is_sRSS" name="is_sRSS">
            	<?php
				 $opt = array("false","true");
				 for($i = 1; $i >= 0; $i--) : ?>
            	<option <?php if($settings[ 'is_sRSS' ] == $opt[$i]){ echo "selected"; } ?> value="<?php echo $opt[$i]; ?>"><?php echo $opt[$i]; ?></option>
                <?php endfor; ?>
            </select><br/>
            <label for="rss">RSS Feed URL:</label><br />
            <input type="text" value="<?php echo $settings[ 'rss' ]; ?>" name="rss" id="rss" /><br /><br />
            
            <!-- =email -->
            <label for="is_sEmail">Show Email Link:</label>
            <select id="is_sEmail" name="is_sEmail">
            	<?php
				 $opt = array("false","true");
				 for($i = 1; $i >= 0; $i--) : ?>
            	<option <?php if($settings[ 'is_sEmail' ] == $opt[$i]){ echo "selected"; } ?> value="<?php echo $opt[$i]; ?>"><?php echo $opt[$i]; ?></option>
                <?php endfor; ?>
            </select><br/>
            <label for="email">Email Subscription URL:</label><br />
            <input type="text" value="<?php echo $settings[ 'email' ]; ?>" name="email" id="email" /><br /><br />
            
            <!-- =twitter -->
            <label for="is_sTwitter">Show Twitter Link:</label>
            <select id="is_sTwitter" name="is_sTwitter">
            	<?php
				 $opt = array("false","true");
				 for($i = 1; $i >= 0; $i--) : ?>
            	<option <?php if($settings[ 'is_sTwitter' ] == $opt[$i]){ echo "selected"; } ?> value="<?php echo $opt[$i]; ?>"><?php echo $opt[$i]; ?></option>
                <?php endfor; ?>
            </select><br/>
            <label for="twitter">Full Twitter URL:</label><br />
            <input type="text" value="<?php echo $settings[ 'twitter' ]; ?>" name="twitter" id="twitter" /><br /><br />
            
            <!-- =facebook -->
            <label for="is_sFacebook">Show Facebook Link:</label>
            <select id="is_sFacebook" name="is_sFacebook">
            	<?php
				 $opt = array("false","true");
				 for($i = 1; $i >= 0; $i--) : ?>
            	<option <?php if($settings[ 'is_sFacebook' ] == $opt[$i]){ echo "selected"; } ?> value="<?php echo $opt[$i]; ?>"><?php echo $opt[$i]; ?></option>
                <?php endfor; ?>
            </select><br/>
            <label for="facebook">Full Facebook URL:</label><br />
            <input type="text" value="<?php echo $settings[ 'facebook' ]; ?>" name="facebook" id="facebook" />
		</p>
		<input type="hidden" id="subscription_sidebar_widget" name="subscription_sidebar_widget" value="1" />
	<?php
	}
}
if(function_exists('register_sidebar_widget')){ register_sidebar_widget('Newspress Subscription', array('newspress_widget_subscription', 'show_newspress_widget_subscription')); }
if (function_exists('register_widget_control')){ register_widget_control( 'Newspress Subscription', array('newspress_widget_subscription', 'newspress_widget_subscription_control'), 300, 200 ); }


/**
 * 3.
 * Newspress Video Embed
 */
class newspress_widget_video_embed {
	function show_newspress_widget_video_embed() {
		$settings = get_option( 'video_embed_sidebar_widget' );
	?>
    	<li id="video_embed" class="widget-container">
        	<?php if($settings['video_embed_title'] <> "") : ?>
            	<h3 class="widget-title"><?php echo stripslashes($settings['video_embed_title']); ?></h3>
			<?php endif; ?>
			<div class="widget-content">
            <?php
            	$embed = stripslashes($settings['video_embed']);
				$embed = $embed <> "" ? $embed : "No video code found!";
				$embed = preg_replace('/width="(.*?)"/', 'width="264"', $embed);
				$embed = preg_replace('/height="(.*?)"/', 'width="200"', $embed);
				
				echo $embed;
			?>
			</div>
		</li>
    <?php
	}
	
	function newspress_widget_video_embed_control() {
		$settings = get_option( 'video_embed_sidebar_widget' );
	
		if( isset( $_POST[ 'video_embed_sidebar_widget' ] ) ) {
			$settings[ 'video_embed_title' ] = stripslashes( $_POST[ 'video_embed_title' ] );
			$settings[ 'video_embed' ] = stripslashes( $_POST[ 'video_embed' ] );
			update_option( 'video_embed_sidebar_widget', $settings );
		}
	?>
		<p>
        	<label for="video_embed_title">Title:</label><br />
            <input type="text" id="video_embed_title" name="video_embed_title" value="<?php echo $settings['video_embed_title']; ?>" /><br/><br/>
			<label for="video_embed">Input video embed code below:</label><br />
            <textarea id="video_embed" name="video_embed" cols="30" rows="10"><?php echo $settings['video_embed']; ?></textarea>
		</p>
		<input type="hidden" id="video_embed_sidebar_widget" name="video_embed_sidebar_widget" value="1" />
	<?php
	}
}
if(function_exists('register_sidebar_widget')){ register_sidebar_widget('Newspress Video Embed', array('newspress_widget_video_embed', 'show_newspress_widget_video_embed')); }
if (function_exists('register_widget_control')){ register_widget_control( 'Newspress Video Embed', array('newspress_widget_video_embed', 'newspress_widget_video_embed_control'), 300, 200 ); }


/**
 * 4.
 * Newspress Search (Replace the default)
 */
class newspress_widget_search {
	function show_newspress_widget_search() {
		$settings = get_option( 'search_sidebar_widget' );
	?>
    	<li id="widget_search" class="widget-container">
        	<?php if($settings['search_title'] <> "") : ?>
            	<h3 class="widget-title"><?php echo stripslashes($settings['search_title']); ?></h3>
			<?php endif; ?>
			<div class="widget-content">
            	<form id="searchform" method="get" action="<?php bloginfo('url'); ?>"> 
					<input type="text" name="s" id="s" class="search_term <?php if($settings['has_button'] == "false") { echo "no_button"; } ?>" value="Type in keyword and hit Enter..." onblur="if (this.value == '') {this.value = 'Type in keyword and hit Enter...';}"  onfocus="if (this.value == 'Type in keyword and hit Enter...') {this.value = '';}" />
                    <?php if($settings['has_button'] == "true") : ?>
                    <input type="submit" class="search_button" value="Search" />
                    <?php endif; ?>
				</form>
			</div>
		</li>
    <?php
	}
	
	function newspress_widget_search_control() {
		$settings = get_option( 'search_sidebar_widget' );
	
		if( isset( $_POST[ 'search_sidebar_widget' ] ) ) {
			$settings[ 'search_title' ] = stripslashes( $_POST[ 'search_title' ] );
			$settings[ 'has_button' ] = stripslashes( $_POST[ 'has_button' ] );
			update_option( 'search_sidebar_widget', $settings );
		}
	?>
		<p>
        	<label for="search_title">Title:</label><br />
            <input type="text" id="search_title" name="search_title" value="<?php echo $settings['search_title']; ?>" /><br/><br/>
			<label for="has_button">Show Search Button:</label>
            <select id="has_button" name="has_button">
            	<?php
				 $opt = array("false","true");
				 for($i = 1; $i >= 0; $i--) : ?>
            	<option <?php if($settings[ 'has_button' ] == $opt[$i]){ echo "selected"; } ?> value="<?php echo $opt[$i]; ?>"><?php echo $opt[$i]; ?></option>
                <?php endfor; ?>
            </select>
		</p>
		<input type="hidden" id="search_sidebar_widget" name="search_sidebar_widget" value="1" />
	<?php
	}
}
if(function_exists('register_sidebar_widget')){ register_sidebar_widget('Search', array('newspress_widget_search', 'show_newspress_widget_search')); }
if (function_exists('register_widget_control')){ register_widget_control( 'Search', array('newspress_widget_search', 'newspress_widget_search_control'), 300, 200 ); }

/**
 * 5.
 * Newspress Text Widget No Title
 */
class newspress_widget_textnotitle {
	function show_newspress_widget_textnotitle() {
		$settings = get_option( 'textnotitle_sidebar_widget' );
	?>
    	<li id="widget_text" class="widget-container">
			<div class="widget-content">
            	<div class="textwidget"><?php echo stripslashes($settings['textnotitle_text']); ?></div>
			</div>
		</li>
    <?php
	}
	
	function newspress_widget_textnotitle_control() {
		$settings = get_option( 'textnotitle_sidebar_widget' );
	
		if( isset( $_POST[ 'textnotitle_sidebar_widget' ] ) ) {
			$settings[ 'textnotitle_text' ] = stripslashes( $_POST[ 'textnotitle_text' ] );
			update_option( 'textnotitle_sidebar_widget', $settings );
		}
	?>
		<p>
            <textarea id="textnotitle_text" name="textnotitle_text" class="widefat" rows="16" cols="20"><?php echo stripslashes($settings['textnotitle_text']); ?></textarea>
		</p>
		<input type="hidden" id="textnotitle_sidebar_widget" name="textnotitle_sidebar_widget" value="1" />
	<?php
	}
}
if(function_exists('register_sidebar_widget')){ register_sidebar_widget('Text Widget No Title', array('newspress_widget_textnotitle', 'show_newspress_widget_textnotitle')); }
if (function_exists('register_widget_control')){ register_widget_control( 'Text Widget No Title', array('newspress_widget_textnotitle', 'newspress_widget_textnotitle_control'), 300, 200 ); }

?>