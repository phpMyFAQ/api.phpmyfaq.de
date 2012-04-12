<?php
header('Content-type: application/json');

require_once '../version.php';

$version = filter_input(INPUT_GET, 'version', FILTER_SANITIZE_STRIPPED);

if (preg_match('((\d+)\.(\d+)(\.\d+)?(-(beta|alpha|rc)(\d+))?)', $version) && file_exists('hashes-' . $version . '.json')) {
    print file_get_contents('hashes-' . $version . '.json');
} else {
    print json_encode('The greatest enemy of knowledge is not ignorance, it is the illusion of knowledge.');
}