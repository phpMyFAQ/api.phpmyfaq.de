<?php
/**
 * API endpoints for
 *
 * - api.phpmyfaq.de/versions
 * - api.phpmyfaq.de/version/stable
 * - api.phpmyfaq.de/version/development
 *
 */

ob_start('ob_gzhandler');
header('Content-type: application/json');

require 'phpmyfaq.php';

$branch = filter_input(INPUT_GET, 'branch', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

echo match ($branch) {
    'stable' => json_encode(PHPMYFAQ_STABLE_VERSION),
    'development' => json_encode(PHPMYFAQ_DEV_VERSION),
    default => json_encode(
        [
            'stable' => PHPMYFAQ_STABLE_VERSION,
            'stable_released' => PHPMYFAQ_STABLE_RELEASE,
            'development' => PHPMYFAQ_DEV_VERSION,
            'development_released' => PHPMYFAQ_DEV_RELEASE
        ]
    ),
};

exit();
