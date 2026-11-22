<?php
// Sanitizes the commenter cookies of the request in place, through the pre_comment_author_* filters.
$_COOKIE[ 'comment_author_' . COOKIEHASH ] = '<b>Ada</b>';
$_COOKIE[ 'comment_author_email_' . COOKIEHASH ] = 'ada@example.org<script>';
sanitize_comment_cookies();
return array( $_COOKIE[ 'comment_author_' . COOKIEHASH ], $_COOKIE[ 'comment_author_email_' . COOKIEHASH ] );
