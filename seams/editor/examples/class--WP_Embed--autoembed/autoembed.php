<?php
// Embeds URLs that stand alone on a line or in their own paragraph; URLs within text are left alone.
guide_queue_http( array( array( 'type' => 'video', 'version' => '1.0', 'html' => '<iframe src="https://www.youtube.com/embed/abc"></iframe>' ) ) );
return $GLOBALS['wp_embed']->autoembed( "Intro text\nhttps://www.youtube.com/watch?v=abc\nSee https://example.org inline." );
