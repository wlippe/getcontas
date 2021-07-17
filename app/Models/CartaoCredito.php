<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaoCredito extends Model {
    use HasFactory;

    protected $table = "cartaocredito";

    protected $fillable = [
        'user_id',
        'descricao',
        'titular',
        'bandeira',
        'datavencimento',
        'digitos',
        'limite',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
