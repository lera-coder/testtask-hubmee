<?php

namespace App\Exceptions;

enum ErrorMessage
{
    const NO_ACCOUNT = 'Sorry, this account does not exist, try to login or contact support';
    const UNAUTHORIZED = 'Sorry, you don\'t have access this page. Authorize firstly, please';

}
