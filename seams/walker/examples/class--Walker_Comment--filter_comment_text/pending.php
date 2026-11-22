<?php
// Strips the tags from a comment awaiting moderation, unless the visitor is its author (their commenter cookie is set).
function guide_comment( $id, $parent = 0, $type = 'comment', $approved = '1' ) { return new WP_Comment( (object) array( 'comment_ID' => (string) $id, 'comment_parent' => (string) $parent, 'comment_type' => $type, 'comment_approved' => $approved, 'comment_content' => '<b>Hi</b>' ) ); }
$walker = new Walker_Comment();
$pending = $walker->filter_comment_text( '<b>Hi</b>', guide_comment( 1, 0, 'comment', '0' ) );
$approved = $walker->filter_comment_text( '<b>Hi</b>', guide_comment( 2 ) );
$_COOKIE[ 'comment_author_' . COOKIEHASH ] = 'Ann';
$author = $walker->filter_comment_text( '<b>Hi</b>', guide_comment( 1, 0, 'comment', '0' ) );
return array( $pending, $approved, $author );
