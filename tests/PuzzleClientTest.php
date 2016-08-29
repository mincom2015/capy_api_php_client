<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Capy\PuzzleClient;
use capy\PuzzleConst;


class PuzzleClientTest extends PHPUnit_Framework_TestCase
{
    var $client;
    const PRIVATE_KEY = "KEY_RXAX3cUJCfH9jSYybCFwwwmpEsML6X";

    public function setUp()
    {
        $this->client = $this->getMockBuilder(PuzzleClient::class)
            ->setConstructorArgs(array(self::PRIVATE_KEY, 5))
            ->setMethods(array('mappingData'))
            ->getMock();
    }

    public function testVerifySuccess(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::Success);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::Success);
    }

    public function testVerifyTimeOutn(){
        $this->client = new PuzzleClient(self::PRIVATE_KEY, 0.1);
        $value = $this->client->verify("xxxxxxxxxxxxxxxxxxxxxxxxxx", "data-answer");
        $this->assertEquals($value, PuzzleConst::Timeout);
    }

    public function testVerifyIncorrectAnswer(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::IncorrectAnswer);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::IncorrectAnswer);
    }
    public function testVerifyInvalidRequestMethod(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::InvalidRequestMethod);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::InvalidRequestMethod);
    }
    public function testVerifyInvalidPostParameters(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::InvalidPostParameters);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::InvalidPostParameters);
    }
    public function testVerifyInvalidPrivateKey(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::InvalidPrivateKey);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::InvalidPrivateKey);
    }
    public function testVerifyInvalidChallengeKey(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::InvalidChallengeKey);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::InvalidChallengeKey);
    }
    public function testVerifyInvalidCaptchaKey(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::InvalidCaptchaKey);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::InvalidCaptchaKey);
    }
    public function testVerifyInvalidOnetimeCaptcha(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::InvalidOnetimeCaptcha);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::InvalidOnetimeCaptcha);
    }
    public function testVerifyIsNotActive(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::IsNotActive);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::IsNotActive);
    }
    public function testVerifyUnknownError(){
        $this->client->method('mappingData')
            ->willReturn(PuzzleConst::UnknownError);
        $value = $this->client->verify("challenge-key", "data-answer");
        $this->assertEquals($value, PuzzleConst::UnknownError);
    }
}
