<?php
// Hooked to init and set_current_user: adds the footnotes kses filter when the user can't post unfiltered HTML.
wp_set_current_user( 0 );
_wp_footnotes_kses_init();
return has_filter( 'sanitize_post_meta_footnotes', '_wp_filter_post_meta_footnotes' );
