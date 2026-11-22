<?php
// Removes a feature without the checks, undoing custom header and background setup.
add_theme_support( 'custom-background' );
return array( _remove_theme_support( 'custom-background' ), current_theme_supports( 'custom-background' ) );
