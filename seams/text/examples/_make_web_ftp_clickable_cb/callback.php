<?php
// The callback that links a www. or ftp. address: it adds http://, and the link text is the full URL.
return _make_web_ftp_clickable_cb( array( ' www.example.com', ' ', 'www.example.com' ) );
