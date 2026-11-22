<?php
// Hooked to image_send_to_editor: wraps an inserted image in a [caption] shortcode when it has a caption; filtered by image_add_caption_text and image_add_caption_shortcode.
return image_add_caption( '<img src="lake.jpg" width="300" height="200" />', 5, 'A calm lake', 'Lake', 'center', '', 'medium', 'A lake' );
