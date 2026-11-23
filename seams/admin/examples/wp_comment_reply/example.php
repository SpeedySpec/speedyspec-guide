<?php
// Prints the inline reply and Quick Edit form of the comments list, hidden until used; replace with wp_comment_reply.
$html = guide_render( fn() => wp_comment_reply() );
return array( str_contains( $html, 'id="replyrow"' ), str_contains( $html, 'replyto-comment' ) );
