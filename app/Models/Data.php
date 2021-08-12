<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model {

    public static function getFirstDay($data) {
        return $data->ano.'-'.$data->mes.'-01';
    }

    public static  function getLastDay($data) {
        $dia = self::getLastDayInMonth($data->mes);

        return $data->ano.'-'.$data->mes.'-'.$dia;
    }

    public static function getLastDayInMonth($mes) {
        if($mes == 2) {
            $dia = 28;
        }
        else if( in_array($mes, [1,3,5,7,8,10,12]) ) {
            $dia = 31;
        }
        else {
            $dia = 30;
        }

        return $dia;
    } 
}
