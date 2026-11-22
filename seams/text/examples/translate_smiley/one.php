<?php
// The callback convert_smilies() uses for one smiley: an emoji for one that maps to an emoji character, otherwise an image from wp-includes/images/smilies/.
add_filter( 'pre_option_use_smilies', fn() => '1' );
smilies_init();
return array( translate_smiley( array( ':)' ) ), translate_smiley( array( ':mrgreen:' ) ) );
