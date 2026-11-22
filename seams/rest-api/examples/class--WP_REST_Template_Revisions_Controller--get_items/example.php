<?php
// The template revisions and autosaves controllers serve a saved template's revisions and autosaves under /wp/v2/templates/<id>/ and /wp/v2/template-parts/<id>/, the parent named by its theme//slug ID.
$template = guide_rest( 'POST', '/wp/v2/templates', array( 'slug' => 'my-page', 'title' => 'v1', 'content' => 'one' ) )[1];
guide_rest( 'POST', "/wp/v2/templates/{$template['id']}", array( 'title' => 'v2', 'content' => 'two' ) );
$revisions = guide_rest( 'GET', "/wp/v2/templates/{$template['id']}/revisions" )[1];
return array( $template['id'], array_map( fn( $r ) => $r['title']['raw'], $revisions ) );
