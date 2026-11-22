<?php
// Reading results: get_var() one value, get_row() one row, get_col() one column, get_results() every row, as objects, arrays or numbered arrays; rows_affected and num_rows describe the last query.
global $wpdb;
wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'B', 'post_status' => 'publish' ) );
$sql = "SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'post' ORDER BY post_title";
return array( $wpdb->get_col( $sql, 1 ), $wpdb->get_row( $sql, ARRAY_A )['post_title'], count( $wpdb->get_results( $sql, ARRAY_N ) ), $wpdb->num_rows );
