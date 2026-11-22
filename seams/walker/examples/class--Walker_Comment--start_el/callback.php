<?php
// With callback and end-callback, they write each comment instead; the style picks ol, ul or div for replies, and $comment_depth holds the level: end_lvl() leaves it at the level the replies closed into.
function guide_comment( $id, $parent = 0, $type = 'comment', $approved = '1' ) { return new WP_Comment( (object) array( 'comment_ID' => (string) $id, 'comment_parent' => (string) $parent, 'comment_type' => $type, 'comment_approved' => $approved, 'comment_content' => '<b>Hi</b>' ) ); }
$args = array( 'style' => 'ol', 'max_depth' => 5, 'callback' => function ( $c, $args, $depth ) { echo "<li>{$c->comment_ID}@$depth"; }, 'end-callback' => function () { echo '</li>'; } );
$out = ( new Walker_Comment() )->walk( array( guide_comment( 1 ), guide_comment( 2, 1 ) ), 5, $args );
return array( $out, $GLOBALS['comment_depth'] );
