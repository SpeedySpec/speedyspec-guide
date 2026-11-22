<?php
// On the term meta filters, stops term meta before database version 34370 (when its table arrived) by returning false; otherwise passes the value on.
$supported = wp_check_term_meta_support_prefilter( null );
update_option( 'db_version', 30000 );
return array( $supported, wp_check_term_meta_support_prefilter( null ) );
