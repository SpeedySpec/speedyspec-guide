<?php
// Whether featured images get the color filter: on unless the image_filter theme mod is 0.
guide_theme( 'twentynineteen' );
$on = twentynineteen_image_filters_enabled();
set_theme_mod( 'image_filter', 0 );
return array( $on, twentynineteen_image_filters_enabled() );
