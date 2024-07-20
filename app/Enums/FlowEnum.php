<?php

namespace App\Enums;

enum FlowEnum: string
{
    case IMPORT = 'I';
    case EXPORT = 'E';

    public static function getText(self $flow): string
    {
        return match ($flow) {
            FlowEnum::IMPORT => 'Importação',
            FlowEnum::EXPORT => 'Exportação',
        };
    }
}
