<?php
// Sends the comments list's new total, page counts and time as XML after a comment is trashed, spammed or deleted.
$sent = guide_ajax( fn() => _wp_ajax_delete_comment_response( 5 ), array( '_total' => 2, '_per_page' => 20, '_page' => 1, '_url' => admin_url( 'edit-comments.php' ) ) );
return array( str_contains( $sent, '<total><![CDATA[' ), str_contains( $sent, 'comment' ) );
