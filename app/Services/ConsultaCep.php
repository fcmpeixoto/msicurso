<?php


namespace App\Services;


use Canducci\ZipCode\ZipCodeAddressTrait;

class ConsultaCep
{
    use ZipCodeAddressTrait;

    public static function verificaCep($cep)
    {
        $zipCodeInfo =	zipcode(preg_replace('/[^0-9]/', "", $cep));

        return $zipCodeInfo->getArray();
    }
}
