<?php
// A tag holding only an opening or only a closing bracket has it escaped.
return do_shortcodes_in_html_tags( '<img alt="a [ b">', false, array( 'url' ) );
