<?php
function guide_no_stored_rules() {
	return '';
}
add_filter( 'pre_option_rewrite_rules', 'guide_no_stored_rules' );
// A URL's post ID: from ?p=, ?page_id= or ?attachment_id=; another host gives 0, and a URL no rule matches gives 0.
return array( url_to_postid( 'http://example.org/?p=12' ), url_to_postid( 'http://example.org/?page_id=7#x' ), url_to_postid( 'http://elsewhere.example/?p=12' ), url_to_postid( 'http://example.org/hello/' ) );
