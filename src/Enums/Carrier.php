<?php

namespace EcommerceGeeks\MyparcelSdk\Enums;

enum Carrier : int
{
    case PostNL = 1;
    case BPost = 2;
    case CheapCargo = 3;
    case DPD = 4;
    case UPS = 8;
    case DHLForYou = 9;
    case DHLParcelConnect = 10;
    case DHLEuroPlus = 11;
}
