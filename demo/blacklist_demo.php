<?php

    require_once __DIR__ . '/../src/BlacklistClient.php';

    use Capy\BlacklistClient;
    use capy\BlacklistConst;

    if($_POST['formSubmit'] == "Submit")
    {
        $private_key = "KEY_RXAX3cUJCfH9jSYybCFwwwmpEsML6X";
        $blacklist_key = "KjEHdnJ6eXTSrp43uQuCygZ4Sm35XPyz";
        $ip_address = $_POST['capy_ipaddress'];
        $client = new BlacklistClient($private_key, 30, $blacklist_key);
        $result = $client->evaluate($ip_address);
        switch ($result["result"]) {
            case BlacklistConst::TooManySuccesses:
                print "1";
                break;
            case BlacklistConst::TooMayFailures:
                print "2";
                break;
            case BlacklistConst::NotFound:
                print "3";
                break;
            case BlacklistConst::FoundButExpired:
                print "4";
                break;
            case BlacklistConst::InWhiteList:
                print "5";
                break;
            case BlacklistConst::InvalidParameters:
                print "6";
                break;
            case BlacklistConst::InvalidIpAddress:
                print "7";
                break;
            case BlacklistConst::InvalidPrivateKey:
                print "8";
                break;
            case BlacklistConst::InvalidBlacklistKey:
                print "9";
                break;
            case BlacklistConst::CalculationError:
                print "10";
                break;
            case BlacklistConst::TimeOut:
                print "11";
                break;
            case BlacklistConst::Others:
                print "12";
                break;
            case BlacklistConst::UnknownError:
                print "13";
                break;
            default:
                print "14";
                break;

        }
        echo json_encode($result);
    }
?>

<form action="blacklist_demo.php" method="post">
    <input type="text" name="capy_ipaddress" value="">
    <input type="submit" name="formSubmit" value="Submit">
</form>
