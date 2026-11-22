<?php
// Strips tags, cuts to a number of characters, drops a cut-off entity, and adds the more text only when cut.
return array( wp_html_excerpt( '<p>Hello &amp; world</p>', 8, '…' ), wp_html_excerpt( 'Short', 10, '…' ) );
