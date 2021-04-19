<?php
namespace App\Helpers;

use Carbon\Carbon;

class Helper
{
    public static function showOrderStatus($status)
    {
        switch($status)
        {
            case 1:
                return "Approval";
                break;
            case 2:
                return "On-Going";
                break;
            case 3:
                return "Done";
                break;
            case 4:
                return "Collected";
                break;
        }
    }

    public static function showPrice($price)
    {
        return 'P'.$price.'.00';
    }

    public static function showDateTime($date_finish)
    {
        return Carbon::parse($date_finish)->format('M d Y h:mA');
    }
}