<?php
// Hooked to term_link: gives a post format term's link with the plain slug, without post-format-.
$term = get_term_by( 'slug', 'post-format-aside', 'post_format' ) ?: get_term( wp_insert_term( 'post-format-aside', 'post_format' )['term_id'], 'post_format' );
return _post_format_link( 'http://example.org/?post_format=post-format-aside', $term, 'post_format' );
