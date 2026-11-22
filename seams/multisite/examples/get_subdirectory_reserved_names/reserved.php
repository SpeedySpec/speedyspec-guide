<?php
// The names subdirectory sites can't take, because WordPress's paths use them (page, comments, blog, files, feed, wp-admin and others); subdirectory_reserved_names filters them.
return get_subdirectory_reserved_names();
