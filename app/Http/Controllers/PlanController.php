<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return Plan::all();
    }

    public function show($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['message' => 'Plan not found'], 404);
        }

        return response()->json($plan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'period' => 'required|string',
            'highlighted' => 'required|boolean',
            'features' => 'required|string',
            'button_text' => 'required|string',
        ]);

        Plan::create($request->all());

        return response()->json(['message' => 'Plan created successfully'], 201);
    }


    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'period' => 'required|string',
            'highlighted' => 'required|boolean',
            'features' => 'required|string',
            'button_text' => 'required|string',
        ]);

        $plan->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'period' => $request->period,
            'features' => $request->features,
            'highlighted' => $request->highlighted,
            'button_text' => $request->button_text,
        ]);

        return response()->json(['message' => 'Plan updated successfully.']);
    }

    public function destroy($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json(['message' => 'Plan not found'], 404);
        }

        $plan->delete();

        return response()->json(['message' => 'Plan deleted successfully']);
    }
}
