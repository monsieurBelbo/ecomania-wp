/*
 * all callback functions
*/

function equalHeight() {
	var group = jQuery('#content').find('.splitted');
	tallest = 0;
	extended = 0;
	group.each(function() {
		thisHeight = jQuery(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
}