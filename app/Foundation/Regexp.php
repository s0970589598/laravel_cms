<?php

namespace App\Foundation;

class Regexp
{
    const PHONE = '((?=(09))[0-9]{10})$';
    const PASSWORD = '^(?![0-9]+$)(?![a-zA-Z]+$)[\w\x21-\x7e]{6,18}$';

    const RESOURCE_ID = '^[1-9][0-9]*$';
    const USERNAME = '^[\w\x7f-\xff]{2,20}$';
}