<?php
// In the pre_comment_content context, lets span carry a class, for note mentions.
return array( _wp_kses_allow_note_mention_span( array(), 'pre_comment_content' ), _wp_kses_allow_note_mention_span( array(), 'post' ) );
