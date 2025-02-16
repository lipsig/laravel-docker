<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanLogin()
    {
        // Cria um usuário para realizar o login
        $user = User::factory()->create([
            'name' => 'João Silva',
            'email' => 'joao2@exemplo.com',
            'password' => bcrypt('senha123'),  
        ]);

        // Dados de login
        $data = [
            'email' => 'joao2@exemplo.com',
            'password' => 'senha123'
        ];

        // Envia um POST para a rota de login
        $response = $this->postJson('/api/login', $data);

        // Verifica se o status da resposta é 200 e se a resposta contém o token de autenticação
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'token',  // Verifique se a resposta retorna o token JWT ou outro tipo de token
                 ]);

        // Verifica se o usuário foi autenticado com sucesso
        $this->assertAuthenticatedAs($user);
    }
}
