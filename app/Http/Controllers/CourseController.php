<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all()->map(function ($course) {
            return [
                'id' => $course->id,
                'title' => $course->title,
                'description' => $course->description,
                'price' => $course->price,
                'image' => $course->image ? url($course->image) : null,
            ];
        });

        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'price']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courses', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $course = Course::create($data);

        return response()->json([
            'id' => $course->id,
            'title' => $course->title,
            'description' => $course->description,
            'price' => $course->price,
            'image' => $course->image ? url($course->image) : null,
        ], 201);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);

        return response()->json([
            'id' => $course->id,
            'title' => $course->title,
            'description' => $course->description,
            'price' => $course->price,
            'image' => $course->image ? url($course->image) : null,
        ]);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'price']);

        if ($request->hasFile('image')) {
            if ($course->image && Storage::disk('public')->exists(str_replace('/storage/', '', $course->image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $course->image));
            }

            $path = $request->file('image')->store('courses', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $course->update($data);

        return response()->json([
            'id' => $course->id,
            'title' => $course->title,
            'description' => $course->description,
            'price' => $course->price,
            'image' => $course->image ? url($course->image) : null,
        ]);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->image && Storage::disk('public')->exists(str_replace('/storage/', '', $course->image))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $course->image));
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted']);
    }
}
