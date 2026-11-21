<?php
// Replaces text only inside HTML tags, not in the text between them.
return wp_replace_in_html_tags( '<a title="x">x</a>', array( 'x' => 'y' ) );
