<?php
// Replies deeper than max_depth are shown at the deepest level allowed rather than dropped.
function guide_comment( $id, $parent = 0, $type = 'comment', $approved = '1' ) { return new WP_Comment( (object) array( 'comment_ID' => (string) $id, 'comment_parent' => (string) $parent, 'comment_type' => $type, 'comment_approved' => $approved, 'comment_content' => '<b>Hi</b>' ) ); }
$args = array( 'style' => 'div', 'max_depth' => 2, 'callback' => function ( $c, $args, $depth ) { echo "<div>{$c->comment_ID}@$depth"; } );
return ( new Walker_Comment() )->walk( array( guide_comment( 1 ), guide_comment( 2, 1 ), guide_comment( 3, 2 ) ), 2, $args );
