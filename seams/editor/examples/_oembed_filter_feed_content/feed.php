<?php
// In feeds, removes the style attribute from WordPress embed iframes (which hides them until their script runs).
return _oembed_filter_feed_content( '<iframe class="wp-embedded-content" style="position: absolute; visibility: hidden;" src="x"></iframe><iframe style="border:0" src="y"></iframe>' );
