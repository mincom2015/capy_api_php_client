<?php
namespace Capy;

require_once __DIR__ . '/BaseClient.php';

use GuzzleHttp\Client;
use Exception;
use capy\CapyMapping;

class BlacklistClient extends BaseClient
{

    function evaluate($ip_address)
    {
        try {
            $client = new Client(["base_uri" => self::CAPY_URL,
                "timeout" => $this->timeOut,
                "stream" => false ]);

            $params = ["form_params" => ["capy_privatekey" => $this->privateKey,
                "capy_ipaddress" => $ip_address]];

            $url = "blacklist/blacklists/". $this->key ."/evaluate";
            $value = $this->execute($client, $params, $url);
            return $value;
        } catch (Exception $e) {
            if ($e->getCode() == 28) {
                return BlacklistConst::TimeOut;
            }
            return BlacklistConst::UnknownError;
        }
    }

    protected function mappingData($input)
    {
        try {
            $values = json_decode($input);
            $result = isset(CapyMapping::$blacklist_mapping[$values->result]) ? CapyMapping::$blacklist_mapping[$values->result] : BlacklistConst::Others;
            $data = [
                "result" => $result,
                "value" => $values->value];
            return $data;

        } catch (Exception $e) {
            return BlacklistConst::UnknownError;
        }
    }
}
