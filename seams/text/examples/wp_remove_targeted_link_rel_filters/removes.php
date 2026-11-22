<?php
// Removes those filters.
wp_init_targeted_link_rel_filters();
wp_remove_targeted_link_rel_filters();
return has_filter( 'content_save_pre', 'wp_targeted_link_rel' );
