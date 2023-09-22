<?php
/**
 * API endpoints for
 *
 * - api.phpmyfaq.de/versions
 * - api.phpmyfaq.de/version/stable
 * - api.phpmyfaq.de/version/development
 * - api.phpmyfaq.de/version/nightly
 *
 */

ob_start('ob_gzhandler');
header('Content-type: application/json');

require 'phpmyfaq.php';

$branch = filter_input(INPUT_GET, 'branch', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$yesterday = date('Y-m-d',strtotime('-1 days'));;

echo match ($branch) {
    'stable' => json_encode(PHPMYFAQ_STABLE_VERSION),
    'development' => json_encode(PHPMYFAQ_DEV_VERSION),
    'nightly' => json_encode('nightly-' . $yesterday),
    default => json_encode(
        [
            'stable' => PHPMYFAQ_STABLE_VERSION,
            'stable_released' => PHPMYFAQ_STABLE_RELEASE,
            'development' => PHPMYFAQ_DEV_VERSION,
            'development_released' => PHPMYFAQ_DEV_RELEASE,
            'nightly' => 'nightly-' . $yesterday,
            'nightly_released' => $yesterday
        ]
    ),
};

exit();
