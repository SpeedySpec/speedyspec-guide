<?php
// A date query turns clauses (year, month, week, day, hour, before, after, inclusive, compare, column) into a WHERE clause on a date column, validating the values.
$dq = new WP_Date_Query( array( array( 'after' => '2026-01-01', 'before' => array( 'year' => 2026, 'month' => 6 ), 'inclusive' => true ), array( 'hour' => 9, 'compare' => '>=' ) ) );
return trim( preg_replace( '/\s+/', ' ', str_replace( $GLOBALS['wpdb']->posts, '<posts>', $dq->get_sql() ) ) );
