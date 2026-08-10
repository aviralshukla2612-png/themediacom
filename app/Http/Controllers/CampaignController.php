<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        // Fetch all campaigns, ordered by featured first, then newest
        $campaigns = [];
        try {
            $campaigns = Campaign::orderBy('featured', 'desc')->orderBy('id', 'desc')->get();
        } catch (\Exception $e) {
            // fallback if DB not ready
        }
        
        return view('campaigns.index', compact('campaigns'));
    }

    public function show($id)
    {
        try {
            $campaign = Campaign::findOrFail($id);
            return view('campaigns.show', compact('campaign'));
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
