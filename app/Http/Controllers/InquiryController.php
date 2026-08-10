<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'inquiry_type' => 'nullable|string|max:255',
            'service_type' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'form_source' => 'nullable|string|max:50',
            'budget_range' => 'nullable|string|max:100',
            'message' => 'nullable|string',
            'extra_data' => 'nullable|string',
        ]);

        // Mapping fields as per original logic
        $serviceType = $request->input('service_type') ?? $request->input('inquiry_type') ?? '';
        
        $formType = $request->input('form_source') ?? 'conversational_lead';

        try {
            Inquiry::create([
                'form_type' => $formType,
                'name' => $validated['name'],
                'company' => $validated['company'] ?? '',
                'service_type' => $serviceType,
                'email' => $validated['email'] ?? '',
                'phone' => $validated['phone'],
                'budget_range' => $validated['budget_range'] ?? null,
                'message' => $validated['message'] ?? null,
                'extra_data' => $validated['extra_data'] ?? null,
                'status' => 'New',
            ]);
            
            // Redirect back with success session
            return back()->with('success', true);
            
        } catch (\Exception $e) {
            // If DB is down or connection fails, log or ignore gracefully to not crash
            // The original logic returned a JSON error if it wasn't a standard form redirect,
            // but the contact form redirects anyway. Let's redirect with error.
            return back()->with('error', 'Database connection failed. Please try again later.');
        }
    }
}
