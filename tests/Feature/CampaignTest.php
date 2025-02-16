<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Influencer;
use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    private function authenticate()
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);

        return $response->json('token');
    }

    public function testCanCreateCampaign()
    {
        $token = $this->authenticate();

        $influencers = Influencer::factory()->count(3)->create();

        $data = [
            'name' => 'New Campaign',
            'budget' => 5000,
            'description' => 'This is a test campaign',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonth()->toDateString(),
            'influencer_ids' => $influencers->pluck('id')->toArray(),
        ];

        $response = $this->postJson('/api/campaigns', $data, ['Authorization' => "Bearer $token"]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id', 'name', 'budget', 'description', 'start_date', 'end_date', 'created_at', 'updated_at', 'influencers'
                 ]);

        $this->assertDatabaseHas('campaigns', ['name' => 'New Campaign']);

        $campaignId = $response->json('id');
        foreach ($influencers as $influencer) {
            $this->assertDatabaseHas('campaign_influencer', [
                'campaign_id' => $campaignId,
                'influencer_id' => $influencer->id,
            ]);
        }
    }

    public function testCanListCampaigns()
    {
        $token = $this->authenticate();

        Campaign::factory()->count(3)->create();

        $response = $this->getJson('/api/campaigns', ['Authorization' => "Bearer $token"]);

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function testCanShowCampaign()
    {
        $token = $this->authenticate();

        $campaign = Campaign::factory()->create();

        $response = $this->getJson("/api/campaigns/{$campaign->id}", ['Authorization' => "Bearer $token"]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id', 'name', 'budget', 'description', 'start_date', 'end_date', 'created_at', 'updated_at', 'influencers'
                 ]);
    }

    public function testCanUpdateCampaign()
    {
        $token = $this->authenticate();

        $campaign = Campaign::factory()->create();

        $data = [
            'name' => 'Updated Campaign',
            'budget' => 10000,
            'description' => 'This is an updated test campaign',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonth()->toDateString(),
        ];

        $response = $this->putJson("/api/campaigns/{$campaign->id}", $data, ['Authorization' => "Bearer $token"]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id', 'name', 'budget', 'description', 'start_date', 'end_date', 'created_at', 'updated_at', 'influencers'
                 ]);

        $this->assertDatabaseHas('campaigns', ['name' => 'Updated Campaign']);
    }

    public function testCanDeleteCampaign()
    {
        $token = $this->authenticate();

        $campaign = Campaign::factory()->create();

        $response = $this->deleteJson("/api/campaigns/{$campaign->id}", [], ['Authorization' => "Bearer $token"]);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('campaigns', ['id' => $campaign->id]);
    }
}