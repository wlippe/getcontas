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

    public static function extractDay($data) {
        return intval(substr($data, 8, 2));
    }

    public static function extractMonth($data) {
        return intval(substr($data, 5, 2));
    }

    public static function extractYear($data) {
        return intval(substr($data, 1, 4));
    }

    public static  function addMes($data, $iMes) {
        $dia = self::extractDay($data);
        $mes = self::extractMonth($data);
        $ano = self::extractYear($data);
 
        for ($indice = 1; $indice <= $iMes; $indice++) {
            if ($mes < 12) {
                $mes = $mes + 1;
            }
            else {
                $mes = 1;
                $ano = $ano + 1;
            }
        }

        return '20'.$ano.'-'.self::trataDigito($mes).'-'.self::trataDigito($dia);
    }

    private static function trataDigito($digito) {
        if($digito < 10){
            return '0'.$digito;
        }

        return $digito;
    }
}
