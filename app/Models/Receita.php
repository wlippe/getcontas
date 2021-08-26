<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model {
    use HasFactory;
   
    protected $fillable = [
        'user_id',
        'conta_id',
        'descricao',
        'valor',
        'tipo',
        'data',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}