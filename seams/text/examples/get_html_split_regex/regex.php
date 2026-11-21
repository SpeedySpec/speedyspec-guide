<?php
// The regular expression wp_html_split() uses, matching comments, CDATA and tags.
return preg_split( get_html_split_regex(), 'a<!-- c --><i>', -1, PREG_SPLIT_DELIM_CAPTURE );
