<?php
// Checks a new site's name and title: lowercase letters and digits, at least 4 characters, not reserved or taken, and a title given; wpmu_validate_blog_signup filters the result.
$ok = wpmu_validate_blog_signup( 'teamblog', 'Team' );
$bad = wpmu_validate_blog_signup( 'wp-admin', '' );
return array( $ok['domain'], $ok['path'], $ok['errors']->has_errors(), $bad['errors']->get_error_codes() );
