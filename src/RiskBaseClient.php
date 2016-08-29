<?php
namespace Capy;

require_once __DIR__ . '/BaseClient.php';

use GuzzleHttp\Client;
use Exception;
use capy\CapyMapping;
use GuzzleHttp\Exception\RequestException;

class RiskBaseClient extends BaseClient
{

    function evaluate($capy_data)
    {
        try {
            $client = new Client(["base_uri" => self::CAPY_URL,
                "timeout" => $this->timeOut,
                "stream" => false]);

            $params = ["form_params" => ["capy_privatekey" => $this->privateKey,
                "capy_data" => $capy_data]];

            $url = "riskbase/v0.1/riskbases/". $this->key ."/evaluate";
            $value = $this->execute($client, $params, $url);
            return $value;
        } catch (Exception $e) {
            if ($e->getCode() == 28) {
                return ["result" => RiskbaseConst::TimeOut];
            }
            return ["result" => RiskbaseConst::UnknownError];
        }
    }

    protected function mappingData($value)
    {
        $values = json_decode($value);
        $data = ["result" => CapyMapping::$riskbase_mapping[$values->result],
            "value" => $values->value,
            "reasons" => $this->reasonMapping($values->reasons)];
        return $data;
    }

    private function reasonMapping($input){
        $reason = [];
        for ($i=0; $i<count($input); $i++) {
            $reason[$i] = CapyMapping::$riskbase_mapping[$input[$i]];
        }
        return $reason;
    }
}
