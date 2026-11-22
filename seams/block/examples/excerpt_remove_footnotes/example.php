<?php
// Content without footnote markers, for excerpts.
return excerpt_remove_footnotes( 'A claim<sup data-fn="abc" class="fn"><a href="#abc" id="abc-link">1</a></sup>.' );
