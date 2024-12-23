<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;
use Saloon\Http\Request;

abstract class MyparcelRequest extends Request
{
    public string $dateFormat = 'Y-m-d';
}