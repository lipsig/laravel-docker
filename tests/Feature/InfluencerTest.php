<?php

namespace Tests\Feature;

use App\Models\Influencer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InfluencerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateInfluencer()
    {
        $data = [
            'name' => 'John Doe',
            'instagram_user' => 'johndoe',
            'followers_count' => 1000,
            'category' => 'Technology',
        ];

        $response = $this->postJson('/api/influencers', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id', 'name', 'instagram_user', 'followers_count', 'category', 'created_at', 'updated_at'
                 ]);

        $this->assertDatabaseHas('influencers', ['instagram_user' => 'johndoe']);
    }

    public function testCanListInfluencers()
    {
        Influencer::factory()->count(3)->create();

        $response = $this->getJson('/api/influencers');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }
}