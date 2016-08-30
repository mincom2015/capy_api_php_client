<?php
namespace Capy;

class PuzzleConst
{
    const Success = "Success";
    const IncorrectAnswer = "IncorrectAnswer";
    const InvalidRequestMethod = "InvalidRequestMethod";
    const InvalidPostParameters = "InvalidPostParameters";
    const InvalidPrivateKey = "InvalidPrivateKey";
    const InvalidChallengeKey = "InvalidChallengeKey";
    const InvalidCaptchaKey = "InvalidCaptchaKey";
    const InvalidOnetimeCaptcha = "InvalidOnetimeCaptcha";
    const IsNotActive = "IsNotActive";
    const UnknownError = "UnknownError";
    const Timeout = "Timeout";
}

class AvatarConst
{
    const Success = "Success";
    const IncorrectAnswer = "IncorrectAnswer";
    const InvalidRequestMethod = "InvalidRequestMethod";
    const InvalidPostParameters = "InvalidPostParameters";
    const InvalidChallengeKey = "InvalidChallengeKey";
    const IsNotActive = "IsNotActive";
    const UnknownError = "UnknownError";
    const Timeout = "Timeout";
}

class BlacklistConst
{
    const TooManySuccesses = "TooManySuccesses";
    const TooMayFailures = "TooMayFailures";
    const NotFound = "NotFound";
    const FoundButExpired = "FoundButExpired";
    const InWhiteList = "InWhiteList";
    const InvalidParameters = "InvalidParameters";
    const InvalidIpAddress = "InvalidIpAddress";
    const InvalidPrivateKey = "InvalidPrivateKey";
    const InvalidBlacklistKey = "InvalidBlacklistKey";
    const CalculationError = "CalculationError";
    const Others = "Others";
    const UnknownError = "UnknownError";
    const TimeOut = "TimeOut";
}

class RiskbaseConst
{
    const Success = "Success";
    const InBlackList = "InBlackList";
    const InvalidParameters = "InvalidParameters";
    const IncorrectParameters = "IncorrectParameters";
    const InvalidPrivateKey = "InvalidPrivateKey";
    const InvalidUsername = "InvalidUsername";
    const EvaluationError = "EvaluationError";
    const DataBaseError = "DataBaseError";
    const DifferentISP = "DifferentISP";
    const DifferentCountry = "DifferentCountry";
    const DifferentBrowser = "DifferentBrowser";
    const DifferentContinent = "DifferentContinent";
    const NotInDataBase = "NotInDataBase";
    const BadRequest = "BadRequest";
    const UnknownError = "UnknownError";
    const TimeOut = "TimeOut";
}

class CapyMapping
{
    public static $puzzle_mapping = array(
        "success" => PuzzleConst::Success,
        "incorrect-answer" => PuzzleConst::IncorrectAnswer,
        "invalid-request-method" => PuzzleConst::InvalidRequestMethod,
        "invalid-post-parameters" => PuzzleConst::InvalidPostParameters,
        "invalid-private-key" => PuzzleConst::InvalidPrivateKey,
        "invalid-challenge-key" => PuzzleConst::InvalidChallengeKey,
        "invalid-captcha-key" => PuzzleConst::InvalidCaptchaKey,
        "is-not-active" => PuzzleConst::IsNotActive,
        "invalid-onetime-captcha" => PuzzleConst::InvalidOnetimeCaptcha,
        "unknown-error" => PuzzleConst::UnknownError
    );

    public static $avatar_mapping = array(
        "success" => AvatarConst::Success,
        "incorrect-answer" => AvatarConst::IncorrectAnswer,
        "invalid-request-method" => AvatarConst::InvalidRequestMethod,
        "invalid-post-parameters" => AvatarConst::InvalidPostParameters,
        "invalid-challenge-key" => AvatarConst::InvalidChallengeKey,
        "is-not-active" => AvatarConst::IsNotActive,
        "unknown-error" => AvatarConst::UnknownError
    );

    public static $blacklist_mapping = array(
        "too-many-successes" => BlacklistConst::TooManySuccesses,
        "too-many-failures" => BlacklistConst::TooMayFailures,
        "not-found" => BlacklistConst::NotFound,
        "found-but-expired" => BlacklistConst::FoundButExpired,
        "in-whitelist" => BlacklistConst::InWhiteList,
        "others" => BlacklistConst::Others,
        "invalid-parameters" => BlacklistConst::InvalidParameters,
        "invalid-privatekey" => BlacklistConst::InvalidPrivateKey,
        "invalid-ip-address" => BlacklistConst::InvalidIpAddress,
        "invalid-blacklist-key" => BlacklistConst::InvalidBlacklistKey,
        "unknown-error" => BlacklistConst::UnknownError,
        "calculation-error" => BlacklistConst::CalculationError
    );

    public static $riskbase_mapping = array(
        "success" => RiskbaseConst::Success,
        "in-blacklist" => RiskbaseConst::InBlackList,
        "not-in-database" => RiskbaseConst::NotInDataBase,
        "bad-request" => RiskbaseConst::BadRequest,
        "invalid-parameters" => RiskbaseConst::InvalidParameters,
        "incorrect-parameters" => RiskbaseConst::IncorrectParameters,
        "invalid-privatekey" => RiskbaseConst::InvalidPrivateKey,
        "invalid-username" => RiskbaseConst::InvalidUsername,
        "evaluation-error" => RiskbaseConst::EvaluationError,
        "database-error" => RiskbaseConst::DataBaseError,
        "unknown-error" => RiskbaseConst::UnknownError,
        "different-isp" => RiskbaseConst::DifferentISP,
        "different-country" => RiskbaseConst::DifferentCountry,
        "different-browser" => RiskbaseConst::DifferentBrowser,
        "different-continent" => RiskbaseConst::DifferentContinent
    );
}
