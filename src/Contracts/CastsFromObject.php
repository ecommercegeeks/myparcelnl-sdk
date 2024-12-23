<?php

namespace EcommerceGeeks\MyparcelSdk\Contracts;

interface CastsFromObject
{
    public static function fromObject(object $object) : self;
}
