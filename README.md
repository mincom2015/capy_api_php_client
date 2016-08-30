# capy-api-php-client
### Capy PHP client library makes verify puzzle/avatar and evaluate blacklist/riskbase for capy's services become easier:

## Installation
The Capy PHP library client Provider can be installed via Composer by requiring the capy/capy_api_client package in your project's composer.json .
```sh
 "require": {
    "capy/capy_api_client": "~1.0"
 },
 ```
 or 
 
 Require this package with composer:
 ```sh
 composer require capy/capy_api_client

 ```

## Usage
### I. Puzzle verify:
**_Step 1_: Create new instance**

$puzzleClient = new PuzzleClient($privateKey, $timeout);

With parameters:
- $privateKey: An API key is a key used for verifying site ownership. It can be obtained from [show privatekey][1]
- $timeOut : Request to server CAPY is Timeout (seconds)

**_Step 2_: Implement verify**
- $result = $puzzleClient.verify($capy_challengekey, $capy_answer)

With parameters:
- $capy_chanllengekey = $_POST['capy_challengekey'];
- $capy_answer = $_POST['capy_answer'];
 
**_Step 3_: Handle data result**

```sh
switch ($result) {
    case PuzzleConst::Success:
      rint "1";
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
}
```

### II. Avatar verify:
**_Step 1_: Create new instance**

$avatarClient = new AvatarClient($privateKey, $timeout);

With parameters:
- $privateKey: An API key is a key used for verifying site ownership. It can be obtained from [show privatekey][1]
- $timeOut : Request to server CAPY is Timeout (seconds)

**_Step 2_: Implement verify**
- $result = $avatarClient.verify($capy_challengekey, $capy_answer)

With parameters:
- $capy_chanllengekey = $_POST['capy_challengekey'];
- $capy_answer = $_POST['capy_answer'];
 
**_Step 3_: Handle data result**

```sh
switch ($result){
    case AvatarConst::Success;
        print "1";
        break;
    case AvatarConst::IncorrectAnswer;
        print "2";
        break;
    case AvatarConst::InvalidRequestMethod;
        print "3";
        break;
    case AvatarConst::InvalidPostParameters;
        print "4";
        break;
    case AvatarConst::InvalidChallengeKey;
        print "5";
        break;
    case AvatarConst::IsNotActive;
        print "6";
        break;
    case AvatarConst::UnknownError;
        print "7";
        break;
    case AvatarConst::Timeout;
        print "8";
        break;
}
```

### III. Blacklist evaluate:
**_Step 1_: Create new instance**

$blacklistClient = new BlacklistClient($apiKey, $timeout, $blacklist_key);

With parameters:
- $apiKey: An API key is a key used for verifying site ownership. It can be obtained from [show api key][1]
- $timeOut : Request to server CAPY is Timeout (seconds)
- $blacklist_key = The key will get from capy server [show blacklist key][2] ;

**_Step 2_: Implement verify**
- $result = $blacklistClient.evaluate($ip_address)

With parameters:
- $ip_address = $_POST['ip_address'];

$result value:
- ["result"=>BlacklistConst::TooManySuccesses, "value"=>0.1]
 
**_Step 3_: Handle data result**

```sh
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
}
```

### IV. Riskbase evaluate:
**_Step 1_: Create new instance**

$riskbaseClient = new RiskbaseClient($apiKey, $timeout, $riskbase_key);

With parameters:
- $apiKey: An API key is a key used for verifying site ownership. It can be obtained from [show api key][1]
- $timeOut : Request to server CAPY is Timeout (seconds)
- $riskbase_key = The key will get from capy server [show riskbase key][3] ;

**_Step 2_: Implement verify**
- $result = $riskbaseClient.evaluate($capy_data)

With parameters:
- $capy_data = $_POST['capy_data'];

$result value:
- ["result"=>RiskbaseConst::Success, "value"=>0.7, "reasons"=>[RiskbaseConst::DifferentISP, RiskbaseConst::DifferentCountry]]
 
**_Step 3_: Handle data result**

```sh
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
}
```

[1]: https://jp.api.capy.me/account/edit/
[2]: https://jp.api.capy.me/blacklist/
[3]: https://jp.api.capy.me/riskbase/