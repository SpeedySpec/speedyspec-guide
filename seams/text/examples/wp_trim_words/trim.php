<?php
// Strips tags, keeps the first words and appends the "more" text when there were more.
return array( wp_trim_words( '<p>One two three four</p>', 2 ), wp_trim_words( 'One two', 5, '...' ), wp_trim_words( 'a b c', 2, ' [more]' ) );
