<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
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

        return response()->json($course, 201);
    }


    public function show($id)
    {
        return Course::findOrFail($id);
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
            // حذف الصورة القديمة إذا كانت موجودة
            if ($course->image && Storage::disk('public')->exists(str_replace('/storage/', '', $course->image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $course->image));
            }

            $path = $request->file('image')->store('courses', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $course->update($data);

        return response()->json($course);
    }


    public function destroy($id)
    {
        Course::destroy($id);

        return response()->json(['message' => 'Course deleted']);
    }
}
