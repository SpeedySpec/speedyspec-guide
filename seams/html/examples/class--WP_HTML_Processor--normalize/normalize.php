<?php
// Rewrites HTML as a browser would read it: quotes attributes, closes elements, lowercases tags.
return WP_HTML_Processor::normalize( '<P class=a>One<br>Two' );
