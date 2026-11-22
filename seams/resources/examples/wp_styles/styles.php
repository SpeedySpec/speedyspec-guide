<?php
// The global WP_Styles, made on first use; WordPress's default styles are registered when it is made.
return array( get_class( wp_styles() ), isset( wp_styles()->registered['dashicons'] ) );
