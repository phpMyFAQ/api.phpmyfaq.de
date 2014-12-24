<?php
/**
 * API endpoint for api.phpmyfaq.de/verfiy/<version>
 *
 *
 */

ob_start('ob_gzhandler');
header('Content-type: application/json');

require 'phpmyfaq.php';

$version  = filter_input(INPUT_GET, 'version', FILTER_SANITIZE_STRIPPED);
$fileName = 'json/hashes-' . $version . '.json';

if (preg_match('((\d+)\.(\d+)(\.\d+)?(-(beta|alpha|rc)(\d+))?)', $version) && file_exists($fileName)) {
    echo file_get_contents($fileName);
} else {
    header("HTTP/1.0 418 I'm a teapot");
    echo json_encode('The greatest enemy of knowledge is not ignorance, it is the illusion of knowledge.');
}