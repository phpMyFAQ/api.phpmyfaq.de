<?php
/**
 * API endpoint for api.phpmyfaq.de/version
 *
 *
 */

ob_start('ob_gzhandler');
header('Content-type: application/json');

require 'phpmyfaq.php';

$branch = filter_input(INPUT_GET, 'branch', FILTER_SANITIZE_STRING);

switch ($branch) {

    case 'stable':
        echo json_encode(PHPMYFAQ_STABLE_VERSION);
        break;

    case 'development':
        echo json_encode(PHPMYFAQ_DEV_VERSION);
        break;

    default:
        echo json_encode(
            [
                'stable'      => PHPMYFAQ_STABLE_VERSION,
                'development' => PHPMYFAQ_DEV_VERSION
            ]
        );
        break;
}

exit();