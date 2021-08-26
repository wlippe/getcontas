<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extrato extends Model {

    use HasFactory;

    protected $fillable = [
        'user_id',
        'receita_id',
        'aplicacao_id',
        'conta_id',
        'valor',
        'tipo',
        'lancamento',
        'data'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
