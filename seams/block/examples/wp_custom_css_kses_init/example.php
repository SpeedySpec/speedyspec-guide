<?php
// Hooked to init and set_current_user: strips block custom CSS on save for users without edit_css.
wp_set_current_user( 0 );
wp_custom_css_kses_init();
return has_filter( 'content_save_pre', 'wp_strip_custom_css_from_blocks' );
