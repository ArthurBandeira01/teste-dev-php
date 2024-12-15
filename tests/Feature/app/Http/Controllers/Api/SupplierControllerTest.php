<?php

use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

uses(RefreshDatabase::class)->beforeEach(function () {
    $this->supplierService = m::mock(SupplierService::class);
    $this->app->instance(SupplierService::class, $this->supplierService);
});

test('deve listar todos os fornecedores', function () {
    $this->supplierService->shouldReceive('list')->once()->andReturn(collect([]));

    $response = $this->getJson('/api/suppliers');
    $response->assertStatus(200);
});

test('deve criar um novo fornecedor com sucesso', function () {
    $payload = [
            "name" => "Arthur Bandeira",
            "email" => "arthur@gmail.com",
            "document" => "37565587117",
            "phone" => "(51) 9 95068118",
            "street" => "Mário Godoy Ilha",
            "number" => 240,
            "district" => "Medianeira",
            "complement" => null,
            "mailcode" => "96503290",
            "city" => "Cachoeira do Sul",
            "state" => "RS",
            "country" => "Brasil"
    ];

    $this->supplierService->shouldReceive('store')->once();

    $response = $this->postJson('/api/suppliers', $payload);
    $response->assertStatus(201)->assertJson(['message' => 'Fornecedor criado com sucesso']);
});


test('deve retornar erro se o mailcode não for fornecido', function () {
    $payload = [
        "name" => "Arthur Bandeira",
        "email" => "arthur@gmail.com",
        "document" => "37565587117",
        "phone" => "(51) 9 95068118",
        "street" => "Mário Godoy Ilha",
        "number" => 240,
        "district" => "Medianeira",
        "complement" => null,
        "city" => "Cachoeira do Sul",
        "state" => "RS",
        "country" => "Brasil"
    ];

    $this->supplierService->shouldReceive('store')->never();

    $response = $this->postJson('/api/suppliers', $payload);
    $response->assertStatus(422)->assertJsonValidationErrors('mailcode');
});

test('deve atualizar um fornecedor com sucesso', function () {
    $payload = [
        "name" => "Arthur Bandeira Atualizado",
        "email" => "arthur@gmail.com",
        "document" => "37565587117",
        "phone" => "(51) 9 95068118",
        "street" => "Mário Godoy Ilha Atualizada",
        "number" => 240,
        "district" => "Medianeira",
        "complement" => null,
        "mailcode" => "96503290",
        "city" => "Cachoeira do Sul",
        "state" => "RS",
        "country" => "Brasil"
    ];

    $this->supplierService->shouldReceive('update')
                          ->once()
                          ->with('123', $payload)
                          ->andReturn(true);

    $response = $this->putJson('/api/suppliers/123', $payload);
    $response->assertStatus(201)->assertJson(['message' => 'Fornecedor atualizado com sucesso']);
});

test('deve excluir um fornecedor com sucesso', function () {
    $this->supplierService->shouldReceive('destroy')
                          ->once()
                          ->with('123')
                          ->andReturn(true);

    $response = $this->deleteJson('/api/suppliers/123');
    $response->assertStatus(200)->assertJson(['message' => 'Fornecedor excluído com sucesso']);
});
