<?php
// With show_split_view false, every row has one cell.
$diff = new Text_Diff( 'native', array( array( 'a' ), array( 'b' ) ) );
$html = ( new WP_Text_Diff_Renderer_Table( array( 'show_split_view' => false ) ) )->render( $diff );
return substr_count( $html, '<td' );
