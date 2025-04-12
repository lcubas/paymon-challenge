<?php

namespace App\Enums;

enum EnrollmentStatus: string
{
    case ACTIVE = 'active';
    case COMPLETED = 'completed';
    case DROPPED = 'dropped';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Activo',
            self::COMPLETED => 'Completado',
            self::DROPPED => 'De baja',
        };
    }
}
