<?php
namespace Capy;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/capy_const.php';

use GuzzleHttp\Exception\RequestException;
use Exception;


abstract class BaseClient
{
    var $privateKey; // You can see the key on server capy https://jp.api.capy.em/account/edit
    var $timeOut; // request has timeout when call server capy (unit: seconds)
    var $key; // This key is one in puzzle_key/avatar_key/blacklist_key/riskbase_key
    const CAPY_URL = "https://staging.capy.me/";

    function __construct($private_key, $time_out, $key=null)
    {
        $this->privateKey = $private_key;
        $this->timeOut = $time_out;
        $this->key=$key;
    }

    protected function execute($client, $params, $url)
    {
        try {
            $response = $client->post($url, $params);
            $value = $this->mappingData($response->getBody());
            return $value;
        } catch (RequestException $e) {
            throw new Exception($e->getHandlerContext()['error'], $e->getHandlerContext()['errno']);
        }
    }

    protected abstract function mappingData($value);
}
