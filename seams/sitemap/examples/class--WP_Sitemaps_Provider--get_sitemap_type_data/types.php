<?php
// One entry per subtype with its page count, or one unnamed entry for a provider without subtypes.
register_post_type( 'post', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
register_post_type( 'page', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
add_filter( 'wp_sitemaps_posts_pre_max_num_pages', fn( $n, $type ) => 'post' === $type ? 3 : 1, 10, 2 );
add_filter( 'wp_sitemaps_users_pre_max_num_pages', fn() => 2 );
return array( ( new WP_Sitemaps_Posts() )->get_sitemap_type_data(), ( new WP_Sitemaps_Users() )->get_sitemap_type_data(), ( new WP_Sitemaps_Users() )->get_object_subtypes() );
