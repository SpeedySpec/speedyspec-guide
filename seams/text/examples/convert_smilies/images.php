<?php
// With use_smilies on, text smilies outside tags become emoji or images. (No database here: the option comes from a filter.)
function guide_use_smilies_on( $pre_option ) {
	return '1';
}
add_filter( 'pre_option_use_smilies', 'guide_use_smilies_on' );
smilies_init();
return convert_smilies( 'Hi :) <code>:)</code>' );
