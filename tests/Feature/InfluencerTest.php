<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Influencer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InfluencerTest extends TestCase
{
    use RefreshDatabase;

    private function authenticate()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);

        return $response->json('token');
    }

    public function testCanCreateInfluencer()
    {
        $token = $this->authenticate();

        $data = [
            'name' => 'John Doe',
            'instagram_user' => 'johndoe',
            'followers_count' => 1000,
            'category' => 'Technology',
        ];

        $response = $this->postJson('/api/influencers', $data, ['Authorization' => "Bearer $token"]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id', 'name', 'instagram_user', 'followers_count', 'category', 'created_at', 'updated_at'
                 ]);

        $this->assertDatabaseHas('influencers', ['instagram_user' => 'johndoe']);
    }

    public function testCanListInfluencers()
    {
        $token = $this->authenticate();

        Influencer::factory()->count(3)->create();

        $response = $this->getJson('/api/influencers', ['Authorization' => "Bearer $token"]);

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function testCanShowInfluencer()
    {
        $token = $this->authenticate();

        $influencer = Influencer::factory()->create();

        $response = $this->getJson("/api/influencers/{$influencer->id}", ['Authorization' => "Bearer $token"]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id', 'name', 'instagram_user', 'followers_count', 'category', 'created_at', 'updated_at'
                 ]);
    }

    public function testCanUpdateInfluencer()
    {
        $token = $this->authenticate();

        $influencer = Influencer::factory()->create();

        $data = [
            'name' => 'Jane Doe',
            'instagram_user' => 'janedoe',
            'followers_count' => 2000,
            'category' => 'Lifestyle',
        ];

        $response = $this->putJson("/api/influencers/{$influencer->id}", $data, ['Authorization' => "Bearer $token"]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id', 'name', 'instagram_user', 'followers_count', 'category', 'created_at', 'updated_at'
                 ]);

        $this->assertDatabaseHas('influencers', ['instagram_user' => 'janedoe']);
    }

    public function testCanDeleteInfluencer()
    {
        $token = $this->authenticate();

        $influencer = Influencer::factory()->create();

        $response = $this->deleteJson("/api/influencers/{$influencer->id}", [], ['Authorization' => "Bearer $token"]);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('influencers', ['id' => $influencer->id]);
    }
}


