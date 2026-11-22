<?php
// Cleans one term field for a context: IDs and counts as integers; raw untouched; edit, db, display and attribute contexts run the {$field} filters (pre_term_{$field} for db, term_{$field} for display).
add_filter( 'term_name', fn( $v ) => strtoupper( $v ) );
return array( sanitize_term_field( 'parent', '7x', 1, 'category', 'display' ), sanitize_term_field( 'name', '<b>a</b>', 1, 'category', 'raw' ), sanitize_term_field( 'name', 'news', 1, 'category', 'display' ), sanitize_term_field( 'name', 'Fish & "Chips"', 1, 'category', 'attribute' ) );
