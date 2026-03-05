<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'razao_social',
        'whatsapp',
        'cidade',
        'valor_conta',
        'tipo_cliente',
        'foto_conta',
        'status'
    ];

    protected $attributes = [
        'status' => 'novo'
    ];
}
