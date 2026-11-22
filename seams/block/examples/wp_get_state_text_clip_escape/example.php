<?php
// When the base clips the background to the text and a state sets another clip without its own background, unsets the background image so the text shows; nothing otherwise.
return array( wp_get_state_text_clip_escape( array( 'background' => array( 'backgroundClip' => 'border-box' ) ), 'text' ), wp_get_state_text_clip_escape( array( 'background' => array( 'backgroundClip' => 'border-box' ) ), '' ) );
