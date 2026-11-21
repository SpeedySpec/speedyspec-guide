<?php
// With use_smilies on, text smilies outside tags become emoji or images. (No database here: the option comes from a filter.)
add_filter( 'pre_option_use_smilies', fn() => '1' );
smilies_init();
return convert_smilies( 'Hi :) <code>:)</code>' );
