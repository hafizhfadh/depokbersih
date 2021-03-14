<?php

namespace App\Services;

class OilService
{
    static function pointCounter($type, $unit, $amount)
    {
        $point = 0;
        if ($type != 'alms') {
            switch ($unit) {
                case 'mililiter':
                    $point = ($amount/1000)*10;
                    break;
                
                default:
                    $point = ($amount)*10;
                    break;
            }
        } else {
            $point = 0;
        }
        return $point;
    }
}
