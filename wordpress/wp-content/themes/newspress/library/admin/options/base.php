<?php

	/*	DEFINE
	---------------------------
	*/
	$categories = get_categories('hide_empty=0');
	$allcaregory = array();
	foreach ($categories as $category) {
		$allcaregory[$category->cat_ID] = $category->cat_name;
	}
	
	$pages = get_pages(); 
	$allpage = array();
	foreach ($pages as $page) {
		$allpage[$page->ID] = $page->post_title;
	}
		
	/*	GENERAL SETTINGS
	---------------------------
	*/
	$options[] = array(	"id" => "general", "type" => "container");
		
		$options[] = array(	"name" => "Custom Design", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "select-switch", 
									"id" => $pre . "_customcss",
									"description" => "Custom stylesheet is located under custom folder in your theme files",
									"options" => array("Yes, use custom stylesheet.//on", "No.//off"),
									"std" => "off");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "Custom Logo", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "text", 
									"id" => $pre . "_customlogo",
									"description" => "Specify the image address of your online logo. ( ex. http://yoursite.com/logo.png )");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "Color Scheme", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "select-switch", 
									"id" => $pre . "_colorscheme",
									"description" => "Here you can set your prefered color scheme to your site.",
									"options" => array("Default//default", "Blue//blue" , "Dark//dark"),
									"std" => "default");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
	$options[] = array(	"type" => "container_end");
	
	
	
	/*	SEO SETTINGS
	---------------------------
	*/
	$options[] = array(	"id" => "seo", "type" => "container");
		
		$options[] = array(	"name" => "Canonical URLs", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "select-switch", 
									"id" => $pre . "_canonical",
									"description" => "Add canonical URLs that helps you solve duplicate content issues on your site",
									"options" => array("Yes, enable this option.//on", "No.//off"),
									"std" => "off");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "Meta Description", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "textarea", 
									"id" => $pre . "_meta_description",
									"description" => "You should use meta descriptions to provide search engines with additional information about topics that appear on your site. This only applies to your home page");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "Meta Keywords ( comma separated )", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "text", 
									"id" => $pre . "_meta_keywords",
									"description" => "Provide search engines with additional information about topics that appear on your site. This only applies to your home page");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "Meta Author", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "text", 
									"id" => $pre . "_meta_author",
									"description" => "You should write your full name here but only do so if this blog is writen only by one outhor. This only applies to your home page");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
	$options[] = array(	"type" => "container_end");
	
	
	
	/*	Layout SETTINGS
	---------------------------
	*/
	$options[] = array(	"id" => "layout", "type" => "container");
		
		$options[] = array(	"name" => "Display Featured Posts Gallery", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "select-switch", 
									"id" => $pre . "_display_postsgallery",
									"description" => "You can choose whether or not to display the Featured Posts Gallery on the homepge",
									"options" => array("Yes, enable featured posts gallery.//on", "No.//off"),
									"std" => "off");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "Featured Category", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "select", 
									"id" => $pre . "_featured_category",
									"description" => "Here you can choose which category will populate your Featured Posts Gallery",
									"options" => $allcaregory);
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
	$options[] = array(	"type" => "container_end");
	
	
	/*	ADVERTISEMENT SETTINGS
	---------------------------
	*/
	$options[] = array(	"id" => "ad", "type" => "container");
	
		$options[] = array(	"name" => "Enable 468x60 Banner Ad", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "select-switch", 
									"id" => $pre . "_enable_banneradcode",
									"description" => "Enabling this option will allow you to put banner ads to your header",
									"options" => array("Yes, enable 468x60 Banner Ad code.//enable", "No.//disable"),
									"std" => "disable");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "468x60 Banner Ad Code", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "textarea", 
									"id" => $pre . "_banneradcode",
									"description" => "Any code you place here will appear in the banner advertisement block of every page of your blog.");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
	
	$options[] = array(	"type" => "container_end");	
	
	
	/*	INTEGRATION SETTINGS
	---------------------------
	*/
	$options[] = array(	"id" => "integration", "type" => "container");
		
		$options[] = array(	"name" => "Enable Header Code", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "select-switch", 
									"id" => $pre . "_enable_headercode",
									"description" => "Enabling this option will allow you to put scripts to your header",
									"options" => array("Yes, enable header code.//enable", "No.//disable"),
									"std" => "disable");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "Header Code", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "textarea", 
									"id" => $pre . "_headercode",
									"description" => "Any code you place here will appear in the head section of every page of your blog. This is useful when you need to add javascript or css to all pages");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "Enable Footer Code", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "select-switch", 
									"id" => $pre . "_enable_footercode",
									"description" => "Enabling this option will allow you to put scripts to your footer",
									"options" => array("Yes, enable footer code.//enable", "No.//disable"),
									"std" => "disable");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
		$options[] = array(	"name" => "Header Code", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "textarea", 
									"id" => $pre . "_footercode",
									"description" => "Any code you place here will appear in the foot section of every page of your blog. This is useful when you need to add scripts such as google analytics tracking code");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
	$options[] = array(	"type" => "container_end");
	
	
	
	/*	SUPPORT SETTINGS
	---------------------------
	*/
	$options[] = array(	"id" => "docs", "type" => "container");
		
		$options[] = array(	"name" => "Support Documentation", "type" => "section");
			$options[] = array(	"type" => "content");
				$options[] = array(	"type" => "support", "name" => "readme");
			$options[] = array(	"type" => "content_end");	
		$options[] = array(	"type" => "section_end"); // end section
		
	$options[] = array(	"type" => "container_end");
	
?>