<?php

class GlobalSettings {    

    const ENVIRONMENT = 'DEV';
    //const ENVIRONMENT = 'PRE';

    const CREATE_TABLE = 'TRU';

    const ERRORS = [
        'FILE_NOT_UPLOAD!'                  => 0,
        'INVALID_PASSWORD!'                 => 1,
        'PASSWORDS_NOT_MATCH!'              => 2,
        'NAME_CAN_NOT_BE_EMPTY!'            => 3,
        'SURNAME_CAN_NOT_BE_EMPTY!'         => 4,
        'EMAIL_CAN_NOT_BE_EMPTY!'           => 5,
        'USERNAME_CAN_NOT_BE_EMPTY!'        => 6,
        'PASSWORD_CAN_NOT_BE_EMPTY!'        => 7,
        'USER_WITH_THIS_EMAIL_EXISTS!'      => 8,
        'USER_WITH_THIS_USERNAME_EXISTS!'   => 9,
        'TITLE_CAN_NOT_BE_EMPTY!'           => 10
    ];

}
