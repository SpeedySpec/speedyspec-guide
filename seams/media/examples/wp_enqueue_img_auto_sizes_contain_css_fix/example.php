<?php
// Hooked to wp_head: adds the CSS rule giving auto-sized lazy images their intrinsic size, when wp_img_tag_add_auto_sizes is on.
wp_enqueue_img_auto_sizes_contain_css_fix();
return wp_style_is( 'wp-img-auto-sizes-contain', 'enqueued' );
