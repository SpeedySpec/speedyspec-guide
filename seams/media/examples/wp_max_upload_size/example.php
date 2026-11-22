<?php
// The largest upload allowed in bytes: the smaller of PHP's upload_max_filesize and post_max_size; filtered by upload_size_limit.
return wp_max_upload_size() > 0;
