<?php
// In an embed, a link to the post's comments with their count, when it has comments or they are open.
$open = guide_post( array( 'comment_status' => 'open' ) );
$closed = guide_post( array( 'comment_status' => 'closed', 'post_title' => 'Closed' ) );
guide_view( $closed );
$none = guide_render( 'print_embed_comments_button' );
guide_view( $open );
return array( $none, guide_render( 'print_embed_comments_button' ) );
