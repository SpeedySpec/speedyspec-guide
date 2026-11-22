<?php
// Removes the footnotes meta kses filter.
_wp_footnotes_kses_init_filters();
_wp_footnotes_remove_filters();
return has_filter( 'sanitize_post_meta_footnotes', '_wp_filter_post_meta_footnotes' );
