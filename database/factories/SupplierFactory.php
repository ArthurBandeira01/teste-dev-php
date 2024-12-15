<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;
use App\Helpers\FunctionsHelper;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        $faker = Faker::create('pt_BR');

        return [
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'document' => FunctionsHelper::removeMaskCpfCnpj($faker->cpf),
            'phone' => $this->faker->phoneNumber,
            'street' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'district' => $this->faker->city,
            'complement' => $this->faker->secondaryAddress,
            'mailcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'country' => 'Brasil',
        ];
    }
}
