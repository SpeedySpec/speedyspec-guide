<?php
// Downloads an image from a URL and saves it as an attachment of a post; gives an img tag, its URL, its ID or an error.
return media_sideload_image( 'https://example.org/not-an-image.txt', 0 )->get_error_code();
