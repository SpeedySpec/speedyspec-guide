<?php
// With $ignore_html, shortcodes inside HTML tags are escaped instead of run, so do_shortcode() leaves them as text.
add_shortcode( 'url', fn() => 'https://example.org/' );
return do_shortcodes_in_html_tags( '<a href="[url]">[url]</a>', true, array( 'url' ) );
