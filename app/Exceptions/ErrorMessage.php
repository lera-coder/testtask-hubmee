<?php

namespace App\Exceptions;

enum ErrorMessage
{
    const NO_ACCOUNT = 'Sorry, this account does not exist, try to login or contact support';
    const UNAUTHORIZED = 'Sorry, you don\'t have access this page. Authorize firstly, please';
    const POST_NOT_FOUND = 'The post you try to access does not exist, please, try again';
    const SOMETHING_WENT_WRONG = 'Whoops, something went wrong';
    const AUTHENTICATION_ERROR = 'Something is wrong with your user account, contact support';
    const NO_ACCESS_TO_POST = 'Sorry, you cannot do anything with post, except of looking';

}
