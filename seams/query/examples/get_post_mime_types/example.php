<?php
// The media types the library filters by (image, audio, video, document and others), with their labels and MIME patterns; filtered by post_mime_types.
return array_keys( get_post_mime_types() );
