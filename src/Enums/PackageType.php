<?php

namespace EcommerceGeeks\MyparcelSdk\Enums;

enum PackageType : int
{
    case Package = 1;
    case MailboxPackage = 2;
    case Letter = 3;
    case DigitalStamp = 4;
    case Pallet = 5;
    case SmallPackage = 6;
}
