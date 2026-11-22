<?php
// Sends the headers for a cached JavaScript response: the site's charset, Vary, and Expires ten days ahead.
cache_javascript_headers();
return 'sent';
