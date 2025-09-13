<?php
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Controller\ApiController;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../phpmyfaq.php';

$request = Request::createFromGlobals();

// Simple CORS helper
$applyCors = function (Response $response): Response {
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    $response->headers->set('Access-Control-Allow-Headers', 'origin, content-type, accept, x-requested-with');
    $response->headers->set('Access-Control-Max-Age', '3600');
    return $response;
};

// Preflight handling
if ($request->getMethod() === 'OPTIONS') {
    $response = new Response('', 204);
    $applyCors($response)->send();
    return;
}

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    '_controller' => [ApiController::class, 'home'],
], [], [], '', [], ['GET']));

$routes->add('versions', new Route('/versions', [
    '_controller' => [ApiController::class, 'versions'],
], [], [], '', [], ['GET']));

$routes->add('version_stable', new Route('/version/stable', [
    '_controller' => [ApiController::class, 'versionStable'],
], [], [], '', [], ['GET']));

$routes->add('version_development', new Route('/version/development', [
    '_controller' => [ApiController::class, 'versionDevelopment'],
], [], [], '', [], ['GET']));

$routes->add('version_nightly', new Route('/version/nightly', [
    '_controller' => [ApiController::class, 'versionNightly'],
], [], [], '', [], ['GET']));

$routes->add('verify', new Route('/verify/{version}', [
    '_controller' => [ApiController::class, 'verify'],
], [
    'version' => '.+',
], [], '', [], ['GET']));

$context = new RequestContext()->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($request->getPathInfo());
    $controller = $parameters['_controller'];
    unset($parameters['_controller'], $parameters['_route']);

    // Argumente aus Routenparametern extrahieren (nur benötigte, z. B. 'version')
    $args = [];
    if (array_key_exists('version', $parameters)) {
        $args[] = (string) $parameters['version'];
    }

    /** @var Response $response */
    $response = call_user_func_array($controller, $args);
    $applyCors($response)->send();
} catch (ResourceNotFoundException $e) {
    $response = new JsonResponse(['error' => 'Not Found'], 404);
    $applyCors($response)->send();
} catch (Throwable $e) {
    $response = new JsonResponse(['error' => 'Internal Server Error'], 500);
    $applyCors($response)->send();
}
