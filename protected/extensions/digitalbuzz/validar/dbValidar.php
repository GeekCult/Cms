<?php

class dbValidar {
    function replace($string) {
        return $string = str_replace("/","", str_replace("-","",str_replace(".","",$string)));
    }
    
    function replacePhone($string) {
        $string = str_replace("/","", str_replace("-","", str_replace(".","",str_replace("(","",str_replace(")","",str_replace(" ","", $string))))));
        return (int)$string;
    }

    function is_date( $str ) {
        $str = str_replace("/", "-", $str);
        $stamp = strtotime( $str );
        if (!is_numeric($stamp)) {
            return FALSE;
        }
        $month = date( 'm', $stamp );
        $day   = date( 'd', $stamp );
        $year  = date( 'Y', $stamp );
        if (checkdate($month, $day, $year)) {
            return TRUE;
        }

        return FALSE;
    }

    function epoch( $str ) {
        $str = str_replace("/", "-", $str);
        $stamp = strtotime( $str );
        if (!is_numeric($stamp)) {
            return FALSE;
        }
        $month = date( 'm', $stamp );
        $day   = date( 'd', $stamp );
        $year  = date( 'Y', $stamp );
        if (checkdate($month, $day, $year)) {
            
            return mktime(0,0,0,$month,$day,$year); //,0); // Mauro mandou deixar fora

        }

            return false;
    }

    function estampa( $str ) {
        $str = str_replace("/", "-", $str);
        $stamp = strtotime( $str );
        return date('c', $stamp);

    }

    function check_fake($string, $length) {
        for($i = 0; $i <= 9; $i++) {
            $fake = str_pad("", $length, $i);
            if($string === $fake)
                return(1);
        }
    }

    function cpf($cpf) {
        $cpf = $this->replace($cpf);
        $cpf = trim($cpf);
        $dv = 0;
        if(empty($cpf) || strlen($cpf) != 11)
            return FALSE;
        else {
            if($this->check_fake($cpf, 11))
                return FALSE;
            else {
                $sub_cpf = substr($cpf, 0, 9);
                for($i = 0; $i < 9; $i++) {
                    $dv += ($sub_cpf[$i] * (10-$i));
                }
                if($dv == 0)
                    return FALSE;
                $dv = 11 - ($dv % 11);
                if($dv > 9)
                    $dv = 0;
                if($cpf[9] != $dv)
                    return FALSE;

                $dv *= 2;
                for($i = 0; $i < 9; $i++) {
                    $dv += ($sub_cpf[$i] * (11-$i));
                }
                $dv = 11 - ($dv % 11);
                if($dv > 9)
                    $dv = 0;
                if($cpf[10] != $dv)
                    return FALSE;
                return TRUE;
            }
        }
    }

    function cnpj($cnpj) {
        $cnpj = $this->replace($cnpj);
        $cnpj = trim($cnpj);
        $sum = 0;
        if(empty($cnpj) || strlen($cnpj) != 14)
            return FALSE;
        else {
            if($this->check_fake($cnpj, 14))
                return FALSE;
            else {
                $rev_cnpj = strrev(substr($cnpj, 0, 12));
                for($i = 0; $i <= 11; $i++) {
                    $i == 0 ? $multiplier = 2 : $multiplier;
                    $i == 8 ? $multiplier = 2 : $multiplier;
                    $multiply = ($rev_cnpj[$i] * $multiplier);
                    $sum = $sum + $multiply;
                    $multiplier++;
                }
                $rest = $sum % 11;
                if($rest == 0 || $rest == 1)
                    $dv1 = 0;
                else
                    $dv1 = 11 - $rest;

                $sub_cnpj = substr($cnpj, 0, 12);
                $rev_cnpj = strrev($sub_cnpj.$dv1);
                unset($sum);
                $sum = 0;
                for($i = 0; $i <= 12; $i++) {

                    $i == 0 ? $multiplier = 2 : $multiplier;
                    $i == 8 ? $multiplier = 2 : $multiplier;
                    $multiply = ($rev_cnpj[$i] * $multiplier);
                    $sum = $sum + $multiply;
                    $multiplier++;
                }
                $rest = $sum % 11;
                if($rest == 0 || $rest == 1)
                    $dv2 = 0;
                else
                    $dv2 = 11 - $rest;

                if($dv1 == $cnpj[12] && $dv2 == $cnpj[13])
                    return TRUE;
                else
                    return FALSE;
            }
        }
    }

    function email($emailstring){

        if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $emailstring)) {
            return false;
        } else {
            return true;
        }
    }
}

?>