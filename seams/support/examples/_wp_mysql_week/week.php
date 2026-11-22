<?php
// The SQL WEEK() expression for a column, by start_of_week: mode 0 when weeks start on Sunday, 1 on Monday, and so on.
$monday = _wp_mysql_week( 'post_date' );
update_option( 'start_of_week', 0 );
return array( $monday, _wp_mysql_week( 'post_date' ) );
