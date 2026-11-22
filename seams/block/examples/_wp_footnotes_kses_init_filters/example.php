<?php
// Adds the footnotes meta kses filter on sanitize_post_meta_footnotes.
_wp_footnotes_kses_init_filters();
return has_filter( 'sanitize_post_meta_footnotes', '_wp_filter_post_meta_footnotes' );
