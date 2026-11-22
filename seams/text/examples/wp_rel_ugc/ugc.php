<?php
// Adds rel="ugc" to every link, for user-generated content, with nofollow too for links off this site.
return wp_unslash( wp_rel_ugc( wp_slash( '<a href="https://example.com">out</a> <a href="http://example.org/x">in</a>' ) ) );
