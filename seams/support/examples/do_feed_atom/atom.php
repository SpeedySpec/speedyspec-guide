<?php
// Loads the Atom feed template, the comments feed when asked.
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
wp( array( 'feed' => 'atom' ) );
return str_contains( guide_render( fn() => do_feed_atom( false ) ), '<title type="html"><![CDATA[Hello]]></title>' );
