<?php
// wp_kses_post() for slashed input; a disallowed script goes with its contents.
return wp_filter_post_kses( addslashes( '<p class="x">a</p><script>b</script>' ) );
