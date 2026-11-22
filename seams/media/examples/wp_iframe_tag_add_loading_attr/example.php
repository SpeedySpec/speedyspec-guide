<?php
// Adds loading="lazy" to an iframe in content that has a width and height and no loading attribute.
return wp_iframe_tag_add_loading_attr( '<iframe src="https://example.org/embed" width="560" height="315"></iframe>', 'the_content' );
