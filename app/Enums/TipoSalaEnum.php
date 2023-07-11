<?php

namespace App\Enums;

class TipoSalaEnum
{
    const NORMAL = "Normal";
    const _3D = "3D";
    const _3D_BOX = "3D-Box";
    const COMFORT = "Comfort";
    const VIP = "Vip";

    public static function get()
    {
        return [
            self::NORMAL => self::NORMAL,
            self::_3D => self::_3D,
            self::_3D_BOX => self::_3D_BOX,
            self::COMFORT => self::COMFORT,
            self::VIP => self::VIP,
        ];
    }
}
