<?php
// Everything needed to show an avatar: its URL, size, default, rating, whether one was found, and extra attributes; filtered by pre_get_avatar_data and get_avatar_data.
$data = get_avatar_data( 1, array( 'size' => 48 ) );
return array( $data['size'], $data['default'], $data['rating'], str_contains( $data['url'], 'gravatar.com/avatar/' ) );
