<?php
// The callback convert_smilies() uses for one smiley: an emoji for one that maps to an emoji character, otherwise an image from wp-includes/images/smilies/.
function guide_use_smilies_on( $pre_option ) {
	return '1';
}
add_filter( 'pre_option_use_smilies', 'guide_use_smilies_on' );
smilies_init();
return array( translate_smiley( array( ':)' ) ), translate_smiley( array( ':mrgreen:' ) ) );
