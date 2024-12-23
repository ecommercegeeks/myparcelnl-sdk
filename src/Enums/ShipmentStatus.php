<?php

namespace EcommerceGeeks\MyparcelSdk\Enums;

enum ShipmentStatus: int
{
    case pending_concept = 1;
    case pending_registered = 2;
    case enroute_handed_to_carrier = 3;
    case enroute_sorting = 4;
    case enroute_distribution = 5;
    case enroute_customs = 6;
    case delivered_at_recipient = 7;
    case delivered_ready_for_pickup = 8;
    case delivered_package_picked_up = 9;
    case delivered_return_shipment_ready_for_pickup = 10;
    case delivered_return_shipment_package_picked_up = 11;
    case printed_letter = 12;
    case inactive_credited = 13;
    case printed_digital_stamp = 14;
    case printed_untracked_shipment = 18;
    case inactive_concept = 30;
    case inactive_registered = 31;
    case inactive_enroute_handed_to_carrier = 32;
    case inactive_enroute_sorting = 33;
    case inactive_enroute_distribution = 34;
    case inactive_enroute_customs = 35;
    case inactive_delivered_at_recipient = 36;
    case inactive_delivered_ready_for_pickup = 37;
    case inactive_delivered_package_picked_up = 38;
}
