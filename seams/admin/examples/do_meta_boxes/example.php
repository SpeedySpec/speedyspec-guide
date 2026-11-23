<?php
// Prints a screen context's boxes in order, honouring the user's saved order and hidden boxes; gives how many it printed.
function guide_tasting_box( WP_Post $post ): void
{
	echo '<p>Tasting notes for ' . esc_html( $post->post_title ) . '</p>';
}
add_meta_box( 'tasting', 'Tasting notes', 'guide_tasting_box', 'post', 'side' );
$post = get_post( wp_insert_post( array( 'post_title' => 'Oolong', 'post_status' => 'publish' ) ) );
$count = 0;
$html = guide_render( function () use ( $post, &$count ) { $count = do_meta_boxes( 'post', 'side', $post ); } );
return array( $count, str_contains( $html, 'Tasting notes for Oolong' ) );
