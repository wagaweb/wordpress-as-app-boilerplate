<?php
define('CLI_HTTP_HOST',''); //Change here to the correct url
define('CLI_DOCUMENT_ROOT',''); //Change here to the correct path

global $_SERVER;
$_SERVER['HTTP_HOST'] = CLI_HTTP_HOST;
$_SERVER['DOCUMENT_ROOT'] = CLI_HTTP_HOST;

/*
 * 1 - COPY HERE local- prod- or staging- config.php.
 *
 * 2 - REPLACE :
 *  $_SERVER['HTTP_HOST'] => CLI_HTTP_HOST
 *  $_SERVER['DOCUMENT_ROOT'] => CLI_DOCUMENT_ROOT
 */