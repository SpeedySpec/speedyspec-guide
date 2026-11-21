<?php
// The preg_replace_callback() callback strip_shortcodes() uses: it keeps an escaped [[tag]] as [tag] and drops the rest.
return array( strip_shortcode_tag( array( '[[a]]', '[', 'a', '', '', '', ']' ) ), strip_shortcode_tag( array( '[a]', '', 'a', '', '', '', '' ) ) );
