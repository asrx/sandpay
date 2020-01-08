<?php
//Change these values below.

define('SAND_MID', 'XXXXXXXX');
define('SAND_PFX_PASSWORD', 'YYYYYYYY');
define('SAND_CERT_PATH', __DIR__.'/sand.cer');
define('SAND_PFX_PATH', __DIR__.'/private.pfx');

if (!defined('SAND_MID') ||
    !defined('SAND_PFX_PASSWORD') ||
    !defined('SAND_CERT_PATH') ||
    !defined('SAND_PFX_PATH')) {
    die("The constants 'SAND_MID', 'SAND_PFX_PASSWORD', 'SAND_CERT_PATH', and 'SAND_PFX_PATH' need to be defined in: " . realpath(__FILE__));
}
