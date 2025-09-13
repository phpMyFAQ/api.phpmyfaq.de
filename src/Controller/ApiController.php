<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use const PHPMYFAQ_DEV_RELEASE;
use const PHPMYFAQ_DEV_VERSION;
use const PHPMYFAQ_STABLE_RELEASE;
use const PHPMYFAQ_STABLE_VERSION;

class ApiController
{
    public static function home(): Response
    {
        return new JsonResponse("It's full of stars!");
    }

    public static function versions(): Response
    {
        $yesterday = date('Y-m-d', strtotime('-1 days'));

        return new JsonResponse([
            'stable' => defined('PHPMYFAQ_STABLE_VERSION') ? PHPMYFAQ_STABLE_VERSION : null,
            'stable_released' => defined('PHPMYFAQ_STABLE_RELEASE') ? PHPMYFAQ_STABLE_RELEASE : null,
            'development' => defined('PHPMYFAQ_DEV_VERSION') ? PHPMYFAQ_DEV_VERSION : null,
            'development_released' => defined('PHPMYFAQ_DEV_RELEASE') ? PHPMYFAQ_DEV_RELEASE : null,
            'nightly' => 'nightly-' . $yesterday,
            'nightly_released' => $yesterday,
        ]);
    }

    public static function versionStable(): Response
    {
        return new JsonResponse(defined('PHPMYFAQ_STABLE_VERSION') ? PHPMYFAQ_STABLE_VERSION : null);
    }

    public static function versionDevelopment(): Response
    {
        return new JsonResponse(defined('PHPMYFAQ_DEV_VERSION') ? PHPMYFAQ_DEV_VERSION : null);
    }

    public static function versionNightly(): Response
    {
        $yesterday = date('Y-m-d', strtotime('-1 days'));
        return new JsonResponse('nightly-' . $yesterday);
    }

    public static function verify(string $version): Response
    {
        $isValid = (bool) preg_match('#^\d+\.\d+(?:\.\d+)?(?:-(?:alpha|beta|rc)(?:\.?\d+)?)?$#i', $version);
        $file = __DIR__ . '/../../json/hashes-' . $version . '.json';

        if ($isValid && is_file($file)) {
            $contents = file_get_contents($file);
            return new Response($contents, 200, ['Content-Type' => 'application/json']);
        }

        return new JsonResponse('The greatest enemy of knowledge is not ignorance, it is the illusion of knowledge.', 418);
    }
}
