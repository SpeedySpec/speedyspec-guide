<?php
// The generator tag for a format: html, xhtml, atom, rss2, rdf, comment or export; filtered by get_the_generator_{$type}.
// The WordPress version is shown as <version>, so the result stays the same between releases.
return str_replace( get_bloginfo( 'version' ), '<version>', array( get_the_generator( 'html' ), get_the_generator( 'atom' ), get_the_generator( 'comment' ) ) );
