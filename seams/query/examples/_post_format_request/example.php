<?php
// Hooked to request: turns a post_format query variable from a slug like aside into its term, post-format-aside, and limits the query to the types that support formats.
return _post_format_request( array( 'post_format' => 'aside' ) );
