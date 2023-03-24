<?php

require_once __DIR__ ."/../ErrorMsg.php";

class MailPassConnectionIncorectException extends Exception
{
    public function __construct()
    {
        $this->code = ErrorMsg::PASSWORD_OR_MAIL_INCORECT;
    }
}
