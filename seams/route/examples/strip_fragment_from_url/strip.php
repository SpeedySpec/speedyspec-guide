<?php
// Removes the fragment from an absolute URL; a URL without a host is returned as it is.
return array( strip_fragment_from_url( 'https://example.org:8080/a?b=1#c' ), strip_fragment_from_url( '/path#frag' ) );
