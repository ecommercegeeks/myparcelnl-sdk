<?php

namespace EcommerceGeeks\MyparcelSdk\Tests;

use EcommerceGeeks\MyparcelSdk\Connector;
use EcommerceGeeks\MyparcelSdk\Enums\SortOrder;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Saloon\Http\Request;
use Saloon\Http\Response;

abstract class TestCase extends BaseTestCase
{
    protected bool $debug = false;

    protected static ?int $shipmentId = null;

    protected function connect() : Connector
    {
        $connector = new Connector($_ENV['API_KEY']);
        if($this->debug){
            $connector = $connector->debug();
        }
        return $connector;
    }

    function send(Request $request) : Response
    {
        return $this->connect()->send($request);
    }

    protected function getShipmentId() : int
    {
        return self::$shipmentId;
    }

    protected function setShipmentId(int $shipmentId) : self
    {
        self::$shipmentId = $shipmentId;
        return $this;
    }
}
