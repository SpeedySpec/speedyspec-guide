<?php
// The user IDs mentioned in a note's content: elements with both the wp-note-mention class and a user-N class.
return wp_get_note_mentioned_user_ids( 'Hi <span class="wp-note-mention user-2">@Bo</span> and <span class="wp-note-mention user-7">@Cy</span>, not <span class="user-9">x</span>' );
