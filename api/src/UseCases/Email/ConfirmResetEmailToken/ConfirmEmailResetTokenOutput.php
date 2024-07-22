<?php

namespace Src\UseCases\Email\ConfirmResetEmailToken;

class ConfirmEmailResetTokenOutput
{
    public function __construct(
        public bool $isValid
    )
    {

    }
}
