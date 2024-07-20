<?php

namespace App\Enums;

enum TransportEnum: string
{
    case AIR = 'A';
    case MARITIME = 'M';
    case ROAD = 'R';

    public static function getText(self $transport): string
    {
        return match ($transport) {
            TransportEnum::AIR => 'Aéreo',
            TransportEnum::MARITIME => 'Marítimo',
            TransportEnum::ROAD => 'Rodoviário',
        };
    }
}
