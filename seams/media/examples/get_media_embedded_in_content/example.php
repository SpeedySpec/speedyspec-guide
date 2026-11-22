<?php
// The audio, video, object, embed and iframe tags found in content, or only those of the types given; filtered by media_embedded_in_content_allowed_types.
$content = '<p>Hi</p><iframe src="https://example.org/v"></iframe><audio src="a.mp3"></audio>';
return array( get_media_embedded_in_content( $content ), get_media_embedded_in_content( $content, array( 'audio' ) ) );
