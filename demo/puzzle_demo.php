<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Capy\PuzzleClient;
use Capy\PuzzleConst;

if($_POST['formSubmit'] == "Submit")
{
    $apiKey = "KEY_RXAX3cUJCfH9jSYybCFwwwmpEsML6X";
    $challenge_key = $_POST['capy_challengekey'];
    $answer = $_POST['capy_answer'];
    $client = new PuzzleClient($apiKey, 5);
    $result = $client->verify($challenge_key, $answer);
    switch ($result) {
        case PuzzleConst::Success:
            print "1";
            break;
        case PuzzleConst::IncorrectAnswer:
            print "2";
            break;
        case PuzzleConst::InvalidRequestMethod:
            print "3";
            break;
        case PuzzleConst::InvalidPostParameters:
            print "4";
            break;
        case PuzzleConst::InvalidPrivateKey:
            print "5";
            break;
        case PuzzleConst::InvalidChallengeKey:
            print "6";
            break;
        case PuzzleConst::InvalidCaptchaKey:
            print "7";
            break;
        case PuzzleConst::InvalidOnetimeCaptcha:
            print "8";
            break;
        case PuzzleConst::IsNotActive:
            print "9";
            break;
        case PuzzleConst::UnknownError:
            print "2";
            break;
        case PuzzleConst::Timeout:
            print "2";
            break;
        default:
            print "default";
            break;
    }
    echo json_encode($result);
}
?>
<form action="puzzle_demo.php" method="post">

    <script src="https://staging.capy.me/puzzle/get_js/?k=PUZZLE_WjN5eW14vEoQCXTHhgDHTDwkK22wzC"></script>

    <input type="submit" name="formSubmit" value="Submit">
</form>
