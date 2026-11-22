<?php
// Splits comments by type: comment, trackback, pingback, and pings for both.
$list = array( (object) array( 'comment_type' => 'comment' ), (object) array( 'comment_type' => 'pingback' ), (object) array( 'comment_type' => 'trackback' ) );
return array_map( 'count', separate_comments( $list ) );
