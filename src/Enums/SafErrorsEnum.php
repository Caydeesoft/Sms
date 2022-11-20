<?php
namespace Caydeesoft\Sms\Enums;

enum SafErrorsEnum: string
    {
        case SC0000 = "SUCCESS";
        case SC0001 = "USER_ID_MISSING";
        case SC0002 = "CRITICAL_ERROR";
        case SC0003 = "CAMP_ID_MISSING";
        case SC0004	= "USER_NAME_MISSING";
        case SC0005	= "PLAN_ID_MISSING";
        case SC0006	= "INCORRECT_USERNAME";
        case SC0007	= "USER_BLOCKED";
        case SC0008	= "FAILURE";
        case SC0009	= "QUOTA_THRESHOLD_REACHED";
        case SC0010	= "FAILED_DB_INSERTION";
        case SC0011	= "TOTAL_QUOTA_EXCEED";
        case SC0012	= "QUOTA_EXPIRED";
        case SC0020	= "MISSING MESSAGE TAG";
        case SC0021	= "MISSING MSISDN TAG";
        case SC0022	= "MISSING CHANNEL TAG";
        case SC0023	= "MISSING USERNAME TAG";
        case SC0024	= "MISSING UNIQUE ID TAG";
        case SC0025	= "MISSING SENDER NAME TAG";
        case SC0026	= "VALIDATION FAILED FOR PACKAGE ID";
        case SC0027	= "VALIDATION FAILED FOR SENDER NAME";
        case SC0028	= "INVALID USER";
        case SC0029	= "SYSTEM ERROR";
    }