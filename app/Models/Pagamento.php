<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model {

    use HasFactory;

    protected $fillable = [
        'user_id',
        'conta_id',
        'despesa_id',
        'valor',
        'data'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}
