<?php

namespace App\Module\Reponse;

enum ReponseType: int
{
    case PRIORITAIRE = 1;
    case DANS_L_HEURE = 2;
    case DANS_LA_JOURNEE = 3;
    case DANS_LES_48_HEURES = 4;

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }
}
