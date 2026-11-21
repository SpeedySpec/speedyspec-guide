<?php
// The callback that links a full URL: the match's prefix, URL and trailing punctuation are 1, 2 and 3, and the punctuation stays outside the link.
return _make_url_clickable_cb( array( ' https://example.com.', ' ', 'https://example.com', '.' ) );
