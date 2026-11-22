<?php
// Ajax handler for the General Settings screen: prints the current time in the time format typed, as a preview.
return guide_ajax( 'wp_ajax_time_format', array( 'date' => 'A' ) ) === strtoupper( current_time( 'a' ) );
