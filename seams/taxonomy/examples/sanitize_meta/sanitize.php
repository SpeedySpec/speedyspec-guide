<?php
// A meta value through its sanitizers: sanitize_{$type}_meta_{$key}_for_{$subtype}, then sanitize_{$type}_meta_{$key}; register_meta()'s sanitize_callback is attached there.
register_meta( 'post', 'count', array( 'sanitize_callback' => 'absint' ) );
add_filter( 'sanitize_post_meta_count_for_page', fn( $v ) => $v * 10 );
return array( sanitize_meta( 'count', '-7', 'post' ), sanitize_meta( 'count', '3', 'post', 'page' ), sanitize_meta( 'other', '<b>x</b>', 'post' ) );
