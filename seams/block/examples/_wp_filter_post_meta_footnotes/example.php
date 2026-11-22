<?php
// Filters the footnotes meta (JSON of each footnote's content) through kses for users without unfiltered_html.
return _wp_filter_post_meta_footnotes( wp_json_encode( array( array( 'id' => 'a', 'content' => 'Ok <script>x</script>' ) ) ) );
