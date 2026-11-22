<?php
// Hooked to wp_robots: adds noindex and nofollow when the site discourages search engines (blog_public off).
update_option( 'blog_public', 0 );
return wp_robots_noindex( array() );
