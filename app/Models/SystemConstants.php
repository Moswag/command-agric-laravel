<?php


namespace App\Models;


class SystemConstants
{

    const ACCESS_ADMIN = 'Admin';
    const ACCESS_FARMER = 'Farmer';
    const ACCESS_EXPERT = 'Expert';

    const STATUS_ACTIVE = 'Active';
    const STATUS_DISABLED = 'Disabled';

    const DEFAULT_PASSWORD = '12345678';

    const STATUS_PENDING = 'Pending';
    const STATUS_RESOLVED = 'Resolved';
    const FARM_STATUS_VACANT = 'Vacant';
    const FARM_OCCUPIED_OCCUPIED = 'Occupied';

    const YIELD_EXCEED = 'Exceed';
    const YIELD_SHORT= 'Short';
    const YIELD_EQUALISED = 'Equalised';

}
