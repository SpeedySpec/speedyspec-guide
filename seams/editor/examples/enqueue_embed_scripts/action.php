<?php
// Fires enqueue_embed_scripts, where an embed view's scripts and styles are enqueued.
function guide_print_enqueue_embed_scripts() {
	echo "enqueue_embed_scripts\n";
}
add_action( 'enqueue_embed_scripts', 'guide_print_enqueue_embed_scripts' );
enqueue_embed_scripts();
return null;
