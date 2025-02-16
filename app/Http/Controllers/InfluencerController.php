<?php

namespace App\Http\Controllers;

use App\Models\Influencer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class InfluencerController extends Controller
{
    public function index()
    {
        try {
            $influencers = Influencer::all();
            return response()->json($influencers);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve influencers'], 500);
        }
    }
   
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'instagram_user' => 'required|string|max:255|unique:influencers',
                'followers_count' => 'required|integer|min:1',
                'category' => 'required|string|max:255',
            ]);
    
            $influencer = Influencer::create($request->all());
    
            return response()->json($influencer, 201);
    
        } catch (ValidationException $e) {
            Log::error('Validation error:', $e->errors());
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors(),
            ], 422);
    
        } catch (QueryException $e) {
            Log::error('QueryException error:', [
                'error' => $e->getMessage(),
                'code' => $e->errorInfo[1]
            ]);
    
            if ($e->errorInfo[1] == 1062) {
                if (str_contains($e->getMessage(), 'instagram_user')) {
                    return response()->json([
                        'error' => 'The Instagram username is already in use.'
                    ], 400);
                }
            }
    
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage(),
            ], 500);
    
        } catch (\Exception $e) {
            Log::error('General exception error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create influencer'], 500);
        }
    }
    

    public function show($id)
    {
        try {
            $influencer = Influencer::findOrFail($id);
            return response()->json($influencer);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Influencer not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve influencer'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'instagram_user' => 'sometimes|required|string|max:255|unique:influencers,instagram_user,' . $id,
                'followers_count' => 'sometimes|required|integer|min:1',
                'category' => 'sometimes|required|string|max:255',
            ]);

            $influencer = Influencer::findOrFail($id);
            $influencer->update($request->all());
            return response()->json($influencer);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Influencer not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update influencer'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $influencer = Influencer::findOrFail($id);
            $influencer->delete();
            return response()->json(['message' => 'Influencer deleted successfully'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Influencer not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete influencer'], 500);
        }
    }
}