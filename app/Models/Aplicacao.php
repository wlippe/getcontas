<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicacao extends Model {
    use HasFactory;

    protected $table = "aplicacoes";

    protected $fillable = [
        'user_id',
        'nome',
        'objetivo',
        'aplicadoinicial',
        'aplicadomensal',
        'rendimentoanual',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
