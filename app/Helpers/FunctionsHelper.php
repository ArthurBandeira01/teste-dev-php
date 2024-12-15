<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class FunctionsHelper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public function timeToBrazil(string $time)
    {
        return date("H:i", strtotime($time));
    }

    public static function formatDateBrToSql(string $data): string
    {
        return Carbon::createFromFormat('d/m/Y', $data)->format('Y-m-d');
    }

    public static function formatDateSqlToBr(string $data): string
    {
        return Carbon::createFromFormat('Y-m-d', $data)->format('d/m/Y');
    }

    public static function formatDecimalBrToSql(string $value): float
    {
        $value = preg_replace('/[^\d,]/', '', $value);
        $value = str_replace(',', '.', $value);
        return (float) $value;
    }

    public static function formatDecimalSqlToCurrencyBr(float $valor): string
    {
        return number_format($valor, 2, ',', '.');
    }

    public static function maskCpfCnpj($document)
    {
        if (strlen($document) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $document);
        }

        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $document);
    }

    // Remove caracteres que não sejam números no documento
    public static function removeMaskCpfCnpj(string $document)
    {
        return preg_replace('/[^0-9]/', '', $document);
    }

    public static function validCpf(string $cpf)
    {
         // Verificar se o CPF é composto por números repetidos, como "11111111111", "22222222222", etc.
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcular o 1° dígito verificador
        $sum1 = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum1 += $cpf[$i] * (10 - $i);
        }
        $digit1 = 11 - ($sum1 % 11);
        if ($digit1 >= 10) {
            $digit1 = 0;
        }

        // Calcula o 2° dígito verificador
        $sum2 = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum2 += $cpf[$i] * (11 - $i);
        }
        $digit2 = 11 - ($sum2 % 11);
        if ($digit2 >= 10) {
            $digit2 = 0;
        }

        // Verificar se os dígitos calculados são iguais aos do CPF informado
        if ($cpf[9] == $digit1 && $cpf[10] == $digit2) {
            return true;
        }

        return false;
    }

    public static function verifyDocument(string $document)
    {
        $documentVerify = self::removeMaskCpfCnpj($document);

        if (strlen($documentVerify) === 11) {
            return self::validCpf($documentVerify);
        } else {
            // Chama a API da BrasilAPI para validar o CNPJ
            $response = Http::get('https://brasilapi.com.br/api/cnpj/v1/' . $documentVerify);

            if ($response->successful()) {
                return true;
            }

            return false;
        }
    }

    public static function verifyCep(string $cep)
    {
        $response = Http::get('https://viacep.com.br/ws/' . $cep . '/json/');

        if ($response->successful() && $response->json('erro') === null) {
            return true;
        }

        return false;
    }
}
