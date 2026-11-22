<?php
// For an attachment, the embed's excerpt is the attachment itself (prepend_attachment()); other content is kept.
guide_view( guide_post() );
return wp_embed_excerpt_attachment( 'Text' );
