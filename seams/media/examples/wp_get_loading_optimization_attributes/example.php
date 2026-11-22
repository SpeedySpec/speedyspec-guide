<?php
// The loading, fetchpriority and decoding attributes for an img or iframe: lazy below the fold, high priority for the first large image; filtered by wp_get_loading_optimization_attributes.
wp_increase_content_media_count( 5 );
return array( wp_get_loading_optimization_attributes( 'img', array( 'width' => 300, 'height' => 200 ), 'the_content' ), wp_get_loading_optimization_attributes( 'video', array(), 'the_content' ) );
