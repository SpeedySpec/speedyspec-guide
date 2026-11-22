<?php
// Redirects a random content request to the picked post's permalink with a 302 and noindex, and stops; does nothing when the request isn't one or nothing was picked.
return wp_random_content_redirect();
