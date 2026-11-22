<?php
// Callback for filter_block_content(): restores a parsed block's delimiters around its filtered HTML.
return _filter_block_content_callback( array( '<!--', 'wp:separator /' ) );
