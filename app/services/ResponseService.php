<?php

namespace Cognitiven\Rest\Services;

use Phalcon\Http\Response;

class ResponseService {

    public static function buildJSONResponse($responseCode, $responseDetails, $responseContent) {
        $response = new Response();
        $response->setContentType('application/json', 'UTF-8');
        $response->setStatusCode($responseCode, $responseDetails);

        $response->setContent(
            json_encode($responseContent)
        );

        $response->send();
    }
}