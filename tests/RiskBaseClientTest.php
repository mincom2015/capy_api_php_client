<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Capy\RiskBaseClient;
use capy\CapyMapping;
use capy\RiskbaseConst;


class RiskBaseClientTest extends PHPUnit_Framework_TestCase
{
    var $client;
    const PRIVATE_KEY = "KEY_RXAX3cUJCfH9jSYybCFwwwmpEsML6X";
    const RISKBASE_KEY = "zc9WHNZ9t2Ly7rPjojNsZzHWAFVd7imQ";

    public function setUp()
    {
        $this->client = $this->getMockBuilder(RiskBaseClient::class)
            ->setConstructorArgs(array(self::PRIVATE_KEY, 2, self::RISKBASE_KEY))
            ->setMethods(array('mappingData'))
            ->getMock();
    }

    public function testEvaluateSuccess()
    {
        $data = ["result"=>RiskbaseConst::Success, "value"=>0.7, "reasons" => array(RiskbaseConst::DifferentContinent, RiskbaseConst::DifferentCountry)];
        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value, $data);
    }

    public function testEvaluateTimeOut()
    {
        $client = new RiskBaseClient(self::RISKBASE_KEY, 0.1, self::RISKBASE_KEY);
        $result = $client->evaluate("xxx", "xxxx");

        $this->assertEquals($result["result"], RiskbaseConst::TimeOut);
    }

    public function testEvaluateInBlackList()
    {
        $data = ["result"=>RiskbaseConst::Success, "value"=>0.7, "reasons" => array(RiskbaseConst::InBlackList)];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["reasons"], array(RiskbaseConst::InBlackList));
    }

    public function testEvaluateNotInDataBase()
    {
        $data = ["result"=>RiskbaseConst::NotInDataBase, "value"=>-1, "reasons" => array()];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["result"], RiskbaseConst::NotInDataBase);
    }

    public function testEvaluateBadRequest()
    {
        $data = ["result"=>RiskbaseConst::BadRequest, "value"=>-1, "reasons" => array()];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["result"], RiskbaseConst::BadRequest);
    }

    public function testEvaluateInvalidParameters()
    {
        $data = ["result"=>RiskbaseConst::InvalidParameters, "value"=>-1, "reasons" => array()];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["result"], RiskbaseConst::InvalidParameters);
    }

    public function testEvaluateIncorrectParameters()
    {
        $data = ["result"=>RiskbaseConst::IncorrectParameters, "value"=>-1, "reasons" => array()];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["result"], RiskbaseConst::IncorrectParameters);
    }

    public function testEvaluateInvalidPrivateKey()
    {
        $data = ["result"=>RiskbaseConst::InvalidPrivateKey, "value"=>-1, "reasons" => array()];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["result"], RiskbaseConst::InvalidPrivateKey);
    }

    public function testEvaluateInvalidUsername()
    {
        $data = ["result"=>RiskbaseConst::InvalidUsername, "value"=>-1, "reasons" => array()];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["result"], RiskbaseConst::InvalidUsername);
    }

    public function testEvaluateEvaluationError()
    {
        $data = ["result"=>RiskbaseConst::EvaluationError, "value"=>-1, "reasons" => array()];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["result"], RiskbaseConst::EvaluationError);
    }

    public function testEvaluateDataBaseError()
    {
        $data = ["result"=>RiskbaseConst::DataBaseError, "value"=>-1, "reasons" => array()];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["result"], RiskbaseConst::DataBaseError);
    }

    public function testEvaluateUnknownError()
    {
        $data = ["result"=>RiskbaseConst::UnknownError, "value"=>-1, "reasons" => array()];

        $this->client->method('mappingData')->willReturn($data);
        $value = $this->client->evaluate("MkFraVhEWmIyNHA1d3FFUToXQ7MzR1r4N+Zr99l0vx99BVbWQTIuki38ZJWkGKF8GRc6wzZQUf054WyasBreJEs5fbM+Mi7rWuB27MxlrhV/CUrUMTwikFrAVszsAN....");
        $this->assertEquals($value["result"], RiskbaseConst::UnknownError);
    }
}
