<?php
// Prints the script that reloads the page when the browser's back button brings it back from its cache.
return str_contains( guide_render( 'wp_page_reload_on_back_button_js' ), 'location.reload' );
