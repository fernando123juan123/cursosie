<?php

if (!defined('BASEPATH'))
    exit('No tiene acceso a esta pagina');

function encrypt_string() {
    $caracteres_permitidos = '#.-/0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $fer=substr(str_shuffle($caracteres_permitidos), 0, 12);
    return $fer;
}
function encrypt_id($string) {
    $key='fernando';
    $root = '';
    for($i=0; $i<strlen($string); $i++) {
          $char = substr($string, $i, 1);
          $keychar = substr($key, ($i % strlen($key))-1, 1);
          $char = chr(ord($char)+ord($keychar));
          $root.=$char;
    }
    $juan=base64_encode($root);
    $fer = str_replace(array('+','/','='),array('-','_','JCferCM0UW'),$juan);
    return $fer;
}
function decrypt_id($string) {
    $key='fernando';
    $string = str_replace(array('-','_','JCferCM0UW'),array('+','/','='),$string);
    $fernando = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
          $char = substr($string, $i, 1);
          $keychar = substr($key, ($i % strlen($key))-1, 1);
          $char = chr(ord($char)-ord($keychar));
          $fernando.=$char;
    }
    return $fernando;
}
function mostrar_cantidad_numeros($obj){
    if ($obj>0 && $obj<=9) {
        return '000000'.$obj;
    }else{
        if ($obj>=10 && $obj<=99) {
            return '00000'.$obj;
        }else{
            if ($obj>=100 && $obj<=999) {
                return '0000'.$obj;
            }else{
                if ($obj>=1000 && $obj<=9999) {
                    return '000'.$obj;
                }else{
                    if ($obj>=10000 && $obj<=99999) {
                        return '00'.$obj;
                    }else{
                        if ($obj>=100000 && $obj<=999999) {
                            return '0'.$obj;
                        }else{
                            if ($obj>=10000000 && $obj<=99999999) {
                                return $obj;
                            }else{
                                if ($obj>=100000000 && $obj<=999999999) {
                                    return $obj;
                                }else{
                                    return $obj;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
function fecha_literal($Fecha, $Formato = 2) {
    $dias = array(0 => 'Domingo', 1 => 'Lunes', 2 => 'Martes', 3 => 'Mièrcoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sàbado');
    $meses = array(1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo', 6 => 'junio',
        7 => 'julio', 8 => 'agosto', 9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre');
    $aux = date_parse($Fecha);
    switch ($Formato) {
        case 1:  // 04/10/10
            return date('d/m/y', strtotime($Fecha));
        case 2:  //04/oct/10
            return sprintf('%02d/%s/%02d', $aux['day'], substr($meses[$aux['month']], 0, 3), $aux['year'] % 100);
        case 3:   //octubre 4, 2010
            return $meses[$aux['month']] . ' ' . sprintf('%.2d', $aux['day']) . ', ' . $aux['year'];
        case 4:   // 4 de octubre de 2010
            return $aux['day'] . ' de ' . $meses[$aux['month']] . ' de ' . $aux['year'];
        case 5:   //lunes 4 de octubre de 2010
            $numeroDia= date('w', strtotime($Fecha));
            return $dias[$numeroDia].' '.$aux['day'] . ' de ' . $meses[$aux['month']] . ' de ' . $aux['year'];
        case 6:
            return date('d/m/Y', strtotime($Fecha));
        default:
            return date('d/m/Y', strtotime($Fecha));
    }
}



?>