<?php
// A value other than false from pre_option_{$option} is returned without reading the table.
add_filter( 'pre_option_blogname', fn() => 'Filtered' );
return get_option( 'blogname' );
