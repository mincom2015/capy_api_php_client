<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Capy\AvatarClient;
use capy\AvatarConst;


class AvatarClientTest extends PHPUnit_Framework_TestCase
{
    var $client;
    const PRIVATE_KEY = "KEY_RXAX3cUJCfH9jSYybCFwwwmpEsML6X";

    public function setUp()
    {

        $this->client = $this->getMockBuilder(AvatarClient::class)
            ->setConstructorArgs(array(self::PRIVATE_KEY, 2000))
            ->setMethods(array('mappingData'))
            ->getMock();
    }

    public function testVerifySuccess()
    {
        $this->client->method('mappingData')->willReturn(AvatarConst::Success);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, AvatarConst::Success);
    }

    public function testVerifyTimeOut()
    {
        $this->client = new AvatarClient(self::PRIVATE_KEY, 0.1);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, AvatarConst::Timeout);
    }
    public function testVerifyIncorrectAnswer()
    {
        $this->client->method('mappingData')->willReturn(AvatarConst::IncorrectAnswer);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, AvatarConst::IncorrectAnswer);
    }

    public function testVerifyInvalidRequestMethod()
    {
        $this->client->method('mappingData')->willReturn(AvatarConst::InvalidRequestMethod);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, AvatarConst::InvalidRequestMethod);
    }

    public function testVerifyInvalidPostParameters()
    {
        $this->client->method('mappingData')->willReturn(AvatarConst::InvalidPostParameters);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, AvatarConst::InvalidPostParameters);
    }

    public function testVerifyInvalidChallengeKey()
    {
        $this->client->method('mappingData')->willReturn(AvatarConst::InvalidChallengeKey);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, AvatarConst::InvalidChallengeKey);
    }

    public function testVerifyIsNotActive()
    {
        $this->client->method('mappingData')->willReturn(AvatarConst::IsNotActive);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, AvatarConst::IsNotActive);
    }

    public function testVerifyUnknownError()
    {
        $this->client->method('mappingData')->willReturn(AvatarConst::UnknownError);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, AvatarConst::UnknownError);
    }
}
