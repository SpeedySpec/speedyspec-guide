<?php
// Emails the admin that the site is installed, with its URL and username; the password is not sent.
wp_new_blog_notification( 'Guide Site', 'http://example.org', 1, '' );
return true;
