<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome',
        'descricao',
        'tipo'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
