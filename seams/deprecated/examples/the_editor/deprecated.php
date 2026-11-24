<?php
// Deprecated in 3.3.0; use wp_editor(). Displays an editor: TinyMCE, HTML, or both. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$result    = guide_deprecated( 'the_editor', '<p>Some <b>content</b>.</p>' );
// The WordPress version is shown as <version>, so the result stays the same between releases.
$result[1] = str_replace( get_bloginfo( 'version' ), '<version>', $result[1] );
return $result;
