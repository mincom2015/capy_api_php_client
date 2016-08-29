<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Capy\RiskBaseClient;
use Capy\RiskbaseConst;

if($_POST['formSubmit'] == "Submit")
{
    $private_key = "KEY_RXAX3cUJCfH9jSYybCFwwwmpEsML6X";
    $riskbase_key = "zc9WHNZ9t2Ly7rPjojNsZzHWAFVd7imQ";
    $capy_data = $_POST['capy_data'];
    $client = new RiskBaseClient($private_key, 5, $riskbase_key);
    $result = $client->evaluate($capy_data);
    switch ($result["result"]) {
        case RiskbaseConst::Success;
            print "1";
            break;
        case RiskbaseConst::InvalidParameters;
            print "2";
            break;
        case RiskbaseConst::IncorrectParameters;
            print "3";
            break;
        case RiskbaseConst::InvalidPrivateKey;
            print "4";
            break;
        case RiskbaseConst::InvalidUsername;
            print "5";
            break;
        case RiskbaseConst::EvaluationError;
            print "6";
            break;
        case RiskbaseConst::DataBaseError;
            print "7";
            break;
        case RiskbaseConst::NotInDataBase;
            print "8";
            break;
        case RiskbaseConst::BadRequest;
            print "9";
            break;
        case RiskbaseConst::TimeOut;
            print "10";
            break;
        case RiskbaseConst::UnknownError;
            print "11";
            break;
        default;
            print "12";
            break;
    }
    echo json_encode($result);
}
?>

<form action="riskbase_demo.php" method="post">
    <script src="http://localhost:8000/riskbase/riskbases/zc9WHNZ9t2Ly7rPjojNsZzHWAFVd7imQ/js"></script>
    <input type="text" name="username" value="">
    <input type="submit" name="formSubmit" value="Submit">
</form>
