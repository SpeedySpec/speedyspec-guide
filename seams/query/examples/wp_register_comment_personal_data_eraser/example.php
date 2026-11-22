<?php
// Hooked to wp_privacy_personal_data_erasers: adds the comments eraser.
return array_keys( wp_register_comment_personal_data_eraser( array() ) );
