<?php
// A meta query turns nested clauses (key, value, compare, type, relation) into the JOIN and WHERE SQL for a table, reusing table aliases where it can.
global $wpdb;
$mq = new WP_Meta_Query( array( 'relation' => 'OR', array( 'key' => 'color', 'value' => 'red' ), array( 'key' => 'size', 'value' => 3, 'compare' => '>', 'type' => 'NUMERIC' ) ) );
$sql = $mq->get_sql( 'post', $wpdb->posts, 'ID' );
return array( substr_count( $sql['join'], 'JOIN' ), str_contains( $sql['where'], 'AS SIGNED' ), $mq->has_or_relation(), array_keys( $mq->get_clauses() ) );
