<?php
// Sanitizes the term IDs a checkbox taxonomy box submits, as integers.
return taxonomy_meta_box_sanitize_cb_checkboxes( 'category', array( '3', '5' ) );
