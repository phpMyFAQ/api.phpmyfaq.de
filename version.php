<?php
/**
 * API endpoint for api.phpmyfaq.de/verfiy/<version>
 *
 *
 */

ob_start('ob_gzhandler');
header('Content-type: application/json');

require 'phpmyfaq.php';

echo json_encode(
    array(
        'stable'      => PHPMYFAQ_STABLE_VERSION,
        'development' => PHPMYFAQ_DEV_VERSION
    )
);