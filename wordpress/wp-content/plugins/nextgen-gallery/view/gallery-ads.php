<?php
/**
Template Page for the gallery overview

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>

<li id="adds" class="widget-container ads">
    <?php $index = 0; ?>
    <?php foreach ( $images as $image ) : ?>
        <a href="<?php echo $image->description ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Ads', 'Click', '<?php echo $image->alttext ?>']);">
            <img src="<?php echo $image->imageURL ?>" border="0" class="ad" style="<?php if ($index++%2 == 1) : ?>float: right;<?php endif; ?>"/>
        </a>
    <?php endforeach; ?>
</li>

<?php endif; ?>