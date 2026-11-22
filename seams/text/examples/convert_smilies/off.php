<?php
// With use_smilies off, text is returned as it is.
add_filter( 'pre_option_use_smilies', fn() => '0' );
smilies_init();
return convert_smilies( 'Hi :)' );
