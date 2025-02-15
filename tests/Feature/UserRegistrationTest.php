<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase; 

    public function testUserCanRegister()
    {
        // Dados para o novo usuário
        $data = [
            'name' => 'João Silva',
            'email' => 'joao@exemplo.com',
            'password' => 'senha123'
        ];

        // Envia um POST para a rota de cadastro
        $response = $this->postJson('/api/register', $data);

        // Verifica se o usuário foi criado e a resposta é válida
        $response->assertStatus(201)
                 ->assertJsonStructure([
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ]);

        // Verifica se o usuário foi realmente criado no banco de dados
        $this->assertDatabaseHas('users', [
            'email' => 'joao@exemplo.com',
        ]);
    }
}
