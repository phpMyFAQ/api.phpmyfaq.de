<?php
header('Content-type: application/json');

require_once '../version.php';

print json_encode(
    array(
        'stable'   => PHPMYFAQ_STABLE_VERSION,
        'unstable' => PHPMYFAQ_DEV_VERSION
    )
);