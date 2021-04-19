<?php

namespace Cognitiven\Rest\Endpoints;

use Phalcon\Db\Enum;
use Cognitiven\Rest\Services\ResponseService;
use Cognitiven\Rest\Services\FMPAPiService;
use Cognitiven\Rest\Endpoints\BaseEndpoint;

class StockOutlookEndpoint extends BaseEndpoint {

    public function get($symbolId) {
        $result = $this->db->query(
            'SELECT
                json
            FROM
                stock_outlook
            WHERE
                symbol_id = ' . $symbolId
        );

        $result->setFetchMode(Enum::FETCH_ASSOC);
        $stockOutlook = $result->fetch();

        return ResponseService::buildJSONResponse(
            200,
            'OK',
            array(
                'data' => json_decode($stockOutlook['json'])
            )
        );
    }
}