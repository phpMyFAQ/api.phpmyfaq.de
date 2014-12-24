<?php
/**
 * API endpoint for /
 *
 * Nothing to see
 *
 */

ob_start('ob_gzhandler');
header('Content-type: application/json');

echo json_encode("It's full of stars!");