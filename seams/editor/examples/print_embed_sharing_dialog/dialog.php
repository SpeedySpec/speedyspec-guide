<?php
// In an embed, the sharing dialog: the post's URL, and its embed HTML to copy.
function guide_secret_password( $password ) {
	return 'SECRET';
}
add_filter( 'random_password', 'guide_secret_password' );
guide_view( guide_post() );
return substr( preg_replace( '/-\d+-\d+/', '-ID-RAND', guide_render( 'print_embed_sharing_dialog' ) ), 0, 700 );
