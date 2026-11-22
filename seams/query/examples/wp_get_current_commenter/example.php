<?php
// The visitor's name, email and URL from their commenter cookies; filtered by wp_get_current_commenter.
$_COOKIE[ 'comment_author_' . COOKIEHASH ] = 'Ada';
$_COOKIE[ 'comment_author_email_' . COOKIEHASH ] = 'ada@example.org';
return wp_get_current_commenter();
