<?php

require_once __DIR__ . '/../vendor/autoload.php';

use capy\BlacklistConst;
use Capy\BlacklistClient;

class BlacklistClientTest extends PHPUnit_Framework_TestCase
{
    var $client;
    const PRIVATE_KEY = "KEY_RXAX3cUJCfH9jSYybCFwwwmpEsML6X";
    const BLACKLIST_KEY = "KjEHdnJ6eXTSrp43uQuCygZ4Sm35XPyz";

    public function setUp()
    {
        $this->client = $this->getMockBuilder(\Capy\BlacklistClient::class)
            ->setConstructorArgs(array(self::PRIVATE_KEY, 5, self::BLACKLIST_KEY))
            ->setMethods(array('mappingData'))
            ->getMock();
    }

    public function testEvaluateSuccess()
    {
        $data = ["result"=>BlacklistConst::TooManySuccesses, "value"=>1];
        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::TooManySuccesses);
        $this->assertEquals($value["value"], 1);
    }

    public function testEvaluateTimeOut()
    {
        $this->client = new BlacklistClient(self::PRIVATE_KEY, 0.1, self::BLACKLIST_KEY);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value, BlacklistConst::TimeOut);
    }

    public function testEvaluateTooMayFailures()
    {
        $data = ["result"=>BlacklistConst::TooMayFailures, "value"=>1];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::TooMayFailures);
    }

    public function testEvaluateNotFound()
    {
        $data = ["result"=>BlacklistConst::NotFound, "value"=>0];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::NotFound);
    }

    public function testEvaluateFoundButExpired()
    {
        $data = ["result"=>BlacklistConst::FoundButExpired, "value"=>0];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::FoundButExpired);
    }

    public function testEvaluateInWhiteList()
    {
        $data = ["result"=>BlacklistConst::InWhiteList, "value"=>0];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::InWhiteList);
    }

    public function testEvaluateInvalidParameters()
    {
        $data = ["result"=>BlacklistConst::InvalidParameters, "value"=>null];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::InvalidParameters);
        $this->assertEquals($value["value"], null);
    }

    public function testEvaluateInvalidIpAddress()
    {
        $data = ["result"=>BlacklistConst::InvalidIpAddress, "value"=>null];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::InvalidIpAddress);
    }

    public function testEvaluateInvalidPrivateKey()
    {
        $data = ["result"=>BlacklistConst::InvalidPrivateKey, "value"=>null];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::InvalidPrivateKey);
    }

    public function testEvaluateInvalidBlacklistKeys()
    {
        $data = ["result"=>BlacklistConst::InvalidBlacklistKey, "value"=>null];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::InvalidBlacklistKey);
    }

    public function testEvaluateCalculationError()
    {
        $data = ["result"=>BlacklistConst::CalculationError, "value"=>null];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::CalculationError);
    }

    public function testEvaluateUnknownError()
    {
        $data = ["result"=>BlacklistConst::UnknownError, "value"=>null];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("192.168.0.10");
        $this->assertEquals($value["result"], BlacklistConst::UnknownError);
    }
}
