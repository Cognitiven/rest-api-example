<?php

error_reporting(E_ALL);

use Phalcon\Loader;
use Phalcon\Mvc\Micro\Collection as MicroCollection;
use Cognitiven\Rest\Application;

use Cognitiven\Rest\Services\ResponseService;
use Cognitiven\Rest\Endpoints\StockOutlookEndpoint;

try {
    $loader = new Loader();
    $loader ->registerNamespaces(
        [
            'Cognitiven\Rest' => '../app/',
            'Cognitiven\Rest\Services' => '../app/services/',
            'Cognitiven\Rest\Endpoints' => '../app/endpoints/'
        ]
    )->register();

    $application = new Application();
    $app = $application->context;

    // Docs Endpoints
    $stockOutlook = new MicroCollection();
    $stockOutlook
        ->setHandler(StockOutlookEndpoint::class)
        ->setLazy(true)
        ->setPrefix('/api/v1/stocks')
        ->get('/{stockId}/outlook', 'get');

    $app->mount($stockOutlook);

    $app->notFound(function () use ($app) {
        return ResponseService::buildJSONResponse(
            404,
            'Not Found',
            array('error' => 'This endpoint is either incorrect or it does not exist')
        );
    });

    $app->handle(
        $_SERVER["REQUEST_URI"]
    );

}
catch (InvalidApiKeyException $e) {
    return ResponseService::buildJSONResponse(
        401,
        'Unauthorized',
        array('error' => $e->getMessage())
    );
}
catch (ValidationException $e) {
    return ResponseService::buildJSONResponse(
        400,
        'Bad Request',
        array('error' => $e->getMessage())
    );
}
catch (\Exception $e) {
    switch ($_SERVER['HTTP_HOST']) {
        case 'rest.api':
            return ResponseService::buildJSONResponse(
                400,
                'Bad Request',
                array('error' => $e->getMessage())
            );

            break;
        default:
            return ResponseService::buildJSONResponse(
                400,
                'Bad Request',
                array('error' => 'Something went wrong')
            );

            break;
    }
}
