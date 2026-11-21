<?php
// Parses a methodCall: the method name and the params, with arrays and structs nested and dates as IXR_Date.
$message = new IXR_Message( '<?xml version="1.0"?><methodCall><methodName>demo.add</methodName><params><param><value><int>2</int></value></param><param><value><struct><member><name>k</name><value><array><data><value>bare</value><value><boolean>1</boolean></value></data></array></value></member></struct></value></param><param><value><dateTime.iso8601>20260102T03:04:05</dateTime.iso8601></value></param></params></methodCall>' );
$ok = $message->parse();
return array( $ok, $message->messageType, $message->methodName, $message->params[0], $message->params[1], $message->params[2]->getIso() );
