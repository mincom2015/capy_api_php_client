<?php

require_once __DIR__ . '/../vendor/autoload.php';
use Capy\AvatarClient;
use Capy\AvatarConst;

if($_POST['formSubmit'] == "Submit")
{
    $privatekey = "KEY_RXAX3cUJCfH9jSYybCFwwwmpEsML6X";
    $challenge_key = $_POST['capy_challengekey'];
    $answer = $_POST['capy_answer'];
    $client = new AvatarClient($privatekey, 5);
    $result = $client->verify($challenge_key, $answer);
    switch ($result){
        case AvatarConst::Success;
            print "";
            break;
        case AvatarConst::IncorrectAnswer;
            print "";
            break;
        case AvatarConst::InvalidRequestMethod;
            print "";
            break;
        case AvatarConst::InvalidPostParameters;
            print "";
            break;
        case AvatarConst::InvalidChallengeKey;
            print "";
            break;
        case AvatarConst::IsNotActive;
            print "";
            break;
        case AvatarConst::UnknownError;
            print "";
            break;
        case AvatarConst::Timeout;
            print "";
            break;
        default:
            print "";
            break;
    }
    echo json_encode($result);
}
?>

<form action="avatar_demo.php" method="post">
    <script src="https://jp.api.capy.me/avatar/get_js/?k=7ui5niy346dHL51SsPfHEntr17y3U4"></script>

    <input type="submit" name="formSubmit" value="Submit">
</form>
