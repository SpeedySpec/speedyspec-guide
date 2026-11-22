<?php
// Binary data as a base64 element.
return ( new IXR_Base64( "\x00hi" ) )->getXml();
