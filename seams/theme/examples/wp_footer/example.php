<?php
// Fires wp_footer, where footer scripts and the admin bar print.
guide_render( 'wp_footer' );
return did_action( 'wp_footer' );
