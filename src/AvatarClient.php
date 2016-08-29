<?php
namespace Capy;

require_once __DIR__ . '/BaseClient.php';

use GuzzleHttp\Client;
use Exception;

class AvatarClient extends BaseClient
{

    function verify($challenge_key, $answer)
    {
        try {
            $client = new Client(["base_uri" => self::CAPY_URL,
                "timeout" => $this->timeOut,
                "stream" => false ]);

            $params = ["form_params" => ["capy_privatekey" => $this->privateKey,
                "capy_challengekey" => $challenge_key,
                "capy_answer" => $answer]];

            $url = "avatar/verify";
            $value = $this->execute($client, $params, $url);
            return $value;
        } catch (Exception $e) {
            if ($e -> getCode() == 28) {
                return PuzzleConst::Timeout;
            }
            return PuzzleConst::UnknownError;
        }

    }

    protected function mappingData($value)
    {
        try {
            $array = explode("\n", $value);
            $result = CapyMapping::$avatar_mapping[$array[1]];
            return $result;
        } catch (Exception $e) {
            return AvatarConst::UnknownError;
        }


    }
}
