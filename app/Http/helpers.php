<?php

use Illuminate\Support\Carbon;


    function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset ($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset ($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

    function urlAmigavel($string) {
        $string = preg_replace('/[\t\n]/', ' ', $string);
        $string = preg_replace('/\s{2,}/', ' ', $string);
        $list = array(
            'Š' => 'S',
            'š' => 's',
            'Đ' => 'Dj',
            'đ' => 'dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'Č' => 'C',
            'č' => 'c',
            'Ć' => 'C',
            'ć' => 'c',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'Ŕ' => 'R',
            'ŕ' => 'r',
            '/' => '-',
            ' ' => '-',
            '.' => '-',
            'ª' => '',
        );

        $string = strtr($string, $list);
        $string = preg_replace('/-{2,}/', '-', $string);
        $string = strtolower($string);

        return $string;

    }

    function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){

        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*_+="; // $si contem os símbolos

        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha = str_shuffle($ma);
        }

        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }

        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }

        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
    }

    function gerarMatricula($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){

        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*_+="; // $si contem os símbolos

        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha = str_shuffle($ma);
        }

        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }

        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }

        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
    }

    function gerar_protocolo($tamanho, $maiusculas, $timestamp){

        $ma        = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $ti        = preg_replace("/[^0-9]/", "", date('Y-m-d H:i:s'));

        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha = substr(str_shuffle($ma),0,3);
        }

        if ($timestamp){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($ti);
        }

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr($senha,0,$tamanho);
    }

    function limpaString($valor){
        return preg_replace('/[^0-9]/', "", $valor);
    }

    function getValorView($value)
    {
        //$valorEmpenho = ltrim($value, '0');
        $valor =  number_format($value , 2, ',', '.');
        return number_format($value , 2, ',', '.');
    }

    function getCpfCnpj($value)
    {
        return strlen($value) == 11 ? mask($value,'###.###.###-##') : mask($value,'##.###.###/####-##')  ;
    }

    function getFixoCelular($value)
    {
        return strlen($value) == 10 ? mask($value,'(##)####-####') : mask($value,'(##)#####-####')  ;
    }

    function getCep($value)
    {
        return mask($value,'#####-###');
    }

    function getDdd($value)
    {
        $ddd = limpaString($value);
        return mb_substr($ddd,0,2);
    }

    function getConverteParaTotal($value)
    {
        $valures =  preg_replace('/[^0-9]/', "", $value);

        return number_format($valures , 2, '.', '');
    }

    function getfome($value)
    {
        $phone = limpaString($value);
        return mb_substr($phone,2,9);
    }

    function tiraAcento($string)
    {
        $list = array(
            'Š' => 'S',
            'š' => 's',
            'Đ' => 'Dj',
            'đ' => 'dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'Č' => 'C',
            'č' => 'c',
            'Ć' => 'C',
            'ć' => 'c',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'Ŕ' => 'R',
            'ŕ' => 'r',
            '/' => '-',
            ' ' => '-',
            '.' => '-',
            'ª' => '',
        );

        return strtr($string, $list);
    }

    function valorReverte($valor){
        $valorBanco = preg_replace('/[^0-9]/', "", $valor);
        return substr($valorBanco,0,-2).".".substr($valorBanco,-2);
    }
