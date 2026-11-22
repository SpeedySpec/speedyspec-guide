<?php
// Prints the hidden notices the comments list shows after a comment is trashed or spammed, with an Undo link.
$html = guide_render( 'wp_comment_trashnotice' );
return array( str_contains( $html, 'id="trash-undo-holder"' ), str_contains( $html, 'id="spam-undo-holder"' ) );
