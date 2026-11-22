<?php
// Registers WordPress's own script modules from script-modules-packages.php, as @wordpress/ IDs; the interactivity and block library modules load late and at low priority.
wp_default_script_modules();
wp_enqueue_script_module( '@wordpress/interactivity' );
return str_contains( guide_render( array( wp_script_modules(), 'print_enqueued_script_modules' ) ), 'id="@wordpress/interactivity-js-module"' );
