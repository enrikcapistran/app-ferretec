<?php

namespace App\Enums;

enum TableLocation: string{
    case Frente = 'front';
    case Dentro = 'inside';
    case Fuera = 'outside';
};