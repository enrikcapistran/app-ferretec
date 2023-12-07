<?php

namespace App\Enums;

enum TableStatus: string{
    case Pendiente = 'pending';
    case Disponible = 'available';
    case Ocupado = 'unavailable';
};