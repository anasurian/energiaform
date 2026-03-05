<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'nome',
        'whatsapp',
        'cidade',
        'valor_conta',
        'tipo_cliente',
        'status'
    ];

    protected $attributes = [
        'status' => 'novo'
    ];
}
