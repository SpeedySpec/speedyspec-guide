<?php
// Lowercases, removes tags and punctuation, and joins words with dashes; percent-encoded characters are kept.
return sanitize_title_with_dashes( '<b>Tom</b> & Jerry  2' );
