<?php
// Hooked to render_block: unwraps inline note markers (mark elements with the wp-note class) from rendered blocks, keeping the marked text, so note data never reaches the page.
return wp_strip_inline_note_markers( '<p>Some <mark class="wp-note" data-id="3">marked</mark> text and <mark>plain</mark>.</p>' );
