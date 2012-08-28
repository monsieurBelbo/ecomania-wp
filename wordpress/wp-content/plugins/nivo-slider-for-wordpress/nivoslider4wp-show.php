<?php
	/*mostra o slide no site*/
	function nivoslider4wp_show() {
		if ( function_exists('plugins_url') )
			$url = plugins_url(plugin_basename(dirname(__FILE__)));
		else
			$url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));
		global $wpdb;
		$ns4wp_plugindir = ABSPATH.'wp-content/plugins/nivo-slider-for-wordpress/';
		$ns4wp_pluginurl = $url;
		$ns4wp_filesdir = ABSPATH.'/wp-content/uploads/nivoslider4wp_files/';
		$ns4wp_filesurl = get_option('siteurl').'/wp-content/uploads/nivoslider4wp_files/';

	?>
	<div id="slider">
				<?php $items = $wpdb->get_results("SELECT nivoslider4wp_id,nivoslider4wp_type,nivoslider4wp_text_headline,nivoslider4wp_image_link,nivoslider4wp_image_status FROM {$wpdb->prefix}nivoslider4wp WHERE nivoslider4wp_image_status = 1 OR nivoslider4wp_image_status IS NULL ORDER BY nivoslider4wp_order,nivoslider4wp_id"); ?>
				<?php foreach($items as $item) : ?>
						<?php
						if(!$item->nivoslider4wp_image_link){ ?>
						<img src="<?php echo $ns4wp_filesurl.$item->nivoslider4wp_id.'_s.'.$item->nivoslider4wp_type; ?>" alt="<?php echo stripslashes($item->nivoslider4wp_text_headline); ?>" title="<?php echo stripslashes($item->nivoslider4wp_text_headline); ?>"/>
						<?php } else { ?>
						<a href="<?php echo $item->nivoslider4wp_image_link;?>"><img src="<?php echo $ns4wp_filesurl.$item->nivoslider4wp_id.'_s.'.$item->nivoslider4wp_type; ?>" alt="<?php echo stripslashes($item->nivoslider4wp_text_headline); ?>" title="<?php echo stripslashes($item->nivoslider4wp_text_headline); ?>"/></a>
						<?php } ?>
				<?php endforeach; ?>
		</div>
	<?php
	}

	/*conteudo que ora para dentro do <head>*/
	function js_NivoSlider(){
	?>
		<?php
		}
		function css_NivoSlider(){
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo get_option('siteurl') . '/wp-content/plugins/nivo-slider-for-wordpress/css/nivoslider4wp.css'?>" />
		<style>
		#slider{
			width:<?php echo get_option('nivoslider4wp_width'); ?>px;
			height:<?php echo get_option('nivoslider4wp_height'); ?>px;
			background:transparent url(<?php echo plugins_url(plugin_basename(dirname(__FILE__))); ?>/css/images/loading.gif) no-repeat 50% 50%;
		}
		.nivo-caption {
			background:#<?php echo get_option('nivoslider4wp_backgroundCaption'); ?>;
			color:#<?php echo get_option('nivoslider4wp_colorCaption'); ?>;
		}
		</style>
	<?php
	}
	add_action('wp_head', 'css_NivoSlider');
	if(get_option('nivoslider4wp_js') == 'head'){
		add_action('wp_head', 'js_NivoSlider');
	}
		else
	{
		add_action('wp_footer', 'js_NivoSlider');
	}
?>