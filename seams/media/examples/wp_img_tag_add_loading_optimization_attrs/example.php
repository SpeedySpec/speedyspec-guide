<?php
// Adds loading, fetchpriority and decoding to an img tag in content, from wp_get_loading_optimization_attributes().
wp_omit_loading_attr_threshold( true );
wp_increase_content_media_count( 5 );
return wp_img_tag_add_loading_optimization_attrs( '<img src="a.jpg" width="300" height="200">', 'the_content' );
