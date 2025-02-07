<?php

namespace EcommerceGeeks\MyparcelSdk\Enums;

enum DeliveryType : int
{
    case Morning = 1;
    case Standard = 2;
    case Evening = 3;
    case Pickup = 4;
    case PickupExpress = 5;
}
