<?php
// Builds the smiley table and its search pattern (the $wpsmiliestrans and $wp_smiliessearch globals) when smilies are on; smilies filters the table.
smilies_init();
return array( $GLOBALS['wpsmiliestrans'][':)'], count( $GLOBALS['wpsmiliestrans'] ) > 40, is_string( $GLOBALS['wp_smiliessearch'] ) );
