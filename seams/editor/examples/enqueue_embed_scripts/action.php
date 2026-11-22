<?php
// Fires enqueue_embed_scripts, where an embed view's scripts and styles are enqueued.
add_action( 'enqueue_embed_scripts', fn() => print( "enqueue_embed_scripts\n" ) );
enqueue_embed_scripts();
return null;
