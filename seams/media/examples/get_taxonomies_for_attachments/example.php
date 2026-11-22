<?php
// The taxonomies registered for attachments, whatever their MIME type.
register_taxonomy( 'image_tag', 'attachment:image' );
register_taxonomy( 'license', 'attachment' );
return get_taxonomies_for_attachments();
