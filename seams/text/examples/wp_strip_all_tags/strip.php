<?php
// Removes tags with script and style contents, and with remove_breaks collapses whitespace.
return array( wp_strip_all_tags( " <script>x()</script><p>a</p>\n<b>b</b> " ), wp_strip_all_tags( "a\n\tb", true ), wp_strip_all_tags( null ) );
