<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model {

    protected $fillable = [
        'user_id',
        'cartaocredito_id',
        'descricao',
        'datavencimento',
        'valor',
        'tipo',
        'situacao',
        'parcela',
        'parcelastotal'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
