<?php
// With use_smilies off, text is returned as it is.
function guide_use_smilies_off( $pre_option ) {
	return '0';
}
add_filter( 'pre_option_use_smilies', 'guide_use_smilies_off' );
smilies_init();
return convert_smilies( 'Hi :)' );
