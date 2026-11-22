<?php
// The global WP_Scripts, made on first use; WordPress's default scripts are registered when it is made.
return array( get_class( wp_scripts() ), wp_scripts() === $GLOBALS['wp_scripts'], isset( wp_scripts()->registered['jquery'] ) );
