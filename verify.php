<?php
ob_start('ob_gzhandler');
header('Content-type: application/json');

require_once '../version.php';

$version = filter_input(INPUT_GET, 'version', FILTER_SANITIZE_STRIPPED);

if (preg_match('((\d+)\.(\d+)(\.\d+)?(-(beta|alpha|rc)(\d+))?)', $version) && file_exists('hashes-' . $version . '.json')) {
    echo file_get_contents('hashes-' . $version . '.json');
} else {
    header("HTTP/1.0 418 I'm a teapot");
    echo json_encode('The greatest enemy of knowledge is not ignorance, it is the illusion of knowledge.');
}