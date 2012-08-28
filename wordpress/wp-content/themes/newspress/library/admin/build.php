<div id="epanel">
	<div id="epanel-header" class="clearfix">
    	<img src="<?php bloginfo('template_directory'); ?>/library/admin/images/panel-logo.png" class="logo" border="0" />
    	<ul id="header-link-list">
        	<li class="hll-sf"><a href="http://wpcrunchy.com/support/" target="_blank">Visit Our Support Forum</a></li>
            <li class="hll-rcr"><a href="http://wpcrunchy.com/contact/" target="_blank">Request For Copyright Removal</a></li>
        </ul>
    </div>
    <div id="main" class="clearfix">
    	<div id="navigation">
        	<ul>
            	<?php if(in_array("general", $settings_navigation)) : ?>
            	<li><a href="#opt-general"><img src="<?php bloginfo('template_directory'); ?>/library/admin/images/general-icon.png" border="0" />General Settings</a></li>
                <?php endif; ?>
                <?php if(in_array("seo", $settings_navigation)) : ?>
                <li><a href="#opt-seo"><img src="<?php bloginfo('template_directory'); ?>/library/admin/images/seo-icon.png" border="0" />SEO Options</a></li>
                <?php endif; ?>
                <?php if(in_array("layout", $settings_navigation)) : ?>
                <li><a href="#opt-layout"><img src="<?php bloginfo('template_directory'); ?>/library/admin/images/layout-icon.png" border="0" />Layout Settings</a></li>
                <?php endif; ?>
                <?php if(in_array("advertisement", $settings_navigation)) : ?>
                <li><a href="#opt-ad"><img src="<?php bloginfo('template_directory'); ?>/library/admin/images/ad-icon.png" border="0" />Ad Management</a></li>
                <?php endif; ?>
                <?php if(in_array("integration", $settings_navigation)) : ?>
                <li><a href="#opt-integration"><img src="<?php bloginfo('template_directory'); ?>/library/admin/images/integration-icon.png" border="0" />Integration</a></li>
                <?php endif; ?>
                <?php if(in_array("support", $settings_navigation)) : ?>
                <li><a href="#opt-docs"><img src="<?php bloginfo('template_directory'); ?>/library/admin/images/support-icon.png" border="0" />Support Docs</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div id="container">
            <form id="buildform" name="buildform" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <?php foreach ($options as $value) : 
				switch($value['type']) {
					case 'container':
						settings_container_header($value['id']);
						break;
					case 'container_end':
						settings_container_footer();
						break;
					case 'section':
						settings_section_header($value['name']);
						break;
					case 'section_end':
						settings_section_footer();
						break;
					case 'content':
						settings_content_header();
						break;
					case 'content_end':
						settings_content_footer();
						break;
					case 'text':
						?><input title="<?php echo $value['description']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /><?php
						break;
					case 'textarea':
						?><textarea title="<?php echo $value['description']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?></textarea><?php
						break;
					case 'select':
						?><select title="<?php echo $value['description']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
            <?php foreach ($value['options'] as $key => $option) { ?>
                <option<?php if ( htmlspecialchars(get_option( $value['id'] )) == htmlspecialchars($key)) { echo ' selected="selected"'; } elseif (get_option( $value['id'] ) == "" && isset($value['std']) && $option == $value['std']) { echo ' selected="selected"'; } ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
            <?php } ?>
            </select><?php
						break;
					case 'select-switch':
						?><select title="<?php echo $value['description']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
            <?php foreach ($value['options'] as $option) { 
				$option = explode("//", $option); ?>
                <option<?php if ( $option[1] == htmlspecialchars(get_option( $value['id'] ))) { echo ' selected="selected"'; } elseif (get_option( $value['id'] ) == "" && isset($value['std']) && $value['std'] == $option[1]) { echo ' selected="selected"'; } ?> value="<?php echo $option[1]; ?>"><?php echo $option[0]; ?></option>
            <?php } ?>
            </select><?php
						break;
					case 'support':
						if(file_exists(TEMPLATEPATH . "/".$value['name'].".php")) {
							include(TEMPLATEPATH . "/".$value['name'].".php");
						}
						break;
					case 'divider':
						echo '<div class="divider"><!-- #empty --></div>';
						break;
					case 'debug-array':
						print_r($value['options']);
						break;
				}
			?>
            <?php endforeach; ?>
            <input type="hidden" id="action" name="action" value="save" />
		</form>
        </div>
        <div id="epanel-buttons" class="clearfix">
        	<input type="button" name="save_button" id="save_button" value="Save Changes" />
            <input type="button" name="defaults_button" id="defaults_button" value="Defaults" />
		</div>
    </div>
    <div id="epanel-footer"><!--empty --></div>
</div>
<?php
	function settings_container_header($id) {
		echo '<div id="opt-' . $id . '" class="primary-container">';
	}
	function settings_container_footer() {
		echo '</div>';
	}
	function settings_section_header($title) {
		echo '<div class="loption"><div class="lhead"><strong>' . $title . '</strong></div>';
	}
	function settings_section_footer() {
		echo '</div>';
	}
	function settings_content_header(){
		echo '<div class="lcontent">';
	}
	function settings_content_footer(){
		echo '</div>';
	}
?>