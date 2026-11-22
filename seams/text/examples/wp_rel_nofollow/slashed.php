<?php
// Adds rel="nofollow" to links off this site, in slashed content as filters get it; links to this site are left alone.
return wp_unslash( wp_rel_nofollow( wp_slash( '<a href="https://example.com">out</a> <a href="http://example.org/x">in</a>' ) ) );
