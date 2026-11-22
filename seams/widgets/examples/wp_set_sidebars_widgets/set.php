<?php
// Saves the widgets of each sidebar to the sidebars_widgets option, with array_version 3, and clears the cached copy.
wp_set_sidebars_widgets( array( 'side' => array( 'text-2' ) ) );
return get_option( 'sidebars_widgets' );
