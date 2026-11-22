<?php
// The post before or after the current one by date, optionally in the same term or excluding terms; '' when there is none, null without a current post. Filtered by get_{$adjacent}_post_join, _where and _sort.
$a = wp_insert_post( array( 'post_title' => 'First', 'post_status' => 'publish', 'post_date' => '2026-01-01 00:00:00' ) );
$b = wp_insert_post( array( 'post_title' => 'Second', 'post_status' => 'publish', 'post_date' => '2026-01-02 00:00:00' ) );
$c = wp_insert_post( array( 'post_title' => 'Third', 'post_status' => 'publish', 'post_date' => '2026-01-03 00:00:00' ) );
guide_go( "/?p=$a" );
the_post();
return array( get_adjacent_post( false, '', true ), get_adjacent_post( false, '', false )->post_title );
