<?php
// Removes from a theme.json tree what isn't safe for users to save: unknown keys, CSS declarations kses refuses, and settings without valid values.
$clean = WP_Theme_JSON::remove_insecure_properties( array( 'version' => 3, 'styles' => array( 'color' => array( 'text' => 'red', 'background' => 'url(javascript:alert(1))' ), 'spacing' => array( 'padding' => 'expression(evil)' ) ) ) );
return $clean['styles'];
