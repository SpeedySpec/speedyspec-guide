<?php
// The stylesheet URLs the editor's audio and video previews load in their sandbox iframe.
return array_map( fn( $url ) => wp_basename( strtok( $url, '?' ) ), wpview_media_sandbox_styles() );
