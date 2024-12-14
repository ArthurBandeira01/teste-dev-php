<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Fornecedor 1',
            'document' => '12345678901',
            'phone' => '11999999999',
            'street' => 'Rua A',
            'number' => 100,
            'district' => 'Centro',
            'mailcode' => '96503290',
            'complement' => 'Prédio 1',
            'city' => 'São Paulo',
            'state' => 'SP',
            'country' => 'Brasil',
        ]);

        Supplier::create([
            'name' => 'Fornecedor 2',
            'document' => '98765432100',
            'phone' => '21988888888',
            'street' => 'Rua B',
            'number' => 200,
            'district' => 'Zona Sul',
            'mailcode' => '96503290',
            'complement' => 'Sala 2',
            'city' => 'Rio de Janeiro',
            'state' => 'RJ',
            'country' => 'Brasil',
        ]);

        Supplier::create([
            'name' => 'Fornecedor 3',
            'document' => '12312312399',
            'phone' => '31977777777',
            'street' => 'Rua C',
            'number' => 300,
            'district' => 'Bairro Alto',
            'mailcode' => '96503290',
            'complement' => null,
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'country' => 'Brasil',
        ]);
    }
}
