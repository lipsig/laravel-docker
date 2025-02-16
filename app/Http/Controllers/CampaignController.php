<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class CampaignController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'influencer_ids' => 'required|array',
            'influencer_ids.*' => 'exists:influencers,id',
        ]);

        try {
            $campaign = Campaign::create($request->only(['name', 'budget', 'description', 'start_date', 'end_date']));
            $campaign->influencers()->attach($request->influencer_ids);

            return response()->json($campaign->load('influencers'), 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create campaign'], 500);
        }
    }

    public function index()
    {
        try {
            $campaigns = Campaign::with('influencers')->get();
            return response()->json($campaigns);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve campaigns'], 500);
        }
    }

    public function show($id)
    {
        try {
            $campaign = Campaign::with('influencers')->findOrFail($id);
            return response()->json($campaign);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Campaign not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to retrieve campaign'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'budget' => 'sometimes|required|numeric|min:0.01',
            'description' => 'nullable|string',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
        ]);

        try {
            $campaign = Campaign::findOrFail($id);
            $campaign->update($request->all());
            return response()->json($campaign->load('influencers'));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Campaign not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update campaign'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $campaign = Campaign::findOrFail($id);
            $campaign->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Campaign not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete campaign'], 500);
        }
    }

    public function attachInfluencer(Request $request, Campaign $campaign)
    {
        $request->validate([
            'influencer_id' => 'required|exists:influencers,id',
        ]);

        try {
            $campaign->influencers()->attach($request->influencer_id);
            return response()->json($campaign->load('influencers'));
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to attach influencer'], 500);
        }
    }
}