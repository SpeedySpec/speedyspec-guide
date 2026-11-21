<?php
// How different two strings' character counts are, per character of the first.
$r = new WP_Text_Diff_Renderer_Table();
return array( $r->compute_string_distance( 'abc', 'abc' ), $r->compute_string_distance( 'abcd', 'abxy' ) );
