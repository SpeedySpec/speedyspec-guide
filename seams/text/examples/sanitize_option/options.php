<?php
// Each known option gets its own cleaning; these need no database.
return array(
	sanitize_option( 'posts_per_page', '0' ),
	sanitize_option( 'posts_per_page', '-5' ),
	sanitize_option( 'blog_charset', 'UTF-8\\' ),
	sanitize_option( 'gmt_offset', 'abc' ),
	sanitize_option( 'default_comment_status', '0' ),
	sanitize_option( 'ping_sites', " example.com \n\n javascript:x " ),
	sanitize_option( 'thumbnail_size_w', '-150' ),
);
