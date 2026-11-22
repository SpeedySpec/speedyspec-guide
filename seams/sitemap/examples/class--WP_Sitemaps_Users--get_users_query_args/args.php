<?php
// Authors with published posts of public post types other than pages and attachments; wp_sitemaps_users_query_args filters the arguments.
register_post_type( 'post', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
register_post_type( 'page', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
register_post_type( 'guide_note', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
class Guide_Users extends WP_Sitemaps_Users { public function args() { return $this->get_users_query_args(); } }
add_filter( 'wp_sitemaps_users_query_args', fn( $args ) => $args + array( 'guide' => true ) );
return ( new Guide_Users() )->args();
